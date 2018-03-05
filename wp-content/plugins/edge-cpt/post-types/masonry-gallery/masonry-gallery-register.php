<?php
/**
 * Created by PhpStorm.
 * User: korisnik
 * Date: 30/3/2015
 * Time: 11:25 AM
 */

namespace EdgeCore\CPT\MasonryGallery;

use EdgeCore\Lib;

/**
 * Class MasonryGalleryRegister
 * @package EdgeCore\CPT\MasonryGallery
 */
class MasonryGalleryRegister implements Lib\PostTypeInterface  {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'masonry_gallery';
        $this->taxBase = 'masonry_gallery_category';
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

		$menuPosition = 20;
		$menuIcon = 'dashicons-schedule';
		if(edgt_core_theme_installed()) {
			$menuPosition = $edgtFramework->getSkin()->getMenuItemPosition('masonry_gallery');
			$menuIcon = $edgtFramework->getSkin()->getMenuIcon('masonry_gallery');
		}

        register_post_type($this->base,
            array(
                'labels' 		=> array(
                    'name' 				=> __('Masonry Gallery','edgt_core' ),
                    'all_items'			=> __('Masonry Gallery Items','edgt_core'),
                    'singular_name' 	=> __('Masonry Gallery Item','edgt_core' ),
                    'add_item'			=> __('New Masonry Gallery Item','edgt_core'),
                    'add_new_item' 		=> __('Add New Masonry Gallery Item','edgt_core'),
                    'edit_item' 		=> __('Edit Masonry Gallery Item','edgt_core')
                ),
                'public'		=>	false,
                'show_in_menu'	=>	true,
                'rewrite' 		=> 	array('slug' => 'masonry_gallery'),
                'menu_position' => 	$menuPosition,
                'show_ui'		=>	true,
                'has_archive'	=>	false,
                'hierarchical'	=>	false,
                'supports'		=>	array('title', 'thumbnail'),
				'menu_icon'  	=>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __( 'Masonry Gallery Categories', 'taxonomy general name' ),
            'singular_name' => __( 'Masonry Gallery Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Masonry Gallery Categories','edgt_core' ),
            'all_items' => __( 'All Masonry Gallery Categories','edgt_core' ),
            'parent_item' => __( 'Parent Masonry Gallery Category','edgt_core' ),
            'parent_item_colon' => __( 'Parent Masonry Gallery Category:','edgt_core' ),
            'edit_item' => __( 'Edit Masonry Gallery Category','edgt_core' ),
            'update_item' => __( 'Update Masonry Gallery Category','edgt_core' ),
            'add_new_item' => __( 'Add New Masonry Gallery Category','edgt_core' ),
            'new_item_name' => __( 'New Masonry Gallery Category Name','edgt_core' ),
            'menu_name' => __( 'Masonry Gallery Categories','edgt_core' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'masonry-gallery-category' ),
        ));
    }
}