<?php

/**
 * Plugin Name:       WPB Accordion Menu or Category PRO
 * Plugin URI:        http://wpbean.com/product/wpb-accordion-menu-or-category
 * Description:       WPB Accordion Menu or Category Plugin allow you to show WordPress menu or any category accordion with submenu / subcategory support. Specially optimized for WooCommerce or any other ecommerce categories. It's responsive and modern flat design.
 * Version:           1.09.4
 * Author:            wpbean
 * Author URI:        http://wpbean.com/
 * Text Domain:       wpb-accordion-menu-or-category
 * Domain Path:       /languages
 */

/**
 * WpBean Plugin updater init
 * Warning!!!! 
 * Do not make any change in the code bellow. It will process the plugin auto update.
 */

define( 'WPB_WAMC_VERSION', '1.09.2' );

function wpb_wamc_plugin_updater_init() {
	$updater_init = wpb_wamc_updater_init();
	$store_url = $updater_init->store_url;
	$item_name = $updater_init->item_name;
	$prefix = $updater_init->prefix;
	$license_key = trim( wpb_wmca_get_option( $updater_init->prefix.'license_key', $updater_init->license_page_slug ) );

	$edd_updater = new WpBean_Plugin_Updater( $store_url, __FILE__, array(
			'version'   => WPB_WAMC_VERSION,
			'license'   => $license_key,
			'item_name' => $item_name,
			'author'    => 'WpBean',
			'url'       => home_url()
		)
	);
}
add_action( 'admin_init', 'wpb_wamc_plugin_updater_init', 0 );


/**
 * Internationalization
 */

function wpb_wmca_textdomain() {
	load_plugin_textdomain( 'wpb-accordion-menu-or-category', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'wpb_wmca_textdomain' );



/**
 * Add plugin action links
 */

function wpb_wmca_plugin_actions( $links ) {
	if( is_admin() ){
		$links[] = '<a href="http://wpbean.com/support/" target="_blank">'. __('Support','wpb-accordion-menu-or-category') .'</a>';
	}
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wpb_wmca_plugin_actions' );



/**
 * Required files
 */

require_once dirname( __FILE__ ) . '/wpb-scripts.php';
require_once dirname( __FILE__ ) . '/inc/wpb-wmca-functions.php';
require_once dirname( __FILE__ ) . '/inc/wpb-wmca-shortcodes.php';
require_once dirname( __FILE__ ) . '/admin/wpb-wmca-taxonomie-meta.php';
require_once dirname( __FILE__ ) . '/admin/wpb-wmca-widget.php';
require_once dirname( __FILE__ ) . '/admin/settings/class.settings-api.php';
require_once dirname( __FILE__ ) . '/admin/settings/wpb-wmca-settings.php';
require_once dirname( __FILE__ ) . '/admin/settings/wpb-wmca-options-config.php';
require_once dirname( __FILE__ ) . '/admin/wp-menu-item-custom-fields/menu-item-custom-fields.php';
require_once dirname( __FILE__ ) . '/admin/wp-menu-item-custom-fields/config/menu-item-custom-fields-config.php';
if( !class_exists( 'WpBean_Plugin_Updater' ) ) {
	include( dirname( __FILE__ ) . '/admin/updater/plugin-updater.php' );
}
require_once dirname( __FILE__ ) . '/admin/updater/updater-init.php';