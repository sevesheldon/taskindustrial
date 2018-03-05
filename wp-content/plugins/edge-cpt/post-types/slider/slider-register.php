<?php
namespace EdgeCore\CPT\Slider;

use EdgeCore\Lib;

/**
 * Class SliderRegister
 * @package EdgeCore\CPT\Slider
 */
class SliderRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'slides';
        $this->taxBase = 'slides_category';
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $edgtFramework;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';

        if(edgt_core_theme_installed()) {
            $menuPosition = $edgtFramework->getSkin()->getMenuItemPosition('slider');
            $menuIcon = $edgtFramework->getSkin()->getMenuIcon('slider');
        }

        register_post_type($this->base,
            array(
                'labels' 		=> array(
                    'name' 				=> __('Edge Slider','edgt_core' ),
                    'menu_name'	=> __('Edge Slider','edgt_core' ),
                    'all_items'	=> __('Slides','edgt_core' ),
                    'add_new' =>  __('Add New Slide','edgt_core'),
                    'singular_name' 	=> __('Slide','edgt_core' ),
                    'add_item'			=> __('New Slide','edgt_core'),
                    'add_new_item' 		=> __('Add New Slide','edgt_core'),
                    'edit_item' 		=> __('Edit Slide','edgt_core')
                ),
                'public'		=>	false,
                'show_in_menu'	=>	true,
                'rewrite' 		=> 	array('slug' => 'slides'),
                'menu_position' => 	$menuPosition,
                'show_ui'		=>	true,
                'has_archive'	=>	false,
                'hierarchical'	=>	false,
                'supports'		=>	array('title', 'thumbnail', 'page-attributes'),
                'menu_icon'  =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __( 'Sliders', 'taxonomy general name' ),
            'singular_name' => __( 'Slider', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Sliders','edgt_core' ),
            'all_items' => __( 'All Sliders','edgt_core' ),
            'parent_item' => __( 'Parent Slider','edgt_core' ),
            'parent_item_colon' => __( 'Parent Slider:','edgt_core' ),
            'edit_item' => __( 'Edit Slider','edgt_core' ),
            'update_item' => __( 'Update Slider','edgt_core' ),
            'add_new_item' => __( 'Add New Slider','edgt_core' ),
            'new_item_name' => __( 'New Slider Name','edgt_core' ),
            'menu_name' => __( 'Sliders','edgt_core' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'slides-category' ),
        ));
    }
}