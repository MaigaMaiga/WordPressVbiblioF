<?php
class DTQ_Dual_Button extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com//dual-button-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->name       = esc_html__( 'Torque Dual Button', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'dual-button.svg';
		$this->slug       = 'ba_dual_button';
		$this->vb_support = 'on';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'btns' => array(
						'title'             => esc_html__( 'Button Content', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'btn_a'     => array(
								'name' => esc_html__( 'Primary', 'addons-for-divi' ),
							),
							'connector' => array(
								'name' => esc_html__( 'Connector', 'addons-for-divi' ),
							),
							'btn_b'     => array(
								'name' => esc_html__( 'Secondary', 'addons-for-divi' ),
							),
						),
					),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'common'         => esc_html__( 'General', 'addons-for-divi' ),
					'btn_a'          => esc_html__( 'Primary Button', 'addons-for-divi' ),
					'btn_b'          => esc_html__( 'Secondary Button', 'addons-for-divi' ),
					'connector'      => esc_html__( 'Connector', 'addons-for-divi' ),
					'btn_a_advanced' => array(
						'title' => esc_html__( 'Primary Button Advanced ', 'addons-for-divi' ),
					),
					'btn_b_advanced' => array(
						'title' => esc_html__( 'Secondary Button Advanced ', 'addons-for-divi' ),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'primary'   => array(
				'label'    => esc_html__( 'Primary Button', 'addons-for-divi' ),
				'selector' => '%%order_class%% .btn-el btn-el--primary',
			),
			'secondary' => array(
				'label'    => esc_html__( 'Secondary Button', 'addons-for-divi' ),
				'selector' => '%%order_class%% .btn-el btn-el--secondary',
			),
			'connector' => array(
				'label'    => esc_html__( 'Connector', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-btn__connector',
			),
		);
	}

	public function get_fields() {

		$fields = array(

			'btn_alignment'          => array(
				'label'            => esc_html__( 'Button Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align buttons to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'common',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),

			'btn_a_text'             => array(
				'label'           => esc_html__( 'Button Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define primary button text for your module.', 'addons-for-divi' ),
				'type'            => 'text',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'btns',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'btn_a',
			),

			'btn_a_link'             => array(
				'label'           => esc_html__( 'Button Link', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define primary button link URL for your module.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'btns',
				'tab_slug'        => 'general',
				'dynamic_content' => 'url',
				'sub_toggle'      => 'btn_a',
			),

			'btn_a_link_target'      => array(
				'label'       => esc_html__( 'Button Link Target', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can choose whether or not your link opens in a new window', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'btns',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'btn_a',
				'default'     => '_self',
				'options'     => array(
					'_self'  => esc_html__( 'Same Tab', 'addons-for-divi' ),
					'_blank' => esc_html__( 'New Tab', 'addons-for-divi' ),
				),
			),

			'btn_b_text'             => array(
				'label'           => esc_html__( 'Button Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define secondary button text for your module.', 'addons-for-divi' ),
				'type'            => 'text',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'btns',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'btn_b',
			),

			'btn_b_link'             => array(
				'label'           => esc_html__( 'Button Link', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define secondary button link URL for your module.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'btns',
				'dynamic_content' => 'url',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'btn_b',
			),

			'btn_b_link_target'      => array(
				'label'       => esc_html__( 'Button Link Target', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can choose whether or not your link opens in a new window', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'btns',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'btn_b',
				'default'     => '_self',
				'options'     => array(
					'_self'  => esc_html__( 'Same Tab', 'addons-for-divi' ),
					'_blank' => esc_html__( 'New Tab', 'addons-for-divi' ),
				),
			),

			'connector_type'         => array(
				'label'       => esc_html__( 'Connector Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select button connector type.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'btns',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'connector',
				'default'     => 'empty',
				'options'     => array(
					'empty' => esc_html__( 'No Connector', 'addons-for-divi' ),
					'text'  => esc_html__( 'Text', 'addons-for-divi' ),
					'icon'  => esc_html__( 'Icon', 'addons-for-divi' ),
				),
			),

			'connector_text'         => array(
				'label'       => esc_html__( 'Connector Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the connector text for your module.', 'addons-for-divi' ),
				'type'        => 'text',
				'default'     => 'OR',
				'toggle_slug' => 'btns',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'connector',
				'show_if'     => array(
					'connector_type' => 'text',
				),
			),

			'connector_icon'         => array(
				'label'           => esc_html__( 'Connector Icon', 'addons-for-divi' ),
				'description'     => esc_html__( 'Select icon for your button connector.', 'addons-for-divi' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'class'           => array( 'dtq-btn__connector' ),
				'toggle_slug'     => 'btns',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'connector',
				'default'         => '5',
				'show_if'         => array(
					'connector_type' => 'icon',
				),
			),

			'connector_text_size'    => array(
				'label'       => esc_html__( 'Connector Text Size', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom text size for your button connector.', 'addons-for-divi' ),
				'type'        => 'range',
				'default'     => '14px',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_text_color'   => array(
				'label'       => esc_html__( 'Text Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom text color for your button connector.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'default'     => '#333',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_bg'           => array(
				'label'       => esc_html__( 'Background', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom background color for your button connector.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'default'     => 'transparent',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_size'         => array(
				'label'       => esc_html__( 'Connector Size', 'addons-for-divi' ),
				'description' => esc_html__( 'Increase or decrease the size for your button connector.', 'addons-for-divi' ),
				'type'        => 'range',
				'default'     => '30px',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_radius'       => array(
				'label'        => esc_html__( 'Connector Radius', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom border radius for your button connector.', 'addons-for-divi' ),
				'type'         => 'range',
				'default'      => '0px',
				'default_unit' => 'px',
				'toggle_slug'  => 'connector',
				'tab_slug'     => 'advanced',
				'show_if_not'  => array(
					'connector_type' => 'empty',
				),
			),

			'connector_border_width' => array(
				'label'       => esc_html__( 'Connector Border Width', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom border width for your button connector.', 'addons-for-divi' ),
				'type'        => 'range',
				'default'     => '0px',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'connector_border_color' => array(
				'label'       => esc_html__( 'Connector Border Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom border color for your button connector.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'default'     => 'transparent',
				'toggle_slug' => 'connector',
				'tab_slug'    => 'advanced',
				'show_if_not' => array(
					'connector_type' => 'empty',
				),
			),

			'button_gap'             => array(
				'label'          => esc_html__( 'Button Gap', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease the spacing between buttons.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '40px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 250,
					'step' => 1,
				),
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
			),

			'btn_a_radius'           => array(
				'label'       => esc_html__( 'Advanced Border Radius', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can control the corner radius of the primary button. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'addons-for-divi' ),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'btn_a_advanced',
			),

			'btn_b_radius'           => array(
				'label'       => esc_html__( 'Advanced Border Radius', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can control the corner radius of the secondary button. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'addons-for-divi' ),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'btn_b_advanced',
			),

		);

		return $fields;
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['button']['btn_a'] = array(
			'label'         => esc_html__( 'Primary Button', 'addons-for-divi' ),
			'css'           => array(
				'main'      => '%%order_class%% .btn-el--primary',
				'important' => 'all',
			),
			'use_alignment' => false,
			'box_shadow'    => false,
		);

		$advanced_fields['button']['btn_b'] = array(
			'label'         => esc_html__( 'Secondary Button', 'addons-for-divi' ),
			'css'           => array(
				'main'      => '%%order_class%% .btn-el--secondary',
				'important' => 'all',
			),
			'use_alignment' => false,
			'box_shadow'    => false,
		);

		$advanced_fields['box_shadow']['btn_a'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .btn-el--primary',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'btn_a_advanced',
		);

		$advanced_fields['box_shadow']['btn_b'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .btn-el--secondary',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'btn_b_advanced',
		);

		return $advanced_fields;
	}

	public function render_button_a() {

		$button_custom = $this->props['custom_btn_a'];
		$button_text   = isset( $this->props['btn_a_text'] ) ? $this->props['btn_a_text'] : 'Button 1';
		$button_link   = isset( $this->props['btn_a_link'] ) ? $this->props['btn_a_link'] : '#';
		$button_url    = trim( $button_link );
		$new_tab       = '_blank' === $this->props['btn_a_link_target'] ? 'on' : 'off';
		$button_rel    = $this->props['btn_a_rel'];

		$custom_icon_values = et_pb_responsive_options()->get_property_values( $this->props, 'btn_a_icon' );
		$custom_icon        = isset( $custom_icon_values['desktop'] ) ? $custom_icon_values['desktop'] : '';
		$custom_icon_tablet = isset( $custom_icon_values['tablet'] ) ? $custom_icon_values['tablet'] : '';
		$custom_icon_phone  = isset( $custom_icon_values['phone'] ) ? $custom_icon_values['phone'] : '';
		$multi_view         = et_pb_multi_view_options( $this );

		if ( function_exists( 'dtq_inject_fa_icons' ) ) {
			// Inject Font Awesome Manually!.
			dtq_inject_fa_icons( $this->props['btn_a_icon'] );
		}

		$button = $this->render_button(
			array(
				'button_id'           => $this->module_id( false ),
				'button_classname'    => array( 'btn-el', 'btn-el--primary' ),
				'button_custom'       => $button_custom,
				'button_text'         => $button_text,
				'button_rel'          => $button_rel,
				'button_text_escaped' => true,
				'button_url'          => $button_url,
				'custom_icon'         => $custom_icon,
				'custom_icon_tablet'  => $custom_icon_tablet,
				'custom_icon_phone'   => $custom_icon_phone,
				'url_new_window'      => $new_tab,
				'has_wrapper'         => false,
				'multi_view_data'     => $multi_view->render_attrs(
					array(
						'content'        => '{{btn_a_text}}',
						'hover_selector' => '%%order_class%% .btn-el--primary',
						'visibility'     => array(
							'button_text' => '__not_empty',
						),
					)
				),
			)
		);

		return $button;

	}

	public function render_button_b() {

		$button_custom = $this->props['custom_btn_b'];
		$button_text   = isset( $this->props['btn_b_text'] ) ? $this->props['btn_b_text'] : 'Button 2';
		$button_link   = isset( $this->props['btn_b_link'] ) ? $this->props['btn_b_link'] : '#';
		$button_url    = trim( $button_link );
		$new_tab       = '_blank' === $this->props['btn_b_link_target'] ? 'on' : 'off';
		$button_rel    = $this->props['btn_b_rel'];

		$custom_icon_values = et_pb_responsive_options()->get_property_values( $this->props, 'btn_b_icon' );
		$custom_icon        = isset( $custom_icon_values['desktop'] ) ? $custom_icon_values['desktop'] : '';
		$custom_icon_tablet = isset( $custom_icon_values['tablet'] ) ? $custom_icon_values['tablet'] : '';
		$custom_icon_phone  = isset( $custom_icon_values['phone'] ) ? $custom_icon_values['phone'] : '';
		$multi_view         = et_pb_multi_view_options( $this );

		if ( function_exists( 'dtq_inject_fa_icons' ) ) {
			// Inject Font Awesome Manually!.
			dtq_inject_fa_icons( $this->props['btn_b_icon'] );
		}

		$button = $this->render_button(
			array(
				'button_id'           => $this->module_id( false ),
				'button_classname'    => array( 'btn-el', 'btn-el--secondary' ),
				'button_custom'       => $button_custom,
				'button_text'         => $button_text,
				'button_rel'          => $button_rel,
				'button_text_escaped' => true,
				'button_url'          => $button_url,
				'custom_icon'         => $custom_icon,
				'custom_icon_tablet'  => $custom_icon_tablet,
				'custom_icon_phone'   => $custom_icon_phone,
				'url_new_window'      => $new_tab,
				'has_wrapper'         => false,
				'multi_view_data'     => $multi_view->render_attrs(
					array(
						'content'        => '{{btn_b_text}}',
						'hover_selector' => '%%order_class%% .btn-el--secondary',
						'visibility'     => array(
							'button_text' => '__not_empty',
						),
					)
				),
			)
		);

		return $button;

	}

	public function renderConnector() {

		$connector_text = null;
		$connector_type = $this->props['connector_type'];
		$connector_text = $this->props['connector_text'];
		$connector_icon = $this->props['connector_icon'];
		$icon           = esc_attr( et_pb_process_font_icon( $connector_icon ) );

		if ( 'text' === $connector_type ) {

			$connector_text = $connector_text;
		} elseif ( 'icon' === $this->props['connector_type'] ) {

			$connector_text = sprintf( '<i class="dtq-et-icon" data-icon="%1$s"></i>', $icon );
		}

		if ( 'empty' !== $connector_type ) {
			return sprintf(
				'<div class="dtq-btn__connector dtq-btn__connector--%1$s">
					%2$s
				</div>',
				$connector_type,
				$connector_text
			);
		}
	}

	public function render( $attrs, $content, $render_slug ) {

		$this->render_css( $render_slug );

		return sprintf(
			'<div class="dtq-module dtq-dual-btn">
				<div class="dtq-btn-wrap">
					%1$s %2$s
				</div>
				<div class="dtq-btn-wrap">
					%3$s
				</div>
			</div>',
			$this->render_button_a(),
			$this->renderConnector(),
			$this->render_button_b()
		);
	}

	public function render_css( $render_slug ) {

		$this->get_buttons_styles( 'btn_a', $render_slug, '%%order_class%% .dtq-dual-btn .btn-el--primary' );
		$this->get_buttons_styles( 'btn_b', $render_slug, '%%order_class%% .dtq-dual-btn .btn-el--secondary' );

		// advanced border radius.
		$btn_a_radius = $this->props['btn_a_radius'];
		$btn_b_radius = $this->props['btn_b_radius'];

		if ( ! empty( $btn_a_radius ) ) {
			$btn_a_radius = explode( '|', $btn_a_radius );

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => 'body #page-container %%order_class%% .dtq-dual-btn .dtq-btn-wrap .btn-el--primary, .et-db #et-boc %%order_class%% .dtq-dual-btn .dtq-btn-wrap .btn-el--primary',
					'declaration' => sprintf(
						'
					border-top-left-radius: %1$s!important;
					border-top-right-radius: %2$s!important;
					border-bottom-right-radius: %3$s!important;
					border-bottom-left-radius: %4$s!important;',
						$btn_a_radius[1],
						$btn_a_radius[2],
						$btn_a_radius[3],
						$btn_a_radius[4]
					),
				)
			);
		}

		if ( ! empty( $btn_b_radius ) ) {
			$btn_b_radius = explode( '|', $btn_b_radius );

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => 'body #page-container %%order_class%% .dtq-dual-btn .dtq-btn-wrap .btn-el--secondary, .et-db #et-boc %%order_class%% .dtq-dual-btn .dtq-btn-wrap .btn-el--secondary',
					'declaration' => sprintf(
						'
					border-top-left-radius: %1$s!important;
					border-top-right-radius: %2$s!important;
					border-bottom-right-radius: %3$s!important;
					border-bottom-left-radius: %4$s!important;',
						$btn_b_radius[1],
						$btn_b_radius[2],
						$btn_b_radius[3],
						$btn_b_radius[4]
					),
				)
			);
		}

		if ( 'empty' !== $this->props['connector_type'] ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-btn__connector',
					'declaration' => sprintf(
						'
					width: %1$s;
					height: %2$s;
					background: %3$s;
					color: %4$s;
					font-size: %5$s;
					border-radius: %6$s;
					box-shadow: 0 0 0 %7$s %8$s',
						$this->props['connector_size'],
						$this->props['connector_size'],
						$this->props['connector_bg'],
						$this->props['connector_text_color'],
						$this->props['connector_text_size'],
						$this->props['connector_radius'],
						$this->props['connector_border_width'],
						$this->props['connector_border_color']
					),
				)
			);
		}

		$button_gap                   = $this->props['button_gap'];
		$button_gap_tablet            = $this->props['button_gap_tablet'];
		$button_gap_phone             = $this->props['button_gap_phone'];
		$button_gap_last_edited       = $this->props['button_gap_last_edited'];
		$button_gap_responsive_status = et_pb_get_responsive_status( $button_gap_last_edited );

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .btn-el--primary',
				'declaration' => sprintf( 'margin-right: calc(%1$s / 2)', $button_gap ),
			)
		);

		if ( $button_gap_tablet && $button_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .btn-el--primary',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-right: calc(%1$s / 2)', $button_gap_tablet ),
				)
			);
		}

		if ( $button_gap_phone && $button_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .btn-el--primary',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-right: calc(%1$s / 2)', $button_gap_phone ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .btn-el--secondary',
				'declaration' => sprintf( 'margin-left: calc(%1$s / 2)', $button_gap ),
			)
		);

		if ( $button_gap_tablet && $button_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .btn-el--secondary',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-left: calc(%1$s / 2)', $button_gap_tablet ),
				)
			);
		}

		if ( $button_gap_phone && $button_gap_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .btn-el--secondary',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-left: calc(%1$s / 2)', $button_gap_phone ),
				)
			);
		}

		$this->get_responsive_styles(
			'btn_alignment',
			'%%order_class%% .dtq-dual-btn',
			array(
				'primary'   => 'justify-content',
				'important' => true,
			),
			array( 'default' => 'left' ),
			$render_slug
		);

	}
}

new DTQ_Dual_Button();
