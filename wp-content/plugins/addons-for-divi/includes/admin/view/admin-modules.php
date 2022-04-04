<?php

defined( 'ABSPATH' ) || die();

$modules             = self::get_modules();
$inactive_modules    = self::get_inactive_modules();
$total_modules_count = count( $modules );

?>

<div class="dtq-admin-panel">
	<div class="dtq-modules-body">
		<form class="dtq-form-admin dtq-modules-admin" id="dtq-admin-modules-form">
			<div class="dtq-row dtq-admin-modules-row">
				<div class="dtq-col">
					<div class="dtq-admin-modules">
					<?php
					foreach ( $modules as $module_key => $module_data ) :

						$title      = isset( $module_data['title'] ) ? $module_data['title'] : '';
						$icon       = isset( $module_data['icon'] ) ? $module_data['icon'] : '';
						$is_pro     = isset( $module_data['is_pro'] ) && $module_data['is_pro'] ? true : false;
						$demo_url   = isset( $module_data['demo'] ) && $module_data['demo'] ? $module_data['demo'] : '';
						$class_attr = 'dtq-admin-modules-item';
						$checked    = '';

						if ( $is_pro ) {
							$class_attr .= ' dtq-module-is-pro';
						}
						if ( ! in_array( $module_key, $inactive_modules ) ) {
							$checked = 'checked="checked"';
						}

						$is_placeholder = $is_pro && ! divitorque_has_pro();

						if ( $is_placeholder ) {
							$class_attr .= ' dtq-module-is-placeholder';
							$checked     = 'disabled="disabled"';
						}

						?>

							<div class="<?php echo $class_attr; ?>">

						<?php if ( $is_placeholder ) : ?>
									<span class="dtq-admin-modules-item-badge badge-pro">pro</span>
								<?php endif; ?>

							<span class="dtq-admin-modules-item-icon dtq-icon-svg">
							<?php echo et_core_intentionally_unescaped( BrainAddons_Static_Icons::icon( $icon ), 'html' ); ?>
							</span>
							<h3 class="dtq-admin-modules-item-title">
								<label for="dtq-module-<?php echo $module_key; ?>"><?php echo $title; ?></label>
							<?php if ( $demo_url ) : ?>
									<a href="<?php echo esc_url( $demo_url ); ?>"
										target="_blank"
										rel="noopener"
										data-tooltip="<?php echo esc_attr_e( 'Click and view demo', 'addons-for-divi' ); ?>"
										class="dtq-admin-modules-item-preview">
										<img class="dtq-img-fluid dtq-item-icon-size" src="<?php echo DIVI_TORQUE_PLUGIN_ASSETS . '/imgs/admin/desktop.svg'; ?>" alt="demo-link">
									</a>
								<?php endif; ?>
							</h3>
							<div class="dtq-admin-modules-item-toggle dtq-toggle">
								<input
									id="dtq-module-<?php echo $module_key; ?>" <?php echo $checked; ?>
									type="checkbox"
									class="dtq-toggle-check"
									name="modules[]"
									value="<?php echo $module_key; ?>"
								>
								<b class="dtq-toggle-switch"></b>
								<b class="dtq-toggle-track"></b>
							</div>
						</div>

						<?php
							endforeach;
					?>

					</div>
				</div>
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
