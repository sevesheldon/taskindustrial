<?php 
	$plugin_url = LSCF_PLUGIN_URL;
	// get all the CUSTOM POSTS TYPE List event if the custom posts weren't created by current plugin.
	$post_types_list = PluginMainController::$post_types_list;
	// custom post types that already are activated into filter.
	$active_post_types = PluginMainController::$filter_custom_posts_type_list;
	$custom_post_types_list_plugin_only = PluginMainController::$plugin_settings['generate_the_custom_posts_list'];
	$custom_fields_data = PluginMainController::$custom_fields_data;
?>

<div class="px-plugin-wrapper">

	<div class="px-plugin-sidebar">

	</div>

	<div class="px-left-col">

		<div class="px-lfcf-logo">
			<img src="<?php echo esc_url( LSCF_PLUGIN_URL . 'assets/css/images/logo.jpg' ) ?>"/>
		</div>

		<div class="nav-tab-wrapper">
			<a href="<?php echo esc_url( $screen . '&plugin-tab=settings' ); ?>" class="nav-tab <?php px_set_as_active( $active_tab, 'settings', 'nav-tab-active' )?>">Settings</a>
			<a href="<?php echo esc_url( $screen . '&plugin-tab=general-opt' ); ?>" class="nav-tab <?php px_set_as_active( $active_tab, 'general-opt', 'nav-tab-active' )?>">Custom Posts</a>
			<a href="<?php echo esc_url( $screen . '&plugin-tab=post-fields' ) ?>" class="nav-tab <?php px_set_as_active( $active_tab, 'post-fields', 'nav-tab-active' )?>">Add/remove Custom Fields</a>
			<a href="<?php echo esc_url( $screen . '&plugin-tab=filter-generator' )?>" class="nav-tab <?php px_set_as_active( $active_tab, 'filter-generator', 'nav-tab-active' ) ?>">Custom Filter</a>
		</div>

		<div class="clear"></div>

		<div class="px-plugin-container lscf-wrapper">

		<?php
		switch ( $active_tab ) {

			case 'settings':

				?>
				<div class="px-plugin-secction">
				<?php include LSCF_PLUGIN_PATH . '_views/backend/settings-tab.php'; ?>
				</div>
				<?php

				break;

			case 'general-opt':
		?>
					<div class="px-plugin-section">

						<div>
							<br/>
							<br/>

							<h3 class="plugin-section-headline">Add new Custom Post</h3>
							<label class="headline-label">Create new custom post types for your website</label>               

							<div class="create-custom-post-wrapper">    

								<div class="create-custom-post-box">

									<label>Custom Post Name:</label><br/>
									<input id="customPostName" type="text" name="post_type_name" value=""/>
									<button id="create-new-custom-post" type="button" class="button">Create new Custom Post</button>

								</div>

								<div class="custom-posts-list">
									<h2> Custom Posts List</h2>
									<?php if ( count( $custom_post_types_list_plugin_only ) > 0 ) : ?>
										<ul>
										<?php foreach ( $custom_post_types_list_plugin_only as $key => $custom_post_type ) : ?>
											<li data-key="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_attr( $custom_post_type ); ?></strong>
											<span class="remove-custom-post">Remove</span></li>
										<?php endforeach;?>
										</ul>
									<?php endif;?>
								</div>

							</div>

						</div>

						<div class="lscf-shortcodes-list">

							<h2><span>shortcodes</span> for custom posts. Copy the shortcode inside page for custom posts display</h2>

							<div class="shortcodes-list posts-shorcodes">

								<h2>Custom Posts Shortcodes:<br/> <i>a shortcode to display all custom posts into a specified page.</i></h2>
								<hr/>

								<ul class="px-active-shorcodes">
								<?php

								$f_data = array();
								$count = 0;

								if ( count( $custom_post_types_list_plugin_only ) > 0 ) :

									foreach ( $custom_post_types_list_plugin_only as $key => $custom_post_type ) :

								?>										
									<li class="single-shortcode">
										<ul>
											<li class="filter-headline">

												<span>Custom Post Name:</span><strong><?php echo esc_attr( $custom_post_type ); ?></strong>
											</li>
											<li class="shortcode-copy">

												<div style="width:100%; text-align:left" rows="4">
													<?php echo esc_html( trim('[px_filter id="' . $key . '" post_type="' . $key . '" only_posts_show="1" view_type="default" ]' ) );?>
													<br/>
													<?php echo esc_html( trim('[px_filter id="' . $key . '" post_type="' . $key . '" only_posts_show="1" view_type="accordion" ]' ) ); ?>
													<br/>
													<?php echo esc_html( trim('[px_filter id="' . $key . '" post_type="' . $key . '" only_posts_show="1" view_type="portrait" ]' ) ); ?>
												</div>
												<hr/>
											</li>

										</ul>
									</li>

								<?php
									endforeach;

								endif;	?>
								</ul>

							</div>
						</div>

					</div>
					
				<?php
				break;

			case 'post-fields':

				$fields_opt = PluginMainController::$custom_fields_opt;

				?>
				<div class="px-posts-list">

					<br/>
					<br/>

					<h3 class="plugin-section-headline">Create your custom fields</h3>
					<label class="headline-label">Select a custom post from the list.</label>  

					<div class="posts-list-custom-fields">                            

						<form id="lscf-custom-fields-form" method="post" action="<?php echo esc_url( $screen . '&doAction=saveCFP' ); ?>">
							<?php
							if ( $post_types_list ) :
								foreach ( $post_types_list as $key => $post_type_name ) :
									if ( 'wooframework' == $key ) { continue; }
								?>
									<div class="px-post-type-row" data-key="<?php echo esc_attr( $key ) ?>">

										<label class="headline">
											<span class="px-post-name"><?php echo esc_attr( $post_type_name ) ?></span>
											<span class="edit-custom-post"><label>edit</label></span>
											<span class="cf-remove-custom-post"><label>remove</label></span>
										</label>
			
										<div class="px_innerContainer">

											<div class="fileds-settings">

												<div class="add-field-box">

													<h2>Add a custom field to selected Post Type</h2>
													<strong>Select the field type</strong>
													<select class="px-custom-select PX_add-field-type" name="add-field-type">
														<option value="0"><label>Select</label></option>
														<option value="date">Date</option>
														<option value="select-box">Dropdown</option>
														<option value="text">Text</option>
														<option value="radio">Radio</option>
														<option value="checkbox">Checkbox</option>
														<option value="checkbox-icon">Checkbox/w icons</option>
													</select>

													<button class="px_add-new-custom-field" type="button" class="button">Add</button>

													<hr />

													<div class="clear"></div>

												</div>

											</div>

											<!-- Container for Dynamic custom fields --> 
											<div class="custom_fields-container">
												<input class="px_post_key-data" type="hidden" name="post_key[]" value="<?php echo esc_attr( $key ); ?>">
											</div>

											<?php
											if ( isset( $custom_fields_data[ $key ] ) ) :

												$row_count = 0;
												foreach ( $custom_fields_data[ $key ] as $field_type => $fields ) {

													switch ( $field_type ) {

														case 'px_date':

															$k = 0;

															foreach ( $fields as $full_slug => $field ) :

																$row_count++;
																$even_class = ( 0 == $row_count % 2  ? 'even' : '' );

																?>    
																<div class="px_field-box px-date <?php echo esc_attr( $even_class ); ?>">

																	<span class="remove-custom-field">Remove Field</span>

																	<div class="inline">

																		<label>Field Name:</label>
																		<input type="text" class="px_date" name="px_date_<?php echo esc_attr( $key ); ?>-name[<?php echo esc_attr( $k ) ?>]" value="<?php echo esc_attr( $field['name'] )?>">

																		<div class="field-type-group">
																			<span>Type:</span>
																			<strong><?php echo esc_attr( $fields_opt[ $field['slug'] ]['name'] );?></strong>
																		</div>

																	</div>

																	<input type="hidden" name="px_date_<?php echo esc_attr( $key ); ?>[<?php echo esc_attr( $k ) ?>]" value="<?php echo esc_attr( px_sanitize( $field['name'] ) ); ?>">
																	<input type="hidden" name="px_date_<?php echo esc_attr( $key ); ?>_fieldUniqueID[<?php echo esc_attr( $k ) ?>]" value="<?php echo esc_attr( $full_slug ); ?>"/>

																</div>    
																<?php
																$k++;

															endforeach;

															break;

														case 'px_text':

															$k = 0;

															foreach ( $fields as $full_slug => $field ) :

																$row_count++;
																$even_class = ( 0 == $row_count % 2  ? 'even' : '' );
																?>    

																<div class="px_field-box px-text <?php echo esc_attr( $even_class ); ?>">

																	<span class="remove-custom-field">Remove Field</span>

																	<div class="inline">

																		<label>Field Name:</label>
																		<input type="text" class="px_text" name="px_text_<?php echo  esc_attr( $key ); ?>-name[<?php echo esc_attr( $k ); ?>]" value="<?php echo esc_attr( $field['name'] );?>">

																		<div class="field-type-group">
																			<span>Type:</span>
																			<strong><?php echo esc_attr( $fields_opt[ $field['slug'] ]['name'] );?></strong>

																		</div>

																	</div>

																	<input type="hidden" name="px_text_<?php echo esc_attr( $key ); ?>[<?php echo esc_attr( $k ); ?>]" value="<?php echo esc_attr( px_sanitize( $field['name'] ) ); ?>">
																	<input type="hidden" name="px_text_<?php echo esc_attr( $key ); ?>_fieldUniqueID[<?php echo esc_attr( $k ); ?>]" value="<?php echo esc_attr( $full_slug ); ?>"/>

																</div>    

																<?php
																$k++;
															endforeach;

															break;

														case 'px_radio_box':

															$index = 0;

															foreach ( $fields as $full_slug => $field ) :

																$row_count++;
																$even_class = ( 0 == $row_count % 2  ? 'even' : '' );

																?>    

																<div class="px_field-box <?php echo esc_attr( $even_class ); ?> px_radio_box_<?php echo esc_attr( $key ); ?>" data-type="px_radio_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>">

																	<span class="remove-custom-field">Remove Field</span>

																	<div class="inline">

																		<label>Field Name:</label>
																		<input type="text" class="px_radio_box" name="px_radio_box_<?php echo esc_attr( $key ); ?>-name[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( $field['name'] ); ?>">

																		<div class="field-type-group">
																			<span>Type:</span>
																			<strong><?php echo esc_attr( $fields_opt[ $field['slug'] ]['name'] );?></strong>
																		</div>

																	</div>

																	<input type="hidden" name="px_radio_box_<?php echo esc_attr( $key ); ?>[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( px_sanitize( $field['name'] ) ); ?>">

																	<ul class="px_select-options-container">

																		<?php if ( isset( $field['options'] ) && count( $field['options'] > 0 ) ) : ?>

																			<?php foreach ( $field['options'] as $option ) : ?>

																					<li>
																						<?php echo esc_attr( $option ); ?>
																						<span class="px_removeOption">Remove</span>

																						<input type="hidden" name="px_options_px_radio_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>[]" value="<?php echo esc_attr( $option );?>">
																					</li>

																			<?php endforeach;?>            

																		<?php endif; ?>

																	</ul>

																	<div class="px-option-add-new">

																		<input type="text" class="px_optionValue" name="px_add_new_select_option[]"/>
																		<span class="px_add_new_select_option px_addNewOption">Add option</span>

																	</div>

																	<input type="hidden" name="px_radio_box_<?php echo esc_attr( $key ); ?>_fieldUniqueID[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( $full_slug ); ?>"/>

																</div>    
																<?php

																$index++;

															endforeach;

															break;

														case 'px_check_box':

															$index = 0;

															foreach ( $fields as $full_slug => $field ) :

																$row_count++;
																$even_class = ( 0 == $row_count % 2 ? 'even' : '' );

															?>    

																<div class="px_field-box <?php echo esc_attr( $even_class ); ?> px_check_box_<?php echo esc_attr( $key ); ?>" data-type="px_check_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>">

																	<span class="remove-custom-field">Remove Field</span>

																	<div class="inline">

																		<label>Field Name:</label>
																		<input type="text" class="px_check_box" name="px_check_box_<?php echo esc_attr( $key ); ?>-name[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( $field['name'] ); ?>">

																		<div class="field-type-group">
																			<span>Type:</span>
																			<strong><?php echo esc_attr( $fields_opt[ $field['slug'] ]['name'] );?></strong>
																		</div>

																	</div>

																	<input type="hidden" name="px_check_box_<?php echo esc_attr( $key ); ?>[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( px_sanitize( $field['name'] ) ); ?>">

																	<ul class="px_select-options-container">
																	<?php if ( isset( $field['options'] ) && count( $field['options'] > 0 ) ) : ?>

																		<?php foreach ( $field['options'] as $option ) : ?>

																			<li>
																			<?php echo esc_attr( $option ); ?>
																				<span class="px_removeOption">Remove</span>

																				<input type="hidden" name="px_options_px_check_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>[]" value="<?php echo esc_attr( $option ); ?>">
																			</li>

																		<?php endforeach;?>            

																	<?php endif; ?>
																	</ul>

																	<div class="px-option-add-new">
																		<input type="text" class="px_optionValue" name="px_add_new_select_option[]"/>
																		<span class="px_add_new_select_option px_addNewOption">Add option</span>
																	</div>

																	<input type="hidden" name="px_check_box_<?php echo esc_attr( $key ); ?>_fieldUniqueID[]" value="<?php echo esc_attr( $full_slug ); ?>"/>

																</div>    
																<?php

																$index++;

															endforeach;

															break;

														case 'px_icon_check_box' :

															$index = 0;

															foreach ( $fields as $full_slug => $field ) :

																$row_count++;
																$even_class = ( 0 == $row_count % 2  ? 'even' : '' );

																?>    
																<div class="px_field-box <?php echo esc_attr( $even_class ); ?> px_icon_check_box_<?php echo esc_attr( $key ); ?>" data-type="px_icon_check_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>">
																	<span class="remove-custom-field">Remove Field</span>

																	<div class="inline">

																		<label>Field Name:</label>
																		<input type="text" class="px_icon_check_box" name="px_icon_check_box_<?php echo esc_attr( $key ); ?>-name[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( $field['name'] )?>">

																		<div class="field-type-group">
																			<span>Type:</span>
																			<strong><?php echo esc_attr( $fields_opt[ $field['slug'] ]['name'] );?></strong>
																		</div>

																	</div>

																	<input type="hidden" name="px_icon_check_box_<?php echo esc_attr( $key ); ?>[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( px_sanitize( $field['name'] ) ); ?>">

																	<ul class="px_select-options-container">

																		<?php if ( isset( $field['options'] ) && count( $field['options'] > 0 ) ) : ?>

																			<?php foreach ( $field['options'] as $option ) : ?>
																			<li>
																				<span class="iconContainer">
																					<img class="option-icon" src="<?php echo esc_attr( $option['icon'] )?>" width="30">
																				</span>
																				<?php echo esc_attr( $option['opt'] ); ?>
																				<span class="px_removeOption">Remove</span>
																				
																				<input type="hidden" name="px_options_icon_px_icon_check_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>[]" value="<?php echo esc_attr( $option['ID'] );?>">
																				<input type="hidden" name="px_options_px_icon_check_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>[]" value="<?php echo esc_attr( $option['opt'] );?>">
																			</li>

																			<?php endforeach;?>            

																		<?php endif; ?>
																	</ul>

																	<div class="px-option-add-new">
																		<input type="text" class="px_optionValue" name="px_add_new_select_option[]"/>
																		<span class="px_add_new_select_option px_addNewOption">Add option</span>
																	</div>

																	<input type="hidden" name="px_icon_check_box_<?php echo esc_attr( $key ); ?>_fieldUniqueID[]" value="<?php echo esc_attr( $full_slug ); ?>"/>

																</div>    

																<?php
																$index++;
															endforeach;

															break;

														case 'px_select_box':

															$index = 0;

															foreach ( $fields as $full_slug => $field ) :

																$row_count++;
																$even_class = ( 0 == $row_count % 2  ? 'even' : '' );
																?>    

																<div class="px_field-box <?php echo esc_attr( $even_class ); ?> px_select_box_<?php echo esc_attr( $key ); ?>" data-type="px_select_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>">

																	<span class="remove-custom-field">Remove Field</span>

																	<div class="inline">

																		<label>Field Name:</label>
																		<input type="text" class="px_select_box" name="px_select_box_<?php echo esc_attr( $key ); ?>-name[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( $field['name'] )?>">

																		<div class="field-type-group">
																			<span>Type:</span>
																			<strong><?php echo esc_attr( $fields_opt[ $field['slug'] ]['name'] );?></strong>
																		</div>

																	</div>

																	<input type="hidden" name="px_select_box_<?php echo esc_attr( $key ); ?>[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( px_sanitize( $field['name'] ) )?>">

																	<ul class="px_select-options-container">

																		<?php if ( isset( $field['options'] ) && count( $field['options'] > 0 ) ) : ?>

																			<?php foreach ( $field['options'] as $option ) : ?>
																				<li>
																					<?php echo esc_attr( $option ); ?>
																					<span class="px_removeOption">Remove</span>

																					<input type="hidden" name="px_options_px_select_box_<?php echo esc_attr( $key ) . '_' . esc_attr( $index ); ?>[]" value="<?php echo esc_attr( $option );?>">
																				</li>
																			<?php endforeach;?>            
																		<?php endif; ?>

																	</ul>

																	<div class="px-option-add-new">
																		<input type="text" class="px_optionValue" name="px_add_new_select_option[]"/>
																		<span class="px_add_new_select_option px_addNewOption">Add option</span>
																	</div>

																	<input type="hidden" name="px_select_box_<?php echo esc_attr( $key ); ?>_fieldUniqueID[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( $full_slug ); ?>"/>

																</div>    
																<?php

																$index++;

															endforeach;

															break;
													}
												}

											endif;
											?>
										</div>

										<div class="save-btn">
											<button class="button button-primary px-button">Save</button>
										</div>

									</div>
									<?php

								endforeach;
							endif;
								?>

							<br/>
							<br/>

						</form>

					</div>

				</div>

				<?php
				break;

			case 'filter-generator':

			?>

				<div id="pxcf_createFilter" class="lfcs-wrapper">

					<h1>Create your Custom Filter</h1>

					<div id="px_post-customFields">

						<form id="generateshortcode-form">

							<div class="f-name">

								<label>Filter Name:</label><br/>

									<div class="inline">
										<input id="px_filter-name-shorcode-generator" type="text" name="px_filter_name" value=""/>
										<button id="goToFilterFields" type="button" class="px-button">Next</button>
									</div>

									<span class="px_error" id="px_filter_name_error">Filter name is empty</span>

							</div>

							<div class="lscf-step-2">


								<div class="px_lf_post-type step1 step-shape">

									<label>Choose the custom post type</label>
									
									<input type="hidden" id="px-filter-for" name="filter-for" value="custom-posts"/>

									<select id="px-filter-selected-post-type" name="px_lf_post-type" class="px-custom-select">

										<option value="0">Select Post Type</option>

										<?php
										if ( count( $post_types_list ) > 0 ) :

											$count = 0;
											if ( class_exists( 'WooCommerce' ) ) {

												foreach ( $post_types_list as $key => $post_type ) :

													if ( 'wooframework' == $key ) {
														continue;
													}

													$checked = ( in_array( $key, $active_post_types ) ? 'checked="checked"' : '' );

													if ( 'product' == $key ) :
													?>
														<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_attr( $post_type ); ?>(WooCommerce)</option>
													<?php
													else :
													?>
														<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_attr( $post_type ); ?></option>
													<?php
													endif;

													$count++;

												endforeach;

											} else {

												foreach ( $post_types_list as $key => $post_type ) :

													$checked = ( in_array( $key, $active_post_types ) ? 'checked="checked"' : '' );
													?>
														<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_attr( $post_type ); ?></option>
														<?php

														$count++;

												endforeach;
											}
										endif;
										?>    

									</select>

								</div><!-- END step1 -->

								<div class="step2 step-shape">

									<label>Select the custom fields for filter sidebar</label>

									<div class="post-categories-group">

										<strong class="expandable-container-headline inactive">Categories</strong>
										

										<div class="expandable-container">
											<div id="px_post_categories" class="data-container"></div>
										</div>

									</div>

									<br/>
									<br/>
									<br/>

									<div class="post-custom-fields-group">

										<strong class="expandable-container-headline always-active">Custom Fields</strong>
										<hr class="silver"/>

										<div class="expandable-container">

											<div class="data-container custom-fields-block">

												<div id="px_post_fields" class="px_dynamic-field"></div>

												<hr class="silver"/>

												<div class="px_additional-fields">

													<h4>Special fields for results filtering</h4>
													<select id="px_additional-fields" class="px-custom-select">
														<option value="">Select Field</option>
														<option value="search">Search</option>
														<option value="range">Range</option>
														<option value="date-interval">Date Interval</option>
													</select>

													<span class="px_add-additional-field" id="px_add-additional-field">Add</span>

													<div class="clear"></div>

													<!-- ************* Custom Post Type Fields List ***********************-->
													<div id="px_additional-fields-container"></div>

												</div><!-- END px_additional-fields-->

											</div><!-- END data-container-->

										</div><!-- END expandable-continer-->

									</div><!-- END post-custom-fields-group -->

								</div><!-- END step2 -->


								<div class="featured-fields-group step3 step-shape ">                                    

									<label>Some extra stuff for you... Nice label on featured pictues(grid), on right side (list) </label>

									<strong class="expandable-container-headline inactive">Features</strong>
									<hr class="silver"/>

									<div class="expandable-container">

										<div class="data-container">

											<div class="px_featured-field">
												<h4>Select a featured field that would show on each post from list</h4>
												<ul id="setAsFeaturedField"></ul>
											</div>

										</div>

									</div><!-- END expandable-container --> 

								</div><!-- END featured-fields-group && step3  -->

								<div class="step4 step-shape ">
									
									<strong class="expandable-container-headline always-active">Styles</strong>

									<div class="expandable-container filter-display-settings">

										<?php include_once LSCF_PLUGIN_PATH . '_views/backend/filter-style.php'; ?>

									</div>

								</div>

								<div class="step5 step-shape">
									
									<strong class="always-active">Settings</strong>

									<!--<div class="lscf-step-container">
										<input type="checkbox" id="lscf-settings-shortcodes-execute" class="px-checkbox" name="lscf_settings_execute_shorcode" value="1">
										<label for="lscf-settings-shortcodes-execute" class="px-checkbox-label green"></label>
										Execute Shorcode in results
									</div>-->

									<div class="lscf-step-container">
										<input type="checkbox" id="lscf-settings-disable-empty-options" class="px-checkbox" name="lscf_settings_disable_empty_options" value="1">
										<label for="lscf-settings-disable-empty-options" class="px-checkbox-label green"></label>
										Disable empty filter options/categories when filtering the posts
									</div>

								</div>

								<div class="step6 step-shape last-step">

									<strong>Shortcode</strong>
									<hr class="silver"/>
									<label>Generate shortcode. Copy and pase the generated shortcode into desired page for filter to show up.</label>

								</div><!-- END step4 -->

								<button type="button" class="generate-shortcode" id="pxcf_generate-shortcode">Generate Shortcode</button>

								<!-- Append Shorcodes -->
								<ul id="pxGenerateShortcodesContainer" class="generatedShorcodes"></ul>

							</div>

						</form>

						<div id="active-shortcodes-list" class="lscf-shortcodes-list">

							<h2><span>or</span> Copy/Paste your filters to Page editor</h2>

							<div class="shortcodes-list">

								<h2>Shortcodes:</h2>
								<hr/>

								<ul class="px-active-shorcodes">
								<?php

								$f_data = array();
								$count = 0;

								if ( isset( PluginMainController::$plugin_settings['filterList'] ) ) :

									foreach ( PluginMainController::$plugin_settings['filterList'] as $filter_id => $ch_data ) {

										$f_data[ $count ]['filterID'] = $filter_id;
										$f_data[ $count ]['data'] = $ch_data;

										$count++;

									}

								endif;

								for ( $i = ( count( $f_data ) - 1 ); $i >= 0; $i-- ) :

									if ( ! isset( $f_data[ $i ]['data']['post_type'] ) || ! isset( $f_data[ $i ]['filterID'] ) ) {
										continue;
									}
								?>
									<li class="single-shortcode">
										<ul>
											<li class="filter-headline">

												<span>Name:</span><strong><?php echo esc_attr( $f_data[ $i ]['data']['name'] ); ?></strong>
												<br/>
												<span data-id="<?php echo esc_attr( $f_data[ $i ]['filterID'] ); ?>" data-post="<?php echo esc_attr( $f_data[ $i ]['data']['post_type'] ); ?>" class="px_remove-shortcode px_removeOption">Remove</span>

											</li>
											<li class="shortcode-copy">

												<textarea style="width:100%; text-align:left" rows="4" readonly="readonly"><?php echo esc_html( trim('
												[px_filter id="' . $f_data[ $i ]['filterID'] . '" post_type="' . $f_data[ $i ]['data']['post_type'] . '" featured_label="' . $f_data[ $i ]['data']['featuredLabelFieldID'] . '"]' ) );
												?></textarea>

											</li>

										</ul>
									</li>
								<?php
								endfor;
									?>
								</ul>

							</div>
						</div>

					</div>       
				</div>
				<?php

				break;
		}
		?>

		</div>
	</div>
</div>
