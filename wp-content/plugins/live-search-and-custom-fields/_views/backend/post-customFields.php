<div class="px-post-custom-fields-group">
<?php 
echo '<input type="hidden" name="save_px_post_fields" value="1"/>';

$grouped_fields_data = array();

foreach ( $fields_data as $field_type => $fields_values ) :

	foreach ( $fields_values as $field_object ) :

		switch ( $field_object['slug'] ) {

			case 'px_select_box':
			case 'px_text':
			case 'px_date':

				$grouped_fields_data['single'][] = $field_object;

				break;
			case 'px_check_box':
			case 'px_radio_box':
			case 'px_icon_check_box':

				$grouped_fields_data['multiple'][] = $field_object;

				break;
		}
	endforeach;
endforeach;

if ( isset( $grouped_fields_data['single'] ) ) :

	$count = 0;

	foreach ( $grouped_fields_data['single'] as $field_object ) :

		$first_column = ( 0 == $count % 3 ? 'first-column' :'' );

		switch ( $field_object['slug'] ) {

			case 'px_select_box':
			?>
				<div class="px-post-field-group px-float-row <?php echo $first_column; ?>">

					<?php

					$selected_option = ( ( isset( $field_object['dataValue'] ) && '' !== $field_object['dataValue'] ) ? '<option>' . esc_attr( $field_object['dataValue'] ) . '</option>' : '' );

					?>
					<strong class="px_custom-field-name"><?php echo esc_html( $field_object['name'] ); ?>:</strong>

					<input type="hidden" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>_-_name" value="<?php echo esc_attr( $field_object['name'] )?>">

					<select name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>">
						<?php

						echo $selected_option;

						foreach ( $field_object['options'] as $option ) {
							echo '<option>' . esc_attr( $option ) . '</option>';
						}
						?>
					</select>  

					<?php
						$checked = ( ( isset( $field_object['post-display'] ) && 1 == $field_object['post-display'] ) ? 'checked="checked"' : '' );
					?>
					<div class="px-cf-show-to-post">
						<input class="px-checkbox" <?php echo $checked; ?> type="checkbox" id="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>_-_display" value="1">
						<label class="px-checkbox-label" for="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" ></label>
						<span>Show it up into post's view page</span>
					</div>

				</div>

				<?php
				break;

			case 'px_date':

				$value = ( ( isset( $field_object['dataValue'] ) && '' !== $field_object['dataValue'] ) ? $field_object['dataValue'] : '' );
				?>

				<div class="px-post-field-group px-float-row <?php echo $first_column; ?>">

					<input type="hidden" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ) ?>_-_name" value="<?php echo esc_attr( $field_object['name'] )?>">
					<strong class="px_custom-field-name"><?php echo esc_attr( $field_object['name'] ); ?>:</strong>
					<label class="px-date-label">
						<input class="initCalendar" type="text" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ) ?>" value="<?php echo esc_attr( $value );?>"/>
					</label>
					<div class="clear"></div>

					<?php
						$checked = ( ( isset( $field_object['post-display'] ) && 1 == $field_object['post-display'] ) ? 'checked="checked"' : '' );
					?>
					<div class="px-cf-show-to-post">
						<input class="px-checkbox" <?php echo $checked; ?> type="checkbox" id="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>_-_display" value="1">
						<label class="px-checkbox-label" for="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" ></label>
						<span>Show it up into post's view page</span>
					</div>

				</div>
				<?php


				break;

			case 'px_text':

			?>
				<div class="px-post-field-group px-float-row <?php echo $first_column; ?>">
					<?php

					$value = ( ( isset( $field_object['dataValue'] ) &&  '' !== $field_object['dataValue'] ) ? $field_object['dataValue'] : '' );
					?>

					<input type="hidden" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ) ?>_-_name" value="<?php echo esc_attr( $field_object['name'] )?>">
					<strong class="px_custom-field-name"><?php echo esc_attr( $field_object['name'] ); ?>:</strong>
					<input type="text" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ) ?>" value="<?php echo esc_attr( $value ); ?>"/>

					<?php
						$checked = ( ( isset( $field_object['post-display'] ) && 1 == $field_object['post-display'] ) ? 'checked="checked"' : '' );
					?>
					<div class="px-cf-show-to-post">
						<input class="px-checkbox" <?php echo $checked; ?> type="checkbox" id="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>_-_display" value="1">
						<label class="px-checkbox-label" for="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" ></label>
						<span>Show it up into post's view page</span>
					</div>

				</div>

				<?php

				break;

		}

		$count++;

	endforeach;
	?>
	<div class="clear"></div>
	<?php
endif;

if ( isset( $grouped_fields_data['multiple'] ) ) :

	foreach ( $grouped_fields_data['multiple'] as $field_object ) :

		switch ( $field_object['slug'] ) {

			case 'px_check_box':

				if ( count( $field_object['options'] ) > 0 ) :
				?>
					<div class="px-post-field-group">

						<strong class="px_custom-field-name"><?php echo esc_html( $field_object['name'] ); ?>:</strong>
						<input type="hidden" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>_-_name" value="<?php echo esc_attr( $field_object['name'] )?>">    
							<ul class="px_checkbox-options">
								<?php
								foreach ( $field_object['options'] as $option ) :
									$checked = ( ( isset( $field_object['dataValue'] ) && is_array( $field_object['dataValue'] ) && in_array( $option, $field_object['dataValue'] ) ) ? 'checked="checked"':'' );
									?>
										<li class="px_option">
											<input type="checkbox" <?php echo esc_attr( $checked ); ?> name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ) ?>[]" value="<?php echo esc_attr( $option )?>"><?php echo esc_attr( $option ) ?>
										</li>
									<?php
								endforeach;
								?>

							</ul>

							<?php
								$checked = ( ( isset( $field_object['post-display'] ) && 1 == $field_object['post-display'] ) ? 'checked="checked"' : '' );
							?>
							<div class="px-cf-show-to-post">
								<input class="px-checkbox" <?php echo $checked; ?> type="checkbox" id="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>_-_display" value="1">
								<label class="px-checkbox-label" for="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" ></label>
								<span>Show it up into post's view page</span>
							</div>

						</div>
				<?php
				endif;

				break;

			case 'px_icon_check_box':

				if ( count( $field_object['options'] ) > 0 ) :
				?>

					<div class="px-post-field-group">

						<strong class="px_custom-field-name"><?php echo esc_attr( $field_object['name'] ); ?>:</strong>
						<input type="hidden" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] )?>_-_name" value="<?php echo esc_attr( $field_object['name'] )?>">
						<ul class="px_checkbox-options icon">
							<?php

							foreach ( $field_object['options'] as $option ) :

								$checked = ( ( isset( $field_object['dataValue'] ) && is_array( $field_object['dataValue'] ) && in_array( $option['opt'], $field_object['dataValue'] ) ) ? 'checked="checked"' : '' );
								$opt_slug = esc_attr( px_sanitize( $option['opt'] ) );
								?>
								<li class="px_option">
									<span class="check-icon">
										<?php if ( isset( $option['icon'] ) && '' !== $option['icon'] ) : ?>
										<img src="<?php echo esc_attr( $option['icon'] )?>"/>
										<?php endif; ?>
									</span>
									<input type="hidden" name="<?php echo esc_attr( $field_object['value'] ) . '___pxopt-icon_' . esc_attr( $opt_slug ); ?>" value="<?php echo esc_attr( $option['icon'] )?>">
									<input type="checkbox" <?php echo esc_attr( $checked ); ?> name="<?php echo esc_attr( $field_object['value'] );?>_-_px-opt_<?php echo esc_attr( $opt_slug ); ?>" value="<?php echo esc_attr( $option['opt'] )?>"><?php echo esc_attr( $option['opt'] ) ?>
								</li>
								<?php
							endforeach;
							?>
						</ul>

						<?php
							$checked = ( ( isset( $field_object['post-display'] ) && 1 == $field_object['post-display'] ) ? 'checked="checked"' : '' );
						?>
						<div class="px-cf-show-to-post">
							<input class="px-checkbox" <?php echo $checked; ?> type="checkbox" id="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>_-_display" value="1">
							<label class="px-checkbox-label" for="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" ></label>
							<span>Show it up into post's view page</span>
						</div>
					</div>
				<?php
				endif;

				break;


			case 'px_radio_box':

				if ( count( $field_object['options'] ) ) :
				?>

					<div class="px-post-field-group">

						<strong class="px_custom-field-name"><?php echo esc_attr( $field_object['name'] ) ?>:</strong>
						<input type="hidden" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] )?>_-_name" value="<?php echo esc_attr( $field_object['name'] )?>">
						<ul class="px_radio-options">

							<?php
							foreach ( $field_object['options'] as $option ) :

								$checked = ( (isset( $field_object['dataValue'] ) && $option === $field_object['dataValue'] ) ? 'checked' : '' );
							?>
								<li class="px_option">
									<input type="radio" <?php echo esc_attr( $checked ); ?> name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] )?>" value="<?php echo esc_attr( $option ) ?>"><?php echo esc_html( $option ) ?>
								</li>
							<?php
							endforeach;
							?>

					</ul>

					<?php
						$checked = ( ( isset( $field_object['post-display'] ) && 1 == $field_object['post-display'] ) ? 'checked="checked"' : '' );
					?>
					<div class="px-cf-show-to-post">
						<input class="px-checkbox" <?php echo $checked; ?> type="checkbox" id="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" name="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>_-_display" value="1">
						<label class="px-checkbox-label" for="<?php echo esc_attr( $field_object['value'] ) . '___' . esc_attr( $field_object['slug'] ); ?>" ></label>
						<span>Show it up into post's view page</span>
					</div>

				</div>

				<?php
				endif;

				break;

		}

	endforeach;

endif;
?>
</div>
