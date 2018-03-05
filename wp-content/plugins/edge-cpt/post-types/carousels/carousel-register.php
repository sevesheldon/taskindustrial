<?php
namespace EdgeCore\CPT\Carousels;

use EdgeCore\Lib;

/**
 * Class CarouselRegister
 * @package EdgeCore\CPT\Carousels
 */
class CarouselRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    /**
     * @var string
     */
    private $taxBase;

    public function __construct() {
        $this->base = 'carousels';
        $this->taxBase = 'carousels_category';
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
            $menuPosition = $edgtFramework->getSkin()->getMenuItemPosition('carousel');
            $menuIcon = $edgtFramework->getSkin()->getMenuIcon('carousel');
        }

        register_post_type($this->base,
            array(
                'labels'    => array(
                    'name'        => __('Edge Carousel','edgt_core' ),
                    'menu_name' => __('Edge Carousel','edgt_core' ),
                    'all_items' => __('Carousel Items','edgt_core' ),
                    'add_new' =>  __('Add New Carousel Item','edgt_core'),
                    'singular_name'   => __('Carousel Item','edgt_core' ),
                    'add_item'      => __('New Carousel Item','edgt_core'),
                    'add_new_item'    => __('Add New Carousel Item','edgt_core'),
                    'edit_item'     => __('Edit Carousel Item','edgt_core')
                ),
                'public'    =>  false,
                'show_in_menu'  =>  true,
                'rewrite'     =>  array('slug' => 'carousels'),
                'menu_position' =>  $menuPosition,
                'show_ui'   =>  true,
                'has_archive' =>  false,
                'hierarchical'  =>  false,
                'supports'    =>  array('title'),
                'menu_icon'  =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __( 'Carousels', 'taxonomy general name' ),
            'singular_name' => __( 'Carousel', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Carousels','edgt_core' ),
            'all_items' => __( 'All Carousels','edgt_core' ),
            'parent_item' => __( 'Parent Carousel','edgt_core' ),
            'parent_item_colon' => __( 'Parent Carousel:','edgt_core' ),
            'edit_item' => __( 'Edit Carousel','edgt_core' ),
            'update_item' => __( 'Update Carousel','edgt_core' ),
            'add_new_item' => __( 'Add New Carousel','edgt_core' ),
            'new_item_name' => __( 'New Carousel Name','edgt_core' ),
            'menu_name' => __( 'Carousels','edgt_core' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'carousels-category' ),
        ));
    }

}