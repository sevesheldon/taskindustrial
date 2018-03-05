<?php
namespace EdgeCore\CPT\Testimonials;

use EdgeCore\Lib;


/**
 * Class TestimonialsRegister
 * @package EdgeCore\CPT\Testimonials
 */
class TestimonialsRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'testimonials';
        $this->taxBase = 'testimonials_category';
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
     * Regsiters custom post type with WordPress
     */
    private function registerPostType() {
        global $edgtFramework;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';

        if(edgt_core_theme_installed()) {
            $menuPosition = $edgtFramework->getSkin()->getMenuItemPosition('testimonial');
            $menuIcon = $edgtFramework->getSkin()->getMenuIcon('testimonial');
        }

        register_post_type('testimonials',
            array(
                'labels' 		=> array(
                    'name' 				=> __('Testimonials','edgt_core' ),
                    'singular_name' 	=> __('Testimonial','edgt_core' ),
                    'add_item'			=> __('New Testimonial','edgt_core'),
                    'add_new_item' 		=> __('Add New Testimonial','edgt_core'),
                    'edit_item' 		=> __('Edit Testimonial','edgt_core')
                ),
                'public'		=>	false,
                'show_in_menu'	=>	true,
                'rewrite' 		=> 	array('slug' => 'testimonials'),
                'menu_position' => 	$menuPosition,
                'show_ui'		=>	true,
                'has_archive'	=>	false,
                'hierarchical'	=>	false,
                'supports'		=>	array('title', 'thumbnail'),
                'menu_icon'  =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __( 'Testimonials Categories', 'taxonomy general name' ),
            'singular_name' => __( 'Testimonial Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Testimonials Categories','edgt_core' ),
            'all_items' => __( 'All Testimonials Categories','edgt_core' ),
            'parent_item' => __( 'Parent Testimonial Category','edgt_core' ),
            'parent_item_colon' => __( 'Parent Testimonial Category:','edgt_core' ),
            'edit_item' => __( 'Edit Testimonials Category','edgt_core' ),
            'update_item' => __( 'Update Testimonials Category','edgt_core' ),
            'add_new_item' => __( 'Add New Testimonials Category','edgt_core' ),
            'new_item_name' => __( 'New Testimonials Category Name','edgt_core' ),
            'menu_name' => __( 'Testimonials Categories','edgt_core' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'testimonials-category' ),
        ));
    }

}