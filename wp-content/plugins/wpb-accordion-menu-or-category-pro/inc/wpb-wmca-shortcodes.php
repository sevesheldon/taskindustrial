<?php

/*
	WPB Menu & Category Accordion
	By WPBean
	
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 



/* ==========================================================================
   WPB Category Accordion Shortcode
   ========================================================================== */


if ( !function_exists('wpb_wmca_category_shortcode_function') ):

	function wpb_wmca_category_shortcode_function($atts){
		extract(shortcode_atts(array(
			'taxonomy' 		=> 'category',
			'orderby' 		=> 'name',
			'order' 		=> 'ASC',
			'show_count' 	=> 'no', // yes
			'hide_empty' 	=> 'yes', // no
			'exclude' 		=> '', // excludes the category with the ID
			'include' 		=> '', // include the category with the ID
			'hierarchical' 	=> 'no', //  Display sub-categories as inner list items (below the parent list item) or inline.
			'number' 		=> 0, //  Sets the number of Categories to display. This causes the SQL LIMIT value to be defined. Default to no LIMIT.
			'depth' 		=> 0, //  This parameter controls how many levels in the hierarchy of Categories are to be included in the list of Categories.
			'accordion' 	=> 'yes', // Close previously opened accordion
			'xclass' 		=> '', // Extra Class
		), $atts));

		$id = rand( 10,1000 );
		$wpb_wmca_theme = '';
		$wpb_wmca_theme = wpb_wmca_get_option( 'wpb_wmca_theme','other_settings' );
		$cat_parent_open = wpb_wmca_get_option( 'wpb_wmca_cat_parent_open','category_accordion' );
		$current_cat_open = wpb_wmca_get_option( 'wpb_wmca_current_cat_open','category_accordion' );

		ob_start();
		?>

		<div id="wpb_wcma_menu_<?php echo $id; ?>" class="wpb_category_n_menu_accordion wpb_wmca_theme_<?php echo ( $wpb_wmca_theme ? $wpb_wmca_theme : 'dark' ); ?><?php echo ( $xclass ? ' '.$xclass.'' : '' ); ?><?php echo ( $cat_parent_open ? ' wpb_wcma_cat_parent_open_'.$cat_parent_open.'' : '' ); ?><?php echo ( $current_cat_open ? ' wpb_wmca_current_cat_open_'.$current_cat_open.'' : '' ); ?>">
			<ul>
				<?php 
				    $args = array(
					'show_option_all'    => '',
					'orderby'            => $orderby,
					'order'              => $order,
					'style'              => 'list',
					'show_count'         => ( $show_count == 'yes' ? 1 : 0 ),
					'hide_empty'         => ( $hide_empty == 'yes' ? 1 : 0 ),
					'exclude'            => $exclude,
					'exclude_tree'       => '',
					'include'            => $include,
					'hierarchical'       => ( $hierarchical == 'no' ? 1 : 0 ),
					'title_li'           => '',
					'number'             => ( $number == 0 ? null : $number ),
					'echo'               => 1,
					'depth'              => $depth,
					'taxonomy'           => $taxonomy,
					'walker'             => new WPB_WCMA_Category_Walker,
				    );
				    wp_list_categories( $args ); 
				?>
			</ul>
		</div>


	    <script type="text/javascript">
		  jQuery(function($){
		    $('#wpb_wcma_menu_<?php echo $id; ?> > ul').navgoco({
              caretHtml: '+',
              accordion: <?php echo ( $accordion == 'yes' ? 'true' : 'false' )?>,
              openClass: 'wpb-submenu-indicator-minus',
              save: true,
              cookie: {
                  name: 'navgoco',
                  expires: false,
                  path: '/'
              },
              slide: {
                  duration: 400,
                  easing: 'swing'
              }
          });

		  });
		</script>

		<?php
		return ob_get_clean();
	}

	add_shortcode( 'wpb_category_accordion', 'wpb_wmca_category_shortcode_function' );

endif;	




/* ==========================================================================
   WPB Menu Accordion Shortcode
   ========================================================================== */


if ( !function_exists('wpb_wmca_menu_shortcode_function') ):

	function wpb_wmca_menu_shortcode_function($atts){
		extract(shortcode_atts(array(
			'theme_location' 	=> '', // menu theme location
			'menu' 				=> '', // (optional) The menu that is desired; accepts (matching in order) id, slug, name
			'accordion' 		=> 'yes', // Close previously opened accordion
			'depth' 			=> 0, 
			'xclass' 			=> '', // Extra Class
		), $atts));

		$id = rand( 10,1000 );
		$wpb_wmca_theme = '';
		$wpb_wmca_theme = wpb_wmca_get_option( 'wpb_wmca_theme','other_settings' );
		$wpb_wmca_menu_icon_support = wpb_wmca_get_option( 'wpb_wmca_menu_icon_support','menu_accordion' );
		$menu_parent_open = wpb_wmca_get_option( 'wpb_wmca_menu_parent_open','menu_accordion' );
		$current_menu_open = wpb_wmca_get_option( 'wpb_wmca_current_menu_open','menu_accordion' );

		ob_start();
		?>

		<div id="wpb_wcma_menu_<?php echo $id; ?>" class="wpb_category_n_menu_accordion wpb_wmca_theme_<?php echo ( $wpb_wmca_theme ? $wpb_wmca_theme : 'dark' ); ?><?php echo ( $xclass ? ' '.$xclass.'' : '' ); ?><?php echo ( $menu_parent_open ? ' wpb_wcma_manu_parent_open_'.$menu_parent_open.'' : '' ); ?><?php echo ( $current_menu_open ? ' wpb_wmca_current_menu_open_'.$current_menu_open.'' : '' ); ?>">
			<?php

				$options = array(
					'theme_location'  => $theme_location,
					'menu'            => $menu,
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'wpb_accordion_menu',
					'menu_id'         => '',
					'echo'            => true,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => $depth,
					'walker'          => new WPB_WMCA_Nav_Walker,
				);

				wp_nav_menu( $options );

			?>
		</div>


	    <script type="text/javascript">
			jQuery(function($){
				
				$('#wpb_wcma_menu_<?php echo $id; ?> > ul').navgoco({
					caretHtml: '+',
					accordion: <?php echo ( $accordion == 'yes' ? 'true' : 'false' )?>,
					openClass: 'wpb-submenu-indicator-minus',
					save: true,
					cookie: {
						name: 'navgoco',
						expires: false,
						path: '/'
					},
					slide: {
						duration: 400,
						easing: 'swing'
					}
				});

			});
		</script>

		<?php
		return ob_get_clean();
	}

	add_shortcode( 'wpb_menu_accordion', 'wpb_wmca_menu_shortcode_function' );

endif;	
