<?php

/*
	WPB Menu And Category Accordion
	By WPBean
	
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 


/* ==========================================================================
   Adding Latest jQuery
   ========================================================================== */

function wpb_wmca_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'wpb_wmca_jquery');	


/* ==========================================================================
   include js files
   ========================================================================== */

function wpb_wmca_adding_scripts() {
	if ( !is_admin() ) {
		$wpb_wmca_load_cookie = wpb_wmca_get_option( 'wpb_wmca_load_cookie','other_settings' );
		if( $wpb_wmca_load_cookie && $wpb_wmca_load_cookie == 'yes' ){
			wp_enqueue_script('wpb_wmca_jquery_cookie', plugins_url('assets/js/jquery.cookie.js', __FILE__),'','1.4.1', true);
		}
		wp_enqueue_script('wpb_wmca_accordion_script', plugins_url('assets/js/jquery.navgoco.min.js', __FILE__),'','1.0', true);
		
		wp_enqueue_script('wpb_wmca_main_script', plugins_url('assets/js/main.js', __FILE__),'','1.0', true);
	}
}
add_action( 'wp_enqueue_scripts', 'wpb_wmca_adding_scripts' ); 


/* ==========================================================================
   include css files
   ========================================================================== */

function wpb_wmca_adding_style() {
	if ( !is_admin() ) {
		wp_enqueue_style( 'wpb_wmca_accordion_style', plugins_url('assets/css/wpb_wmca_style.css', __FILE__),'','1.0' );
	}

	$wpb_wmca_load_font_awesome = wpb_wmca_get_option( 'wpb_wmca_load_font_awesome','other_settings' );

	if( $wpb_wmca_load_font_awesome && $wpb_wmca_load_font_awesome == 'yes' ){
		wp_enqueue_style( 'wpb_wmca_font_awesome_style_frontend', plugins_url('admin/assets/css/font-awesome.min.css', __FILE__),'','1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpb_wmca_adding_style',11 );




/* ==========================================================================
   Admin include Icon Picker JS files
   ========================================================================== */

function wpb_wmca_adding_admin_scripts() {

	global $pagenow;
	$cat_icon_support = wpb_wmca_get_option( 'wpb_wmca_cat_icon_support','category_accordion' );
	$menu_icon_support = wpb_wmca_get_option( 'wpb_wmca_menu_icon_support','menu_accordion' );

	// For Category Page
	if ( is_admin() && $cat_icon_support == 'off' &&  $pagenow == 'edit-tags.php' ) {
		wp_enqueue_script('wpb_wmca_iconpicker_script', plugins_url('admin/assets/js/icon-picker.min.js', __FILE__),'jquery','1.0', true);
	}

	// For Menu Page
	if ( is_admin() && $menu_icon_support == 'off' &&  $pagenow == 'nav-menus.php' ) {
		wp_enqueue_script('wpb_wmca_iconpicker_script', plugins_url('admin/assets/js/icon-picker.min.js', __FILE__),'jquery','1.0', true);
	}

}
add_action( 'admin_enqueue_scripts', 'wpb_wmca_adding_admin_scripts',11 );



/* ==========================================================================
   Admin include Icon Picker CSS files
   ========================================================================== */

function wpb_wmca_adding_admin_style() {

	global $pagenow;
	$cat_icon_support = wpb_wmca_get_option( 'wpb_wmca_cat_icon_support','category_accordion' );
	$menu_icon_support = wpb_wmca_get_option( 'wpb_wmca_menu_icon_support','menu_accordion' );

	// For Category Page
	if ( is_admin() && $cat_icon_support == 'off' &&  $pagenow == 'edit-tags.php' ) {
		wp_enqueue_style('wpb_wmca_font_awesome_style', plugins_url('admin/assets/css/font-awesome.min.css', __FILE__),'','1.0');
		wp_enqueue_style('wpb_wmca_iconpicker_style', plugins_url('admin/assets/css/icon-picker.min.css', __FILE__),'','1.0');
	}

	// For Menu Page
	if ( is_admin() && $menu_icon_support == 'off' &&  $pagenow == 'nav-menus.php' ) {
		wp_enqueue_style('wpb_wmca_font_awesome_style', plugins_url('admin/assets/css/font-awesome.min.css', __FILE__),'','1.0');
		wp_enqueue_style('wpb_wmca_iconpicker_style', plugins_url('admin/assets/css/icon-picker.min.css', __FILE__),'','1.0');
	}


	wp_enqueue_style('wpb_wmca_wpb_admin_style', plugins_url('admin/assets/css/wpb-admin.css', __FILE__),'','1.0');
}
add_action( 'admin_enqueue_scripts', 'wpb_wmca_adding_admin_style',11 );