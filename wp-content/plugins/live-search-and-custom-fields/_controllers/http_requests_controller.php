<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
include LSCF_PLUGIN_PATH . '_models/http_requests_model.php';

/**
 * Class HttpRequestsController Controller used for angular $http requests
 *
 * @category Controller
 * @package  HttpRequests
 * @author   PIXOLETTE
 * @license  http://www.pixollete.com
 * @link     http://www.pixollete.com
 **/
class HttpRequestsController {

	/**
	 * The Http Requests Model.
	 *
	 * @access private
	 * @var Class|Object
	 */
	private $model;

	/**
	 * The Class constructor.
	 * Load the HTTP Requests Model
	 *
	 * @access public
	 * @var function|Class constructor
	 */
	function __construct() {

		$this->model = new HttpRequestsModel();

	}


	/**
	 * Retrieve subcategories from each term in a hierarchical order.
	 *
	 * @param array $taxonomy Filter taxonomy array.
	 * @access public
	 * @var array
	 */
	function retrieve_subcategories_hierarchical( $taxonomy ) {

		$cc = 0;
		$terms_ids = array();
		$cat_data = array();

		foreach ( $taxonomy['terms'] as $term ) {

			if ( ! isset( $term['subcategs'] ) || '' == $term['subcategs'] ) {
				continue;
			}

			$subcategs = get_terms( $taxonomy['slug'], array( 'child_of' => (int) $term['data']['value'], 'hide_empty' => false ) );

			$terms_ids[ $term['data']['value'] ] = 0;

			$cat_data[ $term['data']['value'] ] = $term['data'];

			foreach ( $subcategs as $subcateg ) {

				$cat_data[ $subcateg->term_id ] = $subcateg;

				$terms_ids[ $subcateg->term_id ] = $subcateg->parent;

				if ( 0 == $subcateg->parent ) {
					continue;
				}

				$taxonomy['subcategs'][ $subcateg->parent ]['parent_id'] = (int) $subcateg->parent;
				$taxonomy['subcategs'][ $subcateg->parent ]['data'][ $cc ] = $subcateg;
				$taxonomy['subcategs'][ $subcateg->parent ]['display_as'] = $term['display_as'];
				$taxonomy['subcategs'][ $subcateg->parent ]['parent_name'] = $term['parent_name'];

				$cc++;
			}
		}


		$subcategs = array();

		$sc = 0;

		foreach ( $taxonomy['subcategs'] as $subcateg ) {

			$subcategs[ $sc ]['data'] = array_values( $subcateg['data'] );
			$subcategs[ $sc ]['parent_id'] = $subcateg['parent_id'];
			$subcategs[ $sc ]['display_as'] = $subcateg['display_as'];

			$sc++;
		}

		$taxonomy['categs'] = $cat_data;
		$taxonomy['subcategs'] = $subcategs;
		$taxonomy['subcategs_hierarchy'] = lscf_group_terms_by_parent( $terms_ids );

		return $taxonomy;
	}


	/**
	 * Retrieve all active terms from current post
	 *
	 * @param array  $post_ids An array of posts IDs.
	 * @param array  $taxonomies An array of all available taxonomies from custom post type.
	 * @param string $post_type The post type.
	 *
	 * @access public
	 * @var function|Class method
	 */
	public function get_posts_active_terms( $post_ids, $taxonomies, $post_type ) {

		$active_posts_terms = array();

		foreach ( $taxonomies as $taxonomy ) {

			for ( $i = 0; $i < count( $post_ids ); $i++ ) {

				$terms = get_the_terms( (int) $post_ids[ $i ], $taxonomy );

				foreach ( $terms as $term ) {
					$active_posts_terms[ $term->term_id ] = $term->term_id;
				};

				$custom_fields = json_decode( lscf_wordpress_add_unicode_slash( get_post_meta( (int) $post_ids[ $i ], 'px-custom_fields', true ) ), true );

				foreach ( $custom_fields as $key => $custom_field ) {

					if ( 'px_date' == $custom_field['field_type'] || 'px_text' == $custom_field['field_type'] ) {
						continue;
					}

					if ( is_array( $custom_field['value'] ) ) {

						foreach ( $custom_field['value'] as $value ) {

							$slug = $key . px_sanitize( $value );
							$active_posts_terms['custom_fields'][ $slug ] = $slug;

						}
					} else {

						$slug = $key . px_sanitize( $custom_field['value'] );
						$active_posts_terms['custom_fields'][ $slug ] = $slug;

					}
				}
			}
		}

		$active_posts_terms['length'] = count( $active_posts_terms );

		return $active_posts_terms;
	}

	/**
	 * Init angular $http requests handler.
	 * Loaded via add_action hook
	 *
	 * @access public
	 * @var function|Class method
	 */
	public function init_http_requests() {

		$post_data = json_decode( file_get_contents( 'php://input' ) );

		$section = $post_data->section;

		switch ( $section ) {

			case 'getSidebar':

				if ( is_active_sidebar( 'lscf_custom_sidebar' ) ) {
					dynamic_sidebar( 'lscf_custom_sidebar' );
				}
				die();
				break;

			case 'getFilterFields':

				$filter_id = $post_data->filter_id;

				$filter_data = get_option( PluginMainModel::$meta_name_plugin_settings, true );

				$filter_data = json_decode( $filter_data, true );

				if ( ! isset( $filter_data['filterList'] ) ) {
					exit();
				}

				if ( ! isset( $filter_data['filterList'][ $filter_id ] ) ) {
					exit();
				}


				$custom_template_data = ( isset( $filter_data['custom_templates'] ) && count( $filter_data['custom_templates'] ) > 0 ? $filter_data['custom_templates'] : false  );

				$filter_data = $filter_data['filterList'][ $filter_id ];

				$name = $filter_data['name'];
				$filter_type = ( isset( $filter_data['filter_type'] ) ? $filter_data['filter_type'] : 'custom-posts' );

				$additional_fields = array();
				$post_taxonomies = array();

				$custom_fields_data = get_option( PluginMainModel::$options_custom_fields, true );

				$custom_fields_data = json_decode( $custom_fields_data, true );
				$custom_fields_data = $custom_fields_data[ $filter_data['post_type'] ];

				$count = 0;
				$init_instock_woocommerce = true;
				$filter_fields_data = array();

				foreach ( $filter_data['fields'] as $field ) {

					switch ( $field['group_type'] ) {

						case 'custom_field':

							if ( 'woocommerce-instock' == $field['ID'] && true === $init_instock_woocommerce ) {

								$init_instock_woocommerce = false;

								$display_as = ( isset( $field['display'] ) && 'default' != $field['display'] ? $field['display'] : 'px_select_box' );

								$filter_fields_data[ $count ]['type'] = 'px_select_box';
								$filter_fields_data[ $count ]['ID'] = 'woocommerce-instock';
								$filter_fields_data[ $count ]['name'] = 'Availability';
								$filter_fields_data[ $count ]['display_as'] = $display_as;
								$filter_fields_data[ $count ]['group_type'] = $field['group_type'];


								$filter_fields_data[ $count ]['options'][0]['opt'] = 'In Stock';
								$filter_fields_data[ $count ]['options'][0]['value'] = 'instock';
								$filter_fields_data[ $count ]['options'][1]['opt'] = 'Out of Stock';
								$filter_fields_data[ $count ]['options'][1]['value'] = 'outofstock';

								$count++;

								continue;
							}


							if ( null !== $custom_fields_data && count( $custom_fields_data ) > 0 ) {

								foreach ( $custom_fields_data as $field_type => $f_data ) {

									foreach ( $f_data as $id => $single_field ) {

										if ( ! isset( $field['ID'] ) ) { continue; }

										if ( $id == $field['ID'] ) {

											$display_as = ( isset( $field['display'] ) && 'default' != $field['display'] ? $field['display'] : $field_type );

											$filter_fields_data[ $count ]['type'] = $field_type;
											$filter_fields_data[ $count ]['ID'] = $id;
											$filter_fields_data[ $count ]['name'] = $single_field['name'];
											$filter_fields_data[ $count ]['display_as'] = $display_as;
											$filter_fields_data[ $count ]['group_type'] = $field['group_type'];



											if ( isset( $single_field['options'] ) ) {
												if ( 'px_select_box' == $field_type || 'px_radio_box' == $field_type || 'px_check_box' == $field_type ) {
													foreach( $single_field['options'] as $opt ) {
														$filter_fields_data[ $count ]['options'][]['opt'] = $opt;
													}
												} else {
													$filter_fields_data[ $count ]['options'] = $single_field['options'];
												}
											}

											$count++;

										}
									}
								}
							}

							break;

						case 'taxonomies':

							$taxonomy = $field;

							if ( ! isset( $taxonomy['terms'] ) || empty( $taxonomy['terms'] ) || count( $taxonomy['terms'] ) < 1 ) {
								continue;
							}

							if ( 1 == $taxonomy['subcategories_hierarchy_display'] ) {
								$taxonomy_data = $this->retrieve_subcategories_hierarchical( $taxonomy );
							} else {

								$s_count = count( $taxonomy['terms'] );

								foreach ( $taxonomy['terms'] as $term ) {

									if ( ! isset( $term['subcategs'] ) ) {
										continue;
									}

									$subcategs = get_terms( $taxonomy['slug'], array( 'child_of' => (int) $term['data']['value'], 'hide_empty' => false ) );

									foreach ( $subcategs as $subcateg ) {
										$taxonomy['terms'][ $s_count ]['data']['value'] = $subcateg->term_id;
										$taxonomy['terms'][ $s_count ]['data']['name'] = $subcateg->name;
										$s_count++;
									}
								}

								$taxonomy_data = $taxonomy;
							}

							$filter_fields_data[ $count ]['type'] = 'checkbox_post_terms';
							$filter_fields_data[ $count ]['ID'] = $taxonomy_data['slug'];
							$filter_fields_data[ $count ]['tax'] = $taxonomy_data;
							$filter_fields_data[ $count ]['group_type'] = $taxonomy_data['group_type'];

							$post_taxonomies[ $taxonomy['slug'] ] = $filter_fields_data[ $count ];

							$count++;

							break;

						case 'additional_fields':

							switch ( $field['type'] ) {

								case 'search':

									if ( 'woocommerce' == $filter_data['filter_type'] ) {

										$filter_fields_data[ $count ]['type'] = 'woo-search-' . $field['search_by'];
										$filter_fields_data[ $count ]['name'] = $field['name'];
										$filter_fields_data[ $count ]['group_type'] = $field['group_type'];
										$count++;

									} else {
										$filter_fields_data[ $count ]['type'] = 'search';
										$filter_fields_data[ $count ]['name'] = $field['name'];
										$filter_fields_data[ $count ]['group_type'] = $field['group_type'];
										$count++;
									}


									break;

								case 'date-interval':

										$filter_fields_data[ $count ]['type'] = 'date-interval';
										$filter_fields_data[ $count ]['name'] = $field['name'];
										$filter_fields_data[ $count ]['key'] = $field['key'];
										$filter_fields_data[ $count ]['filterFieldID'] = $field['fieldID'];
										$filter_fields_data[ $count ]['group_type'] = $field['group_type'];
										$count++;

									break;

								case 'range':

										$filter_fields_data[ $count ]['type'] = 'range';
										$filter_fields_data[ $count ]['name'] = $field['name'];
										$filter_fields_data[ $count ]['key'] = $field['key'];
										$filter_fields_data[ $count ]['min'] = $field['min'];
										$filter_fields_data[ $count ]['max'] = $field['max'];
										$filter_fields_data[ $count ]['label'] = $field['label'];
										$filter_fields_data[ $count ]['filterFieldID'] = $field['fieldID'];
										$filter_fields_data[ $count ]['group_type'] = $field['group_type'];
										$count++;

									break;
							}

							break;

					}
				}

				if ( false !== $custom_template_data ) {
					$filter_data['custom_templates'] = $custom_template_data;
				}

				echo wp_json_encode(

					array(
						'title' => $name,
						'fields' => $filter_fields_data,
						'filter_type' => $filter_data['filter_type'],
						'post_taxonomies' => $post_taxonomies,
						'default_data' => $filter_data,
					)
				);

				die();

				break;

			case 'getPosts':

				$filter_id = $post_data->filter_id;

				$filter_data = get_option( PluginMainModel::$meta_name_plugin_settings, true );

				$filter_data = json_decode( $filter_data, true );

				if ( ! isset( $filter_data['filterList'] ) && $filter_id != $post_data->post_type ) {
					exit();
				}

				if ( ! isset( $filter_data['filterList'][ $filter_id ] ) && $filter_id != $post_data->post_type ) {
					exit();
				}


				if ( $filter_id == $post_data->post_type ) {

					$filter_data['filter_type'] = 'not-available';

				} else {

					$filter_data = $filter_data['filterList'][ $filter_id ];

				}

				$featured_label = 0;
				if ( isset( $post_data->featured_label ) && '' !== $post_data->featured_label ) {

					$featured_label = 1;

				}

				if ( 'woocommerce' == $filter_data['filter_type'] ) {
					$woo_price_currency = get_woocommerce_currency_symbol();
				}


				$all_taxonomies_names = get_object_taxonomies( $post_data->post_type, 'names' );

				if ( isset( $post_data->q ) && count( $post_data->q ) > 0 ) {

					$additional_filter_fields = array();
					$post_taxonomies = array();
					$general_search_keyword = null;
					$woo_product_sku_search = null;

					foreach ( $post_data->q as $field ) {

						if ( isset( $field->filter_as ) && '' != $field->filter_as ) {
							$f_type = $field->filter_as;
						} else {
							$f_type = $field->type;
						}

						if ( 'range' === $field->type ||  'date-interval' === $field->type ) {

							$additional_filter_fields[] = $field;

							continue;

						};

						if ( 'checkbox_post_terms' === $f_type  ) {

							$post_taxonomies[] = $field;

							continue;
						}

						if ( 'main-search' == $field->type ) {


							if ( 'ajax-main-search' == $field->ID ) {
								$general_search_keyword = $field->value;
							}

							continue;
						}
					}

					$limit = ( count( $additional_filter_fields ) > 0 ? 500 : (int) $post_data->limit );

					$args = array(
						'post_type' => $post_data->post_type,
						'post_status' => 'publish',
						'posts_per_page' => $limit,
						'paged' => (int) $post_data->page,
					);

					if ( isset( $post_data->q->default_filter ) ) {

						$args['px_default_filter'] = $post_data->q->default_filter;
						$args['tax_query']['relation'] = 'OR';

						if ( isset( $post_data->q->default_filter->post_taxonomies ) ) {

							$default_post_taxs = $post_data->q->default_filter->post_taxonomies;
							$tax_count = 0;

							foreach ( $default_post_taxs as $tax_data ) {

								$terms = array();

								foreach ( $tax_data->tax->terms as $term ) {
									$terms[] = $term->data->value;
								}

								if ( count( $terms ) > 0 ) {

									$args['tax_query'][ $tax_count ]['taxonomy'] = $tax_data->ID;
									$args['tax_query'][ $tax_count ]['field'] = 'term_id';
									$args['tax_query'][ $tax_count ]['terms'] = $terms;
									$args['tax_query'][ $tax_count ]['operator'] = 'IN';

									$tax_count++;
								}
							}
						}
					} else {
						$args['px_custom_fields'] = $post_data->q;
					};

					if ( isset( $additional_filter_fields ) && count( $additional_filter_fields ) > 0 ) {

						foreach ( $additional_filter_fields as $field ) {

							if ( 'px-woocommerce-price' == $field->ID && 'woocommerce' == $filter_data['filter_type'] ) {

								if ( ! isset( $args['meta_query'] ) ) {
									$args['posts_per_page'] = (int) $post_data->limit;
								}

								$range_max_value = (int) $field->value->max;
								$range_min_value = (int) $field->value->min;

							} elseif ( 'px-woocommerce-inventory' == $field->ID && 'woocommerce' == $filter_data['filter_type'] ) {

								if ( ! isset( $args['meta_query'] ) ) {
									$args['posts_per_page'] = (int) $post_data->limit;
								}

								$range_max_value = (int) $field->value->max;
								$range_min_value = (int) $field->value->min;

							}
						}
					}

					if ( null != $general_search_keyword ) {
						$args['s'] = sanitize_text_field( $general_search_keyword );
					}

					if ( isset( $post_taxonomies ) && count( $post_taxonomies ) > 0 ) {

						$args['tax_query']['relation'] = 'AND';

						foreach ( $post_taxonomies as $taxonomy ) {

							if ( preg_match( '/(.+?)_-_([0-9]+)$/', $taxonomy->ID, $matches ) ) {
								$tax_id = $matches[1];
							} else {
								$tax_id = $taxonomy->ID;
							}

							if ( is_array( $taxonomy->value ) ) {

								foreach ( $taxonomy->value as $value ) {

									$args['tax_query'][] = array(
										'taxonomy' 	=> $tax_id,
										'field' 	=> 'term_id',
										'terms' 	=> $value,
									);
								}
							} else {

								$args['tax_query'][] = array(
									'taxonomy' 	=> $tax_id,
									'field' 	=> 'term_id',
									'terms' 	=> $taxonomy->value,
								);

							}
						}
					};

					$posts_q = new PxWpQuery( $args );


				} else {

					$args = array(
						'post_type'			=> $post_data->post_type,
						'post_status'		=> 'publish',
						'posts_per_page'	=> (int) $post_data->limit,
						'paged'				=> (int) $post_data->page,
					);

					if ( isset( $post_taxonomies ) && count( $post_taxonomies ) > 0 ) {

						$args['tax_query']['relation'] = 'AND';

						foreach ( $post_taxonomies as $taxonomy ) {

							if ( is_array( $taxonomy->value ) ) {

								foreach ( $taxonomy->value as $value ) {

									$args['tax_query'][] = array(
										'taxonomy' 	=> $taxonomy->ID,
										'field' 	=> 'term_id',
										'terms' 	=> $value,
									);
								}
							} else {
								$args['tax_query'][] = array(
									'taxonomy' 	=> $taxonomy->ID,
									'field' 	=> 'term_id',
									'terms' 	=> $taxonomy->value,
								);
							}
						}
					}
					$posts_q = new WP_QUERY( $args );
				}

				$data_posts = array();

				$posts_count = $posts_q->found_posts;

				$total_pages = $posts_q->max_num_pages;

				$count = 0;

				$active_posts_terms = array();

				while ( $posts_q->have_posts() ) {

					$posts_q->the_post();

					if ( 'woocommerce' == $filter_data['filter_type'] ) {

						$woo_product = wc_get_product( get_the_ID() );

						$woo_sale_price = $woo_product->get_sale_price();
						$woo_price = $woo_product->get_price();

					}

					$matches = 1;

					$custom_fields = json_decode( lscf_wordpress_add_unicode_slash( get_post_meta( get_the_ID(), 'px-custom_fields', true ) ), true );

					if ( isset( $additional_filter_fields ) && count( $additional_filter_fields ) > 0 ) {

						foreach ( $additional_filter_fields as $field ) {

							switch ( $field->type ) {

								case 'range':

									if ( isset( $custom_fields[ $field->ID ] ) ) {

										$range_max_value = (int) $field->value->max;
										$range_min_value = (int) $field->value->min;

										$post_field_value = intval( (float) $custom_fields[ $field->ID ]['value'] );

										if ( $post_field_value > $range_max_value || $post_field_value < $range_min_value ) {

											$matches = 0;

											break;
										};

									}

								break;

								case 'date-interval':

									if ( isset( $custom_fields[ $field->ID ] ) ) {

										$post_date = strtotime( $custom_fields[ $field->ID ]['value'] );
										$from = strtotime( $field->fields->from->value );
										$to = strtotime( $field->fields->to->value );

										if ( $post_date < $from || $post_date > $to ) {

											$matches = 0;
											break;
										}
									}

								break;

							}
						}
					}

					if ( 0 == $matches ) {
						continue;
					}


					$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array( 420, 300 ), false, '' );
					$featured_img_portrait = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array( 320, 480 ), false, '' );

					$full_content = preg_replace( '/\[(.+?)\]/', '', get_the_content() );
					$short_content = wp_trim_words( $full_content, 20, null );
					$content = wp_trim_words( $full_content, 55, null );


					$data_posts[ $count ]['title']['short'] = wp_trim_words( get_the_title(), 6, null );

					$data_posts[ $count ]['title']['long']  = get_the_title();

					$data_posts[ $count ]['ID'] = get_the_ID();

					$data_posts[ $count ]['content'] = $content;

					$data_posts[ $count ]['short_content'] = $short_content;

					$data_posts[ $count ]['full_content'] = $full_content;

					$data_posts[ $count ]['featuredImage'] = $featured_img[0];

					$data_posts[ $count ]['featured_portrait'] = $featured_img_portrait[0];

					$data_posts[ $count ]['permalink'] = get_permalink();

					$data_posts[ $count ]['customFields'] = $custom_fields;

					if ( 'woocommerce' == $filter_data['filter_type'] ) {

						$data_posts[ $count ]['woocommerce']['regular_price'] = $woo_product->get_regular_price();
						$data_posts[ $count ]['woocommerce']['sale_price'] = $woo_sale_price;
						$data_posts[ $count ]['woocommerce']['price'] = $woo_price;
						$data_posts[ $count ]['woocommerce']['price_currency'] = $woo_price_currency;
						$data_posts[ $count ]['woocommerce']['sku'] = $woo_product->get_sku();
						$data_posts[ $count ]['woocommerce']['stock'] = $woo_product->get_stock_quantity();
						$data_posts[ $count ]['woocommerce']['add_to_cart_link'] = site_url() . '/?add-to-cart='. get_the_ID();

						if ( 1 == $featured_label ) {

							if ( 'woocommerce-featured-price' == $post_data->featured_label ) {

								$featured_price = ( '' != $woo_sale_price ? $woo_sale_price : $woo_price );

								$data_posts[ $count ]['featured_label'] = ( '' != $featured_price ? html_entity_decode( $woo_price_currency ) . $featured_price : '' );
							};

						}
					}

					if ( 1 == $featured_label && 'woocommerce' != $filter_data['filter_type'] ) {

						$featured_label_value = ( isset( $custom_fields[ $post_data->featured_label ] ) ? $custom_fields[ $post_data->featured_label ]['value'] : '' );

						$data_posts[ $count ]['featured_label'] = $featured_label_value;

					}

					$count++;

				}

				if ( isset( $additional_filter_fields ) && count( $additional_filter_fields ) > 0 && 'woocommerce' != $filter_data['filter_type']  ) {

					$offset = $post_data->limit * ( $post_data->page - 1 );
					$posts_limit = ( ( $offset + $post_data->limit ) > count( $data_posts ) ? count( $data_posts ) : $offset + $post_data->limit );

					$temp_data = array();

					for ( $i = $offset; $i < $posts_limit; $i++ ) {

						$temp_data[] = $data_posts[ $i ];

					}

					$total_pages = ceil( count( $data_posts ) / $post_data->limit );

					$posts_count = count( $data_posts );

					$all_matched_posts = $data_posts;

					$data_posts = $temp_data;
				}

				if ( isset( $args['px_custom_fields'] ) ) {

					$filter_data = get_option( PluginMainModel::$meta_name_plugin_settings, true );

					$filter_data = json_decode( $filter_data, true );
					$filter_id = $post_data->filter_id;

					if ( isset( $filter_data['filterList'] ) &&
						isset( $filter_data['filterList'][ $filter_id ] ) ) {

						if ( isset( $filter_data['filterList'][ $filter_id ]['options']['disable_empty_option_on_filtering'] ) && 1 === (int) $filter_data['filterList'][ $filter_id ]['options']['disable_empty_option_on_filtering'] ) {

							unset( $args['px_postmeta'] );
							$args['fields'] = 'ids';
							$args['posts_per_page'] = 200;
							$all_posts_ids = new PxWpQuery( $args, true );

							$active_posts_terms = $this->get_posts_active_terms( $all_posts_ids->posts, $all_taxonomies_names, $data_posts->post_type );
						}
					}
				}

				echo wp_json_encode(
					array(
						'posts'			=> $data_posts,
						'matched_posts' => $all_matched_posts,
						'pages'			=> $total_pages,
						'postsCount'	=> $posts_count,
						'featuredLabel'	=> $featured_label,
						'active_terms'	=> $active_posts_terms,
						'filter_type'	=> $filter_data['filter_type'],
					)
				);

				die();
				break;
		}

		die();
	}

}
