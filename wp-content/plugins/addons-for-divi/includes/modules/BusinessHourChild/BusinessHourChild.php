<?php
class DTQ_Business_Hour_Child extends BA_Builder_Module {

	public $slug                     = 'ba_business_hour_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'admin_title';
	public $child_title_fallback_var = 'day';

	public function init() {

		$this->name = esc_html__( 'Business Hour Item', 'addons-for-divi' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'texts'      => array(
						'title'             => esc_html__( 'Day & Time', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'day'  => array(
								'name' => esc_html__( 'Day', 'addons-for-divi' ),
							),
							'time' => array(
								'name' => esc_html__( 'Time', 'addons-for-divi' ),
							),
						),
					),
					'separator'  => esc_html__( 'Separator', 'addons-for-divi' ),
					'border'     => esc_html__( 'Border', 'addons-for-divi' ),
					'box_shadow' => esc_html__( 'Box Shadow', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'day'       => array(
				'label'    => esc_html__( 'Day', 'addons-for-divi' ),
				'selector' => '.dtq-business-hour  %%order_class%% .dtq-business-hour-day',
			),
			'time'      => array(
				'label'    => esc_html__( 'Time', 'addons-for-divi' ),
				'selector' => '.dtq-business-hour  %%order_class%% .dtq-business-hour-time',
			),
			'separator' => array(
				'label'    => esc_html__( 'Separator', 'addons-for-divi' ),
				'selector' => '.dtq-business-hour  %%order_class%% .dtq-business-hour-separator',
			),
		);
	}

	public function get_fields() {

		$content = array(
			'day'  => array(
				'label'       => esc_html__( 'Day', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the day your for business hour.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'time' => array(
				'label'       => esc_html__( 'Time', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the time your for business hour.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),
		);

		$separator = array(
			'separator_type'   => array(
				'label'       => esc_html__( 'Separator Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select text separator type.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => 'relative',
				'options'     => array(
					'relative'       => esc_html__( 'Relative to Parent', 'addons-for-divi' ),
					'solid_border'   => esc_html__( 'Solid', 'addons-for-divi' ),
					'double_border'  => esc_html__( 'Double', 'addons-for-divi' ),
					'dotted_border'  => esc_html__( 'Dotted', 'addons-for-divi' ),
					'dashed_border'  => esc_html__( 'Dashed', 'addons-for-divi' ),
					'curved_pattern' => esc_html__( 'Curved', 'addons-for-divi' ),
					'zigzag_pattern' => esc_html__( 'Zigzag', 'addons-for-divi' ),
				),
			),
			'separator_gap'    => array(
				'label'          => esc_html__( 'Separator Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define separator both side spacing.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '15px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if_not'    => array(
					'separator_type' => 'relative',
				),
			),
			'separator_color'  => array(
				'label'       => esc_html__( 'Separator Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for your text separator.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => '#dddddd',
				'show_if_not' => array(
					'separator_type' => 'relative',
				),
			),
			'separator_weight' => array(
				'label'          => esc_html__( 'Separator Weight', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom depth for your text separator', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '1px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if_not'    => array(
					'separator_type' => 'relative',
				),
			),
			'separator_height' => array(
				'label'          => esc_html__( 'Separator Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom height for your text separator', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if_not'    => array(
					'separator_type' => 'relative',
				),
				'show_if'        => array(
					'separator_type' => array( 'curved_pattern', 'zigzag_pattern' ),
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

		return array_merge( $content, $separator, $label );
	}


	public function get_advanced_fields_config() {

		$advanced_fields          = array();
		$advanced_fields['text']  = false;
		$advanced_fields['fonts'] = false;

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '.dtq-business-hour %%order_class%% .dtq-business-hour-child',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['main'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '.dtq-business-hour %%order_class%% .dtq-business-hour-child',
					'border_styles' => '.dtq-business-hour %%order_class%% .dtq-business-hour-child',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '.dtq-business-hour %%order_class%% .dtq-business-hour-child',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'box_shadow',
		);

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '.dtq-business-hour %%order_class%% .dtq-business-hour-child',
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['day'] = array(
			'label'           => esc_html__( 'Day', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '.dtq-business-hour %%order_class%% .dtq-business-hour-day',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'day',
			'hide_text_align' => false,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
		);

		$advanced_fields['fonts']['time'] = array(
			'label'           => esc_html__( 'Time', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '.dtq-business-hour %%order_class%% .dtq-business-hour-time',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'time',
			'hide_text_align' => false,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
		);

		return $advanced_fields;
	}

	protected function render_day() {
		if ( ! empty( $this->props['day'] ) ) {
			return '<div class="dtq-business-hour-day">' . $this->props['day'] . '</div>';
		}
	}

	protected function render_time() {
		if ( ! empty( $this->props['time'] ) ) {
			return '<div class="dtq-business-hour-time">' . $this->props['time'] . '</div>';
		}
	}

	public function render( $attrs, $content, $render_slug ) {

		$this->render_css( $render_slug );
		$this->add_classname( 'ba_et_pb_module' );

		return sprintf(
			'<div class="dtq-module-child dtq-business-hour-child">
				%1$s
				<div class="dtq-business-hour-separator"></div>
				%2$s
             </div>',
			$this->render_day(),
			$this->render_time()
		);
	}

	protected function render_css( $render_slug ) {

		$type             = $this->props['separator_type'];
		$separator_height = $this->props['separator_height'];
		$separator_color  = $this->props['separator_color'];
		$separator_gap    = $this->props['separator_gap'];
		$separator_weight = $this->props['separator_weight'];

		if ( ! empty( $this->props['separator_gap'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtq-business-hour %%order_class%% .dtq-business-hour-separator',
					'declaration' => sprintf(
						'margin-right: %1$s;
						margin-left: %1$s;',
						$separator_gap
					),
				)
			);
		}

		if ( 'relative' !== $type ) {
			if ( '#' === $separator_color[0] ) {
				$separator_color = $this->hex_to_rgb( $separator_color );
			}

			$_type = explode( '_', $type );

			if ( 'border' === $_type[1] ) {

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '.dtq-business-hour %%order_class%% .dtq-business-hour-separator',
						'declaration' => sprintf(
							'border-top: %1$s %2$s %3$s;
							height: initial!important;
							background-image: initial!important;',
							$separator_weight,
							$_type[0],
							$separator_color
						),
					)
				);
			} else {

				if ( 'curved' === $_type[0] || 'zigzag' === $_type[0] ) {
					$pattern_bg = $this->get_pattern( $_type[0], $separator_color, $separator_weight );
				}

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '.dtq-business-hour %%order_class%% .dtq-business-hour-separator',
						'declaration' => sprintf(
							'background-image: url("%1$s");
							height: %2$s;
							border-top: 0!important;
							background-size: %2$s 100%%;',
							$pattern_bg,
							$separator_height
						),
					)
				);
			}
		}

	}
}

new DTQ_Business_Hour_Child();
