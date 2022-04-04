<?php
$admin_assets_url = DIVI_TORQUE_PLUGIN_ASSETS . 'imgs/admin/templates/';
$admin_templates  = self::get_admin_templates();
?>

<div class="dtq-admin-panel">
	<div class="dtq-admin-templates">


	<?php
	foreach ( $admin_templates as $template_key => $template_data ) :

		$name     = isset( $template_data['name'] ) ? $template_data['name'] : '';
		$image    = isset( $template_data['image'] ) ? $template_data['image'] : '';
		$is_pro   = isset( $template_data['is_pro'] ) && $template_data['is_pro'] ? true : false;
		$demo     = isset( $template_data['demo'] ) ? $template_data['demo'] : '';
		$download = isset( $template_data['download'] ) ? $template_data['download'] : '';

		?>

		<div class="dtq-template">
			<div class="dtq-template-figure">
				<img src="<?php echo $admin_assets_url . $image; ?>" alt="<?php echo $name; ?>">
				<?php if ( $is_pro ) : ?>
					<span class="dtq-template-badge">PRO</span>
				<?php endif; ?>
			</div>
			<div class="dtq-template-content">
				<h3><?php echo $name; ?></h3>
				<div class="dtq-template-btns">
					<a target="_blank" href="<?php echo $demo; ?>">View Demo</a>
					<?php if ( ! $is_pro ) : ?>
						<a target="_blank" href="<?php echo $download; ?>">Download</a>
					<?php else : ?>
						<?php if ( divitorque_has_pro() ) : ?>
							<a target="_blank" href="<?php echo $download; ?>">Download</a>
						<?php else : ?>
							<a  class="dtq-btn-alert" href="#">Download</a>
						<?php endif; ?>
					<?php endif; ?>

				</div>
			</div>
		</div>

		<?php
		endforeach;
	?>


	</div>
</div>
