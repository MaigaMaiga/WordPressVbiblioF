<?php
class DTQ_Icon_Box extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/icon-box-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_icon_box';
		$this->name       = esc_html__( 'Torque Icon Box', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'icon-box.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'icon_box'   => esc_html__( 'Alignment', 'addons-for-divi' ),
					'icon'       => esc_html__( 'Icon', 'addons-for-divi' ),
					'badge'      => esc_html__( 'Badge', 'addons-for-divi' ),
					'title'      => esc_html__( 'Title', 'addons-for-divi' ),
					'desc'       => esc_html__( 'Description', 'addons-for-divi' ),
					'border'     => esc_html__( 'Border', 'addons-for-divi' ),
					'box_shadow' => esc_html__( 'Box Shadow', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'icon_wrap' => array(
				'label'    => esc_html__( 'Icon Wrapper', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-iconbox__icon',
			),
			'icon'      => array(
				'label'    => esc_html__( 'Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-iconbox__icon i',
			),
			'icon_img'  => array(
				'label'    => esc_html__( 'Icon Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-iconbox__icon img',
			),
			'badge'     => array(
				'label'    => esc_html__( 'Badge', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-iconbox__badge',
			),
			'title'     => array(
				'label'    => esc_html__( 'Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-iconbox__title',
			),
			'desc'      => array(
				'label'    => esc_html__( 'Description', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-iconbox__desc',
			),
		);
	}

	public function get_fields() {

		$fields_top = array();
		$fields     = array();

		$fields['icon'] = array(
			'label'       => esc_html__( 'Icon', 'addons-for-divi' ),
			'description' => esc_html__( 'Select icon for the icon box.', 'addons-for-divi' ),
			'type'        => 'select_icon',
			'toggle_slug' => 'content',
			'default'     => '&#x2b;||divi||400',
			'show_if'     => array(
				'use_image' => 'off',
			),
		);

		$fields['use_image'] = array(
			'label'           => esc_html__( 'Use Image', 'addons-for-divi' ),
			'description'     => esc_html__( 'Here you can choose whether image should be used.', 'addons-for-divi' ),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => array(
				'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
				'off' => esc_html__( 'No', 'addons-for-divi' ),
			),
			'default'         => 'off',
			'toggle_slug'     => 'content',
		);

		$fields['icon_image'] = array(
			'label'              => esc_html__( 'Upload Icon Image', 'addons-for-divi' ),
			'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display for the icon box.', 'addons-for-divi' ),
			'type'               => 'upload',
			'option_category'    => 'basic_option',
			'upload_button_text' => esc_attr__( 'Upload an Icon', 'addons-for-divi' ),
			'choose_text'        => esc_attr__( 'Choose an Icon', 'addons-for-divi' ),
			'update_text'        => esc_attr__( 'Set As Icon', 'addons-for-divi' ),
			'toggle_slug'        => 'content',
			'show_if'            => array(
				'use_image' => 'on',
			),
		);

		$fields['image_alt'] = array(
			'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
			'description' => esc_html__( 'Define the HTML ALT text for your image here.', 'addons-for-divi' ),
			'type'        => 'text',
			'toggle_slug' => 'content',
			'show_if'     => array(
				'use_image' => 'on',
			),
		);

		$fields['badge_text'] = array(
			'label'           => esc_html__( 'Badge Text', 'addons-for-divi' ),
			'description'     => esc_html__( 'Define the badge text for your icon box.', 'addons-for-divi' ),
			'type'            => 'text',
			'toggle_slug'     => 'content',
			'dynamic_content' => 'text',
		);

		$fields['title'] = array(
			'label'           => esc_html__( 'Title', 'addons-for-divi' ),
			'description'     => esc_html__( 'Define the title text for your icon box.', 'addons-for-divi' ),
			'type'            => 'text',
			'toggle_slug'     => 'content',
			'dynamic_content' => 'text',
		);

		$fields['description'] = array(
			'label'           => esc_html__( 'Description', 'addons-for-divi' ),
			'description'     => esc_html__( 'Define the description text for your icon box.', 'addons-for-divi' ),
			'type'            => 'textarea',
			'toggle_slug'     => 'content',
			'dynamic_content' => 'text',
		);

		$fields_top['icon__placement'] = array(
			'label'       => esc_html__( 'Icon Position', 'addons-for-divi' ),
			'description' => esc_html__( 'Select icon position. By selecting absolute position icon can be placed any where on the icon box.', 'addons-for-divi' ),
			'type'        => 'select',
			'toggle_slug' => 'icon',
			'tab_slug'    => 'advanced',
			'default'     => 'normal',
			'options'     => array(
				'normal'   => esc_html__( 'Normal', 'addons-for-divi' ),
				'absolute' => esc_html__( 'Absolute', 'addons-for-divi' ),
			),
		);

		$fields['icon_color'] = array(
			'label'       => esc_html__( 'Icon Color', 'addons-for-divi' ),
			'description' => esc_html__( 'Here you can define a custom color for the icon.', 'addons-for-divi' ),
			'type'        => 'color-alpha',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'icon',
			'default'     => '#333',
			'hover'       => 'tabs',
			'show_if'     => array(
				'use_image' => 'off',
			),
		);

		$fields['icon_size'] = array(
			'label'          => esc_html__( 'Icon Size', 'addons-for-divi' ),
			'description'    => esc_html__( 'Here you can define a custom size for the icon.', 'addons-for-divi' ),
			'type'           => 'range',
			'mobile_options' => true,
			'default'        => '60px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 200,
			),
			'toggle_slug'    => 'icon',
			'sub_toggle'     => 'icon',
			'tab_slug'       => 'advanced',
		);

		$fields['icon_width'] = array(
			'label'          => esc_html__( 'Icon Width', 'addons-for-divi' ),
			'description'    => esc_html__( 'Define static width for the icon box.', 'addons-for-divi' ),
			'type'           => 'range',
			'mobile_options' => true,
			'default'        => 'auto',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 500,
			),
			'toggle_slug'    => 'icon',
			'sub_toggle'     => 'icon',
			'tab_slug'       => 'advanced',
		);

		$fields['icon_height'] = array(
			'label'          => esc_html__( 'Icon Height', 'addons-for-divi' ),
			'description'    => esc_html__( 'Define static height for the icon box.', 'addons-for-divi' ),
			'type'           => 'range',
			'mobile_options' => true,
			'default'        => 'auto',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 500,
			),
			'toggle_slug'    => 'icon',
			'sub_toggle'     => 'icon',
			'tab_slug'       => 'advanced',
		);

		$fields['icon_padding'] = array(
			'label'          => esc_html__( 'Icon Padding', 'addons-for-divi' ),
			'description'    => esc_html__( 'Here you can define a custom padding for the icon.', 'addons-for-divi' ),
			'type'           => 'custom_padding',
			'default'        => '0px|0px|0px|0px',
			'mobile_options' => true,
			'toggle_slug'    => 'icon',
			'tab_slug'       => 'advanced',
			'show_if'        => array(
				'use_image' => 'on',
			),
		);

		$fields['icon_spacing'] = array(
			'label'          => esc_html__( 'Icon Bottom Spacing', 'addons-for-divi' ),
			'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the icon.', 'addons-for-divi' ),
			'type'           => 'range',
			'default'        => '10px',
			'mobile_options' => true,
			'range_settings' => array(
				'min'  => 0,
				'max'  => 200,
				'step' => 1,
			),
			'toggle_slug'    => 'icon',
			'tab_slug'       => 'advanced',
			'show_if'        => array(
				'icon__placement' => 'normal',
			),
		);

		$fields['icon_bg_rotate'] = array(
			'label'          => esc_html__( 'Icon Box Rotate', 'addons-for-divi' ),
			'description'    => esc_html__( 'Rotate icon box, icon will be in same position. Only container box will be rotated.', 'addons-for-divi' ),
			'type'           => 'range',
			'default'        => '0deg',
			'fixed_unit'     => 'deg',
			'range_settings' => array(
				'min'  => -360,
				'max'  => 360,
				'step' => 1,
			),
			'toggle_slug'    => 'icon',
			'tab_slug'       => 'advanced',
		);

		$fields['content_alignment'] = array(
			'label'            => esc_html__( 'Alignment', 'addons-for-divi' ),
			'description'      => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
			'type'             => 'text_align',
			'option_category'  => 'layout',
			'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
			'options_icon'     => 'module_align',
			'default_on_front' => 'center',
			'toggle_slug'      => 'icon_box',
			'tab_slug'         => 'advanced',
		);

		$fields['title_spacing'] = array(
			'label'          => esc_html__( 'Title Spacing Bottom', 'addons-for-divi' ),
			'description'    => esc_html__( 'Here you can define a custom spacing at the top of the title.', 'addons-for-divi' ),
			'type'           => 'range',
			'mobile_options' => true,
			'default'        => '10px',
			'range_settings' => array(
				'min'  => 0,
				'max'  => 200,
				'step' => 1,
			),
			'toggle_slug'    => 'title',
			'tab_slug'       => 'advanced',
		);

		$icon_defaults = array(
			'position' => 'left_top',
			'offset_x' => '50%',
			'offset_y' => '50%',
		);

		$badge_defaults = array(
			'position' => 'right_top',
			'offset_x' => '15px',
			'offset_y' => '15px',
			'padding'  => '5px|15px|5px|15px',
			'bg'       => '#efefef',
			'color'    => '#ffffff',
		);

		$icon_additional_opts = $this->get_absolute_element_options( 'icon', 'Icon', 'icon', $icon_defaults, array( 'icon__placement' => 'absolute' ) );

		$badge_additional_opts = $this->get_badge_options(
			'badge',
			esc_html__( 'Badge', 'addons-for-divi' ),
			'badge',
			$badge_defaults
		);

		$icon_bg = $this->custom_background_fields(
			'icon',
			esc_html__( 'Icon', 'addons-for-divi' ),
			'advanced',
			'icon',
			array( 'color', 'gradient', 'hover' ),
			array(),
			''
		);

		return array_merge( $fields_top, $icon_additional_opts, $badge_additional_opts, $fields, $icon_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['icon'] = array(
			'label_prefix' => esc_html__( 'Icon', 'addons-for-divi' ),
			'toggle_slug'  => 'icon',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-iconbox__icon',
					'border_styles' => '%%order_class%% .dtq-iconbox__icon',
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

		$advanced_fields['borders']['badge'] = array(
			'label_prefix' => esc_html__( 'Badge', 'addons-for-divi' ),
			'toggle_slug'  => 'badge',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-iconbox__badge',
					'border_styles' => '%%order_class%% .dtq-iconbox__badge',
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

		$advanced_fields['height'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-iconbox-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['width'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-iconbox-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-iconbox-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-iconbox-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['box'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-iconbox-inner',
					'border_styles' => '%%order_class%% .dtq-iconbox-inner',
				),
				'important' => 'all',
			),
		);

		$advanced_fields['box_shadow']['item'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .dtq-iconbox-inner',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'box_shadow',
		);

		$advanced_fields['box_shadow']['icon'] = array(
			'label'       => esc_html__( 'Icon Box Shadow', 'addons-for-divi' ),
			'css'         => array(
				'main'      => '%%order_class%% .dtq-iconbox__icon',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'icon',
		);

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-iconbox__title',
				'important' => 'all',
			),
			'header_level'    => array(
				'default' => 'h3',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'title',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '22px',
			),
		);

		$advanced_fields['fonts']['description'] = array(
			'label'           => esc_html__( 'Description', 'addons-for-divi' ),
			'css'             => array(
				'main' => '%%order_class%% .dtq-iconbox__desc',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'desc',
			'show_if'         => array(
				'is_description_hide' => 'off',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['badge'] = array(
			'label'           => esc_html__( 'Badge', 'addons-for-divi' ),
			'css'             => array(
				'main' => '%%order_class%% .dtq-iconbox__badge',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'badge',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

				// Default values.
		if ( ! dt_if_not_migrated() ) {
			// $advanced_fields['fonts']['title']['font_size']['default'] = '20px';
			$advanced_fields['borders']['box']['defaults'] = array(
				'border_styles' => array(
					'width' => '1px',
					'color' => '#EBEBEB',
				),
			);
		} else {
			// $advanced_fields['fonts']['title']['font_size']['default'] = '26px';
			$advanced_fields['borders']['box']['defaults'] = array(
				'border_styles' => array(
					'width' => '0px',
				),
			);
		}

		return $advanced_fields;
	}

	public function render_icon() {

		$use_image  = $this->props['use_image'];
		$icon       = $this->props['icon'];
		$icon_image = $this->props['icon_image'];
		$image_alt  = $this->props['image_alt'];
		$html       = '';

		if ( 'off' === $use_image ) {
			// Inject Font Awesome Manually!.
			dtq_inject_fa_icons( $this->props['icon'] );

			$icon = esc_attr( et_pb_process_font_icon( $icon ) );
			$html = '<i class="dtq-icon dtq-et-icon">' . $icon . '</i>';
		} else {
			$html = '<img class="dtq-icon-image" src="' . $icon_image . '" alt="' . $image_alt . '" />';
		}

		if ( ! empty( $icon ) || ! empty( $icon_image ) ) {
			return sprintf(
				'<div class="dtq-iconbox__icon-wrap">
                    <div class="dtq-iconbox__icon">
                        %1$s
                    </div>
                </div>',
				$html
			);

		}
	}

	public function render_title() {

		$title                 = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h2' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title ) ) {
			return sprintf(
				'<%1$s class="dtq-iconbox__title">%2$s</%1$s>',
				$processed_title_level,
				$title
			);
		}
	}

	public function render_description() {
		$description = $this->props['description'];
		if ( ! empty( $description ) ) {
			return sprintf( '<p class="dtq-iconbox__desc">%1$s</p>', $description );
		}
	}

	public function render_badge() {
		$badge_text = $this->props['badge_text'];
		if ( ! empty( $badge_text ) ) {
			return sprintf(
				'<div class="dtq-iconbox__badge">
                    %1$s
                </div>',
				$badge_text
			);
		}
	}

	public function render( $attrs, $content, $render_slug ) {

		$icon__placement = $this->props['icon__placement'];
		$this->render_css( $render_slug );

		return sprintf(
			'<div class="dtq-module dtq-module-parent dtq-iconbox">
                %1$s %5$s
                <div class="dtq-iconbox-inner dtq-bg-support">
                     %2$s %3$s %4$s
                </div>
            </div>',
			$this->render_badge(),
			'absolute' !== $icon__placement ? $this->render_icon() : '',
			$this->render_title(),
			$this->render_description(),
			'absolute' === $icon__placement ? $this->render_icon() : ''
		);
	}

	protected function render_css( $render_slug ) {

		$icon__placement  = $this->props['icon__placement'];
		$use_image        = $this->props['use_image'];
		$icon_color       = $this->props['icon_color'];
		$icon_color_hover = $this->get_hover_value( 'icon_color' );
		$icon_bg_rotate   = $this->props['icon_bg_rotate'];
		$is_negative      = substr( $icon_bg_rotate, 0, 1 ) === '-';
		$alignment        = $this->props['content_alignment'];

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtq-iconbox__icon',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		// Default Design.
		if ( ! dt_if_not_migrated() ) {
			if ( empty( $this->props['border_color_all_box'] ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-iconbox-inner',
						'declaration' => 'border-color: #EBEBEB;',
					)
				);
			}
			if ( empty( $this->props['border_width_all_box'] ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-iconbox-inner',
						'declaration' => 'border-width: 1px;',
					)
				);
			}
			if ( empty( $this->props['custom_padding'] ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-iconbox-inner',
						'declaration' => 'padding: 60px 30px 60px 30px;',
					)
				);
			}
		}

		if ( ! empty( $this->props['custom_margin'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%.et_pb_module',
					'declaration' => 'margin-bottom: 0!important;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-iconbox',
				'declaration' => sprintf( 'text-align: %1$s;', $alignment ),
			)
		);

		if ( 'right' === $alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-iconbox__icon-wrap',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} elseif ( 'center' === $alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-iconbox__icon-wrap',
					'declaration' => 'justify-content: center;',
				)
			);
		}

		if ( 'normal' === $icon__placement ) {
			$this->get_responsive_styles(
				'icon_spacing',
				'%%order_class%% .dtq-iconbox__icon-wrap',
				array( 'primary' => 'margin-bottom' ),
				array( 'default' => '10px' ),
				$render_slug
			);
		}

		if ( 'auto' !== $this->props['icon_width'] ) {
			$this->get_responsive_styles(
				'icon_width',
				'%%order_class%% .dtq-iconbox__icon',
				array( 'primary' => 'width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		if ( 'auto' !== $this->props['icon_height'] ) {
			$this->get_responsive_styles(
				'icon_height',
				'%%order_class%% .dtq-iconbox__icon',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-iconbox__icon',
				'declaration' => sprintf(
					'
                transform: rotate(%1$s);',
					$icon_bg_rotate
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-iconbox__icon i, %%order_class%% .dtq-iconbox__icon img',
				'declaration' => sprintf(
					'transform: rotate(%1$s%2$sdeg);',
					! $is_negative ? '-' : '',
					absint( $icon_bg_rotate )
				),
			)
		);

		if ( 'off' === $use_image ) {
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtq-iconbox__icon i',
				array( 'primary' => 'font-size' ),
				array( 'default' => '60px' ),
				$render_slug
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-iconbox__icon i',
					'declaration' => sprintf( 'color: %1$s;', $icon_color ),
				)
			);

			if ( ! empty( $icon_color_hover ) ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%%:hover .dtq-iconbox__icon i',
						'declaration' => sprintf( ' color: %1$s;', $icon_color_hover ),
					)
				);
			}
		} else {
			$this->get_responsive_styles(
				'icon_padding',
				'%%order_class%% .dtq-iconbox__icon',
				array( 'primary' => 'padding' ),
				array( 'default' => '0px|0px|0px|0px' ),
				$render_slug
			);

			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtq-iconbox__icon img',
				array( 'primary' => 'width' ),
				array( 'default' => '60px' ),
				$render_slug
			);
		}

		if ( 'absolute' === $icon__placement ) {
			$this->get_absolute_element_styles( $render_slug, 'icon', '%%order_class%% .dtq-iconbox__icon' );
		}

		$this->get_responsive_styles(
			'title_spacing',
			'%%order_class%% .dtq-iconbox__title',
			array( 'primary' => 'padding-bottom' ),
			array( 'default' => '10px' ),
			$render_slug
		);

		$this->get_badge_styles( $render_slug, 'badge', '%%order_class%% .dtq-iconbox__badge', '%%order_class%%:hover .dtq-iconbox__badge' );

		$this->get_custom_bg_style( $render_slug, 'icon', '%%order_class%% .dtq-iconbox__icon', '%%order_class%%:hover .dtq-iconbox__icon' );

	}
}

new DTQ_Icon_Box();
