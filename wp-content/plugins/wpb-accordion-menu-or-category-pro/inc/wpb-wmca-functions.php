<?php

/*
	WPB Menu & Category Accordion
	By WPBean
	
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 



/* ==========================================================================
   Text Widget Shortcode Support
   ========================================================================== */

add_filter('widget_text', 'do_shortcode');



/* ==========================================================================
   WPB WMCA Category Walker
   ========================================================================== */


class WPB_WCMA_Category_Walker extends Walker_Category {

	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters(
			'list_cats',
			esc_attr( $category->name ),
			$category
		);

		// Don't generate an element if the category name is empty.
		if ( ! $cat_name ) {
			return;
		}

		$wpb_wmca_cat_count = '';
		$wpb_wmca_cat_icon = '';


		// Getting the category icon [ texonomoy meta ]
		$wpb_wcma_term_meta = get_option( "taxonomy_$category->term_id" );
		if ( ! empty( $wpb_wcma_term_meta['wpb_wcma_cat_icons'] ) ) {
			$wpb_wmca_cat_icon = '<i class="'.$wpb_wcma_term_meta['wpb_wcma_cat_icons'].'"></i>';
		}

		// Adding Post count 
		if ( ! empty( $args['show_count'] ) ) {
			$wpb_wmca_cat_count = '<span class="wpb-wmca-cat-count">' . number_format_i18n( $category->count ) . '</span>';
		}

        // If has cat child
        $open_accordion_on_cat_click = wpb_wmca_get_option( 'wpb_wmca_open_accordion_on_cat_click','category_accordion' );

        if( $args['has_children'] == true && $open_accordion_on_cat_click == 'on' ){
            $link = '<a href="#" ';
        }else{
            $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
        }

		
		if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		}

		$link .= '>'.$wpb_wmca_cat_icon;
		$link .= $cat_name . $wpb_wmca_cat_count. '</a>';



		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$css_classes = array(
				'cat-item',
				'cat-item-' . $category->term_id,
			);

			$termchildren = get_term_children( $category->term_id, $category->taxonomy );

            if( count($termchildren)>0 ){
                $css_classes[] =  'cat-item-have-child';
            }

			if ( ! empty( $args['current_category'] ) ) {
				$_current_category = get_term( $args['current_category'], $category->taxonomy );
				if ( $category->term_id == $args['current_category'] ) {
					$css_classes[] = 'current-cat';
				} elseif ( $category->term_id == $_current_category->parent ) {
					$css_classes[] = 'wpb-wmca-current-cat-parent';
				}
			}

			$css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

			$output .=  ' class="' . $css_classes . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}
}





/* ==========================================================================
   WPB WMCA NAV Walker
   ========================================================================== */



/**
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 */
class WPB_WMCA_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){

        $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

        $class_names = join(
            ' '
        ,   apply_filters(
                'nav_menu_css_class'
            ,   array_filter( $classes ), $item
            )
        );

        if($args->has_children) { $class_names .= ' wpb-wmca-menu-item-has-children'; }

        $wpb_wmca_menu_item_keep_open = get_post_meta( $item->ID, 'menu-item-keep-open', true );
        $menu_item_keep_open = ( $wpb_wmca_menu_item_keep_open == 'yes' ? ' wpb_wmca_menu_item_keep_open' : '' );


        ! empty ( $class_names )

            and $class_names = ' class="'. esc_attr( $class_names ) . esc_attr( $menu_item_keep_open ) .'"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';

        $open_accordion_on_menu_click = wpb_wmca_get_option( 'wpb_wmca_open_accordion_on_menu_click','menu_accordion' );

        if ( $args->has_children && $open_accordion_on_menu_click == 'on' ){
            $attributes .= ' href="#"';
        }elseif( ! empty( $item->url ) ){
            $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';
        }

        // insert description for top level elements only
        // you may change this
        $wpb_wmca_menu_icon = get_post_meta( $item->ID, 'menu-item-icon', true );
        $wpb_wmca_menu_icon_support = wpb_wmca_get_option( 'wpb_wmca_menu_icon_support','menu_accordion' );
        $wpb_wmca_menu_icon_setup = ( ! empty ( $wpb_wmca_menu_icon ) && $wpb_wmca_menu_icon_support == 'off' )
            ? '<i class="'.esc_attr( $wpb_wmca_menu_icon ).'"></i>' : ''; 

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output = $args->before
            . "<a $attributes>"
            . $wpb_wmca_menu_icon_setup
            . $args->link_before
            . $title
            . '</a> '
            . $args->link_after
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );
    }


    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}