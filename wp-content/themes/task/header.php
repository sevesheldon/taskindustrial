<?php global $edgt_options, $edgtIconCollections, $wp_query; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php edgt_wp_title(); ?>

    <?php
    /**
     * @see edgt_header_meta() - hooked with 10
     * @see edgt_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('edgt_header_meta'); ?>

	<?php wp_head(); ?>

	<!-- This is just for the DEV site, all custom code for LIVE site is done in WP > Task Website Options > General > Custom CSS -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom.css"> 

</head>

<body <?php body_class(); ?>>

<?php extract(edgt_get_header_variables()); ?>

<?php if($loading_animation){ ?>
	<div class="ajax_loader">
        <div class="ajax_loader_1">
            <?php if($loading_image != "") { ?>
                <div class="ajax_loader_2">
                    <img src="<?php echo esc_url($loading_image); ?>" alt="" />
                </div>
            <?php } else {
                edgt_loading_spinners();
            } ?>
        </div>
    </div>
<?php } ?>
<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no' && edgt_is_top_header()) { ?>
	<section class="side_menu right">
		<?php if(isset($edgt_options['side_area_title']) && $edgt_options['side_area_title'] != "") { ?>
			<div class="side_menu_title">
				<h5><?php echo esc_html($edgt_options['side_area_title']) ?></h5>
			</div>
		<?php } ?>
		<div class="close_side_menu_holder">
            <div class="close_side_menu_holder_inner">
                <a href="#" target="_self" class="close_side_menu">
                    <span aria-hidden="true" class="icon_close"></span>
                </a></div>
        </div>
		<?php if(is_active_sidebar('sidearea')) {
            dynamic_sidebar('sidearea');
        } ?>
	</section>
<?php } ?>
<div class="wrapper">
<div class="wrapper_inner">	

<?php if(edgt_is_side_header()) { ?>
	<aside class="vertical_menu_area<?php echo esc_attr($vertical_area_scroll); ?> <?php echo esc_attr($header_style); ?>">
		<div class="vertical_menu_area_inner">
			<?php if(isset($edgt_options['vertical_area_type']) && ($edgt_options['vertical_area_type'] == 'hidden' || $edgt_options['vertical_area_type'] == 'hidden_with_icons')) { ?>
			<a href="#" class="vertical_menu_hidden_button">
				<span class="vertical_menu_hidden_button_line"></span>
			</a>
			<?php } ?>
			<div class="vertical_area_background <?php if($vertical_area_background_image != ""){ echo "preload_background";  } ?>" <?php echo 'style="'.esc_attr($bkg_image).esc_attr($page_vertical_area_background_transparency_style).esc_attr($page_vertical_area_background_style).'"'; ?>></div>
           

			<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
				<div class="vertical_logo_wrapper">
					<?php
					if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
					if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
					if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };

					?>
					<div class="edgt_logo_vertical" style="height: <?php echo esc_attr(intval($edgt_options['logo_height'])/2); ?>px;">
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/>
							<img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/>
							<img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/>
						</a>
					</div>

				</div>
			<?php } ?>

			<nav class="vertical_menu dropdown_animation vertical_menu_<?php echo esc_attr($vertical_menu_style); ?> <?php echo esc_attr($vertical_area_menu_items_arrow); ?>">
				<?php

				wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
					'container'  => '',
					'container_class' => '',
					'menu_class' => '',
					'menu_id' => '',
					'fallback_cb' => 'top_navigation_fallback',
					'link_before' => '<span>',
					'link_after' => '</span>',
					'walker' => new edgt_type1_walker_nav_menu()
				));
				?>
			</nav>
			<div class="vertical_menu_area_widget_holder">
				<?php if(is_active_sidebar('vertical_menu_area')) {
                    dynamic_sidebar('vertical_menu_area');
                } ?>
			</div>
		</div>
	</aside>
	<?php if((isset($edgt_options['vertical_area_type']) && ($edgt_options['vertical_area_type'] == 'hidden' || $edgt_options['vertical_area_type'] == 'hidden_with_icons')) &&
		(isset($edgt_options['vertical_logo_bottom']) && $edgt_options['vertical_logo_bottom'] !== '')) { ?>
		<div class="vertical_menu_area_bottom_logo">
			<div class="vertical_menu_area_bottom_logo_inner">
				<a href="javascript: void(0)">
					<img src="<?php echo esc_url($edgt_options['vertical_logo_bottom']); ?>" alt="vertical_menu_area_bottom_logo"/>
				</a>
			</div>
		</div>
	<?php } ?>

<?php } ?>

<?php if(edgt_is_ribbon_header()) { ?>

	<aside class="ribbon ribbon_opened">	
		<div class="ribbon_inner">
			<div class="base">
				<?php if ($edgt_options['show_logo'] == "yes"){ ?>
					<div class="ribbon_logo_wrapper">
						<?php
						if ($edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
						?>
						<div class="edgt_ribbon_logo" style="height: <?php echo esc_attr(intval($edgt_options['logo_height'])/2); ?>px;">
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/>
							</a>
						</div>
					</div>
				<?php } ?>
				<nav class="ribbon_menu">
					<?php

					wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
						'container'  => '',
						'container_class' => '',
						'menu_class' => '',
						'menu_id' => '',
						'fallback_cb' => 'top_navigation_fallback',
						'link_before' => '<span>',
						'link_after' => '</span>',
						'walker' => new edgt_type1_walker_nav_menu()
					));
					?>
				</nav>
				<div class="close_ribbon"><a href="#"><span class="arrow_carrot-up" aria-hidden="true"></span></a></div>
			</div>
			<div class="corner_wrapper">
				<div class="left_corner"></div>
				<div class="right_corner"></div>
			</div>
		</div>
	</aside>
	
	<aside class="ribbon ribbon_closed">	
		<div class="ribbon_inner">
			<div class="base">
				<?php if ($edgt_options['show_logo'] == "yes"){ ?>
					<div class="ribbon_logo_wrapper">
						<?php
						if ($edgt_options['ribbon_closed_image'] != ""){ $logo_image = $edgt_options['ribbon_closed_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
						?>
						<div class="edgt_ribbon_logo" style="height: <?php echo esc_attr(intval($edgt_options['ribbon_closed_image_height'])/2); ?>px;">
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="corner_wrapper">
				<div class="left_corner"></div>
				<div class="right_corner"></div>
			</div>
		</div>
	</aside>
<?php } ?>

<?php if(edgt_space_around_content()){

    $frame_around_content_class = '';
    if($edgt_options['frame_around_content'] == 'yes'){
        $frame_around_content_class = 'frame_around_content';
    }

    ?>
    <div class="space_around_content <?php echo esc_attr($frame_around_content_class); ?>"><div class="space_around_content_inner">
<?php } ?>

<?php if(edgt_is_top_header()){ ?>

	<?php if($header_bottom_appearance == "regular" || $header_bottom_appearance == "fixed" || $header_bottom_appearance == "fixed_hiding" || $header_bottom_appearance == "stick" || $header_bottom_appearance == "stick menu_bottom" || $header_bottom_appearance == "stick_with_left_right_menu"){ ?>
		<header class="<?php edgt_header_classes(); ?>">
			<div class="header_inner clearfix">
				<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" ){ ?>
					<?php if( ($header_color_transparency_per_page == '' || $header_color_transparency_per_page == '1') && ($header_color_transparency_on_scroll=='' || $header_color_transparency_on_scroll == '1') &&  isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_slides_from_header_bottom"){ ?>
					<form action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_2" method="get">
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix">
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							 <?php } ?>
								<div class="form_holder_outer">
									<div class="form_holder">
										<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
                                        <a class="edgt_search_submit" href="javascript:void(0)">
                                            <?php $edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']); ?>
                                        </a>
									</div>
								</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</form>

				<?php } else if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_covers_header") { ?>
					<form action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_3" method="get">
							<?php if($header_in_grid){ ?>
							<div class="container">
								<div class="container_inner clearfix">
								<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							<?php } ?>
									<div class="form_holder_outer">
										<div class="form_holder">
											<div class="form_holder_inner">
												<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />

												<div class="edgt_search_close">
													<a href="#">
														<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
														<!--<i class="fa fa-times"></i>-->
													</a>
												</div>
											</div>
										</div>
									</div>
							<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
								</div>
							</div>
							<?php } ?>
					</form>
				<?php } else if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_slides_from_window_top") { ?>
					<form id="searchform" action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form" method="get">
						<?php if($header_in_grid){ ?>
							<div class="container">
								<div class="container_inner clearfix">
						<?php } ?>
						<i class="fa fa-search"></i>
						<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
						<input type="submit" value="Search" />
						<div class="edgt_search_close">
							<a href="#">
								<span class="icon_close"></span>
							</a>
						</div>
						<?php if($header_in_grid){ ?>
								</div>
							</div>
						<?php } ?>
					</form>
				<?php } ?>
				
				
			<?php } ?>
			
		
			<div class="header_top_bottom_holder">
				<?php if($display_header_top == "yes"){ ?>
					<div class="header_top clearfix	<?php if(isset($edgt_options['header_top_has_background_pattern']) && $edgt_options['header_top_has_background_pattern'] == "yes") {echo "has_pattern";}?>"	<?php edgt_inline_style($header_top_color_per_page); ?> >
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix" >
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
								<?php } ?>
								<div class="left">
									<div class="inner">
										<?php if(is_active_sidebar('header_left')) {
                                            dynamic_sidebar('header_left');
                                        } ?>
									</div>
								</div>
								<div class="right">
									<div class="inner">
										<?php if(is_active_sidebar('header_right')) {
                                            dynamic_sidebar('header_right');
                                        } ?>
									</div>
								</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
				<div class="header_bottom <?php echo esc_attr($header_bottom_class) ;?> clearfix <?php if($menu_item_icon_position=="top"){echo 'with_large_icons ';} if($menu_position == "left" && $header_bottom_appearance != "fixed_hiding" && $header_bottom_appearance != "stick menu_bottom" && $header_bottom_appearance != "stick_with_left_right_menu"){ echo 'left_menu_position';} ?>" <?php edgt_inline_style($header_color_per_page); ?> >
					<?php if($header_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
						<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							<?php } ?>
							<?php if($header_bottom_appearance == "stick_with_left_right_menu") { ?>
								<nav class="main_menu drop_down left_side <?php echo esc_attr($menu_dropdown_appearance_class); ?>" <?php edgt_inline_style($divided_left_menu_padding); ?>>
									<div class="side_menu_button_wrapper right">
										<?php if(is_active_sidebar('header_bottom_left')) { ?>
											<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_left'); ?></div>
										<?php } ?>
									</div>
									
									<?php
									wp_nav_menu( array( 'theme_location' => 'left-top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type1_walker_nav_menu()
									));
									?>
								</nav>
							<?php } ?>
							<div class="header_inner_left">
								<?php if($centered_logo && $header_bottom_appearance !== "stick menu_bottom") {
									if(is_active_sidebar('header_left_from_logo')) {
                                        dynamic_sidebar( 'header_left_from_logo' );
                                    }
								} ?>
								<?php if(edgt_is_main_menu_set()) { ?>
									<div class="mobile_menu_button">
										<span>
											<?php
											if(isset($edgt_options['mobile_header_icon_pack']) && $edgt_options['mobile_header_icon_pack'] !== ''){
												$edgtIconCollections->getMobileMenuIcon($edgt_options['mobile_header_icon_pack']);
											}
											else{
												$edgtIconCollections->getMobileMenuIcon($edgt_options['header_icon_pack']);
											}
											?>
										</span>
									</div>
								<?php } ?>
								
								
								
								<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
									<div class="logo_wrapper" <?php edgt_inline_style($logo_wrapper_style); ?>>
										<?php
										if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
										if (isset($edgt_options['logo_image_fixed_hidden']) && $edgt_options['logo_image_fixed_hidden'] != ""){ $logo_image_fixed_hidden = $edgt_options['logo_image_fixed_hidden'];}else{ $logo_image_fixed_hidden =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
											$logo_image_mobile = $edgt_options['logo_image_mobile'];
										}else{ 
											if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
												$logo_image_mobile = $edgt_options['logo_image'];
											}else{ 
												$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
											}
										}
										?>
										<div class="edgt_logo"><a <?php edgt_inline_style($logo_wrapper_style); ?> href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
										<?php if($header_bottom_appearance == "fixed_hiding") { ?>
											<div class="edgt_logo_hidden"><a href="<?php echo esc_url(home_url('/')); ?>"><img alt="Logo" src="<?php echo esc_url($logo_image_fixed_hidden); ?>" style="height: 100%;"></a></div>
										<?php } ?>
									</div>
								<?php } ?>
								
								
								<?php if($header_bottom_appearance == "stick menu_bottom" && is_active_sidebar('header_fixed_right')){ ?>
									<div class="header_fixed_right_area">
										<?php if(is_active_sidebar('header_fixed_right')) {
                                            dynamic_sidebar('header_fixed_right');
                                        } ?>
									</div>
								<?php } ?>
								<?php if($centered_logo && $header_bottom_appearance !== "stick menu_bottom") {
									if(is_active_sidebar('header_right_from_logo')) {
                                        dynamic_sidebar( 'header_right_from_logo' );
                                    }
								} ?>
							</div>
							<?php if($header_bottom_appearance == "stick_with_left_right_menu") { ?>
								<nav class="main_menu drop_down right_side <?php echo esc_attr($menu_dropdown_appearance_class); ?>" <?php edgt_inline_style($divided_right_menu_padding); ?>>
									<?php
									wp_nav_menu( array( 'theme_location' => 'right-top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type1_walker_nav_menu()
									));
									?>
									<div class="side_menu_button_wrapper right">
										<?php if(is_active_sidebar('header_bottom_right')) { ?>
											<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
										<?php } ?>
										<div class="side_menu_button">
										<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
											$search_type_class = 'search_slides_from_top';
											if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
												$search_type_class = $edgt_options['search_type'];
											}
											if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == 'search_covers_header') {
												if (isset($edgt_options['search_cover_only_bottom_yesno']) && $edgt_options['search_cover_only_bottom_yesno']=='yes') {
													$search_type_class .= ' search_covers_only_bottom';
												}
											}
											if (isset($edgt_options['search_icon_background_full_height']) && $edgt_options['search_icon_background_full_height'] == 'yes'){
												$search_type_class .= ' search_icon_bckg_full';
											}
											?>
											<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
												<?php if(isset($edgt_options['search_icon_pack'])){
                                                    $edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']);
												} ?>
												<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
													<span class="search_icon_text">
														<?php _e('Search', 'edgt'); ?>
													</span>
												<?php } ?>
											</a>
								
											<?php if($search_type_class == 'fullscreen_search' && $fullscreen_search_animation=='from_circle'){ ?>
												<div class="fullscreen_search_overlay"></div>
											<?php } ?>
										<?php } ?>
										<?php if($enable_popup_menu == "yes"){ ?>
											<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
										<?php } ?>
										<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
											<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
											<?php echo edgt_get_side_menu_icon_html(); ?></a>
										<?php } ?>
										</div>
									</div>
								</nav>
								
							<?php } ?>
							<?php if($header_bottom_appearance != "stick menu_bottom" && $header_bottom_appearance != "stick_with_left_right_menu"){ ?>
								<?php if($header_bottom_appearance == "fixed_hiding") { ?> <div class="holeder_for_hidden_menu"> <?php } //only for fixed with hiding menu ?>
								<?php if(!$centered_logo) { ?>
									<div class="header_inner_right">
										<div class="side_menu_button_wrapper right">
											<?php if(is_active_sidebar('header_bottom_right')) { ?>
												<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
											<?php } ?>
											<div class="side_menu_button">
	
											<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
												$search_type_class = 'search_slides_from_top';
												if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
													$search_type_class = $edgt_options['search_type'];
												}
												if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == 'search_covers_header') {
													if (isset($edgt_options['search_cover_only_bottom_yesno']) && $edgt_options['search_cover_only_bottom_yesno']=='yes') {
														$search_type_class .= ' search_covers_only_bottom';
													}
												}
												if (isset($edgt_options['search_icon_background_full_height']) && $edgt_options['search_icon_background_full_height'] == 'yes'){
													$search_type_class .= ' search_icon_bckg_full';
												} ?>

												<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
													<?php if(isset($edgt_options['search_icon_pack'])){
														$edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']);
													} ?>
													<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
														<span class="search_icon_text">
															<?php _e('Search', 'edgt'); ?>
														</span>
													<?php } ?>
												</a>
						
												<?php if($search_type_class == 'fullscreen_search' && $fullscreen_search_animation=='from_circle'){ ?>
													<div class="fullscreen_search_overlay"></div>
												<?php } ?>

											<?php } ?>
		
												<?php if($enable_popup_menu == "yes"){ ?>
													<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
												<?php } ?>
												<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
													<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
													<?php echo edgt_get_side_menu_icon_html(); ?></a>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php } ?>
								<?php if($centered_logo == true && $enable_border_top_bottom_menu == true) { ?> <div class="main_menu_and_widget_holder"> <?php } //only for logo is centered ?>
								<?php if($centered_logo == true && $enable_search_left_sidearea_right == true ) { ?>
									<div class="header_inner_right left_side">
										<div class="side_menu_button_wrapper">
											<div class="side_menu_button"> 
												<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
													$search_type_class = 'search_slides_from_top';
													if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
														$search_type_class = $edgt_options['search_type'];
													}
													if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == 'search_covers_header') {
														if (isset($edgt_options['search_cover_only_bottom_yesno']) && $edgt_options['search_cover_only_bottom_yesno']=='yes') {
															$search_type_class .= ' search_covers_only_bottom';
														}
													}
													if (isset($edgt_options['search_icon_background_full_height']) && $edgt_options['search_icon_background_full_height'] == 'yes'){
														$search_type_class .= ' search_icon_bckg_full';
													}?>

													<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
														<?php if(isset($edgt_options['search_icon_pack'])){
															$edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']);
														} ?>
														<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
															<span class="search_icon_text">
																<?php _e('Search', 'edgt'); ?>
															</span>
														<?php } ?>
													</a>
													<?php if($search_type_class == 'fullscreen_search' && $fullscreen_search_animation=='from_circle'){ ?>
														<div class="fullscreen_search_overlay"></div>
													<?php } ?>

												<?php } ?>
											</div>
											<?php if(is_active_sidebar('header_bottom_left')) { ?>
												<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_left'); ?></div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
								<nav class="main_menu drop_down  <?php  echo esc_attr($menu_dropdown_appearance_class); if($menu_position == "" && $header_bottom_appearance != "stick menu_bottom"){ echo ' right';} ?>">
									<?php

									wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type1_walker_nav_menu()
									));
									?>
								</nav>
								<?php if($centered_logo) { ?>
									<div class="header_inner_right">
										<div class="side_menu_button_wrapper right">
											<?php if(is_active_sidebar('header_bottom_right')) { ?>
												<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
											<?php } ?>
											<div class="side_menu_button"> 
												<?php if($enable_search_left_sidearea_right == false && (isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes')) {
													$search_type_class = 'search_slides_from_top';
													if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
														$search_type_class = $edgt_options['search_type'];
													}
													if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == 'search_covers_header') {
														if (isset($edgt_options['search_cover_only_bottom_yesno']) && $edgt_options['search_cover_only_bottom_yesno']=='yes') {
															$search_type_class .= ' search_covers_only_bottom';
														}
													}
													if (isset($edgt_options['search_icon_background_full_height']) && $edgt_options['search_icon_background_full_height'] == 'yes'){
														$search_type_class .= ' search_icon_bckg_full';
													}?>

													<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
														<?php if(isset($edgt_options['search_icon_pack'])){
															$edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']);
														} ?>
														<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
															<span class="search_icon_text">
																<?php _e('Search', 'edgt'); ?>
															</span>
														<?php } ?>
													</a>
													<?php if($search_type_class == 'fullscreen_search' && $fullscreen_search_animation=='from_circle'){ ?>
														<div class="fullscreen_search_overlay"></div>
													<?php } ?>

												<?php } ?>
												<?php if($enable_popup_menu == "yes"){ ?>
													<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
												<?php } ?>
												<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
													<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
														<?php echo edgt_get_side_menu_icon_html(); ?>
													</a>
												<?php } ?>

											</div>
										</div>
									</div>
								<?php } ?>
								<?php if($centered_logo == true && $enable_border_top_bottom_menu == true) { ?> </div> <?php } //only for logo is centered ?>
								<?php if($header_bottom_appearance == "fixed_hiding") { ?> </div> <?php } //only for fixed with hiding menu ?>
							<?php }else if($header_bottom_appearance == "stick menu_bottom"){ ?>
							<div class="header_menu_bottom clearfix">
								<div class="header_menu_bottom_inner">
									<?php if($centered_logo) { ?>
									<div class="main_menu_header_inner_right_holder with_center_logo">
										<?php } else { ?>
										<div class="main_menu_header_inner_right_holder">
											<?php } ?>
											<nav class="main_menu drop_down <?php echo esc_attr($menu_dropdown_appearance_class); ?>">
												<?php
												wp_nav_menu( array(
													'theme_location' => 'top-navigation' ,
													'container'  => '',
													'container_class' => '',
													'menu_class' => 'clearfix',
													'menu_id' => '',
													'fallback_cb' => 'top_navigation_fallback',
													'link_before' => '<span>',
													'link_after' => '</span>',
													'walker' => new edgt_type1_walker_nav_menu()
												));
												?>
											</nav>
											<div class="header_inner_right">
												<div class="side_menu_button_wrapper right">
													<?php if(is_active_sidebar('header_bottom_right')) { ?>
														<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
													<?php } ?>
													<div class="side_menu_button">
		
													<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
														$search_type_class = 'search_slides_from_top';
														if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
															$search_type_class = $edgt_options['search_type'];
														}
														if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == 'search_covers_header') {
															if (isset($edgt_options['search_cover_only_bottom_yesno']) && $edgt_options['search_cover_only_bottom_yesno']=='yes') {
																$search_type_class .= ' search_covers_only_bottom';
															}
														}
														if (isset($edgt_options['search_icon_background_full_height']) && $edgt_options['search_icon_background_full_height'] == 'yes'){
															$search_type_class .= ' search_icon_bckg_full';
														}?>

														<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
															<?php if(isset($edgt_options['search_icon_pack'])){
																$edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']);
															} ?>
															<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
																<span class="search_icon_text">
																	<?php _e('Search', 'edgt'); ?>
																</span>
															<?php } ?>
														</a>
												
														<?php if($search_type_class == 'fullscreen_search' && $fullscreen_search_animation=='from_circle'){ ?>
															<div class="fullscreen_search_overlay"></div>
														<?php } ?>

													<?php } ?>
		
														<?php if($enable_popup_menu == "yes"){ ?>
															<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
														<?php } ?>
														<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
															<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
																<?php echo edgt_get_side_menu_icon_html(); ?>
															</a>
														<?php } ?>
												
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
								<nav class="mobile_menu">
									<?php
									if($header_bottom_appearance == "stick_with_left_right_menu") {
										echo '<ul>';
										wp_nav_menu( array( 'theme_location' => 'left-top-navigation' ,
											'container'  => '',
											'container_class' => '',
											'menu_class' => '',
											'menu_id' => '',
											'fallback_cb' => '',
											'link_before' => '<span>',
											'link_after' => '</span>',
											'walker' => new edgt_type4_walker_nav_menu(),
											'items_wrap'      => '%3$s'
										));
										wp_nav_menu( array( 'theme_location' => 'right-top-navigation' ,
											'container'  => '',
											'container_class' => '',
											'menu_class' => '',
											'menu_id' => '',
											'fallback_cb' => '',
											'link_before' => '<span>',
											'link_after' => '</span>',
											'walker' => new edgt_type4_walker_nav_menu(),
											'items_wrap'      => '%3$s'
										));
										echo '</ul>';
									}else{
										wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
											'container'  => '',
											'container_class' => '',
											'menu_class' => '',
											'menu_id' => '',
											'fallback_cb' => 'top_navigation_fallback',
											'link_before' => '<span>',
											'link_after' => '</span>',
											'walker' => new edgt_type2_walker_nav_menu()
										));
									}
									?>
								</nav>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</header>
	<?php } else if($header_bottom_appearance == "fixed_top_header"){ ?>
	
<?php //FIXED HEADER TOP Header Type ?>
	
	<header class="<?php edgt_header_classes(); ?>">
		<div class="header_inner clearfix">
			<!--insert start-->
				<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" ){ ?>
					<?php  if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_covers_header") { ?>
						<form action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_3" method="get">
								<?php if($header_in_grid){ ?>
								<div class="container">
									<div class="container_inner clearfix">
									<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
								<?php } ?>
										<div class="form_holder_outer">
											<div class="form_holder">
												<div class="form_holder_inner">
													<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
													<div class="edgt_search_close">
														<a href="#">
															<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
														</a>
													</div>
												</div>
											</div>
										</div>
								<?php if($header_in_grid){ ?>
									<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
									</div>
								</div>
							<?php } ?>
						</form>
					<?php } ?>
				<?php } ?>
			<!--insert end-->
			<div class="header_top_bottom_holder">
				<?php if($display_header_top == "yes"){ ?>
					<div class="top_header clearfix" <?php edgt_inline_style($header_top_color_per_page); ?> >
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix" >
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
								<?php } ?>
								<div class="left">
									<div class="inner">
										<nav class="main_menu drop_down <?php echo esc_attr($menu_dropdown_appearance_class); ?>">
											<?php
											wp_nav_menu( array(
												'theme_location' => 'top-navigation' ,
												'container'  => '',
												'container_class' => '',
												'menu_class' => 'clearfix',
												'menu_id' => '',
												'fallback_cb' => 'top_navigation_fallback',
												'link_before' => '<span>',
												'link_after' => '</span>',
												'walker' => new edgt_type1_walker_nav_menu()
											));
											?>
										</nav>
										<?php if(edgt_is_main_menu_set()) { ?>
											<div class="mobile_menu_button"><span>
													<?php
													if(isset($edgt_options['mobile_header_icon_pack']) && $edgt_options['mobile_header_icon_pack'] !== ''){
														$edgtIconCollections->getMobileMenuIcon($edgt_options['mobile_header_icon_pack']);
													}
													else{
														$edgtIconCollections->getMobileMenuIcon($edgt_options['header_icon_pack']);
													}
													?>
												</span>
											</div>
										<?php } ?>
										
									</div>
								</div>
								<div class="right">
									<div class="inner">
										<div class="side_menu_button_wrapper right">
											<div class="header_bottom_right_widget_holder">
												<?php if(is_active_sidebar('header_right')) {
                                                    dynamic_sidebar('header_right');
                                                } ?>
											</div>
											<div class="side_menu_button">
												<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') { ?>
													<a class="search_covers_header <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
														<?php if(isset($edgt_options['search_icon_pack'])){ $edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']); } ?>
													</a>
												<?php } ?>
												
												<?php if($enable_popup_menu == "yes"){ ?>
													<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
												<?php } ?>
												<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
													<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
														<?php echo edgt_get_side_menu_icon_html(); ?>
													</a>
												<?php } ?>
										
											</div>
										</div>
									</div>
								</div>
								<nav class="mobile_menu">
								<?php
									wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type2_walker_nav_menu()
									));
								
								?>
								</nav>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
				<div class="bottom_header clearfix" <?php edgt_inline_style($header_color_per_page); ?> >
					<?php if($header_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
						<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							<?php } ?>
							<div class="header_inner_center">
								
								<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
									<div class="logo_wrapper" <?php edgt_inline_style($logo_wrapper_style); ?>>
										<?php
										if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
										if (isset($edgt_options['logo_image_fixed_hidden']) && $edgt_options['logo_image_fixed_hidden'] != ""){ $logo_image_fixed_hidden = $edgt_options['logo_image_fixed_hidden'];}else{ $logo_image_fixed_hidden =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
											$logo_image_mobile = $edgt_options['logo_image_mobile'];
										}else{ 
											if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
												$logo_image_mobile = $edgt_options['logo_image'];
											}else{ 
												$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
											}
										}
										?>
										<div class="edgt_logo"><a <?php edgt_inline_style($logo_wrapper_style); ?> href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
										
									</div>
								<?php } ?>
								<?php if(is_active_sidebar('header_bottom_center')) {
                                        dynamic_sidebar('header_bottom_center');
                                    } ?>
							</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</header>

	<?php } else if($header_bottom_appearance == "fixed fixed_minimal"){ ?>
	
<?php //FIXED MINIMAL Header Type ?>

		<header class="<?php edgt_header_classes(); ?>">
			<div class="header_inner clearfix">
				<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" ){ ?>
					<?php if( ($header_color_transparency_per_page == '' || $header_color_transparency_per_page == '1') && ($header_color_transparency_on_scroll=='' || $header_color_transparency_on_scroll == '1') &&  isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_slides_from_header_bottom"){ ?>
					<form action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_2" method="get">
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix">
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
							 <?php } ?>
								<div class="form_holder_outer">
									<div class="form_holder">
										<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
										<input type="submit" class="edgt_search_submit" value="&#xf002;" />
									</div>
								</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</form>
				<?php } else if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_covers_header") { ?>
					<form action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_3" method="get">
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix">
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
								<div class="form_holder_outer">
									<div class="form_holder">
										<div class="form_holder_inner">
											<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
											<div class="edgt_search_close">
												<a href="#">
													<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
												</a>
											</div>
										</div>
									</div>
								</div>
						<?php if($header_in_grid){ ?>
							<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
					<?php } ?>
					</form>
					<?php } ?>
				<?php } ?>
				<div class="header_top_bottom_holder">
					<?php if($display_header_top == "yes"){ ?>
						<div class="header_top clearfix	<?php if(isset($edgt_options['header_top_has_background_pattern']) && $edgt_options['header_top_has_background_pattern'] == "yes") {echo "has_pattern";}?>" <?php edgt_inline_style($header_top_color_per_page); ?> >
							<?php if($header_in_grid){ ?>
							<div class="container">
								<div class="container_inner clearfix" >
								<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
									<?php } ?>
									<div class="left">
										<div class="inner">
											<?php if(is_active_sidebar('header_left')) {
                                                dynamic_sidebar('header_left');
                                            } ?>
										</div>
									</div>
									<div class="right">
										<div class="inner">
											<?php if(is_active_sidebar('header_right')) {
                                                dynamic_sidebar('header_right');
                                            } ?>
										</div>
									</div>
									<?php if($header_in_grid){ ?>
									<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
								</div>
							</div>
						<?php } ?>
						</div>
					<?php } ?>
					<div class="header_bottom <?php echo esc_attr($header_bottom_class) ;?> clearfix" <?php edgt_inline_style($header_color_per_page); ?> >
						<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
							<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
								<div class="header_inner_left">
									<div class="side_menu_button_wrapper left">
										<div class="side_menu_button">
											<?php if($enable_popup_menu == "yes"){ ?>
												<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
									<div class="logo_wrapper" <?php edgt_inline_style($logo_wrapper_style); ?>>
										<?php
										if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
										if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
										if (isset($edgt_options['logo_image_fixed_hidden']) && $edgt_options['logo_image_fixed_hidden'] != ""){ $logo_image_fixed_hidden = $edgt_options['logo_image_fixed_hidden'];}else{ $logo_image_fixed_hidden =  get_template_directory_uri().'/img/logo.png'; };
										if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
											$logo_image_mobile = $edgt_options['logo_image_mobile'];
										}else{ 
											if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
												$logo_image_mobile = $edgt_options['logo_image'];
											}else{ 
												$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
											}
										}
										?>
										<div class="edgt_logo"><a <?php edgt_inline_style($logo_wrapper_style); ?> href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
								
									</div>
								<?php } ?>
								<div class="header_inner_right">
									<div class="side_menu_button_wrapper right">
										<div class="side_menu_button">
											<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes') {
												$search_type_class = 'search_slides_from_top';
												if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
													$search_type_class = $edgt_options['search_type'];
												}
												if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == 'search_covers_header') {
													if (isset($edgt_options['search_cover_only_bottom_yesno']) && $edgt_options['search_cover_only_bottom_yesno']=='yes') {
														$search_type_class .= ' search_covers_only_bottom';
													}
												}										
												if (isset($edgt_options['search_icon_background_full_height']) && $edgt_options['search_icon_background_full_height'] == 'yes'){
													$search_type_class .= ' search_icon_bckg_full';
												}?>
												<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
													<?php if(isset($edgt_options['search_icon_pack'])){
														$edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']);
													} ?>
													<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
														<span class="search_icon_text">
															<?php _e('Search', 'edgt'); ?>
														</span>
													<?php } ?>
												</a>
												<?php if($search_type_class == 'fullscreen_search' && $fullscreen_search_animation=='from_circle'){ ?>
													<div class="fullscreen_search_overlay"></div>
												<?php } ?>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if($header_in_grid){ ?>
								<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</header>
		
<?php //STICK COMPOUND header type ?>

<?php } else if($header_bottom_appearance == "stick compound"){ ?>
<header class="<?php edgt_header_classes(); ?>">
	<div class="header_inner clearfix">
		<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == "yes" ){ ?>
			<?php if( ($header_color_transparency_per_page == '' || $header_color_transparency_per_page == '1') && ($header_color_transparency_on_scroll=='' || $header_color_transparency_on_scroll == '1') &&  isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_slides_from_header_bottom"){ ?>
			<form action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_2" method="get">
				<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
					<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
					 <?php } ?>
						<div class="form_holder_outer">
							<div class="form_holder">
								<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
								<!--<input type="submit" class="edgt_search_submit" value="<?php /*if (isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchIconValue($edgt_options['header_icon_pack']); } */?>"/>-->
								<input type="submit" class="edgt_search_submit" value="&#xf002" />
							</div>
						</div>
						<?php if($header_in_grid){ ?>
						<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
					</div>
				</div>
				<?php } ?>
			</form>
		<?php } else if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_covers_header") { ?>
			<form action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form_3" method="get">
					<?php if($header_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix">
						<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
					<?php } ?>
							<div class="form_holder_outer">
								<div class="form_holder">
									<div class="form_holder_inner">
										<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />

										<div class="edgt_search_close">
											<a href="#">
												<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
												<!--<i class="fa fa-times"></i>-->
											</a>
										</div>
									</div>
								</div>
							</div>
					<?php if($header_in_grid){ ?>
						<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
						</div>
					</div>
				<?php } ?>
			</form>
			<?php } else if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == "search_slides_from_window_top") { ?>
				<form id="searchform" action="<?php echo esc_url(home_url('/')); ?>" class="edgt_search_form" method="get">
					<?php if($header_in_grid){ ?>
						<div class="container">
							<div class="container_inner clearfix">
					<?php } ?>
					<i class="fa fa-search"></i>
					<input type="text" placeholder="<?php _e('Search', 'edgt'); ?>" name="s" class="edgt_search_field" autocomplete="off" />
					<input type="submit" value="Search" />
					<div class="edgt_search_close">
						<a href="#">
							<span class="icon_close"></span>
						</a>
					</div>
					<?php if($header_in_grid){ ?>
							</div>
						</div>
					<?php } ?>
				</form>
			<?php } ?>
	<?php } ?>
		<div class="header_top_bottom_holder">
		<?php if($display_header_top == "yes"){ ?>
			<div class="header_top clearfix	<?php if(isset($edgt_options['header_top_has_background_pattern']) && $edgt_options['header_top_has_background_pattern'] == "yes") {echo "has_pattern";}?>" <?php edgt_inline_style($header_top_color_per_page); ?> >
				<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix" >
					<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
						<div class="left">
							<div class="inner">
								<?php if(is_active_sidebar('header_left')) {
                                    dynamic_sidebar('header_left');
                                } ?>
							</div>
						</div>
						<div class="right">
							<div class="inner">
								<?php if(is_active_sidebar('header_right')) {
                                    dynamic_sidebar('header_right');
                                } ?>
							</div>
						</div>
						<?php if($header_in_grid){ ?>
						<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>
			<div class="header_bottom <?php echo esc_attr($header_bottom_class) ;?> clearfix <?php if
            ($menu_item_icon_position=="top"){echo 'with_large_icons ';}?>" <?php edgt_inline_style($header_color_per_page); ?> >
			<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
					<?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
						<div class="header_inner_left">
							<?php if(edgt_is_main_menu_set()) { ?>
								<div class="mobile_menu_button">
									<span>
										<?php
										if(isset($edgt_options['mobile_header_icon_pack']) && $edgt_options['mobile_header_icon_pack'] !== ''){
											$edgtIconCollections->getMobileMenuIcon($edgt_options['mobile_header_icon_pack']);
										}
										else{
											$edgtIconCollections->getMobileMenuIcon($edgt_options['header_icon_pack']);
										}
										?>
									</span>
								</div>
							<?php } ?>
							<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
								<div class="logo_wrapper" <?php edgt_inline_style($logo_wrapper_style); ?>>
									<?php
									if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
									if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
									if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
									if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
									if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
									if (isset($edgt_options['logo_image_fixed_hidden']) && $edgt_options['logo_image_fixed_hidden'] != ""){ $logo_image_fixed_hidden = $edgt_options['logo_image_fixed_hidden'];}else{ $logo_image_fixed_hidden =  get_template_directory_uri().'/img/logo.png'; };
									if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
										$logo_image_mobile = $edgt_options['logo_image_mobile'];
									}else{ 
										if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
											$logo_image_mobile = $edgt_options['logo_image'];
										}else{ 
											$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
										}
									}
									?>
									<div class="edgt_logo"><a <?php edgt_inline_style($logo_wrapper_style); ?> href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
									<?php if($header_bottom_appearance == "fixed_hiding") { ?>
										<div class="edgt_logo_hidden"><a href="<?php echo esc_url(home_url('/')); ?>"><img alt="Logo" src="<?php echo esc_url($logo_image_fixed_hidden); ?>" style="height: 100%;"></a></div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
						<div class="bottom_right">
							<div class="header_inner_right">
								<div class="side_menu_button_wrapper right">
									<div class="side_menu_button">
									<?php if(isset($edgt_options['enable_search']) && $edgt_options['enable_search'] == 'yes'){
										$search_type_class = 'search_slides_from_top';
										if(isset($edgt_options['search_type']) && $edgt_options['search_type'] !== '') {
											$search_type_class = $edgt_options['search_type'];
										}
										if(isset($edgt_options['search_type']) && $edgt_options['search_type'] == 'search_covers_header') {
											if (isset($edgt_options['search_cover_only_bottom_yesno']) && $edgt_options['search_cover_only_bottom_yesno']=='yes') {
												$search_type_class .= ' search_covers_only_bottom';
											}
										}
										if (isset($edgt_options['search_icon_background_full_height']) && $edgt_options['search_icon_background_full_height'] == 'yes'){
											$search_type_class .= ' search_icon_bckg_full';
										}?>
										<a class="<?php echo esc_attr($search_type_class); ?> <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
											<?php if(isset($edgt_options['search_icon_pack'])){
												$edgtIconCollections->getSearchIcon($edgt_options['search_icon_pack']);
											} ?>
											<?php if(isset($edgt_options['enable_search_icon_text']) && $edgt_options['enable_search_icon_text'] == 'yes'){?>
												<span class="search_icon_text">
													<?php _e('Search', 'edgt'); ?>
												</span>
											<?php } ?>
										</a>
										<?php if($search_type_class == 'fullscreen_search' && $fullscreen_search_animation=='from_circle'){ ?>
											<div class="fullscreen_search_overlay"></div>
										<?php } ?>
									<?php } ?>
									<?php if($enable_popup_menu == "yes"){ ?>
										<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
									<?php } ?>
									<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
										<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
										<?php echo edgt_get_side_menu_icon_html(); ?></a>
									<?php } ?>
									</div>
								</div>
							</div>
							<nav class="main_menu drop_down right <?php  echo esc_attr($menu_dropdown_appearance_class);?>">
								<?php
									wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker' => new edgt_type1_walker_nav_menu()
									));
								?>
							</nav>
						</div>
						<div class="header_right_top">
							<div class="header_right_top_left">
								<?php if(is_active_sidebar('header_bottom_right')) { ?>
									<div class="header_right_top_widget_holder"><?php dynamic_sidebar('header_bottom_right'); ?></div>
								<?php } ?>
							</div>
						</div>
						<nav class="mobile_menu">
							<?php
								wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
									'container'  => '',
									'container_class' => '',
									'menu_class' => '',
									'menu_id' => '',
									'fallback_cb' => 'top_navigation_fallback',
									'link_before' => '<span>',
									'link_after' => '</span>',
									'walker' => new edgt_type2_walker_nav_menu()
								));
							?>
						</nav>
							<?php if($header_in_grid){ ?>
							<?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</header>

<?php } ?>
	
<?php } else{?>

	<?php //Here renders header simplified because Side Menu is enabled?>
	
	<header class="page_header <?php if($display_header_top == "yes"){ echo 'has_top'; }  if($header_top_area_scroll == "yes"){ echo ' scroll_top'; }?> <?php if($centered_logo){ echo " centered_logo"; } ?> <?php echo esc_attr($header_bottom_appearance); ?>  <?php echo esc_attr($header_style); ?> <?php if(is_active_sidebar('header_fixed_right')) { echo 'has_header_fixed_right'; } ?>">
		<div class="header_inner clearfix">
			<div class="header_bottom <?php echo esc_attr($header_bottom_class) ;?> clearfix" <?php edgt_inline_style($header_color_per_page); ?>>
				<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix" <?php edgt_inline_style($header_bottom_border_style); ?>>
                    <?php if($edgt_options['overlapping_content'] == 'yes') {?><div class="overlapping_content_margin"><?php } ?>
						<?php } ?>
						<div class="header_inner_left">
							<?php if(edgt_is_main_menu_set()) { ?>
								<div class="mobile_menu_button"><span>
										<?php
										if(isset($edgt_options['mobile_header_icon_pack']) && $edgt_options['mobile_header_icon_pack'] !== ''){
											$edgtIconCollections->getMobileMenuIcon($edgt_options['mobile_header_icon_pack']);
										}
										else{
											$edgtIconCollections->getMobileMenuIcon($edgt_options['header_icon_pack']);
										}
										?>
									</span>
								</div>
							<?php } ?>
							<?php if (!(isset($edgt_options['show_logo']) && $edgt_options['show_logo'] == "no")){ ?>
								<div class="logo_wrapper">
									<?php
									if (isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){ $logo_image = $edgt_options['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
									if (isset($edgt_options['logo_image_light']) && $edgt_options['logo_image_light'] != ""){ $logo_image_light = $edgt_options['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
									if (isset($edgt_options['logo_image_dark']) && $edgt_options['logo_image_dark'] != ""){ $logo_image_dark = $edgt_options['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
									if (isset($edgt_options['logo_image_sticky']) && $edgt_options['logo_image_sticky'] != ""){ $logo_image_sticky = $edgt_options['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
									if (isset($edgt_options['logo_image_popup']) && $edgt_options['logo_image_popup'] != ""){ $logo_image_popup = $edgt_options['logo_image_popup'];}else{ $logo_image_popup =  get_template_directory_uri().'/img/logo_white.png'; };
									if (isset($edgt_options['logo_image_mobile']) && $edgt_options['logo_image_mobile'] != ""){
										$logo_image_mobile = $edgt_options['logo_image_mobile'];
									}else{ 
										if(isset($edgt_options['logo_image']) && $edgt_options['logo_image'] != ""){
											$logo_image_mobile = $edgt_options['logo_image'];
										}else{ 
											$logo_image_mobile =  get_template_directory_uri().'/img/logo.png'; 
										}
									}
									?>
									<div class="edgt_logo"><a href="<?php echo esc_url(home_url('/')); ?>"><img class="normal" src="<?php echo esc_url($logo_image); ?>" alt="Logo"/><img class="light" src="<?php echo esc_url($logo_image_light); ?>" alt="Logo"/><img class="dark" src="<?php echo esc_url($logo_image_dark); ?>" alt="Logo"/><img class="sticky" src="<?php echo esc_url($logo_image_sticky); ?>" alt="Logo"/><img class="mobile" src="<?php echo esc_url($logo_image_mobile); ?>" alt="Logo"/><?php if($enable_popup_menu == 'yes'){ ?><img class="popup" src="<?php echo esc_url($logo_image_popup); ?>" alt="Logo"/><?php } ?></a></div>
								</div>
							<?php } ?>
						</div>
						<nav class="mobile_menu">
							<?php
							wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
								'container'  => '',
								'container_class' => '',
								'menu_class' => '',
								'menu_id' => '',
								'fallback_cb' => 'top_navigation_fallback',
								'link_before' => '<span>',
								'link_after' => '</span>',
								'walker' => new edgt_type2_walker_nav_menu()
							));
							?>
						</nav>

						<?php if($header_in_grid){ ?>
                        <?php if($edgt_options['overlapping_content'] == 'yes') {?></div><?php } ?>
					</div>
				</div>
			<?php } ?>				
			</div>
		</div>
	</header>
<?php } ?>

<?php if($edgt_options['show_back_button'] == "yes") {
    $edgt_back_to_top_button_styles = "";
    if(isset($edgt_options['back_to_top_position']) && !empty($edgt_options['back_to_top_position'])) {
        $edgt_back_to_top_button_styles .= $edgt_options['back_to_top_position'];
    }
    if(isset($edgt_options['back_to_top_background_pattern']) && $edgt_options['back_to_top_background_pattern'] == "yes") {
        $edgt_back_to_top_button_styles .= " has_pattern";
    } ?>
		<a id='back_to_top' class="<?php echo esc_attr($edgt_back_to_top_button_styles);?>" href='#'>
			<span class="edgt_icon_stack">
				<?php if(isset($edgt_options['show_back_button_icon']) && $edgt_options['show_back_button_icon']!== '') { ?>				
				<span <?php edgt_class_attribute($edgt_options['show_back_button_icon'])?>></span>
				<?php } else { ?>
					<span class="icon-arrows-slide-left1"></span>
				<?php } ?>
			</span>
			<span class="a_overlay"></span>
		</a>
<?php } ?>
<?php if($enable_popup_menu == "yes"){
	?>
	<div class="popup_menu_holder_outer">
		<div class="popup_menu_holder">
			<div class="popup_menu_holder_inner">
			<?php if (isset($edgt_options['popup_in_grid']) && $edgt_options['popup_in_grid'] == "yes") { ?>
				<div class = "container_inner">
			<?php } ?>

				<?php if(is_active_sidebar('fullscreen_above_menu')) { ?>
					<div class="fullscreen_above_menu_widget_holder"><?php dynamic_sidebar('fullscreen_above_menu'); ?></div>
				<?php } ?>
				<nav class="popup_menu">
					<?php
					wp_nav_menu( array( 'theme_location' => 'popup-navigation' ,
						'container'  => '',
						'container_class' => '',
						'menu_class' => '',
						'menu_id' => '',
						'fallback_cb' => 'top_navigation_fallback',
						'link_before' => '<span>',
						'link_after' => '</span>',
						'walker' => new edgt_type3_walker_nav_menu()
					));
					?>
				</nav>
				<?php if(is_active_sidebar('fullscreen_menu')) { ?>
					<div class="fullscreen_menu_widget_holder"><?php dynamic_sidebar('fullscreen_menu'); ?></div>
				<?php } ?>
			<?php if (isset($edgt_options['popup_in_grid']) && $edgt_options['popup_in_grid'] == "yes") { ?>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>

<?php if($enable_fullscreen_search=="yes"){ ?>
	<div class="fullscreen_search_holder <?php echo esc_attr($fullscreen_search_animation); ?>">
		<div class="close_container">
			<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix" >
			<?php } ?>
					<div class="search_close_holder">
						<div class="side_menu_button">
							<a class="fullscreen_search_close" href="javascript:void(0)">
								<?php if(isset($edgt_options['header_icon_pack'])) { $edgtIconCollections->getSearchClose($edgt_options['header_icon_pack']); } ?>
							</a>
							<?php if($header_bottom_appearance!="fixed fixed_minimal"){?>
								<?php if($enable_popup_menu == "yes"){ ?>
									<a href="javascript:void(0)" class="popup_menu <?php echo esc_attr($header_button_size.' '.$popup_menu_animation_style); ?>"><span class="popup_menu_inner"><i class="line">&nbsp;</i></span></a>
								<?php } ?>
								<?php if($enable_side_area == "yes" && $enable_popup_menu == 'no'){ ?>
									<a class="side_menu_button_link <?php echo esc_attr($header_button_size); ?>" href="javascript:void(0)">
										<?php echo edgt_get_side_menu_icon_html(); ?>
									</a>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
			<?php if($header_in_grid){ ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="fullscreen_search_table">
			<div class="fullscreen_search_cell">
				<div class="fullscreen_search_inner">
					<form action="<?php echo esc_url(home_url('/')); ?>" class="fullscreen_search_form" method="get">
						<div class="form_holder">
							<span class="search_label"><?php _e('Search:', 'edgt'); ?></span>
							<div class="field_holder">
								<input type="text"  name="s" class="search_field" autocomplete="off" />
								<div class="line"></div>
							</div>
							<input type="submit" class="search_submit" value="&#x55;" />
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } ?>


<?php
$content_class = "";
$is_title_area_visible = true;
if(get_post_meta($id, "edgt_show-page-title", true) == 'yes') {
	$is_title_area_visible = true;
} elseif(get_post_meta($id, "edgt_show-page-title", true) == 'no') {
	$is_title_area_visible = false;
} elseif(get_post_meta($id, "edgt_show-page-title", true) == '' && (isset($edgt_options['show_page_title']) && $edgt_options['show_page_title'] == 'yes')) {
	$is_title_area_visible = true;
} elseif(get_post_meta($id, "edgt_show-page-title", true) == '' && (isset($edgt_options['show_page_title']) && $edgt_options['show_page_title'] == 'no')) {
	$is_title_area_visible = false;
} elseif(isset($edgt_options['show_page_title']) && $edgt_options['show_page_title'] == 'yes') {
	$is_title_area_visible = true;
}
if((get_post_meta($id, "edgt_revolution-slider", true) == "" && ($header_transparency == '' || $header_transparency == 1))  || get_post_meta($id, "edgt_enable_content_top_margin", true) == "yes" ){
	if($edgt_options['header_bottom_appearance'] == "fixed" || $edgt_options['header_bottom_appearance'] == "fixed_hiding" || $edgt_options['header_bottom_appearance'] == "fixed fixed_minimal"){
		$content_class = "content_top_margin";
	}else {
		$content_class = "content_top_margin_none";
	}
}

if(isset($edgt_options['header_bottom_appearance']) && ($edgt_options['header_bottom_appearance'] == "stick" || $edgt_options['header_bottom_appearance'] == "stick menu_bottom" || $edgt_options['header_bottom_appearance'] == "stick_with_left_right_menu" || $edgt_options['header_bottom_appearance'] == "stick compound")){
	if(get_post_meta(edgt_get_page_id(), "edgt_page_hide_initial_sticky", true) !== ''){
		if(get_post_meta(edgt_get_page_id(), "edgt_page_hide_initial_sticky", true) == 'yes'){
			$content_class = " ";
		}
	}else if(isset($edgt_options['hide_initial_sticky']) && $edgt_options['hide_initial_sticky'] == 'yes') {
		$content_class = " ";
	}
}


if(edgt_get_page_template_name() == "full_screen"){
    // solution for top header
    if(!edgt_is_side_header()){
        if (($header_transparency == '' || $header_transparency == 1) || ($edgt_options['header_bottom_appearance'] == "regular" || $edgt_options['header_bottom_appearance'] == "fixed_top_header")) {
            if ($edgt_options['header_bottom_appearance'] == "fixed" || $edgt_options['header_bottom_appearance'] == "fixed_hiding" || $edgt_options['header_bottom_appearance'] == "fixed fixed_minimal") {
                $content_class = "content_top_margin_none";
            }
            elseif($edgt_options['header_bottom_appearance'] == 'stick menu_bottom'){
                $content_class = ""; // delete class if exists
            }
            else {
                $content_class = "content_top_margin_negative content_top_margin_none";
            }
        }
    }

    // solution for paspartu on side and top header
    if((isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'yes') && (isset($edgt_options['paspartu_on_top']) && $edgt_options['paspartu_on_top'] == 'yes')){
        if(isset($edgt_options['paspartu_on_top_fixed']) && $edgt_options['paspartu_on_top_fixed'] == 'yes'){
            if(!(edgt_is_side_header() && (isset($edgt_options['vertical_menu_inside_paspartu']) && $edgt_options['vertical_menu_inside_paspartu'] == 'yes'))){ // not for this case
                $content_class .= " content_top_margin_vm_paspartu";
            }
        }
        else{
            // not resolved
        }
    }
}

//check if there is slider added and set class to content div, this is used for content top margin in style_dynamic.php
if(get_post_meta($id, "edgt_revolution-slider", true) != ""){
    $content_class .= " has_slider";
}
?>

<?php
if(isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'yes'){

$paspartu_additional_classes = "";
if(isset($edgt_options['paspartu_on_top']) && $edgt_options['paspartu_on_top'] == 'no'){
    $paspartu_additional_classes .= " disable_top_paspartu";
}
if(isset($edgt_options['paspartu_on_bottom']) && $edgt_options['paspartu_on_bottom'] == 'no'){
    $paspartu_additional_classes .= " disable_bottom_paspartu";
}
if(isset($edgt_options['paspartu_on_bottom_slider']) && $edgt_options['paspartu_on_bottom_slider'] == 'yes'){
    $paspartu_additional_classes .= " paspartu_on_bottom_slider";
}
if((isset($edgt_options['paspartu_on_bottom']) && $edgt_options['paspartu_on_bottom'] == 'yes' && isset($edgt_options['paspartu_on_bottom_fixed']) && $edgt_options['paspartu_on_bottom_fixed'] == 'yes') || 
(edgt_is_side_header() && isset($edgt_options['vertical_menu_inside_paspartu']) && $edgt_options['vertical_menu_inside_paspartu'] == 'yes')){
    $paspartu_additional_classes .= " paspartu_on_bottom_fixed";
}
?>


<div class="paspartu_outer <?php echo esc_attr($paspartu_additional_classes); ?>">
    <?php if(edgt_is_side_header() && isset($edgt_options['vertical_menu_inside_paspartu']) && $edgt_options['vertical_menu_inside_paspartu'] == 'no') { ?>
        <div class="paspartu_middle_inner">
    <?php }?>
	
	<?php if((isset($edgt_options['paspartu_on_top']) && $edgt_options['paspartu_on_top'] == 'yes' && isset($edgt_options['paspartu_on_top_fixed']) && $edgt_options['paspartu_on_top_fixed'] == 'yes') || 
	(edgt_is_side_header() && isset($edgt_options['vertical_menu_inside_paspartu']) && $edgt_options['vertical_menu_inside_paspartu'] == 'yes')){ ?>
        <div class="paspartu_top"></div>
    <?php }?>
	<div class="paspartu_left"></div>
    <div class="paspartu_right"></div>
    <div class="paspartu_inner">
<?php
}
?>

<div class="content <?php echo esc_attr($content_class); ?>">
	<?php
	$animation = get_post_meta($id, "edgt_show-animation", true);

	?>
	<?php if($edgt_options['page_transitions'] == "1" || $edgt_options['page_transitions'] == "2" || $edgt_options['page_transitions'] == "3" || $edgt_options['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
		<div class="meta">
			<?php do_action('edgt_ajax_meta'); ?>
			<span id="edgt_page_id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>
			<div class="body_classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
		</div>
	<?php } ?>
	<div class="content_inner <?php echo esc_attr($animation);?> ">
		<?php if($edgt_options['page_transitions'] == "1" || $edgt_options['page_transitions'] == "2" || $edgt_options['page_transitions'] == "3" || $edgt_options['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
		<?php do_action('edgt_visual_composer_custom_shortcodce_css');?>
	<?php } ?>