<?php 
/**
	Plugin Name: Live Search & Custom Fields
	Plugin URI: http://wp.pixolette.com/plugins/live-search-custom-filter/
	Description: Make your own live filter for custom posts. Add add custom fields for your filter and custom posts.
	Author: Pixolette
	Version: 1.5
	Author URI: http://pixolette.com
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'LSCF', 1 );
define( 'LSCF_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'LSCF_PLUGIN_URL', plugins_url() . '/live-search-and-custom-fields/' );


$lscf_icon_url = LSCF_PLUGIN_URL . 'assets/images/icons/panda-white-16x16.png';

$main_path = explode( 'wp-content', LSCF_PLUGIN_URL );
$main_path = array_shift( $main_path );

define( 'LSCF_MAIN_PATH', $main_path );

include LSCF_PLUGIN_PATH . 'settings/settings.php';
include LSCF_PLUGIN_PATH . 'Class_createTemplate.php';
include LSCF_PLUGIN_PATH . 'shortcode.php';

