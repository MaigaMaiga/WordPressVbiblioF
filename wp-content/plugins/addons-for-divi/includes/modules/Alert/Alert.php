<?php
class DTQ_Alert extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/alert-module',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->slug       = 'ba_alert';
		$this->vb_support = 'on';
		$this->name       = esc_html__( 'Torque Alert', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'alert.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'addons-for-divi' ),
					'settings' => esc_html__( 'Settings', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'icon'    => esc_html__( 'Icon', 'addons-for-divi' ),
					'dismiss' => esc_html__( 'Dismiss', 'addons-for-divi' ),
					'text'    => esc_html__( 'Text', 'addons-for-divi' ),
					'title'   => esc_html__( 'Title Text', 'addons-for-divi' ),
					'border'  => esc_html__( 'Border', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'icon_wrapper' => array(
				'label'    => esc_html__( 'Icon Wrapper', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-alert .dtq-alert-icon',
			),
			'icon'         => array(
				'label'    => esc_html__( 'Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-alert .dtq-alert-icon .dtq-alert-icon-inner',
			),
			'title'        => array(
				'label'    => esc_html__( 'Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-alert .dtq-alert-title',
			),
			'desc'         => array(
				'label'    => esc_html__( 'Description', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-alert .dtq-alert-desc',
			),
		);
	}

	public function get_fields() {
		$content = array(
			'use_icon'    => array(
				'label'           => esc_html__( 'Use Icon', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether icon set below should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'content',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
			),
			'icon'        => array(
				'label'           => esc_html__( 'Select Icon', 'addons-for-divi' ),
				'description'     => esc_html__( 'Choose an icon to display with your alert.', 'addons-for-divi' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'content',
				'tab_slug'        => 'general',
				'show_if'         => array(
					'use_icon' => 'on',
				),
			),
			'image'       => array(
				'label'              => esc_html__( 'Upload Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'content',
				'dynamic_content'    => 'image',
				'show_if'            => array(
					'use_icon' => 'off',
				),
			),
			'image_alt'   => array(
				'label'       => esc_html__( 'Image Alt', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define the HTML ALT text for your image.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
				'show_if'     => array(
					'use_icon' => 'off',
				),
			),
			'title'       => array(
				'label'           => esc_html__( 'Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the title text for your alert.', 'addons-for-divi' ),
				'type'            => 'text',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'content',
			),
			'description' => array(
				'label'           => esc_html__( 'Description', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the description text for your alert.', 'addons-for-divi' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'content',
			),
		);

		$settings = array(
			'alert_type'   => array(
				'label'       => esc_html__( 'Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define different types of pre made alert layout.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'danger',
				'options'     => array(
					'danger'  => esc_html__( 'Danger', 'addons-for-divi' ),
					'warning' => esc_html__( 'Warning', 'addons-for-divi' ),
					'info'    => esc_html__( 'Info', 'addons-for-divi' ),
					'light'   => esc_html__( 'Light', 'addons-for-divi' ),
					'dark'    => esc_html__( 'Dark', 'addons-for-divi' ),
					'ltdark'  => esc_html__( 'Light Dark', 'addons-for-divi' ),
				),
			),
			'show_dismiss' => array(
				'label'           => esc_html__( 'Show Dismiss Button', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether dismiss button should be displayed.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'settings',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
			),
			'align_items'  => array(
				'label'       => esc_html__( 'Content Vertical Alignment', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can set the vertical content alignment.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__( 'Top', 'addons-for-divi' ),
					'center'     => esc_html__( 'Center', 'addons-for-divi' ),
					'flex-end'   => esc_html__( 'Bottom', 'addons-for-divi' ),
				),
			),
		);

		$icon = array(
			'icon_size'    => array(
				'label'          => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom size for your alert icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '40px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),

			'icon_color'   => array(
				'label'       => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Pick a color to use for the icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'hover'       => 'tabs',
				'show_if'     => array(
					'use_icon' => 'on',
				),
			),

			'icon_spacing' => array(
				'label'          => esc_html__( 'Icon Spacing Gap', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing between icon and content.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),

			'use_icon_box' => array(
				'label'           => esc_html__( 'Use Icon Box', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether icon should display within a box.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'icon',
				'tab_slug'        => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
			),
			'icon_width'   => array(
				'label'          => esc_html__( 'Icon Box Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define static width for the icon box.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '80px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'icon',
				'sub_toggle'     => 'icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'use_icon_box' => 'on',
				),
			),

			'icon_height'  => array(
				'label'          => esc_html__( 'Icon Box Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define static height for the icon box.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '80px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'    => 'icon',
				'sub_toggle'     => 'icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'use_icon_box' => 'on',
				),
			),
		);

		$dismiss = array(
			'dismiss_size'    => array(
				'label'          => esc_html__( 'Dismiss Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom size for the dismiss icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '22px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'dismiss',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_dismiss' => 'on',
				),
			),

			'dismiss_color'   => array(
				'label'       => esc_html__( 'Dismiss Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Pick a color to use for the dismiss icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'dismiss',
				'hover'       => 'tabs',
				'show_if'     => array(
					'show_dismiss' => 'on',
				),
			),

			'dismiss_spacing' => array(
				'label'          => esc_html__( 'Dismiss Spacing Gap', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing between dismiss icon and content.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => 'dismiss',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_dismiss' => 'on',
				),
			),
		);

		$icon_bg = $this->custom_background_fields(
			'icon',
			esc_html__( 'Icon Box', 'addons-for-divi' ),
			'advanced',
			'icon',
			array( 'color', 'gradient', 'hover' ),
			array( 'use_icon_box' => 'on' ),
			''
		);

		$title = array(
			'title_spacing' => array(
				'label'          => esc_html__( 'Title Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the title.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'    => 'title',
				'tab_slug'       => 'advanced',
			),
		);
		return array_merge( $content, $settings, $icon, $icon_bg, $dismiss, $title );
	}

	public function get_advanced_fields_config() {

		$advanced_fields               = array();
		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%%.et_pb_module',
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'label'        => esc_html__( 'Title', 'addons-for-divi' ),
			'css'          => array(
				'main'      => '%%order_class%% .dtq-alert-title',
				'important' => 'all',
			),
			'tab_slug'     => 'advanced',
			'toggle_slug'  => 'title',
			'header_level' => array(
				'default' => 'h5',
			),
			'font_size'    => array(
				'default' => '16px',
			),
			'line_height'  => array(
				'default' => '1.7em',
			),
		);

		$advanced_fields['fonts']['body'] = array(
			'label'          => esc_html__( 'Body', 'addons-for-divi' ),
			'css'            => array(
				'main'        => '%%order_class%% .dtq-alert-desc',
				'line_height' => '%%order_class%% .dtq-alert-desc',
				'text_align'  => '%%order_class%% .dtq-alert-desc',
				'text_shadow' => '%%order_class%% .dtq-alert-desc',
				'important'   => 'all',
			),
			'block_elements' => array(
				'tabbed_subtoggles' => true,
				'css'               => array(
					'main'      => '%%order_class%% .dtq-alert-desc',
					'important' => 'all',
				),
			),
		);

		$advanced_fields['borders']['icon'] = array(
			'toggle_slug'     => 'icon',
			'css'             => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-alert-icon',
					'border_styles' => '%%order_class%% .dtq-alert-icon',
				),
				'important' => 'all',
			),
			'depends_on'      => array( 'use_icon_box' ),
			'depends_show_if' => 'on',
			'defaults'        => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '',
					'style' => 'solid',
				),
			),
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
					'color' => '',
					'style' => 'solid',
				),
			),
		);

		return $advanced_fields;
	}

	public function render_icon() {
		if ( 'on' === $this->props['use_icon'] ) {
			$icon = esc_attr( et_pb_process_font_icon( $this->props['icon'] ) );

			// Inject Font Awesome Manually!.
			dtq_inject_fa_icons( $this->props['icon'] );

			if ( $icon ) {
				return sprintf(
					'<div class="dtq-alert-icon">
						<i class="dtq-et-icon dtq-alert-icon-inner">%1$s</i>
					</div>',
					$icon
				);
			}
		}
	}

	public function render_title() {
		$title_text            = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h5' );
		$processed_title_level = esc_html( $processed_title_level );
		if ( ! empty( $title_text ) ) {
			return sprintf( '<%2$s class="dtq-alert-title">%1$s</%2$s>', $title_text, $processed_title_level );
		}
	}

	public function render_description() {
		$description = $this->props['description'];
		$content     = force_balance_tags( $description );
		$content     = preg_replace( '~\s?<p></p>\s?~', '', $content );
		if ( ! empty( $content ) ) {
			return sprintf( '<div class="dtq-alert-desc">%1$s</div>', $content );
		}
	}

	public function render_figure() {
		$use_icon  = $this->props['use_icon'];
		$image     = $this->props['image'];
		$image_alt = $this->props['image_alt'];

		if ( 'on' === $use_icon ) {
			return $this->render_icon();
		}

		if ( $image ) {
			return sprintf(
				'<div class="dtq-alert-icon">
					<img class="dtq-alert-icon-inner" src="%1$s" alt="%2$s">
				</div>',
				$image,
				$image_alt
			);
		}
	}

	public function render_dismiss() {
		if ( 'on' === $this->props['show_dismiss'] ) {
			return '<div class="dtq-alert-dismiss"><i data-icon="M" class="dtq-et-icon"></i></div>';
		}
	}

	public function render( $attrs, $content, $render_slug ) {

		$this->apply_css( $render_slug );
		$alert_type = $this->props['alert_type'];
		return sprintf(
			'<div class="dtq-module dtq-alert dtq-alert-%1$s">
				%2$s
				<div class="dtq-alert-content">
					%3$s %4$s
				</div>
				%5$s
            </div>',
			$alert_type,
			$this->render_figure(),
			$this->render_title(),
			$this->render_description(),
			$this->render_dismiss()
		);
	}

	protected function apply_css( $render_slug ) {
		$alerts_data = array(
			'danger'  => array(
				'color'      => '#721c24',
				'background' => '#f8d7da',
				'link'       => '#491217',
			),
			'warning' => array(
				'color'      => '#856404',
				'background' => '#fff3cd',
				'link'       => '#533f03',
			),
			'info'    => array(
				'color'      => '#0c5460',
				'background' => '#d1ecf1',
				'link'       => '#062c33',
			),
			'ltdark'  => array(
				'color'      => '#1b1e21',
				'background' => '#d6d8d9',
				'link'       => '#040505',
			),
			'dark'    => array(
				'color'      => '#ffffff',
				'background' => '#626686',
				'link'       => '#ffffff',
			),
			'light'   => array(
				'color'      => '#818182',
				'background' => '#fefefe',
				'link'       => '#686868',
			),
		);

		$background_color    = $this->props['background_color'];
		$custom_padding      = $this->props['custom_padding'];
		$align_items         = $this->props['align_items'];
		$use_icon            = $this->props['use_icon'];
		$icon_color          = $this->props['icon_color'];
		$icon_color_hover    = $this->get_hover_value( 'icon_color' );
		$use_icon_box        = $this->props['use_icon_box'];
		$icon_bg_color       = $this->props['icon_bg_color'];
		$dismiss_color       = $this->props['dismiss_color'];
		$dismiss_color_hover = $this->get_hover_value( 'dismiss_color' );
		$title_spacing       = $this->props['title_spacing'];
		$alert_type          = $this->props['alert_type'];

		if ( ! $background_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => sprintf( 'background-color: %1$s;', $alerts_data[ $alert_type ]['background'] ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%%, %%order_class%% .dtq-alert-title',
				'declaration' => sprintf( 'color: %1$s;', $alerts_data[ $alert_type ]['color'] ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% a, %%order_class%% .dtq-alert-dismiss i, %%order_class%% strong, %%order_class%% b',
				'declaration' => sprintf( 'color: %1$s;', $alerts_data[ $alert_type ]['link'] ),
			)
		);

		if ( ! $custom_padding ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => 'padding: 20px;',
				)
			);
		}

		// Align Items.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-alert',
				'declaration' => sprintf( 'align-items: %1$s;', $align_items ),
			)
		);

		// Icon Size.
		if ( 'on' === $use_icon ) {
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtq-alert-icon',
				array( 'primary' => 'font-size' ),
				array( 'default' => '40px' ),
				$render_slug
			);
		} else {
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtq-alert-icon img',
				array( 'primary' => 'width' ),
				array( 'default' => '40px' ),
				$render_slug
			);
		}

		if ( 'on' === $use_icon ) {
			$this->generate_styles(
				array(
					'utility_arg'    => 'icon_font_family',
					'render_slug'    => $render_slug,
					'base_attr_name' => 'icon',
					'important'      => true,
					'selector'       => '%%order_class%% .dtq-alert-icon',
					'processor'      => array(
						'ET_Builder_Module_Helper_Style_Processor',
						'process_extended_icon',
					),
				)
			);

			if ( $icon_color ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-alert-icon',
						'declaration' => sprintf( 'color: %1$s;', $icon_color ),
					)
				);
			}

			if ( $icon_color_hover ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%%:hover .dtq-alert-icon i',
						'declaration' => sprintf( 'color: %1$s;', $icon_color_hover ),
					)
				);
			}
		}

		$this->get_responsive_styles(
			'icon_spacing',
			'%%order_class%% .dtq-alert-icon',
			array( 'primary' => 'margin-right' ),
			array( 'default' => '20px' ),
			$render_slug
		);

		// Icon Box.
		if ( 'on' === $use_icon_box ) {

			if ( ! $icon_bg_color ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-alert-icon',
						'declaration' => 'background-color: rgba(0,0,0,.1);',
					)
				);
			} else {
				$this->get_custom_bg_style( $render_slug, 'icon', '%%order_class%% .dtq-alert-icon', '%%order_class%%:hover .dtq-alert-icon' );
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-alert-icon',
					'declaration' => 'display: flex; align-items: center; justify-content: center;',
				)
			);

			$this->get_responsive_styles(
				'icon_width',
				'%%order_class%% .dtq-alert-icon',
				array( 'primary' => 'width' ),
				array( 'default' => '80px' ),
				$render_slug
			);

			$this->get_responsive_styles(
				'icon_height',
				'%%order_class%% .dtq-alert-icon',
				array( 'primary' => 'height' ),
				array( 'default' => '80px' ),
				$render_slug
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-alert-icon',
					'declaration' => 'overflow: visible!important; border-radius: 0 0 0 0!important;',
				)
			);
		}

		// Dismiss.
		$this->get_responsive_styles(
			'dismiss_size',
			'%%order_class%% .dtq-alert-dismiss i',
			array( 'primary' => 'font-size' ),
			array( 'default' => '22px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'dismiss_spacing',
			'%%order_class%% .dtq-alert-dismiss',
			array( 'primary' => 'margin-left' ),
			array( 'default' => '20px' ),
			$render_slug
		);

		if ( $dismiss_color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-alert-dismiss i',
					'declaration' => sprintf( 'color: %1$s;', $dismiss_color ),
				)
			);
		}

		if ( $dismiss_color_hover ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-alert-dismiss:hover i',
					'declaration' => sprintf( 'color: %1$s;', $dismiss_color_hover ),
				)
			);
		}

		if ( $title_spacing ) {
			$this->get_responsive_styles(
				'title_spacing',
				'%%order_class%% .dtq-alert .dtq-alert-title',
				array( 'primary' => 'padding-bottom' ),
				array( 'default' => '0px' ),
				$render_slug
			);
		}
	}
}

new DTQ_Alert();
