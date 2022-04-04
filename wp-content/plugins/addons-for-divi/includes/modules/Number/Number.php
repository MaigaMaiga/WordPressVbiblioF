<?php
class DTQ_Number extends BA_Builder_Module {

	public $slug       = 'ba_number';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/number-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {
		$this->name      = esc_html__( 'Torque Number', 'addons-for-divi' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'number.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'number'     => esc_html__( 'Number', 'addons-for-divi' ),
					'text'       => esc_html__( 'Number Text', 'addons-for-divi' ),
					'title'      => esc_html__( 'Title Text', 'addons-for-divi' ),
					'border'     => esc_html__( 'Border', 'addons-for-divi' ),
					'box_shadow' => esc_html__( 'Box Shadow', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'wrapper' => array(
				'label'    => esc_html__( 'Text Wrapper', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-number-wrap',
			),
			'text'    => array(
				'label'    => esc_html__( 'Text', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-number-text',
			),
		);
	}

	public function get_fields() {

		$fields          = array();
		$_defaults       = array(
			'position' => 'left_top',
			'offset_x' => '50px',
			'offset_y' => '50px',
		);
		$number_abs_opts = $this->get_absolute_element_options( 'number', '', 'number', $_defaults, array( 'number_placement' => 'absolute' ) );
		// Content.
		$content = array(
			'number'           => array(
				'label'       => esc_html__( 'Number', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the number.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'use_counter'      => array(
				'label'           => esc_html__( 'Use Counter', 'addons-for-divi' ),
				'description'     => esc_html__( 'This won\'t work on visual builder', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'content',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
			),

			'title'            => array(
				'label'       => esc_html__( 'Title', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the title.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'number_placement' => array(
				'label'           => esc_html__( 'Number Position', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define the number position.', 'addons-for-divi' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'toggle_slug'     => 'content',
				'default'         => '_default',
				'options'         => array(
					'_default' => esc_html__( 'Default', 'addons-for-divi' ),
					'absolute' => esc_html__( 'Absolute', 'addons-for-divi' ),
				),
			),
		);

			// Number.
				$fields['number_alignment'] = array(
					'label'           => esc_html__( 'Alignment', 'addons-for-divi' ),
					'description'     => esc_html__( 'Align number to the left, right or center.', 'addons-for-divi' ),
					'type'            => 'text_align',
					'option_category' => 'layout',
					'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
					'options_icon'    => 'module_align',
					'toggle_slug'     => 'number',
					'tab_slug'        => 'advanced',
				);
				$fields['use_box']          = array(
					'label'           => esc_html__( 'Use Number Box', 'addons-for-divi' ),
					'description'     => esc_html__( 'Here you can choose whether overlay image should be used.', 'addons-for-divi' ),
					'type'            => 'yes_no_button',
					'option_category' => 'configuration',
					'options'         => array(
						'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
						'off' => esc_html__( 'No', 'addons-for-divi' ),
					),
					'default'         => 'on',
					'toggle_slug'     => 'number',
					'tab_slug'        => 'advanced',
				);

				$fields['number_height'] = array(
					'label'          => esc_html__( 'Height', 'addons-for-divi' ),
					'description'    => esc_html__( 'Here you can define a custom height for number text.', 'addons-for-divi' ),
					'type'           => 'range',
					'default'        => '100px',
					'mobile_options' => true,
					'range_settings' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 1000,
					),
					'toggle_slug'    => 'number',
					'tab_slug'       => 'advanced',
					'show_if'        => array(
						'use_box' => 'on',
					),
				);

				$fields['number_width'] = array(
					'label'          => esc_html__( 'Width', 'addons-for-divi' ),
					'description'    => esc_html__( 'Here you can define a custom width for number text.', 'addons-for-divi' ),
					'type'           => 'range',
					'default'        => '100px',
					'mobile_options' => true,
					'range_settings' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 1000,
					),
					'toggle_slug'    => 'number',
					'tab_slug'       => 'advanced',
					'show_if'        => array(
						'use_box' => 'on',
					),
				);

				$fields['number_rotate'] = array(
					'label'          => esc_html__( 'Rotate', 'addons-for-divi' ),
					'description'    => esc_html__( 'Rotate number box, number text will be in same position. Only container box will be rotated.', 'addons-for-divi' ),
					'type'           => 'range',
					'default'        => '0deg',
					'fixed_unit'     => 'deg',
					'range_settings' => array(
						'min'  => -360,
						'max'  => 360,
						'step' => 1,
					),
					'toggle_slug'    => 'number',
					'tab_slug'       => 'advanced',
					'show_if'        => array(
						'use_box' => 'on',
					),
				);

				$fields['title_spacing'] = array(
					'label'          => esc_html__( 'Title Spacing Top', 'addons-for-divi' ),
					'description'    => esc_html__( 'Here you can define a custom spacing for the title.', 'addons-for-divi' ),
					'type'           => 'range',
					'default'        => '10px',
					'mobile_options' => true,
					'range_settings' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 1000,
					),
					'toggle_slug'    => 'title',
					'tab_slug'       => 'advanced',
					'show_if'        => array(
						'number_placement' => '_default',
					),
				);

				$number_bg = $this->custom_background_fields(
					'number',
					'',
					'advanced',
					'number',
					array( 'color', 'gradient', 'hover' ),
					array( 'use_box' => 'on' ),
					'#efefef'
				);

		// Default values.
		if ( dt_if_not_migrated() ) {
			$fields['number_alignment']['default'] = 'center';
		} else {
			$fields['number_alignment']['default'] = 'left'; // new.
		}

		return array_merge( $content, $number_abs_opts, $fields, $number_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text_shadow'] = false;

		$advanced_fields['borders']['number'] = array(
			'toggle_slug'     => 'number',
			'css'             => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-number-wrap',
					'border_styles' => '%%order_class%% .dtq-number-wrap',
				),
				'important' => 'all',
			),
			'defaults'        => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
			'depends_on'      => array( 'use_box' ),
			'depends_show_if' => 'on',
		);

		$advanced_fields['borders']['main'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%%',
					'border_styles' => '%%order_class%%',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['box_shadow']['number'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .dtq-number-wrap',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'number',
			'show_if'     => array(
				'use_box' => 'on',
			),
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%%',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'box_shadow',
		);

		$advanced_fields['fonts']['number'] = array(
			'label'           => esc_html__( 'Number', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-number-text',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '26px',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'label'       => esc_html__( 'Title', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .dtq-number-title h3',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'title',
			'line_height' => array(
				'default' => '1.3em',
			),
			'font_size'   => array(
				'default' => '22px',
			),
		);

		return $advanced_fields;
	}

	public function render_number() {
		if ( ! empty( $this->props['number'] ) ) {
			return sprintf(
				'<div class="dtq-number-wrap">
                    <div class="dtq-number-text">
                        %1$s
                    </div>
                </div>',
				$this->props['number']
			);
		}
	}

	public function render_title() {
		if ( ! empty( $this->props['title'] ) ) {
			return sprintf(
				'<div class="dtq-number-title">
                   <h3>%1$s</h3>
                </div>',
				$this->props['title']
			);
		}
	}

	public function render( $attrs, $content, $render_slug ) {

		$this->render_css( $render_slug );
		$use_counter = $this->props['use_counter'];

		if ( 'on' === $use_counter ) {
			wp_enqueue_script( 'dtqj-counter' );
		}

		return sprintf(
			'<div class="dtq-module dtq-number %3$s">
                %1$s
                %2$s
            </div>',
			$this->render_number(),
			$this->render_title(),
			'on' === $use_counter ? 'dtq-counter' : ''
		);
	}

	protected function render_css( $render_slug ) {

		$number_rotate = $this->props['number_rotate'];
		$use_box       = $this->props['use_box'];

		if ( 'on' === $use_box ) {
			$this->get_responsive_styles(
				'number_height',
				'%%order_class%% .dtq-number-wrap',
				array(
					'primary'   => 'height',
					'important' => false,
				),
				array( 'default' => '100px' ),
				$render_slug
			);

			$this->get_responsive_styles(
				'number_width',
				'%%order_class%% .dtq-number-wrap',
				array(
					'primary'   => 'width',
					'important' => false,
				),
				array( 'default' => '100px' ),
				$render_slug
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-number-wrap',
					'declaration' => sprintf(
						'display: flex;
                        justify-content: center;
                        align-items: center;
                        border-style: solid;
                        transform: rotate(%1$s);',
						$number_rotate
					),
				)
			);

			// Number BG.
			$this->get_custom_bg_style( $render_slug, 'number', '%%order_class%% .dtq-number-wrap', '%%order_class%%:hover .dtq-number-wrap' );

		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-number-wrap',
				'declaration' => sprintf(
					'text-align: %1$s;',
					$this->props['number_alignment']
				),
			)
		);

		if ( 'center' === $this->props['number_alignment'] ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-number-wrap',
					'declaration' => 'margin-right: auto;margin-left: auto;',
				)
			);
		} elseif ( 'right' === $this->props['number_alignment'] ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-number-wrap',
					'declaration' => 'margin-left: auto;',
				)
			);
		}

		if ( '_default' === $this->props['number_placement'] ) {
			$this->get_responsive_styles(
				'title_spacing',
				'%%order_class%% .dtq-number-title',
				array(
					'primary'   => 'margin-top',
					'important' => false,
				),
				array( 'default' => '10px' ),
				$render_slug
			);
		}

		if ( 'absolute' === $this->props['number_placement'] ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-number-wrap',
					'declaration' => 'z-index: 9!important;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-number-title',
					'declaration' => 'z-index: 999!important;position: relative;',
				)
			);

			$this->get_absolute_element_styles( $render_slug, 'number', '%%order_class%% .dtq-number-wrap' );
		}

	}
}

new DTQ_Number();
