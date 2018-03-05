<?php

if(!function_exists('edgt_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function edgt_is_responsive_on() {
        global $edgt_options;

        return isset($edgt_options['responsiveness']) && $edgt_options['responsiveness'] !== 'no';
    }
}

if(!function_exists('edgt_is_seo_enabled')) {
    /**
     * Checks if SEO is enabled in theme options
     * @return bool
     */
    function edgt_is_seo_enabled() {
        global $edgt_options;

        return isset($edgt_options['disable_edgt_seo']) && $edgt_options['disable_edgt_seo'] == 'no';
    }
}

if(!function_exists('edgt_get_header_variables')) {
    function edgt_get_header_variables() {
        global $edgt_options;

        //init variables
        $id = edgt_get_page_id();
        $loading_animation = true;
        $loading_image =  "";
        $enable_side_area = "yes";
        $enable_popup_menu = "no";
        $popup_menu_animation_style = '';
        $enable_fullscreen_search = "no";
        $fullscreen_search_animation = "fade";
        $header_button_size = '';
        $paspartu_header_alignment = false;
        $header_in_grid = true;
        $header_bottom_class = ' header_in_grid';
        $menu_item_icon_position = "";
        $menu_position = "";
        $centered_logo = edgt_is_logo_centered();
        $enable_border_top_bottom_menu = false;
        $menu_dropdown_appearance_class = "";
        $logo_wrapper_style = "";
        $divided_left_menu_padding = "";
        $divided_right_menu_padding = "";
        $display_header_top = "yes";
        $header_top_area_scroll = "no";
        $header_style = edgt_get_header_style();
        $header_color_transparency_per_page = edgt_get_header_transparency();
        $header_color_per_page = "";
        $header_top_color_per_page = "";
        $header_color_transparency_on_scroll = "";
        $header_bottom_border_style = '';
        $header_bottom_appearance = 'fixed';
        $header_transparency = '';
        $enable_vertical_menu = false;
        $enable_search_left_sidearea_right = false;
        $vertical_area_background_image = "";
        $vertical_menu_style = "toggle";
        $vertical_area_scroll = " with_scroll";
        $page_vertical_area_background_transparency = "";
        $page_vertical_area_background = "";

        if (isset($edgt_options['loading_animation'])) {
            if($edgt_options['loading_animation'] == "off") {
                $loading_animation = false;
            }
        }

        if (isset($edgt_options['loading_image']) && $edgt_options['loading_image'] != "") {
            $loading_image = $edgt_options['loading_image'];
        }

        if (isset($edgt_options['enable_side_area'])) {
            if($edgt_options['enable_side_area'] == "no") {
                $enable_side_area = "no";
            }
        }

        if (isset($edgt_options['enable_popup_menu'])) {
            if($edgt_options['enable_popup_menu'] == "yes" && has_nav_menu('popup-navigation')) {
                $enable_popup_menu = "yes";
            }

            if (isset($edgt_options['popup_menu_animation_style']) && !empty($edgt_options['popup_menu_animation_style'])) {
                $popup_menu_animation_style = $edgt_options['popup_menu_animation_style'];
            }
        }

        if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" && isset($edgt_options['search_type']) && $edgt_options['search_type'] == "fullscreen_search" ){
            $enable_fullscreen_search="yes";
        }

        if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "fullscreen_search" && isset($edgt_options['search_animation']) && $edgt_options['search_animation'] !== "" ){
            $fullscreen_search_animation = $edgt_options['search_animation'];
        }

        if(isset($edgt_options['header_buttons_size'])){
            $header_button_size = $edgt_options['header_buttons_size'];
        }

        if(isset($edgt_options['paspartu_header_alignment'])
            && $edgt_options['paspartu_header_alignment'] == 'yes'
            && isset($edgt_options['paspartu'])
            && $edgt_options['paspartu'] == 'yes') {
            $paspartu_header_alignment = true;
        }

        if ($edgt_options['header_in_grid'] == "no" || $paspartu_header_alignment){
            $header_in_grid = false;
        }

        if($header_in_grid) {
            $header_bottom_class = ' header_in_grid';
        } else {
            $header_bottom_class = ' header_full_width';
        }

        if(isset($edgt_options['menu_item_icon_position'])) {
            $menu_item_icon_position = $edgt_options['menu_item_icon_position'];
        }

        if(isset($edgt_options['menu_position'])) {
            $menu_position = $edgt_options['menu_position'];
        }


        if(isset($edgt_options['enable_border_top_bottom_menu']) && $edgt_options['enable_border_top_bottom_menu'] == "yes") {
            $enable_border_top_bottom_menu = true;
        }

        if(isset($edgt_options['menu_dropdown_appearance']) && $edgt_options['menu_dropdown_appearance'] != "default"){
            $menu_dropdown_appearance_class = $edgt_options['menu_dropdown_appearance'];
        }

        if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "stick_with_left_right_menu"){
            $logo_wrapper_style = 'width:'.(esc_attr($edgt_options['logo_width'])/2).'px;';
            $divided_left_menu_padding = 'padding-right:'.(esc_attr($edgt_options['logo_width'])/4).'px;';
            $divided_right_menu_padding = 'padding-left:'.(esc_attr($edgt_options['logo_width'])/4).'px;';
        }

        if($edgt_options['center_logo_image'] == "yes" && $edgt_options['header_bottom_appearance'] == "regular"){
            $logo_wrapper_style = 'height:'.(esc_attr($edgt_options['logo_height'])/2).'px;';
        }

        if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "fixed_top_header"){
            $logo_wrapper_style = 'height:'.(esc_attr($edgt_options['logo_height'])/2).'px;';
        }

        if(isset($edgt_options['header_top_area'])){
            $display_header_top = $edgt_options['header_top_area'];
        }

        if(isset($edgt_options['header_top_area_scroll'])){
            $header_top_area_scroll = $edgt_options['header_top_area_scroll'];
        }

        if(get_post_meta($id, "edgt_header_color_per_page", true) != ""){
            if($header_color_transparency_per_page != ""){
                $header_background_color = edgt_hex2rgb(esc_attr(get_post_meta($id, "edgt_header_color_per_page", true)));
                $header_color_per_page .= "background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
            }else{
                $header_color_per_page .= "background-color:" . esc_attr(get_post_meta($id, "edgt_header_color_per_page", true)) . ";";
            }
        } else if($header_color_transparency_per_page != "" && get_post_meta($id, "edgt_header_color_per_page", true) == ""){
            $header_background_color = $edgt_options['header_background_color'] ? edgt_hex2rgb(esc_attr($edgt_options['header_background_color'])) : edgt_hex2rgb("#ffffff");
            $header_color_per_page .= "background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
        }

        if(isset($edgt_options['header_botom_border_in_grid']) && $edgt_options['header_botom_border_in_grid'] != "yes" && get_post_meta($id, "edgt_header_bottom_border_color", true) != ""){
            $header_color_per_page .= "border-bottom: 1px solid ".esc_attr(get_post_meta($id, "edgt_header_bottom_border_color", true)).";";
        }

        if(get_post_meta($id, "edgt_header_color_per_page", true) != ""){
            if($header_color_transparency_per_page != ""){
                $header_background_color = edgt_hex2rgb(esc_attr(get_post_meta($id, "edgt_header_color_per_page", true)));
                $header_top_color_per_page .= "background-color:rgba(" . esc_attr($header_background_color[0]) . ", " . esc_attr($header_background_color[1]) . ", " . esc_attr($header_background_color[2]) . ", " . esc_attr($header_color_transparency_per_page) . ");";
            }else{
                $header_top_color_per_page .= "background-color:" . esc_attr(get_post_meta($id, "edgt_header_color_per_page", true)) . ";";
            }
        } else if($header_color_transparency_per_page != "" && get_post_meta($id, "edgt_header_color_per_page", true) == ""){
            $header_background_color = $edgt_options['header_top_background_color'] ? edgt_hex2rgb(esc_attr($edgt_options['header_top_background_color'])) : edgt_hex2rgb("#ffffff");
            $header_top_color_per_page .= "background-color:rgba(" . esc_attr($header_background_color[0]) . ", " . esc_attr($header_background_color[1]) . ", " . esc_attr($header_background_color[2]) . ", " . esc_attr($header_color_transparency_per_page) . ");";
        }

        if(isset($edgt_options['header_background_transparency_sticky']) && $edgt_options['header_background_transparency_sticky'] != ""){
            $header_color_transparency_on_scroll = $edgt_options['header_background_transparency_sticky'];
        }

        if(isset($edgt_options['header_botom_border_in_grid']) && $edgt_options['header_botom_border_in_grid'] == "yes" && get_post_meta($id, "edgt_header_bottom_border_color", true) != ""){
            $header_bottom_border_style = 'border-bottom: 1px solid '.esc_attr(get_post_meta($id, "edgt_header_bottom_border_color", true)).';';
        }

        if(isset($edgt_options['header_bottom_appearance'])){
            $header_bottom_appearance = $edgt_options['header_bottom_appearance'];
        }

        $per_page_header_transparency = esc_attr(get_post_meta($id, 'edgt_header_color_transparency_per_page', true));
        if($per_page_header_transparency !== '' && $per_page_header_transparency !== false) {
            $header_transparency = $per_page_header_transparency;
        } else {
            $header_transparency = esc_attr($edgt_options['header_background_transparency_initial']);
        }

        if(edgt_is_side_header()){
            $enable_vertical_menu = true;
        }

        if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] =='fixed_hiding'){
            if(isset($edgt_options['search_left_sidearea_right']) && $edgt_options['search_left_sidearea_right'] =='yes'){
                $enable_search_left_sidearea_right = true;
            }
        }else{
            if(isset($edgt_options['search_left_sidearea_right_regular']) && $edgt_options['search_left_sidearea_right_regular'] =='yes'){
                $enable_search_left_sidearea_right = true;
            }
        }

        if(isset($edgt_options['vertical_area_background_image']) && $edgt_options['vertical_area_background_image'] != "" && isset($edgt_options['vertical_area_dropdown_showing']) && $edgt_options['vertical_area_dropdown_showing'] != "side" && get_post_meta($id, "edgt_page_disable_vertical_area_background_image", true) != "yes") {
            $vertical_area_background_image = $edgt_options['vertical_area_background_image'];
        }
        if(get_post_meta($id, "edgt_page_vertical_area_background_image", true) != "" && get_post_meta($id, "edgt_page_disable_vertical_area_background_image", true) != "yes" && isset($edgt_options['vertical_area_dropdown_showing']) && $edgt_options['vertical_area_dropdown_showing'] != "side"){
            $vertical_area_background_image = get_post_meta($id, "edgt_page_vertical_area_background_image", true);
        }

        $vertical_area_dropdown_showing = $edgt_options['vertical_area_dropdown_showing'];
		
		if(isset($edgt_options['vertical_area_nav_in_middle']) && $edgt_options['vertical_area_nav_in_middle']=="yes"){
			$vertical_menu_style = 'to_content';
		}
		else{
			switch($vertical_area_dropdown_showing){
				case 'hover':
					$vertical_menu_style = "toggle";
					break;
				case 'click':
					$vertical_menu_style = "toggle click";
					break;
				case 'side':
					$vertical_menu_style = "side";
					break;
				case 'to_content':
					$vertical_menu_style = "to_content";
					break;
				default:
					$vertical_menu_style = "toggle";

			}
		}
		
        $vertical_area_scroll = " with_scroll";
        if ($vertical_area_dropdown_showing == 'to_content') {
            $vertical_area_scroll = "";
        }

        if(isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'yes' && isset($edgt_options['vertical_menu_inside_paspartu']) && $edgt_options['vertical_menu_inside_paspartu'] == 'yes'){
            if($edgt_options['vertical_area_background_transparency'] != "") {
                $page_vertical_area_background_transparency = esc_attr($edgt_options['vertical_area_background_transparency']);
            }
            if(get_post_meta($id, "edgt_page_vertical_area_background_opacity", true) != ""){
                $page_vertical_area_background_transparency = esc_attr(get_post_meta($id, "edgt_page_vertical_area_background_opacity", true));
            }

            if(isset($edgt_options['vertical_area_dropdown_showing']) && $edgt_options['vertical_area_dropdown_showing'] == "side"){
                $page_vertical_area_background_transparency = 1;
            }
        }
        else if(isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'no') {
            if($edgt_options['vertical_area_background_transparency'] != "") {
                $page_vertical_area_background_transparency = esc_attr($edgt_options['vertical_area_background_transparency']);
            }
            if(get_post_meta($id, "edgt_page_vertical_area_background_opacity", true) != ""){
                $page_vertical_area_background_transparency = esc_attr(get_post_meta($id, "edgt_page_vertical_area_background_opacity", true));
            }

            if(isset($edgt_options['vertical_area_dropdown_showing']) && $edgt_options['vertical_area_dropdown_showing'] == "side"){
                $page_vertical_area_background_transparency = 1;
            }
        }

        if(get_post_meta($id, "edgt_page_vertical_area_background", true) != ""){
            $page_vertical_area_background =esc_attr(get_post_meta($id, 'edgt_page_vertical_area_background', true));

        }else if(get_post_meta($id, "edgt_page_vertical_area_background", true) == ""){
            $page_vertical_area_background = $edgt_options['vertical_area_background'];
        }

        $bkg_image="";
        $page_vertical_area_background_style = "";
        $page_vertical_area_background_transparency_style = "";
        if($vertical_area_background_image != ""){ $bkg_image = 'background-image:url('.esc_url($vertical_area_background_image).');'; }
        if($page_vertical_area_background != ""){ $page_vertical_area_background_style = 'background-color:'.esc_attr($page_vertical_area_background).';'; }
        if($page_vertical_area_background_transparency != ""){ $page_vertical_area_background_transparency_style = 'opacity:'.esc_attr($page_vertical_area_background_transparency).';'; }

        $vertical_area_menu_items_arrow = '';
        if (isset($edgt_options['vertical_area_menu_items_arrow']) && $edgt_options['vertical_area_menu_items_arrow'] =='yes' ){
            $vertical_area_menu_items_arrow = 'with_arrow';
        }

        return array(
            'id' => $id,
            'loading_animation' => $loading_animation,
            'loading_image' => $loading_image,
            'enable_side_area' => $enable_side_area,
            'enable_popup_menu' => $enable_popup_menu,
            'popup_menu_animation_style' => $popup_menu_animation_style,
            'enable_fullscreen_search' => $enable_fullscreen_search,
            'fullscreen_search_animation' => $fullscreen_search_animation,
            'header_button_size' => $header_button_size,
            'header_in_grid' => $header_in_grid,
            'header_bottom_class' => $header_bottom_class,
            'menu_item_icon_position' => $menu_item_icon_position,
            'menu_position' => $menu_position,
            'centered_logo' => $centered_logo,
            'enable_border_top_bottom_menu' => $enable_border_top_bottom_menu,
            'menu_dropdown_appearance_class' => $menu_dropdown_appearance_class,
            'logo_wrapper_style' => $logo_wrapper_style,
            'divided_left_menu_padding' => $divided_left_menu_padding,
            'divided_right_menu_padding' => $divided_right_menu_padding,
            'display_header_top' => $display_header_top,
            'header_top_area_scroll' => $header_top_area_scroll,
            'header_style' => $header_style,
            'header_color_transparency_per_page' => $header_color_transparency_per_page,
            'header_color_per_page' => $header_color_per_page,
            'header_top_color_per_page' => $header_top_color_per_page,
            'header_color_transparency_on_scroll' => $header_color_transparency_on_scroll,
            'header_bottom_border_style' => $header_bottom_border_style,
            'header_bottom_appearance' => $header_bottom_appearance,
            'header_transparency' => $header_transparency,
            'enable_vertical_menu' => $enable_vertical_menu,
            'enable_search_left_sidearea_right' => $enable_search_left_sidearea_right,
            'vertical_area_background_image' => $vertical_area_background_image,
            'vertical_menu_style' => $vertical_menu_style,
            'vertical_area_scroll' => $vertical_area_scroll,
            'page_vertical_area_background_transparency' => $page_vertical_area_background_transparency,
            'page_vertical_area_background' => $page_vertical_area_background,
            'bkg_image' => $bkg_image,
            'page_vertical_area_background_style' => $page_vertical_area_background_style,
            'page_vertical_area_background_transparency_style' => $page_vertical_area_background_transparency_style,
            'vertical_area_menu_items_arrow' => $vertical_area_menu_items_arrow
        );
    }
}

if(!function_exists('edgt_get_footer_variables')) {
    function edgt_get_footer_variables() {
        global $edgt_options;

        $id = edgt_get_page_id();

        $footer_border_columns				= 'yes';
        $footer_top_border_color            = '';
        $footer_top_border_in_grid          = '';
        $footer_bottom_border_in_grid       = '';
        $footer_bottom_border_color         = '';
        $footer_bottom_border_bottom_color  = '';
        $footer_classes                     = '';
        $footer_classes_array               = array();
        $footer_in_grid                     = true;
        $display_footer_top                 = true;
        $footer_top_columns                 = 4;
        $footer_bottom_columns              = 3;

        if(isset($edgt_options['footer_border_columns']) && $edgt_options['footer_border_columns'] !== '') {
            $footer_border_columns = $edgt_options['footer_border_columns'];
        }

        if(!empty($edgt_options['footer_top_border_color'])) {
            if (isset($edgt_options['footer_top_border_width']) && $edgt_options['footer_top_border_width'] !== '') {
                $footer_border_height = $edgt_options['footer_top_border_width'];
            } else {
                $footer_border_height = '1';
            }

            $footer_top_border_color = 'height: '.esc_attr($footer_border_height).'px;background-color: '.esc_attr($edgt_options['footer_top_border_color']).';';
        }

        if(isset($edgt_options['footer_top_border_in_grid']) && $edgt_options['footer_top_border_in_grid'] == 'yes') {
            $footer_top_border_in_grid = 'in_grid';
        }

        if(isset($edgt_options['footer_bottom_border_in_grid']) && $edgt_options['footer_bottom_border_in_grid'] == 'yes') {
            $footer_bottom_border_in_grid = 'in_grid';
        }

        if(!empty($edgt_options['footer_bottom_border_color'])) {
            if(!empty($edgt_options['footer_bottom_border_width'])) {
                $footer_bottom_border_width = $edgt_options['footer_bottom_border_width'].'px';
            }
            else{
                $footer_bottom_border_width = '1px';
            }

            $footer_bottom_border_color = 'height: '.esc_attr($footer_bottom_border_width).';background-color: '.esc_attr($edgt_options['footer_bottom_border_color']).';';
        }


        if(!empty($edgt_options['footer_bottom_border_bottom_color'])) {
            if(!empty($edgt_options['footer_bottom_border_bottom_width'])) {
                $footer_bottom_border_bottom_width = $edgt_options['footer_bottom_border_bottom_width'].'px';
            } else {
                $footer_bottom_border_bottom_width = '1px';
            }

            $footer_bottom_border_bottom_color = 'height: '.esc_attr($footer_bottom_border_bottom_width).';background-color: '.esc_attr($edgt_options['footer_bottom_border_bottom_color']).';';
        }

        //is uncovering footer option set in theme options?
        if(isset($edgt_options['uncovering_footer']) && $edgt_options['uncovering_footer'] == "yes" && isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'no') {
            //add uncovering footer class to array
            $footer_classes_array[] = 'uncover';
        }


        if(get_post_meta($id, "edgt_footer-disable", true) == "yes"){
            $footer_classes_array[] = 'disable_footer';
        }

        if($footer_border_columns == 'yes') {
            $footer_classes_array[] = 'footer_border_columns';
        }

        if(isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'yes' && isset($edgt_options['paspartu_footer_alignment']) && $edgt_options['paspartu_footer_alignment'] == 'yes'){
            $footer_classes_array[]= 'paspartu_footer_alignment';
        }

        if($edgt_options['overlapping_content'] == 'yes' && $edgt_options['overlapping_bottom_content_amount'] !== "") {
            $footer_classes_array[]= 'footer_overlapped';
        }

        //is some class added to footer classes array?
        if(is_array($footer_classes_array) && count($footer_classes_array)) {
            //concat all classes and prefix it with class attribute
            $footer_classes = esc_attr(implode(' ', $footer_classes_array));
        }

        if(isset($edgt_options['footer_in_grid'])){
            if ($edgt_options['footer_in_grid'] != "yes") {
                $footer_in_grid = false;
            }
        }

        if (isset($edgt_options['show_footer_top']) && $edgt_options['show_footer_top'] == "no") {
            $display_footer_top = false;
        }

        if (isset($edgt_options['footer_top_columns'])) {
            $footer_top_columns = $edgt_options['footer_top_columns'];
        }

        if (isset($edgt_options['footer_bottom_columns'])) {
            $footer_bottom_columns = $edgt_options['footer_bottom_columns'];
        }

        return array(
            'footer_border_columns' => $footer_border_columns,
            'footer_top_border_color' => $footer_top_border_color,
            'footer_top_border_in_grid' => $footer_top_border_in_grid,
            'footer_bottom_border_in_grid' => $footer_bottom_border_in_grid,
            'footer_bottom_border_color' => $footer_bottom_border_color,
            'footer_bottom_border_bottom_color' => $footer_bottom_border_bottom_color,
            'footer_classes' => $footer_classes,
            'footer_in_grid' => $footer_in_grid,
            'display_footer_top' => $display_footer_top,
            'footer_top_columns' => $footer_top_columns,
            'footer_bottom_columns' => $footer_bottom_columns
        );
    }
}

if(!function_exists('edgt_is_logo_centered')) {
    /**
     * Checks if logo is centered or not
     * @return bool
     */
    function edgt_is_logo_centered() {
        global $edgt_options;

        $centered_logo = false;

        if (isset($edgt_options['center_logo_image'])) {
            if($edgt_options['center_logo_image'] == "yes" && $edgt_options['header_bottom_appearance'] !== "stick_with_left_right_menu") {
                $centered_logo = true;
            }
        }

        if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "fixed_hiding"){
            $centered_logo = true;
        }

        return $centered_logo;
    }
}

if(!function_exists('edgt_get_header_style')) {
    /**
     * Returns current page header style. It first checks in current page meta field,
     * if that isn't set it checks in global options
     * @return mixed|string
     */
    function edgt_get_header_style() {
        global $edgt_options;

        $id = edgt_get_page_id();
        $header_style = '';

        if(get_post_meta($id, "edgt_header-style", true) != "") {
            $header_style = get_post_meta($id, "edgt_header-style", true);
        } elseif(isset($edgt_options['header_style'])) {
            $header_style = $edgt_options['header_style'];
        }

        return $header_style;
    }
}

if(!function_exists('edgt_get_header_transparency')) {
    /**
     * Returns current page's header transparency. First it checks in current page custom field,
     * if not set it checks in global options
     * @return mixed|string
     */
    function edgt_get_header_transparency() {
        global $edgt_options;

        $id = edgt_get_page_id();
        $header_color_transparency_per_page = '';


        if(get_post_meta($id, "edgt_header_color_transparency_per_page", true) != ""){
            $header_color_transparency_per_page = get_post_meta($id, "edgt_header_color_transparency_per_page", true);
        } elseif($edgt_options['header_background_transparency_initial'] != "") {
            $header_color_transparency_per_page = $edgt_options['header_background_transparency_initial'];
        }

        return $header_color_transparency_per_page;
    }
}

if(!function_exists('edgt_is_top_header')) {
    /**
     * Checks if header type is top
     * @return bool
     */
    function edgt_is_top_header() {
        global $edgt_options;

		$top_header = false;
		
        if($edgt_options['header_type'] == "top") {
            $top_header = true;
        }

        return $top_header;
    }
}

if(!function_exists('edgt_is_side_header')) {
    /**
     * Checks if header type is side
     * @return bool
     */
    function edgt_is_side_header() {
        global $edgt_options;

		$side_header = false;
		
        if($edgt_options['header_type'] == "side") {
            $side_header = true;
        }

        return $side_header;
    }
}

if(!function_exists('edgt_is_ribbon_header')) {
    /**
     * Checks if header type is ribbon
     * @return bool
     */
    function edgt_is_ribbon_header() {
        global $edgt_options;

		$ribbon_header = false;
		
        if($edgt_options['header_type'] == "ribbon") {
            $ribbon_header = true;
        }

        return $ribbon_header;
    }
}

if(!function_exists('edgt_space_around_content')) {
    /**
     * Checks if there is spacing around content
     * @return bool
     */
    function edgt_space_around_content() {
        global $edgt_options;

        $space_around_content = false;

        if($edgt_options['boxed'] == "yes" && $edgt_options['spacing_arround_content'] == "yes") {
            $space_around_content = true;
        }

        return $space_around_content;
    }
}

if(!function_exists('edgt_include_footer_in_content')) {
    /**
     * Checks if footer is included in spacing
     * @return bool
     */
    function edgt_include_footer_in_content() {
        global $edgt_options;

        $include_footer_in_content = false;

        if($edgt_options['boxed'] == "yes" && $edgt_options['spacing_arround_content'] == "yes" && $edgt_options['footer_in_content'] == "yes") {
            $include_footer_in_content = true;
        }

        return $include_footer_in_content;
    }
}