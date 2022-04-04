<?php
	$extensions             = self::get_extensions();
	$inactive_extensions    = self::get_inactive_extensions();
	$total_extensions_count = count( $extensions );
?>
<div class="dtq-admin-panel">
	<div class="dtq-extensions-body">
		<form class="dtq-form-admin dtq-extensions-admin" id="dtq-admin-extensions-form">
			<div class="dtq-admin-extensions">
				<?php
				foreach ( $extensions as $extension_key => $extension_data ) :
					$title      = isset( $extension_data['title'] ) ? $extension_data['title'] : '';
					$desc       = isset( $extension_data['desc'] ) ? $extension_data['desc'] : '';
					$icon       = isset( $extension_data['icon'] ) ? $extension_data['icon'] : '';
					$demo_url   = isset( $extension_data['demo'] ) && $extension_data['demo'] ? $extension_data['demo'] : '';
					$class_attr = 'dtq-admin-extensions-item';
					$badge      = '';
					$checked    = '';

					if ( ! in_array( $extension_key, $inactive_extensions ) ) {
						$checked = 'checked="checked"';
					}
					?>

					<div class="<?php echo $class_attr; ?>">
						<div class="dtq-admin-icon">
							<i class="dashicons dashicons-admin-plugins centered"></i>
						</div>
						<div class="dtq-admin-content">
							<div class="dtq-admin-extensions-item-title dtq-text f20">
							<?php echo $title . ' ' . $badge; ?>
							</div>
							<p class="dtq-text f16">
							<?php echo $desc; ?>
							</p>
						</div>
						<div class="dtq-toggle-action">
							<div class="dtq-admin-extensions-item-toggle dtq-toggle">
								<input
									id="dtq-extension-<?php echo $extension_key; ?>" <?php echo $checked; ?>
									type="checkbox"
									class="dtq-ext-switch dtq-toggle-check"
									name="extensions[]"
									value="<?php echo $extension_key; ?>"
								>
								<b class="dtq-toggle-switch"></b>
								<b class="dtq-toggle-track"></b>
							</div>
						</div>
					</div>
					<?php
						endforeach;
				?>
			</div>

			<div class="dtq-row dtq-admin-button-panel">
				<div class="dtq-col">
					<button disabled class="dtq-btn dtq-btn-save dtq-btn-lg" type="submit">
						<?php esc_html_e( 'Save Settings', 'addons-for-divi' ); ?>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
