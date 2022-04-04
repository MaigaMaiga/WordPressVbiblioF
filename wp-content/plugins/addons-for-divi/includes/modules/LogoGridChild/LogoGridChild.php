<?php
class DTQ_Logo_Grid_Child extends BA_Builder_Module {

	public $slug                     = 'ba_logo_grid_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'admin_title';
	public $child_title_fallback_var = 'brand_name';

	public function init() {

		$this->name = esc_html__( 'Logo', 'addons-for-divi' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'tooltip' => esc_html__( 'Tooltip', 'addons-for-divi' ),
					'border'  => esc_html__( 'Border', 'addons-for-divi' ),
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(

			'logo_url'     => array(
				'label'              => esc_html__( 'Upload Logo', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload a logo or type in the URL of the logo you would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload a Logo', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose a Logo', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Logo', 'addons-for-divi' ),
				'toggle_slug'        => 'main_content',
			),

			'brand_name'   => array(
				'label'       => esc_html__( 'Logo Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Define alt text for html img tag.', 'addons-for-divi' ),
				'type'        => 'text',
				'default'     => esc_html__( 'Brand Name', 'addons-for-divi' ),
				'toggle_slug' => 'main_content',
			),

			'use_tooltip'  => array(
				'type'        => 'multiple_checkboxes',
				'default'     => 'off',
				'toggle_slug' => 'main_content',
				'options'     => array(
					'tooltip' => esc_html__( 'Use Tooltip', 'addons-for-divi' ),
				),
			),

			'tooltip_text' => array(
				'label'       => esc_html__( 'Tooltip Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define tooltip text for logo image.', 'addons-for-divi' ),
				'type'        => 'text',
				'default'     => esc_html__( 'Tooltip!', 'addons-for-divi' ),
				'toggle_slug' => 'main_content',
				'show_if'     => array(
					'use_tooltip' => 'on',
				),
			),

			'theme'        => array(
				'label'       => esc_html__( 'Theme', 'addons-for-divi' ),
				'description' => esc_html__( 'Select tooltip theme.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'tooltip',
				'tab_slug'    => 'advanced',
				'default'     => 'dark',
				'options'     => array(
					'dark'  => esc_html__( 'Dark', 'addons-for-divi' ),
					'light' => esc_html__( 'Light', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'use_tooltip' => 'on',
				),
			),

			'position'     => array(
				'label'       => esc_html__( 'Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Select tooltip position.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'tooltip',
				'tab_slug'    => 'advanced',
				'default'     => 'top',
				'options'     => array(
					'top'    => esc_html__( 'Top', 'addons-for-divi' ),
					'bottom' => esc_html__( 'Bottom', 'addons-for-divi' ),
					'left'   => esc_html__( 'Left', 'addons-for-divi' ),
					'right'  => esc_html__( 'Right', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'use_tooltip' => 'on',
				),
			),

			'animation'    => array(
				'label'       => esc_html__( 'Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Select tooltip animation.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'tooltip',
				'tab_slug'    => 'advanced',
				'default'     => 'scale',
				'options'     => array(
					'fade'  => esc_html__( 'Fade', 'addons-for-divi' ),
					'scale' => esc_html__( 'Scale', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'use_tooltip' => 'on',
				),
			),

		);

		$label = array(
			'admin_title' => array(
				'label'       => esc_html__( 'Admin Label', 'addons-for-divi' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the item', 'addons-for-divi' ),
				'toggle_slug' => 'admin_label',
			),
		);

		return array_merge( $label, $fields );
	}


	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['fonts']       = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['max_width']   = false;

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-logo-grid__item',
				'important' => 'all',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-logo-grid__item',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['default'] = array(
			'label_prefix' => esc_html__( 'Logo', 'addons-for-divi' ),
			'toggle_slug'  => 'border',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-logo-grid__item',
					'border_styles' => '%%order_class%% .dtq-logo-grid__item',
				),
				'important' => 'all',
			),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		return $advanced_fields;
	}


	public function render_logo() {

		$logo_url   = $this->props['logo_url'];
		$brand_name = $this->props['brand_name'];

		if ( ! empty( $logo_url ) ) {
			return sprintf(
				'<img src="%1$s" alt="%2$s"/>',
				$logo_url,
				$brand_name
			);
		}

	}

	public function render( $attrs, $content, $render_slug ) {

		$use_tooltip  = $this->props['use_tooltip'];
		$tooltip_text = $this->props['tooltip_text'];
		$position     = $this->props['position'];
		$animation    = $this->props['animation'];
		$theme        = $this->props['theme'];
		$tippy_opts   = '';

		// CSS Classes.
		$this->remove_classname( 'et_pb_module' );
		$this->add_classname( 'ba_et_pb_module' );

		if ( $use_tooltip === 'on' ) {

			wp_enqueue_script( 'dtqj-popper' );
			wp_enqueue_script( 'dtqj-tippy' );
			wp_enqueue_style( 'dtqc-tippy' );

			$tippy_opts = sprintf(
				'data-tippy-content="%1$s"
                data-tippy-placement="%2$s"
                data-tippy-animation="%3$s"
                data-tippy-theme="%4$s"',
				$tooltip_text,
				$position,
				$animation,
				$theme
			);
		}

		return sprintf(
			'<div class="dtq-module dtq-child dtq-logo-grid__item">
                    <div class="dtq-logo-grid__item__inner %2$s" %3$s>
					    %1$s
				    </div>
                </div>',
			$this->render_logo(),
			'on' === $use_tooltip ? 'dtq-tooltip' : '',
			$tippy_opts
		);
	}
}

new DTQ_Logo_Grid_Child();
