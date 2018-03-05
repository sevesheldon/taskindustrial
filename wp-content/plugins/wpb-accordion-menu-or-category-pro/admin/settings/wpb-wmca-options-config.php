<?php

/*
	WPB Menu & Category Accordion
	By WPBean
	
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 



/**
 * Getting ready the plugin settings  
 */


function wpb_wmca_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}




/**
 ** Hooking Icon Picker to selected texonomy
 * 
 *  Function available on admin/wpb-wmca-taxonomie-meta.php
 *
 */

function wpb_wmca_hook_icon_picker_to_selected_texonomy(){

	$texonomies = wpb_wmca_get_option( 'wpb_wcma_icon_support_taxonomies','category_accordion' );
	$cat_icon_support = wpb_wmca_get_option( 'wpb_wmca_cat_icon_support','category_accordion' );

	if( $cat_icon_support && $cat_icon_support == 'off' && !empty($texonomies))
	foreach ($texonomies as $texonomy) {
		add_action( $texonomy.'_add_form_fields', 'wpb_wcma_taxonomy_add_icon_field', 20, 2 );
		add_action( $texonomy.'_edit_form_fields', 'wpb_wcma_taxonomy_edit_icon_field', 20, 2 );
		add_action( 'edited_'.$texonomy, 'wpb_wcma_save_taxonomy_icon', 10, 2 );  
		add_action( 'create_'.$texonomy, 'wpb_wcma_save_taxonomy_icon', 10, 2 );
		add_filter('manage_edit-'.$texonomy.'_columns', 'wpb_wmca_columns_head', 10, 3);
		add_filter('manage_'.$texonomy.'_custom_column', 'wpb_wmca_columns_content_taxonomy', 10, 3);
	}

}
add_action( 'init','wpb_wmca_hook_icon_picker_to_selected_texonomy' );









/* ==========================================================================
   Custom Theme hook up
   ========================================================================== */

function wpb_wmca_custom_theme (){

	$wpb_wmca_theme = wpb_wmca_get_option( 'wpb_wmca_theme','other_settings' );
	$wpb_wmca_bg_color = wpb_wmca_get_option( 'wpb_wmca_bg_color','other_settings' );
	$wpb_wmca_child_bg_color = wpb_wmca_get_option( 'wpb_wmca_child_bg_color','other_settings' );
	$wpb_wmca_text_color = wpb_wmca_get_option( 'wpb_wmca_text_color','other_settings' );
	$wpb_wmca_border_color = wpb_wmca_get_option( 'wpb_wmca_border_color','other_settings' );
	$wpb_wmca_bg_hover_color = wpb_wmca_get_option( 'wpb_wmca_bg_hover_color','other_settings' );

	if( $wpb_wmca_theme && $wpb_wmca_theme == 'custom' ){
		?>
		<style>
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul > li > a,
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul ul li > a,
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul ul ul li > a {
			  border-bottom: 1px solid <?php echo $wpb_wmca_border_color; ?>!important;
			}
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul > li a,
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul > li a:visited{
			  color: <?php echo $wpb_wmca_text_color; ?>!important;
			}
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul > li li:hover > a,
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul > li li.current-cat > a,
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom li.wpb-submenu-indicator-minus > a {
			  border-left-color: <?php echo $wpb_wmca_border_color; ?>;
			}
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul > li > a {
			  background: <?php echo $wpb_wmca_bg_color; ?>;
			}
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom ul > li li {
			  background: <?php echo $wpb_wmca_child_bg_color; ?>;
			}
			.wpb_category_n_menu_accordion.wpb_wmca_theme_custom > ul > li > a:hover {
			  background-color: <?php echo $wpb_wmca_bg_hover_color; ?>;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head','wpb_wmca_custom_theme' );
