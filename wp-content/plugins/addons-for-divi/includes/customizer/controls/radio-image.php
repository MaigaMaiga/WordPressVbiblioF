<?php

class BrainAddons_Radio_Image extends \WP_Customize_Control {

	public $type = 'brainaddons-radio-image';
	public $is_tab = false;
	public $is_subtab = false;
	public $controls;
	public $choices;
	public $subcontrols = array();
	public function __construct( \WP_Customize_Manager $manager, $id, array $args = array() ) {
		parent::__construct( $manager, $id, apply_filters( $id . '_filter_args', $args ) );

		if ( ! empty( $args['is_tab'] ) && $args['is_tab'] === true ) {
			$this->is_tab = $args['is_tab'];
			if ( ! empty( $args['is_subtab'] ) && $args['is_subtab'] === true ) {
				$this->is_subtab = $args['is_subtab'];
			}

			if ( ! empty( $this->choices ) ) {
				foreach ( $this->choices as $value => $args ) {
					$this->controls[ $value ] = $args['controls'];
				}
			}

			if ( array_key_exists( 'subcontrols', $args ) ) {
				$this->subcontrols = esc_attr( $args['subcontrols'] );
			}
		}

	}

	public function enqueue() {

		$css_path    = DIVI_TORQUE_PLUGIN_URL . '/includes/customizer/controls/css/';
        $file_prefix = ( defined( 'DTQ_DEBUG' ) && true === constant( 'DTQ_DEBUG' ) ) ? '' : '.min';
        wp_enqueue_style( 'brainaddons-radio-image', $css_path . 'radio-image' . $file_prefix . '.css', false, DIVI_TORQUE_PLUGIN_VERSION );
		wp_enqueue_script( 'jquery-ui-button' );

	}

	public function json() {

		$json = parent::json();

		$json['is_tab']    = $this->is_tab;
		$json['is_subtab'] = $this->is_subtab;
		if ( $json['is_tab'] === true ) {
			$json['controls'] = $this->controls;
		}
		// We need to make sure we have the correct image URL.
		$json['choices'] = $this->choices;
		$json['width']   = 100;
		if ( ! empty( $this->choices ) ) {
			$json['width'] = number_format( 100 / count( $this->choices ), 2 );
		}
		$json['id']          = $this->id;
		$json['link']        = $this->get_link();
		$json['value']       = $this->value();
		$json['subcontrols'] = $this->subcontrols;

		return $json;
	}

	public function content_template() {
		?>
		<#
		if ( ! data.choices ) {
		return;
		}
		#>
		<# if( !data.is_tab) {#>
		<# if ( data.label ) { #>
		<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
		<span class="description customize-control-description">{{{ data.description }}}</span> <?php // phpcs:ignore WordPressVIPMinimum.Security.Mustache.OutputNotation ?>
		<# } #>
		<#}#>


		<div class="image">
			<# for ( key in data.choices ) { #>

			<input <# if( data.is_tab) {#>data-controls="{{data.controls[key]}}"<#}#> type="radio" value="{{ key }}"
			name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" <# if ( key
			=== data.value && ( !data.is_tab || data.is_subtab) ) { #> checked="checked" <# } #>
			{{{ data.link }}} /> <?php // phpcs:ignore WordPressVIPMinimum.Security.Mustache.OutputNotation ?>
			<label for="{{ data.id }}-{{ key }}" class="brainaddons-radio-img-svg">
				<# if( !data.is_tab) {#>
				{{{data.choices[ key ]['path']}}}
				<span class="image-clickable" title="{{ data.choices[ key ]['label'] }}"></span>
				<# } #>
			</label>
			<# } #>

		</div>
		<?php
	}
}
