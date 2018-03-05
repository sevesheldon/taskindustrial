<?php
namespace EdgeCore\CPT\Portfolio;

use EdgeCore\Lib\PostTypeInterface;

/**
 * Class PortfolioRegister
 * @package EdgeCore\CPT\Portfolio
 */
class PortfolioRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'portfolio_page';
        $this->taxBase = 'portfolio_category';

        add_filter('single_template', array($this, 'registerSingleTemplate'));
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
        $this->registerTagTax();
    }

    /**
     * Registers portfolio single template if one does'nt exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-portfolio_page.php')) {
                return EDGE_CORE_CPT_PATH.'/portfolio/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $edgtFramework, $edgt_options;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';
        $slug = 'portfolio_page';

        if(edgt_core_theme_installed()) {
            $menuPosition = $edgtFramework->getSkin()->getMenuItemPosition('portfolio');
            $menuIcon = $edgtFramework->getSkin()->getMenuIcon('portfolio');

            if(isset($edgt_options['portfolio_single_slug'])) {
                if($edgt_options['portfolio_single_slug'] != ""){
                    $slug = $edgt_options['portfolio_single_slug'];
                }
            }
        }

        register_post_type( 'portfolio_page',
            array(
                'labels' => array(
                    'name' => __( 'Portfolio','edgt_core' ),
                    'singular_name' => __( 'Portfolio Item','edgt_core' ),
                    'add_item' => __('New Portfolio Item','edgt_core'),
                    'add_new_item' => __('Add New Portfolio Item','edgt_core'),
                    'edit_item' => __('Edit Portfolio Item','edgt_core')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui' => true,
                'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'  =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __( 'Portfolio Categories', 'taxonomy general name' ),
            'singular_name' => __( 'Portfolio Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Portfolio Categories','edgt_core' ),
            'all_items' => __( 'All Portfolio Categories','edgt_core' ),
            'parent_item' => __( 'Parent Portfolio Category','edgt_core' ),
            'parent_item_colon' => __( 'Parent Portfolio Category:','edgt_core' ),
            'edit_item' => __( 'Edit Portfolio Category','edgt_core' ),
            'update_item' => __( 'Update Portfolio Category','edgt_core' ),
            'add_new_item' => __( 'Add New Portfolio Category','edgt_core' ),
            'new_item_name' => __( 'New Portfolio Category Name','edgt_core' ),
            'menu_name' => __( 'Portfolio Categories','edgt_core' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'portfolio-category' ),
        ));
    }

    /**
     * Registers custom tag taxonomy with WordPress
     */
    private function registerTagTax() {
        $labels = array(
            'name' => __( 'Portfolio Tags', 'taxonomy general name' ),
            'singular_name' => __( 'Portfolio Tag', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Portfolio Tags','edgt_core' ),
            'all_items' => __( 'All Portfolio Tags','edgt_core' ),
            'parent_item' => __( 'Parent Portfolio Tag','edgt_core' ),
            'parent_item_colon' => __( 'Parent Portfolio Tags:','edgt_core' ),
            'edit_item' => __( 'Edit Portfolio Tag','edgt_core' ),
            'update_item' => __( 'Update Portfolio Tag','edgt_core' ),
            'add_new_item' => __( 'Add New Portfolio Tag','edgt_core' ),
            'new_item_name' => __( 'New Portfolio Tag Name','edgt_core' ),
            'menu_name' => __( 'Portfolio Tags','edgt_core' ),
        );

        register_taxonomy('portfolio_tag',array($this->base), array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'portfolio-tag' ),
        ));
    }
}