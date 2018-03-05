<?php
	$default_settings = PluginMainController::$plugin_settings['options'];

	$custom_templates = ( isset( PluginMainController::$plugin_settings['custom_templates'] ) ? PluginMainController::$plugin_settings['custom_templates'] : false  );

	$main_color = ( isset( $default_settings['main-color']['color'] ) ? $default_settings['main-color']['color']  : '#1e88e5' );
	$posts_per_page = ( isset( $default_settings['posts_per_page']['filter'] ) ? (int) $default_settings['posts_per_page']['filter'] : 15 ) ;

	$reset_button = array();
	$reset_button['status'] = ( isset( $default_settings['reset_button']['status'] ) ? (int) $default_settings['reset_button']['status'] : 0 );
	$reset_button['name'] = ( isset( $default_settings['reset_button']['name'] ) ? $default_settings['reset_button']['name'] : 'Reset' );
	$reset_button['position'] = ( isset( $default_settings['reset_button']['position'] ) ? $default_settings['reset_button']['position'] : 'top' );

?>
<div class="data-container">
	<h4>Filter display settings</h4>

	<div class="single-filter-opt">
		<strong>Main color</strong>
		<div>
			<input type="text" class="filter-main-color colorpick-rgba" name="filter-main-color" value="<?php echo esc_attr( $main_color )?>"/>
		</div>	
	</div>

	<div class="single-filter-opt">
		<strong>Posts per page</strong>
		<div>
			<input type="number" name="posts-per-page" value="<?php echo (int) $posts_per_page ?>"/>
		</div>	
	</div>

	<div class="single-filter-opt">
		<strong>Reset button</strong>
		<div>
			<input id="px-reset-button" <?php echo ( 1 == $reset_button['status'] ? 'checked="checked"' : '' ) ?> type="checkbox" name="filter-reset-button" class="px-checkbox-slide green"  name="display-review-system" value="1"/>
			<label for="px-reset-button" id="reset-button-checkbox">
				<span class="px-checkbox-slide-tracker"></span>
				<span class="px-checkbox-slide-bullet"></span>
			</label>
			
			<div id="single-filter-reset-button-opt">
				<input type="radio" <?php echo ( 'top' === $reset_button['position'] ? 'checked="checked"' : '' );?> name="rest-button-position" value="top" > Top
				<input type="radio" <?php echo ( 'bottom' === $reset_button['position'] ? 'checked="checked"' : '' )?> name="rest-button-position" value="bottom">Bottom
				&nbsp;
				<i>Name:</i>
				<input type="text" name="reset-button-name" value="<?php  echo esc_attr( $reset_button['name'] ); ?>" placeholder="Reset Filter">
			</div>
		</div>	
	</div>

	<strong class="post-themes-headline">Themes:</strong>
	<div class="single-filter-opt dark">
		
		<div class="posts-themes">
			
			<div class="theme-options-slider">			
				
				<div class="slide">

					<span>

						<label for="post-theme-style-1" class="theme-style-type" data-columns="4" data-viewchanger="1" data-link-type="0" >
							<img src="<?php echo esc_url( LSCF_PLUGIN_URL . 'assets/images/themes/normal.jpg' ); ?>"/>
						</label>

						<input type="radio" checked="checked" id="post-theme-style-1" class="px_radiobox-input" name="post-theme-style" value="default" >
						<label for="post-theme-style-1" class="px_radiobox white"></label>
						<span>Classic(default) view mode</span>

					</span>

					<span>

						<label for="post-theme-style-2" class="theme-style-type" data-columns="0" data-viewchanger="0" data-link-type="1">
							<img src="<?php echo esc_url( LSCF_PLUGIN_URL . 'assets/images/themes/accordion.jpg' ); ?>"/>
						</label>

						<input type="radio" id="post-theme-style-2" class="px_radiobox-input" name="post-theme-style" value="accordion" >
						<label for="post-theme-style-2" class="px_radiobox white"></label>
						<span>Posts Accordion</span>

					</span>

					<span>

						<label for="post-theme-style-3" class="theme-style-type" data-columns="4" data-viewchanger="0" data-link-type="0" >
							<img src="<?php echo esc_url( LSCF_PLUGIN_URL . 'assets/images/themes/portret.jpg' ); ?>"/>
						</label>

						<input type="radio" id="post-theme-style-3" class="px_radiobox-input" name="post-theme-style" value="portrait" >
						<label for="post-theme-style-2" class="px_radiobox white"></label>
						<span>Portrait</span>

					</span>

					<span class="clear"></span>
					
				</div>

			</div>	

			<div class="lscf-custom-templates-container">
				<?php
				if ( false !== $custom_templates && count( $custom_templates ) > 0 ) :
				?>
				<strong class="lscf-ct-headline">Custom templates</strong>
				<?php
					$cc = 0;
					foreach ( $custom_templates as $template ) :
					?>

						<div class="lscf-custom-template" >

							<label for="lscf-custom-template-<?php echo (int) $cc; ?>" >
								<img src="<?php echo esc_url( LSCF_PLUGIN_URL . 'assets/images/themes/custom-template-icon.jpg' ); ?>"/>
							</label>

							<input type="radio" id="lscf-custom-template-<?php echo (int) $cc; ?>" class="px_radiobox-input lscf-custom-theme" name="post-theme-style" data-name="<?php echo esc_attr( $template['name'] )?>" data-url="<?php echo esc_attr( $template['url'] );?>" value="custom-theme" >
							<label for="lscf-custom-template-<?php echo (int) $cc; ?>" class="px_radiobox white"></label>
							<span><?php echo esc_attr( $template['name'] )?></span>

						</div>

					<?php
					$cc++;
					endforeach;

				endif;
				?>
		   </div>
		   
		</div>
	</div>

	<div class="single-filter-opt theme-columns-opt">
		
		<strong>Number of columns:</strong>
		<select name="filter-columns-number">
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
		</select>

	</div>
	
	<div class="single-filter-opt pxfilter-style-multiple-views">
		
		<strong>View Changer</strong>
		<div>
			<input type="checkbox" checked name="filter-default-view-grid" value="1"/>Grid view
			<input type="checkbox" checked name="filter-default-view-list" value="1"/>List view
		</div>

	</div>

	<div class="single-filter-opt pxfilter-style-link-type">

		<strong>Link type</strong>
		
		<div>
			<input type="radio" name="filter-link-type" value="link-only"/>Active title link &nbsp;
			<input type="radio" name="filter-link-type" value="view-more"/>"see more" link &nbsp;
			<input type="radio" checked name="filter-link-type" value="0"/>None
		</div>

	</div>

	<div class="single-filter-opt">

		<strong>Sidebar position</strong>
		<div>
			<input type="radio" checked="checked" name="sidebar-position" value="left"/>Left &nbsp;
			<input type="radio" name="sidebar-position" value="right"/>Right &nbsp;
			<input type="radio" name="sidebar-position" value="top"/>Top &nbsp;
		</div>

	</div>


</div>