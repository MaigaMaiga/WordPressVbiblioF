<?php

$class_array = array(
	'dtq-popup',
	'dtq-popup-front-mode',
	'dtq-popup-hide-state',
	'dtq-popup-animation-' . $animation,
	'dtq-popup-custom-height-' . $popup_settings['ba_use_container_height'],
);

$class_attr   = implode( ' ', $class_array );
$popup_styles = ba_custom_css( esc_attr( $popup_id ) );

?>
<div id="dtq-popup-<?php echo esc_attr( $popup_id ); ?>" class="<?php echo esc_attr( $class_attr ); ?>" data-settings="<?php echo esc_attr( $popup_json_data ); ?>">
	<div class="dtq-popup-inner">
		<?php echo $overlay_html; //phpcs:ignore     ?>
		<div class="dtq-popup-container">
			<div class="dtq-popup-container-inner">
				<div class="dtq-popup-container-overlay"></div>
				<div class="dtq-popup-container-content">
					<?php
						$this->print_location_content( esc_attr( $popup_id ) );
						$styles['et-builder-advanced-style']    = ET_Builder_Element::get_style();
						$styles['et-builder-page-custom-style'] = et_pb_get_page_custom_css();
					foreach ( $styles as $style_id => $style ) {
						if ( ! $style ) {
							continue;
						}
						$style = str_replace( 'body #page-container', ' ', $style );
						echo '<style type="text/css" id="dtq-style-popup-' . $style_id . '"> ' . $style . ' </style>'; //phpcs:ignore
					}
					?>
				</div>
			</div>
			<?php echo $close_button_html; //phpcs:ignore     ?>
		</div>
	</div>
</div>
<style type="text/css" id="dtq-popup-style-<?php echo esc_attr( $popup_id ); ?>">
	<?php echo esc_attr( $popup_styles ); ?>
</style>
