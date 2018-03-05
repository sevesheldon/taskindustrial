<?php
/*
Plugin Name: Edge CPT
Description: Plugin that adds all post types needed by our theme
Author: Edge Themes
Version: 1.0.1
*/

require_once 'load.php';

use EdgeCore\CPT;
use EdgeCore\Lib;

add_action('after_setup_theme', array(CPT\PostTypesRegister::getInstance(), 'register'));

Lib\ShortcodeLoader::getInstance()->load();

if(!function_exists('edgt_core_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines edgt_core_on_activate action
     */
    function edgt_core_activation() {
        do_action('edgt_core_on_activate');

        EdgeCore\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'edgt_core_activation');
}

if(!function_exists('edgt_core_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function edgt_core_text_domain() {
        $plugin_dir = basename(dirname(__FILE__));
        load_plugin_textdomain( 'edgt_core', false, $plugin_dir.'/languages' );
    }

    add_action('plugins_loaded', 'edgt_core_text_domain');
}