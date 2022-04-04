<div class="dtq-popup-conditions">
	<div class="dtq-popup-conditions-head">
		<h3><?php esc_html_e( 'WHERE DO YOU WANT TO DISPLAY IT?', 'addons-for-divi' ); ?></h3>
	</div>

	<div class="dtq-popup-conditions-body">
		<div class="dtq-popup-new-condition">
			<h4><?php esc_html_e( 'Add New Condition', 'addons-for-divi' ); ?></h4>
			<div class="dtq-popup-holder">
			<?php

				global $post;
				$display_conditions_fields = get_post_meta( $post->ID, '_ba_display_conditions', true );
				wp_nonce_field( '_ba_display_conditions_nonce', '_ba_display_conditions_nonce' );

			if ( $display_conditions_fields ) :

				foreach ( $display_conditions_fields as $field ) :

					if ( isset( $field['include'] ) && '' !== $field['include'] ) {
						$conditions_type = $field['include'];
					}

					if ( isset( $field['target'] ) && '' !== $field['target'] ) {
						$conditions_target = $field['target'];
					}

					$conditions_post = '';
					if ( isset( $field['post'] ) && '' !== $field['post'] ) {
						$conditions_post = $field['post'];
					}
					?>
			<div class="row">
				<div class="dtq-popup-select">
					<select name="conditions[type][]">
						<option value="1" <?php selected( $conditions_type, 1 ); ?>>
						<?php esc_html_e( 'Include', 'addons-for-divi' ); ?>
						</option>
						<option value="0" <?php selected( $conditions_type, 0 ); ?>>
						<?php esc_html_e( 'Exclude', 'addons-for-divi' ); ?>
						</option>
					</select>
				</div>

				<div class="dtq-popup-select">
					<select id="dtq-target" class="dtq-select2-initialized dtq-taget" name="conditions[target][]">
						<option value="entire" <?php selected( $conditions_target, 'entire' ); ?>>
						<?php esc_html_e( 'Entire Sites', 'addons-for-divi' ); ?>
						</option>
						<option value="page_selected" <?php selected( $conditions_target, 'page_selected' ); ?>>
						<?php esc_html_e( 'Pages', 'addons-for-divi' ); ?>
						</option>
						<!-- /**
						<option value="post_selected" <?php // selected( $conditions_target, 'post_selected' ); ?>>
						<?php // esc_html_e( 'Posts', 'addons-for-divi' ); ?>
						</option>
						<option value="is_front_page" <?php // selected( $conditions_target, 'is_front_page' ); ?>>
						<?php // ( 'Frontpage', 'addons-for-divi' ); ?>
						</option>
						<option value="is_404" <?php // selected( $conditions_target, 'is_404' ); ?>>
						<?php // ( '404 Page', 'addons-for-divi' ); ?>
						</option> -->
					</select>
				</div>

					<?php if ( 'page_selected' === $conditions_target ) : ?>
					<div class="dtq-popup-select dtq-popup-target">
						<select class="dtq-select2-initialized" name="conditions[target][post][]">
							<?php
								$myposts = $this->get_all_posts( 'page' );

							if ( $myposts ) :
								foreach ( $myposts as $postid => $lebel ) :
									?>

							<option value="<?php echo esc_attr( $postid ); ?>" <?php selected( $conditions_post, $postid ); ?>>
									<?php echo esc_attr( $lebel ); ?>
							</option>

									<?php
							endforeach;
								wp_reset_postdata();
								endif;
							?>
						</select>
					</div>
				<?php endif; ?>

				<div class="dtq-popup-remove">
					<?php esc_html_e( 'Remove', 'addons-for-divi' ); ?>
				</div>
			</div>
					<?php
				endforeach;
				else :
					?>
			<div class="row">
				<div class="dtq-popup-select">
					<select name="conditions[type][]">
						<option value="1"><?php esc_html_e( 'Include', 'addons-for-divi' ); ?></option>
						<option value="0"><?php esc_html_e( 'Exclude', 'addons-for-divi' ); ?></option>
					</select>
				</div>

				<div class="dtq-popup-select">
					<select id="dtq-target" class="dtq-select2-initialized dtq-taget" name="conditions[target][]">
						<option value="entire"><?php esc_html_e( 'Entire Site', 'addons-for-divi' ); ?></option>
						<option value="page_selected"><?php esc_html_e( 'Pages', 'addons-for-divi' ); ?></option>
						<!-- <option value="post_selected"><?php // esc_html_e( 'Posts', 'addons-for-divi' ); ?></option>
						<option value="is_front_page"><?php // esc_html_e( 'Frontpage', 'addons-for-divi' ); ?></option>
						<option value="is_404"><?php // esc_html_e( '404 Page', 'addons-for-divi' ); ?></option> -->
					</select>
				</div>

				<div class="dtq-popup-select dtq-popup-target"></div>

			</div>
					<?php
				endif;
				?>
			</div>

			<div class="dtq-popup-add-condition" id="dtq-repeat">
				<svg id="dtq-add" viewBox="0 0 16 16">
					<g>
						<g class="dtq-icon-wrapper" fill="currentColor">
							<path fill="currentColor" d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm4 9H9v3H7V9H4V7h3V4h2v3h3v2z">
							</path>
						</g>
					</g>
				</svg> <?php esc_html_e( 'Add new display condition', 'addons-for-divi' ); ?>
			</div>
	</div>
</div>
