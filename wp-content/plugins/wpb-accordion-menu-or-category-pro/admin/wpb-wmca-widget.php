<?php

/*
	WPB Menu & Category Accordion
	By WPBean
	
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 



/* ==========================================================================
   Add WPB WMCA Menu Accordion Widget Class
   ========================================================================== */

class wpb_wmca_menu_accordion_Widget extends WP_Widget {

	/**
	 * Register widget
	 */
	function __construct() {
		parent::__construct(
			'wpb_wmca_menu_accordion_widget', // Base ID
			__( 'WPB Menu Accordion', 'wpb-accordion-menu-or-category' ), // Name
			array( 'description' => __( 'Dispay accordion of WordPress menu.', 'wpb-accordion-menu-or-category' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {

		extract( $args );
		extract( $instance );

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . apply_filters( 'widget_title', $title ). $after_title;
		}

		echo do_shortcode( '[wpb_menu_accordion theme_location="'.$theme_location.'" menu="'.$menu.'" accordion="'.( $accordion && $accordion == 'on' ? 'yes' : 'no' ).'" depth="'.$depth.'" xclass="'.$xclass.'"]' );

		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
		extract( $instance );
		if( !isset( $theme_location ) ){
			$theme_location = '';
		}
		if( !isset( $menu ) ){
			$menu = '';
		}
		if( !isset( $accordion ) ){
			$accordion = 'on';
		}
		if( !isset( $depth ) ){
			$depth = '0';
		}
		if( !isset( $xclass ) ){
			$xclass = '';
		}

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','wpb-accordion-menu-or-category' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php if( isset( $title ) ) echo esc_attr( $title ); ?>">
		</p>

		<strong><?php _e( 'Select a theme location or select a menu. Do not select theme location & menu at a time. Use one of it.','wpb-accordion-menu-or-category' ); ?></strong>

		<p>
			<?php $wpb_wmca_menu_locations = get_nav_menu_locations();?>
			<label for="<?php echo $this->get_field_id( 'theme_location' ); ?>"><?php _e( 'Select a theme location','wpb-accordion-menu-or-category' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'theme_location' ); ?>" name="<?php echo $this->get_field_name( 'theme_location' ); ?>">
				<option value="" ><?php _e( '- Select an option -','wpb-accordion-menu-or-category' ); ?></option>
				<?php 
					foreach ($wpb_wmca_menu_locations as $key => $wpb_wmca_menu_location) {
						if( $wpb_wmca_menu_location != 0 ){
							?>
							<option value="<?php echo $key; ?>" <?php if( $theme_location && $theme_location == $key ) echo 'selected';?>><?php echo $key; ?></option>
							<?php
						}
					}
				?>
			</select>
		</p>

		<p>
			<?php $wpb_wmca_menus = get_terms('nav_menu'); ?>
			<label for="<?php echo $this->get_field_id( 'menu' ); ?>"><?php _e( 'Select a menu','wpb-accordion-menu-or-category' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'menu' ); ?>" name="<?php echo $this->get_field_name( 'menu' ); ?>">
				<option value="" ><?php _e( '- Select an option -','wpb-accordion-menu-or-category' ); ?></option>
				<?php 
					foreach ( $wpb_wmca_menus as $wpb_wmca_menu ) {
						echo '<option value="'.$wpb_wmca_menu->slug.'" '.( $menu && $menu == $wpb_wmca_menu->slug ? 'selected' : '' ).'>' . $wpb_wmca_menu->name . '</option>';
					}
				?>
			</select>
		</p>

		<p>
			<span style="display: block"><?php _e( 'Close previously opened accordion','wpb-accordion-menu-or-category' ); ?></span>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'accordion' ); ?>" name="<?php echo $this->get_field_name( 'accordion' ); ?>" <?php if( $accordion && $accordion == 'on' ) echo 'checked';?>>
			<label for="<?php echo $this->get_field_id( 'accordion' ); ?>"><?php _e( 'Yes please.','wpb-accordion-menu-or-category' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'depth' ); ?>"><?php _e( 'Menu depth:','wpb-accordion-menu-or-category' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" type="number" value="<?php echo esc_attr( $depth ); ?>" required>
			<span class="wpb_widget_help"><?php _e( 'How many levels of the hierarchy are to be included where 0 means all.','wpb-accordion-menu-or-category' ); ?></span>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'xclass' ); ?>"><?php _e( 'Extra class:','wpb-accordion-menu-or-category' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'xclass' ); ?>" name="<?php echo $this->get_field_name( 'xclass' ); ?>" type="text" value="<?php if( isset( $xclass ) ) echo esc_attr( $xclass ); ?>">
		</p>

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['theme_location'] = ( ! empty( $new_instance['theme_location'] ) ) ? strip_tags( $new_instance['theme_location'] ) : '';
		$instance['menu'] = ( ! empty( $new_instance['menu'] ) ) ? strip_tags( $new_instance['menu'] ) : '';
		$instance['accordion'] = ( ! empty( $new_instance['accordion'] ) ) ? strip_tags( $new_instance['accordion'] ) : '';
		$instance['depth'] = ( ! empty( $new_instance['depth'] ) ) ? strip_tags( $new_instance['depth'] ) : 0;
		$instance['xclass'] = ( ! empty( $new_instance['xclass'] ) ) ? strip_tags( $new_instance['xclass'] ) : '';


		return $instance;
	}

} // class wpb_wmca_menu_accordion_Widget




/**
 * Register wpb_wmca_menu_accordion_Widget widget 
 */

function register_wpb_wmca_menu_accordion_widget() {
    register_widget( 'wpb_wmca_menu_accordion_Widget' );
}
add_action( 'widgets_init', 'register_wpb_wmca_menu_accordion_widget' );






/* ==========================================================================
   Add WPB WMCA Category Accordion Widget Class
   ========================================================================== */

class wpb_wmca_category_accordion_Widget extends WP_Widget {

	/**
	 * Register widget
	 */
	function __construct() {
		parent::__construct(
			'wpb_wmca_category_accordion_widget', // Base ID
			__( 'WPB Category Accordion', 'wpb-accordion-menu-or-category' ), // Name
			array( 'description' => __( 'Dispay accordion of WordPress Categories.', 'wpb-accordion-menu-or-category' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {

		extract( $args );
		extract( $instance );

		$exclude    = $instance['exclude'];
        if( !isset( $exclude ) ){
			$exclude = array();
		}
        $wpb_wmca_exclude_cats_id_comma_seperated = implode (", ", $exclude);

        $include    = $instance['include'];
        if( !isset( $include ) ){
			$include = array();
		}
        $wpb_wmca_include_cats_id_comma_seperated = implode (", ", $include);

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . apply_filters( 'widget_title', $title ). $after_title;
		}

		echo do_shortcode( '[wpb_category_accordion taxonomy="'.$taxonomy.'" orderby="'.$orderby.'" order="'.$order.'" show_count="'.( $show_count && $show_count == 'on' ? 'yes' : 'no' ).'" hide_empty="'.( $hide_empty && $hide_empty == 'on' ? 'yes' : 'no' ).'" hierarchical="'.( $hierarchical && $hierarchical == 'on' ? 'yes' : 'no' ).'" number="'.$number.'" depth="'.$depth.'" accordion="'.( $accordion && $accordion == 'on' ? 'yes' : 'no' ).'" xclass="'.$xclass.'" include="'.$wpb_wmca_include_cats_id_comma_seperated.'" exclude="'.$wpb_wmca_exclude_cats_id_comma_seperated.'"]' );

		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
		extract( $instance );

		if( !isset( $taxonomy ) ){
			$taxonomy = 'category';
		}
		if( !isset( $orderby ) ){
			$orderby = 'name';
		}
		if( !isset( $order ) ){
			$order = 'ASC';
		}
		if( !isset( $show_count ) ){
			$show_count = 'off';
		}
		if( !isset( $hide_empty ) ){
			$hide_empty = 'on';
		}
		if( !isset( $hierarchical ) ){
			$hierarchical = 'off';
		}
		if( !isset( $number ) ){
			$number = '0';
		}
		if( !isset( $depth ) ){
			$depth = '0';
		}
		if( !isset( $accordion ) ){
			$accordion = 'on';
		}
		if( !isset( $xclass ) ){
			$xclass = '';
		}
		if( !isset( $instance['exclude'] ) ){
			$instance['exclude'] = array();
		}
		if( !isset( $instance['include'] ) ){
			$instance['include'] = array();
		}

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','wpb-accordion-menu-or-category' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php if( isset( $title ) ) echo esc_attr( $title ); ?>">
		</p>

		<p>
			<?php $wpb_wmca_texonomies = get_taxonomies( array( 'public' => true ) ); ?>
			<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e( 'Select a taxonomy','wpb-accordion-menu-or-category' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>">
				<?php 
					foreach ( $wpb_wmca_texonomies as $wpb_wmca_texonomie ) {
						echo '<option value="'.$wpb_wmca_texonomie.'" '.( $taxonomy && $taxonomy == $wpb_wmca_texonomie ? 'selected' : '' ).'>' . $wpb_wmca_texonomie . '</option>';
					}
				?>
			</select>
		</p>

		<p><b>Use exclude or include, don't use both together. For exclude selected categories will be hidden form the accordion. and for include only selected categories will be shown.</b></p>

		<p>
            <label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e('Exclude Categories','wpb-accordion-menu-or-category'); ?></label>
            <span class="wpb_wmca_cat_exclude">
	            <?php
	            	$wpb_wmca_exclude_texonomies = get_terms( $taxonomy );
					foreach ($wpb_wmca_exclude_texonomies as $wpb_wmca_exclude_texonomie) {
						$option='<span><input type="checkbox" id="'. $this->get_field_id( 'exclude' ) .'[]" name="'. $this->get_field_name( 'exclude' ) .'[]"';
						if ( is_array($instance['exclude']) ) {
							foreach ($instance['exclude'] as $wpb_wmca_exclude_texonomies) {
								if($wpb_wmca_exclude_texonomies==$wpb_wmca_exclude_texonomie->term_id) {
									$option=$option.' checked="checked"';
								}
							}
						}
						$option .= ' value="'.$wpb_wmca_exclude_texonomie->term_id.'" />';
		                $option .= $wpb_wmca_exclude_texonomie->name;
		                $option .= ' ('.$wpb_wmca_exclude_texonomie->count.')';
		                $option .= '</span>';
		                echo $option;
	              	}
	            ?>
            </span>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('include'); ?>"><?php _e('Include Categories','wpb-accordion-menu-or-category'); ?></label>
            <span class="wpb_wmca_cat_include">
	            <?php
	            	$wpb_wmca_include_texonomies = get_terms( $taxonomy );
					foreach ($wpb_wmca_include_texonomies as $wpb_wmca_include_texonomie) {
						$option='<span><input type="checkbox" id="'. $this->get_field_id( 'include' ) .'[]" name="'. $this->get_field_name( 'include' ) .'[]"';
						if ( is_array($instance['include']) ) {
							foreach ($instance['include'] as $wpb_wmca_include_texonomies) {
								if($wpb_wmca_include_texonomies==$wpb_wmca_include_texonomie->term_id) {
									$option=$option.' checked="checked"';
								}
							}
						}
						$option .= ' value="'.$wpb_wmca_include_texonomie->term_id.'" />';
		                $option .= $wpb_wmca_include_texonomie->name;
		                $option .= ' ('.$wpb_wmca_include_texonomie->count.')';
		                $option .= '</span>';
		                echo $option;
	              	}
	            ?>
            </span>
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby','wpb-accordion-menu-or-category' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<option value="ID" <?php if( $orderby && $orderby == 'ID' ) echo 'selected';?>><?php _e( 'ID','wpb-accordion-menu-or-category' ); ?></option>
				<option value="name" <?php if( $orderby && $orderby == 'name' ) echo 'selected';?>><?php _e( 'Name','wpb-accordion-menu-or-category' ); ?></option>
				<option value="slug" <?php if( $orderby && $orderby == 'slug' ) echo 'selected';?>><?php _e( 'Slug','wpb-accordion-menu-or-category' ); ?></option>
				<option value="count" <?php if( $orderby && $orderby == 'count' ) echo 'selected';?>><?php _e( 'Count','wpb-accordion-menu-or-category' ); ?></option>
				<option value="term_group" <?php if( $orderby && $orderby == 'term_group' ) echo 'selected';?>><?php _e( 'Term Group','wpb-accordion-menu-or-category' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order','wpb-accordion-menu-or-category' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
				<option value="ASC" <?php if( $order && $order == 'ASC' ) echo 'selected';?>><?php _e( 'Ascending','wpb-accordion-menu-or-category' ); ?></option>
				<option value="DESC" <?php if( $order && $order == 'DESC' ) echo 'selected';?>><?php _e( 'Descending','wpb-accordion-menu-or-category' ); ?></option>
			</select>
		</p>

		<p>
			<span style="display: block"><?php _e( 'Show post count in category','wpb-accordion-menu-or-category' ); ?></span>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" <?php if( $show_count && $show_count == 'on' ) echo 'checked';?>>
			<label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e( 'Yes please.','wpb-accordion-menu-or-category' ); ?></label>
		</p>

		<p>
			<span style="display: block"><?php _e( 'Hide empty categories','wpb-accordion-menu-or-category' ); ?></span>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_empty' ); ?>" name="<?php echo $this->get_field_name( 'hide_empty' ); ?>" <?php if( $hide_empty && $hide_empty == 'on' ) echo 'checked';?>>
			<label for="<?php echo $this->get_field_id( 'hide_empty' ); ?>"><?php _e( 'Yes please.','wpb-accordion-menu-or-category' ); ?></label>
		</p>

		<p>
			<span style="display: block"><?php _e( 'Display sub-categories as inner list items (below the parent list item) or inline','wpb-accordion-menu-or-category' ); ?></span>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hierarchical' ); ?>" name="<?php echo $this->get_field_name( 'hierarchical' ); ?>" <?php if( $hierarchical && $hierarchical == 'on' ) echo 'checked';?>>
			<label for="<?php echo $this->get_field_id( 'hierarchical' ); ?>"><?php _e( 'Yes please.','wpb-accordion-menu-or-category' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of categories','wpb-accordion-menu-or-category' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" required>
			<span class="wpb_widget_help"><?php _e( 'How many categories to show where 0 means all.','wpb-accordion-menu-or-category' ); ?></span>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'depth' ); ?>"><?php _e( 'Category depth:','wpb-accordion-menu-or-category' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" type="number" value="<?php echo esc_attr( $depth ); ?>" required>
			<span class="wpb_widget_help"><?php _e( ' This parameter controls how many levels in the hierarchy of Categories are to be included in the list of Categories where 0 means all.','wpb-accordion-menu-or-category' ); ?></span>
		</p>

		<p>
			<span style="display: block"><?php _e( 'Close previously opened accordion','wpb-accordion-menu-or-category' ); ?></span>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'accordion' ); ?>" name="<?php echo $this->get_field_name( 'accordion' ); ?>" <?php if( $accordion && $accordion == 'on' ) echo 'checked';?>>
			<label for="<?php echo $this->get_field_id( 'accordion' ); ?>"><?php _e( 'Yes please.','wpb-accordion-menu-or-category' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'xclass' ); ?>"><?php _e( 'Extra class:','wpb-accordion-menu-or-category' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'xclass' ); ?>" name="<?php echo $this->get_field_name( 'xclass' ); ?>" type="text" value="<?php if( isset( $xclass ) ) echo esc_attr( $xclass ); ?>">
		</p>

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['taxonomy'] = ( ! empty( $new_instance['taxonomy'] ) ) ? strip_tags( $new_instance['taxonomy'] ) : '';
		$instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
		$instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
		$instance['show_count'] = ( ! empty( $new_instance['show_count'] ) ) ? strip_tags( $new_instance['show_count'] ) : '';
		$instance['hide_empty'] = ( ! empty( $new_instance['hide_empty'] ) ) ? strip_tags( $new_instance['hide_empty'] ) : '';
		$instance['hierarchical'] = ( ! empty( $new_instance['hierarchical'] ) ) ? strip_tags( $new_instance['hierarchical'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : 0;
		$instance['depth'] = ( ! empty( $new_instance['depth'] ) ) ? strip_tags( $new_instance['depth'] ) : 0;
		$instance['accordion'] = ( ! empty( $new_instance['accordion'] ) ) ? strip_tags( $new_instance['accordion'] ) : '';
		$instance['xclass'] = ( ! empty( $new_instance['xclass'] ) ) ? strip_tags( $new_instance['xclass'] ) : '';
		$instance['xclass'] = ( ! empty( $new_instance['xclass'] ) ) ? strip_tags( $new_instance['xclass'] ) : '';
		$instance['exclude'] = $new_instance['exclude'];
		$instance['include'] = $new_instance['include'];



		return $instance;
	}

} // class wpb_wmca_category_accordion_Widget




/**
 * Register wpb_wmca_category_accordion_Widget widget 
 */

function register_wpb_wmca_category_accordion_widget() {
    register_widget( 'wpb_wmca_category_accordion_Widget' );
}
add_action( 'widgets_init', 'register_wpb_wmca_category_accordion_widget' );