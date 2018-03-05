<?php

/*
	WPB Menu And Category Accordion
	By WPBean
	
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 


if ( !class_exists('WPB_wcma_Settings_API' ) ):
class WPB_wcma_Settings_API {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( __( 'WPB Accordion Menu or Category','wpb-accordion-menu-or-category' ), __( 'WPB Accordion Menu or Category','wpb-accordion-menu-or-category' ), 'delete_posts', 'wpb_wcma_settings', array($this, 'wpb_wcma_plugin_option_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'category_accordion',
                'title' => __( 'Category Accordion Settings', 'wpb-accordion-menu-or-category' )
            ),
            array(
                'id' => 'menu_accordion',
                'title' => __( 'Menu Accordion Settings', 'wpb-accordion-menu-or-category' )
            ),
            array(
                'id' => 'other_settings',
                'title' => __( 'Other Settings', 'wpb-accordion-menu-or-category' )
            )
        );

        $sections = apply_filters( 'wpb_wamc_settings_sections', $sections );

        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'category_accordion' => array(
                array(
                    'name'  => 'wpb_wmca_cat_icon_support',
                    'label' => __( 'Category Icon Support', 'wpb-accordion-menu-or-category' ),
                    'desc'  => __( 'No Please!', 'wpb-accordion-menu-or-category' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'    => 'wpb_wcma_icon_support_taxonomies',
                    'label'   => __( 'Taxonomy Icon Support', 'wpb-accordion-menu-or-category' ),
                    'desc'    => __( 'Choose taxonomies where you want icon support.', 'wpb-accordion-menu-or-category' ),
                    'type'    => 'multicheck',
                    'options' => get_taxonomies( array( 'public' => true ) ),
                ),
                array(
                    'name'  => 'wpb_wmca_cat_parent_open',
                    'label' => __( 'Keep 1st Level Parent Category Open', 'wpb-accordion-menu-or-category' ),
                    'desc'  => __( 'Yes Please!', 'wpb-accordion-menu-or-category' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'  => 'wpb_wmca_current_cat_open',
                    'label' => __( 'Keep Current Category Open', 'wpb-accordion-menu-or-category' ),
                    'desc'  => __( 'Yes Please!', 'wpb-accordion-menu-or-category' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'  => 'wpb_wmca_open_accordion_on_cat_click',
                    'label' => __( 'Open category accordion click on entire category.', 'wpb-accordion-menu-or-category' ),
                    'desc'  => __( 'Yes Please!', 'wpb-accordion-menu-or-category' ),
                    'type'  => 'checkbox'
                ),
            ),
            'menu_accordion' => array(

                array(
                    'name'  => 'wpb_wmca_menu_icon_support',
                    'label' => __( 'Menu Icon Support', 'wpb-accordion-menu-or-category' ),
                    'desc'  => __( 'No Please!', 'wpb-accordion-menu-or-category' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'  => 'wpb_wmca_menu_parent_open',
                    'label' => __( 'Keep 1st Level Parent Menu Open', 'wpb-accordion-menu-or-category' ),
                    'desc'  => __( 'Yes Please!', 'wpb-accordion-menu-or-category' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'  => 'wpb_wmca_current_menu_open',
                    'label' => __( 'Keep Current Menu Open', 'wpb-accordion-menu-or-category' ),
                    'desc'  => __( 'Yes Please!', 'wpb-accordion-menu-or-category' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'  => 'wpb_wmca_open_accordion_on_menu_click',
                    'label' => __( 'Open menu accordion click on entire menu item.', 'wpb-accordion-menu-or-category' ),
                    'desc'  => __( 'Yes Please!', 'wpb-accordion-menu-or-category' ),
                    'type'  => 'checkbox'
                ),

            ),
            'other_settings' => array(

                array(
                    'name'    => 'wpb_wmca_theme',
                    'label'   => __( 'Choose a theme', 'wpb-accordion-menu-or-category' ),
                    'desc'    => __( 'Default Drak Theme', 'wpb-accordion-menu-or-category' ),
                    'type'    => 'select',
                    'default' => 'dark',
                    'options' => array(
                        'dark'          => 'Dark',
                        'transparent'   => 'Transparent',
                        'custom'        => 'Custom Theme',
                    )
                ),

                array(
                    'name'      => 'wpb_wmca_bg_color',
                    'label'     => __( 'Background Color', 'wpb-accordion-menu-or-category' ),
                    'type'      => 'color',
                    'default'   => '#3b424d'
                ),

                array(
                    'name'      => 'wpb_wmca_child_bg_color',
                    'label'     => __( 'Child Background Color', 'wpb-accordion-menu-or-category' ),
                    'type'      => 'color',
                    'default'   => '#383838'
                ),

                array(
                    'name'      => 'wpb_wmca_bg_hover_color',
                    'label'     => __( 'Background Hover Color', 'wpb-accordion-menu-or-category' ),
                    'type'      => 'color',
                    'default'   => '#383F4A'
                ),

                array(
                    'name'      => 'wpb_wmca_text_color',
                    'label'     => __( 'Text Color', 'wpb-accordion-menu-or-category' ),
                    'type'      => 'color',
                    'default'   => '#f5f5f5'
                ),

                array(
                    'name'      => 'wpb_wmca_border_color',
                    'label'     => __( 'Border Color', 'wpb-accordion-menu-or-category' ),
                    'type'      => 'color',
                    'default'   => '#414956'
                ),
                array(
                    'name'      => 'wpb_wmca_load_font_awesome',
                    'label'     => __( 'Load Font Awesome CSS', 'wpb-accordion-menu-or-category' ),
                    'desc'      => __( 'You can disable loading Font Awesome icon css form this plugin, if your theme or any other plugin loading this. Default Yes.', 'wpb-accordion-menu-or-category' ),
                    'type'      => 'radio',
                    'default'   => 'yes',
                    'options'   => array(
                        'yes'   => 'Yes',
                        'no'    => 'No'
                    )
                ),
                array(
                    'name'      => 'wpb_wmca_load_cookie',
                    'label'     => __( 'Load Font jQuery Cookie', 'wpb-accordion-menu-or-category' ),
                    'desc'      => __( 'You can disable loading jQuery Cookie form this plugin, if your theme or any other plugin loading this. Default Yes.', 'wpb-accordion-menu-or-category' ),
                    'type'      => 'radio',
                    'default'   => 'yes',
                    'options'   => array(
                        'yes'   => 'Yes',
                        'no'    => 'No'
                    )
                ),
            )
        );
        
        $settings_fields = apply_filters( 'wpb_wamc_settings_settings_fields', $settings_fields );

        return $settings_fields;
    }

    function wpb_wcma_plugin_option_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

new WPB_wcma_Settings_API();