<div class="dtq-admin wrapper">
	<h1 class="screen-reader-text"><?php esc_html_e( 'DiviTorque Settings', 'addons-for-divi' ); ?></h1>
	<div class="dtq-admin-header">
		<div class="dtq-admin-logo-inline">
			<?php $logo_url = DIVI_TORQUE_PLUGIN_ASSETS . 'imgs/admin/'; ?>
			<div class="dtq-header-left">
				<?php esc_attr_e( 'DiviTorque Settings', 'addons-for-divi' ); ?>
			</div>
		</div>
		<div class="dtq-nav" role="tablist">
			<nav class="dtq-tabs-nav">
				<?php
					$tab_count = 1;

				foreach ( self::get_tabs() as $slug => $tab ) :

					$slug = esc_attr( strtolower( $slug ) );
					if ( divitorque_has_pro() && 'pro' === $slug ) {
						continue;
					}

					$class = ' dtq-admin-nav-item-link';
					if ( $tab_count === 1 ) {
						$class .= ' active-tab';
					}

					if ( ! empty( $tab['href'] ) ) {
						$href = esc_url( $tab['href'] );
					} else {
						$href = '#' . $slug;
					}

					printf(
						'<a href="%1$s" aria-controls="tab-content-%2$s" id="tab-nav-%2$s" class="%3$s" role="tab">
							<span>%4$s</span>
                        </a>',
						$href,
						$slug,
						$class,
						$tab['title']
					);

					++$tab_count;
					endforeach;
				?>
			</nav>
		</div>
	</div>

	<div class="dtq-admin-tabs">
		<div class="dtq-admin-tabs-content">
			<?php
				$tab_count = 1;

			foreach ( self::get_tabs() as $slug => $tab ) :

				$class = 'dtq-admin-tabs-content-item';

				if ( $tab_count === 1 ) {
					$class .= ' active-tab';
				}

				if ( divitorque_has_pro() && 'pro' === $slug ) {
					continue;
				}

				$slug = esc_attr( strtolower( $slug ) );

				?>
					<div class="<?php echo $class; ?>" id="tab-content-<?php echo $slug; ?>" role="tabpanel" aria-labelledby="tab-nav-<?php echo $slug; ?>">
					<?php call_user_func( $tab['renderer'], $slug, $tab ); ?>
					</div>
				<?php
				++$tab_count;
				endforeach;
			?>
		</div>
	</div>
</div>

<?php if ( ! divitorque_has_pro() ) : ?>
<div class="dtq-pro-alert" style="display: none;">
	<div class="dtq-pro-alert-inner">
		<div class="dtq-pro-alert-close">
			&times;
		</div>
		<div class="dtq-pro-alert-figure">
			<img src="<?php echo DIVI_TORQUE_PLUGIN_ASSETS; ?>/imgs/admin/gift-box.jpg" alt="">
		</div>

		<div class="dtq-pro-alert-content">
			<h4>Unlock a Faster Experience</h4>
			<img src="<?php echo DIVI_TORQUE_PLUGIN_ASSETS; ?>/imgs/admin/sale-gr.svg" alt="">
			<div class="dtq-alert-btn">
				<a target="_blank" href="https://divitorque.com/pricing/">UPGRADE TO PRO</a>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
