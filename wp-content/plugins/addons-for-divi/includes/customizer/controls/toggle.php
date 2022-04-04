<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class BrainAddons_Toggle_Control extends WP_Customize_Control {

	public $type = 'brainaddons-toggle';

	public function enqueue() {

		$css_path    = DIVI_TORQUE_PLUGIN_URL . '/includes/customizer/controls/css/';
		$js_path     = DIVI_TORQUE_PLUGIN_URL . '/includes/customizer/controls/js/';
		$file_prefix = ( defined( 'DTQ_DEBUG' ) && true === constant( 'DTQ_DEBUG' ) ) ? '' : '.min';
		wp_enqueue_script( 'brainaddons-toggle-control', $js_path . 'toggle-control' . $file_prefix . '.js', array( 'customize-controls' ), DIVI_TORQUE_PLUGIN_VERSION, true );
	}

	public function to_json() {
		parent::to_json();

		$this->json['id']           = $this->id;
		$this->json['value']        = $this->value();
		$this->json['link']         = $this->get_link();
		$this->json['defaultValue'] = $this->setting->default;
	}

	public function render_content() {}

	protected function content_template() {
		?>
		<label class="toggle">
			<div class="toggle-wrapper">

				<# if ( data.label ) { #>
					<span class="customize-control-title">{{ data.label }}</span>
				<# } #>

				<input id="toggle-{{ data.id }}" type="checkbox" class="toggle-input" value="{{ data.value }}" {{{ data.link }}} <# if ( data.value ) { #> checked="checked" <# } #> />
				<label for="toggle-{{ data.id }}" class="toggle-label"></label>
			</div>

			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>
		</label>
		<?php
	}
}
