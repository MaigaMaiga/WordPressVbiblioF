<?php
class DTQ_Card extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/card-module',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->name       = esc_html__( 'Torque Card', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'card.svg';
		$this->slug       = 'ba_card';
		$this->vb_support = 'on';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'addons-for-divi' ),
					'button'       => esc_html__( 'Button', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'card'       => esc_html__( 'Card', 'addons-for-divi' ),
					'image_icon' => esc_html__( 'Image/Icon', 'addons-for-divi' ),
					'image_mask' => esc_html__( 'Image Mask', 'addons-for-divi' ),
					'overlay'    => esc_html__( 'Overlay', 'addons-for-divi' ),
					'badge'      => esc_html__( 'Badge', 'addons-for-divi' ),
					'texts'      => array(
						'title'             => esc_html__( 'Title & Description', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'       => array(
								'name' => esc_html__( 'Title', 'addons-for-divi' ),
							),
							'description' => array(
								'name' => esc_html__( 'Description', 'addons-for-divi' ),
							),
						),
					),
					'button'     => esc_html__( 'Button', 'addons-for-divi' ),
					'border'     => esc_html__( 'Border', 'addons-for-divi' ),
				),
			),

		);

		$this->custom_css_fields = array(
			'icon'   => array(
				'label'    => esc_html__( 'Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-card-icon i',
			),
			'image'  => array(
				'label'    => esc_html__( 'Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-card-figure img',
			),
			'badge'  => array(
				'label'    => esc_html__( 'Badge', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-card .dtq-card-badge',
			),
			'title'  => array(
				'label'    => esc_html__( 'Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-card .dtq-card-title',
			),
			'desc'   => array(
				'label'    => esc_html__( 'Description', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-card .dtq-card-desc',
			),
			'button' => array(
				'label'    => esc_html__( 'Button', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-card .dtq-btn-card',
			),
		);
	}

	public function get_fields() {

		$main_content = array(
			'use_icon'     => array(
				'label'           => esc_html__( 'Use Icon', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether icon set below should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
			),

			'icon'         => array(
				'label'           => esc_html__( 'Select Icon', 'addons-for-divi' ),
				'description'     => esc_html__( 'Choose an icon to display with your card.', 'addons-for-divi' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
				'tab_slug'        => 'general',
				'default'         => '&#x2b;||divi||400',
				'show_if'         => array(
					'use_icon' => 'on',
				),
			),
			'photo'        => array(
				'label'              => esc_html__( 'Upload Card Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display for the card.', 'addons-for-divi' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'main_content',
				'mobile_options'     => true,
				'hover'              => 'tabs',
				'show_if'            => array(
					'use_icon' => 'off',
				),
			),
			'use_lightbox' => array(
				'type'        => 'multiple_checkboxes',
				'default'     => 'off',
				'toggle_slug' => 'main_content',
				'options'     => array(
					'tooltip' => esc_html__( 'Open Photo in Lightbox', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'use_icon' => 'off',
				),
			),
			'photo_alt'    => array(
				'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define the HTML ALT text for your image.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'main_content',
				'show_if'     => array(
					'use_icon' => 'off',
				),
			),
			'use_badge'    => array(
				'label'           => esc_html__( 'Use Badge', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether badge should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
			),
			'badge_text'   => array(
				'label'           => esc_html__( 'Badge Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the badge text for your card.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => esc_html__( 'Badge', 'addons-for-divi' ),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'use_badge' => 'on',
				),
			),
			'title'        => array(
				'label'           => esc_html__( 'Title Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the title text for your card.', 'addons-for-divi' ),
				'type'            => 'text',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'main_content',
			),
			'description'  => array(
				'label'           => esc_html__( 'Description', 'addons-for-divi' ),
				'description'     => esc_html__( 'Input the description text for your card module.', 'addons-for-divi' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'main_content',
			),
		);

		$button_content = array(
			'use_button'    => array(
				'label'           => esc_html__( 'Use Button', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether button should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'button',
			),
			'button_text'   => array(
				'label'           => esc_html__( 'Button Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the button text for your button.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => 'Click Here',
				'toggle_slug'     => 'button',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
			'button_link'   => array(
				'label'           => esc_html__( 'Button Link', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the button link url for your button.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => '',
				'toggle_slug'     => 'button',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
			'is_new_window' => array(
				'label'           => esc_html__( 'Open Button link in new window', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether button URL should be opened in new window.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'button',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
		);

		$img_icon_style = array(
			'image_position'        => array(
				'label'          => esc_html__( 'Image/Icon Position', 'addons-for-divi' ),
				'description'    => esc_html__( 'Select Image or icon placement.', 'addons-for-divi' ),
				'type'           => 'select',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'image_icon',
				'default'        => 'top',
				'options'        => array(
					'top'   => esc_html__( 'Top', 'addons-for-divi' ),
					'left'  => esc_html__( 'Left', 'addons-for-divi' ),
					'right' => esc_html__( 'Right', 'addons-for-divi' ),
				),
			),

			'icon_color'            => array(
				'label'       => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for your icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'image_icon',
				'default'     => '#333',
				'show_if'     => array(
					'use_icon' => 'on',
				),
			),

			'icon_size'             => array(
				'label'           => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'     => esc_html__( 'Control the size of the icon by increasing or decreasing the range.', 'addons-for-divi' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default'         => '45px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'     => 'image_icon',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
				'show_if'         => array(
					'use_icon' => 'on',
				),
			),

			'image_hover_animation' => array(
				'label'       => esc_html__( 'Image Hover Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Select image mouse hover animation.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'image_icon',
				'default'     => 'none',
				'options'     => $this->get_image_hover_animations(),
				'show_if'     => array(
					'use_icon' => 'off',
				),
			),

			'image_overflow'        => array(
				'label'       => esc_html__( 'Image Overflow', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can control image overflow on the X and Y axis. If set to hidden, image will be clipped.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'image_icon',
				'default'     => 'hidden',
				'options'     => array(
					'hidden'  => esc_html__( 'Hidden', 'addons-for-divi' ),
					'visible' => esc_html__( 'Visible', 'addons-for-divi' ),
				),
			),
			'custom_height'         => array(
				'label'           => esc_html__( 'Custom Image Height', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether custom image height should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'image_icon',
				'tab_slug'        => 'advanced',
			),
			'image_height'          => array(
				'label'          => esc_html__( 'Image Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'This sets a static height value for your card image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '300px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'image_icon',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'show_if'        => array(
					'custom_height' => 'on',
					'use_icon'      => 'off',
				),
			),

			'image_width'           => array(
				'label'          => esc_html__( 'Image Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'This sets a static width value for your card image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => 'auto',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'image_icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'use_icon' => 'off',
				),
			),

			'image_padding'         => array(
				'label'          => esc_html__( 'Image Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'image_icon',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'use_icon' => 'off',
				),
			),

			'icon_padding'          => array(
				'label'          => esc_html__( 'Icon Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'image_icon',
				'default'        => '25px|25px|25px|25px',
				'mobile_options' => true,
				'show_if'        => array(
					'use_icon' => 'on',
				),
			),
		);

		$fields = array(
			'btn_spacing_top'      => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the button.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '15px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'button',
				'tab_slug'       => 'advanced',
			),
			'title_bottom_spacing' => array(
				'label'          => esc_html__( 'Title Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the title.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '10px',
				'mobile_options' => true,
				'allowed_units'  => array( 'px' ),
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'texts',
				'tab_slug'       => 'advanced',
				'sub_toggle'     => 'title',
			),

			// Card.
			'content_overflow'     => array(
				'label'       => esc_html__( 'Content Overflow', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can control card content overflow on the X and Y axis. If set to hidden, content will be clipped.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'card',
				'default'     => 'visible',
				'options'     => array(
					'hidden'  => esc_html__( 'Hidden', 'addons-for-divi' ),
					'visible' => esc_html__( 'Visible', 'addons-for-divi' ),
				),
			),
			'content_alignment'    => array(
				'label'            => esc_html__( 'Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'module_align',
				'default'          => 'left',
				'mobile_options'   => true,
				'default_on_front' => 'left',
				'toggle_slug'      => 'card',
				'tab_slug'         => 'advanced',
			),
			'content_padding'      => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'card',
				'tab_slug'       => 'advanced',
				'default'        => '25px|25px|25px|25px',
				'mobile_options' => true,
			),
		);

		$badge_defaults = array(
			'position' => 'right_top',
			'offset_x' => '15px',
			'offset_y' => '15px',
			'padding'  => '5px|15px|5px|15px',
			'bg'       => '#ffffff',
			'color'    => '#333',
		);
		$badge_options  = $this->get_badge_options(
			'badge',
			esc_html__( 'Badge', 'addons-for-divi' ),
			'badge',
			$badge_defaults
		);
		$overlay        = $this->get_overlay_option_fields( 'overlay', 'on', array( 'use_icon' => 'off' ) );
		$icon_bg        = $this->custom_background_fields(
			'icon',
			esc_html__( 'Icon', 'addons-for-divi' ),
			'advanced',
			'image_icon',
			array( 'color', 'gradient', 'hover' ),
			array( 'use_icon' => 'on' ),
			''
		);

		return array_merge( $main_content, $button_content, $img_icon_style, $fields, $overlay, $badge_options, $icon_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['fonts']['badge'] = array(
			'label'           => esc_html__( 'Badge', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-card-badge',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'badge',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'font_size'       => array(
				'default' => '13px',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-card-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'title',
			'header_level'    => array(
				'default' => 'h3',
			),
			'font_size'       => array(
				'default' => '22px',
			),
		);

		$advanced_fields['fonts']['description'] = array(
			'label'           => esc_html__( 'Description', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-card-desc',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'description',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['borders']['card'] = array(
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
					'width' => '1px',
					'color' => '#efefef',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['borders']['photo'] = array(
			'label_prefix' => esc_html__( 'Image/Icon', 'addons-for-divi' ),
			'toggle_slug'  => 'image_icon',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-card-icon, %%order_class%% .dtq-card-figure img',
					'border_styles' => '%%order_class%% .dtq-card-icon, %%order_class%% .dtq-card-figure img',
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
			'toggle_slug'  => 'badge',
			'label_prefix' => esc_html__( 'Badge', 'addons-for-divi' ),
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-card-badge',
					'border_styles' => '%%order_class%% .dtq-card-badge',
				),
				'important' => 'all',
			),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['button']['button'] = array(
			'label'          => esc_html__( 'Button', 'addons-for-divi' ),
			'css'            => array(
				'main'      => '%%order_class%% .dtq-btn-card',
				'alignment' => '%%order_class%% .dtq-btn-card-wrap',
				'important' => 'all',
			),
			'use_alignment'  => false,
			'box_shadow'     => array(
				'css' => array(
					'main' => '%%order_class%% .dtq-btn-card',
				),
			),
			'borders'        => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%%',
				'important' => true,
			),
		);

		return $advanced_fields;
	}

	public function render_badge() {
		if ( 'off' !== $this->props['use_badge'] ) {
			return sprintf(
				'<div class="dtq-card-badge pos--%1$s">%2$s</div>',
				$this->props['badge_position'],
				$this->props['badge_text']
			);
		}
	}

	public function render_figure() {

		$photo                  = $this->props['photo'];
		$processed_overlay_icon = esc_attr( et_pb_process_font_icon( $this->props['overlay_icon'] ) );
		$overlay_icon           = ! empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';
		$data_schema            = $this->get_swapped_img_schema( 'photo' );
		$use_lightbox           = $this->props['use_lightbox'];
		$photo_alt              = $this->props['photo_alt'];
		$use_icon               = $this->props['use_icon'];
		dtq_inject_fa_icons( $this->props['overlay_icon'] );
		if ( 'on' !== $use_icon && ! empty( $photo ) ) {
			return sprintf(
				'<div class="dtq-figure dtq-card-figure">
                    %1$s
                    <div class="dtq-overlay"><i class="dtq-overlay-icon">%4$s</i></div>
                    <img class="dtq-img-cover dtq-card-figure-img dtq-swapped-img %5$s" data-mfp-src="%2$s" src="%2$s" %3$s alt="%6$s"/>
                </div>',
				$this->render_Badge(),
				$photo,
				$data_schema,
				$overlay_icon,
				'on' === $use_lightbox ? 'dtq-lightbox' : '',
				$photo_alt
			);
		}
	}

	public function render_title() {

		$title_text            = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h3' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title_text ) ) {
			return sprintf( '<%2$s class="dtq-card-title">%1$s</%2$s>', $title_text, $processed_title_level );
		}
	}

	public function render_description() {
		$description = $this->props['description'];
		if ( ! empty( $description ) ) {
			return sprintf( '<div class="dtq-card-desc">%1$s</div>', $description );
		}
	}

	public function render_icon() {

		if ( 'off' === $this->props['use_icon'] ) {
			return;
		}
		$icon_name = esc_attr( et_pb_process_font_icon( $this->props['icon'] ) );

		// Inject Font Awesome Manually!.
		dtq_inject_fa_icons( $this->props['icon'] );

		return sprintf(
			'<div class="dtq-card-icon-wrap"> %1$s
                <div class="dtq-card-icon">
                    <i class="dtq-et-icon">%2$s</i>
                </div>
            </div>',
			$this->render_Badge(),
			$icon_name
		);
	}

	public function render_module_button() {

		if ( 'on' === $this->props['use_button'] ) {

			$button_custom = $this->props['custom_button'];
			$button_text   = isset( $this->props['button_text'] ) ? $this->props['button_text'] : 'Click Here';
			$button_link   = isset( $this->props['button_link'] ) ? $this->props['button_link'] : '#';
			$button_url    = trim( $button_link );
			$new_tab       = $this->props['is_new_window'];
			$button_rel    = $this->props['button_rel'];

			$custom_icon_values = et_pb_responsive_options()->get_property_values( $this->props, 'button_icon' );
			$custom_icon        = isset( $custom_icon_values['desktop'] ) ? $custom_icon_values['desktop'] : '';
			$custom_icon_tablet = isset( $custom_icon_values['tablet'] ) ? $custom_icon_values['tablet'] : '';
			$custom_icon_phone  = isset( $custom_icon_values['phone'] ) ? $custom_icon_values['phone'] : '';
			$multi_view         = et_pb_multi_view_options( $this );

			if ( function_exists( 'dtq_inject_fa_icons' ) ) {
				// Inject Font Awesome Manually!.
				dtq_inject_fa_icons( $this->props['button_icon'] );
			}

			$button = $this->render_button(
				array(
					'button_id'           => $this->module_id( false ),
					'button_classname'    => array( 'dtq-btn-default', 'dtq-btn-card' ),
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
							'content'        => '{{button_text}}',
							'hover_selector' => '%%order_class%% .dtq-btn-card',
							'visibility'     => array(
								'button_text' => '__not_empty',
							),
						)
					),
				)
			);

			return sprintf(
				'<div class="dtq-btn-card-wrap">
                    %1$s
                </div>',
				$button
			);
		}
	}

	public function render_content() {

		$title       = $this->props['title'];
		$description = $this->props['description'];
		$use_button  = $this->props['use_button'];

		if ( empty( $title ) && empty( $description ) && 'off' === $use_button ) {
			return false;
		}

		return sprintf(
			'<div class="dtq-card-content">%1$s %2$s %3$s</div>',
			$this->render_title(),
			$this->render_description(),
			$this->render_module_button()
		);
	}

	public function render( $attrs, $content, $render_slug ) {

		$this->render_css( $render_slug );

		$image_hover_animation = $this->props['image_hover_animation'];
		$use_icon              = $this->props['use_icon'];

		$classes = sprintf(
			'dtq-hover--%1$s use-icon-%2$s',
			$image_hover_animation,
			$use_icon
		);

		return sprintf(
			'<div class="dtq-module dtq-card dtq-swapped-img-selector %1$s">
                %2$s %3$s %4$s
            </div>',
			$classes,
			$this->render_figure(),
			$this->render_icon(),
			$this->render_content()
		);
	}

	public function render_css( $render_slug ) {

		$use_icon                         = $this->props['use_icon'];
		$image_width                      = $this->props['image_width'];
		$image_position                   = $this->props['image_position'];
		$image_position_tablet            = $this->props['image_position_tablet'];
		$image_position_phone             = $this->props['image_position_phone'];
		$image_position_last_edited       = $this->props['image_position_last_edited'];
		$image_position_responsive_status = et_pb_get_responsive_status( $image_position_last_edited );
		$image_width_tablet               = $this->props['image_width_tablet'];
		$image_width_phone                = $this->props['image_width_phone'];
		$image_width_last_edited          = $this->props['image_width_last_edited'];
		$image_width_responsive_status    = et_pb_get_responsive_status( $image_width_last_edited );
		$border_width_all_card            = $this->props['border_width_all_card'];
		$border_color_all_card            = $this->props['border_color_all_card'];
		$border_style_all_card            = $this->props['border_style_all_card'];
		$content_overflow                 = $this->props['content_overflow'];
		$image_overflow                   = $this->props['image_overflow'];

		if ( ! empty( $this->props['custom_margin'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%.et_pb_module',
					'declaration' => 'margin-bottom: 0!important;',
				)
			);
		}

		if ( 'top' !== $image_position ) {
			if ( 'auto' === $image_width ) {
				$image_width = '50%';
			}
		} else {
			if ( 'auto' === $image_width ) {
				$image_width = '100%';
			}
		}

		if ( empty( $border_color_all_card ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => 'border-color: #efefef;',
				)
			);
		}

		if ( empty( $border_width_all_card ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => 'border-width:1px;',
				)
			);
		}

		if ( empty( $border_style_all_card ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => 'border-style:solid;',
				)
			);
		}

		// Content Alignment.
		$this->get_responsive_styles(
			'content_alignment',
			'%%order_class%% .dtq-card',
			array( 'primary' => 'text-align' ),
			array( 'default' => 'left' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'content_alignment',
			'%%order_class%% .dtq-card-figure',
			array( 'primary' => 'align-self' ),
			array( 'default' => 'left' ),
			$render_slug
		);

		// Image/Icon position.
		if ( 'top' === $image_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-card',
					'declaration' => 'flex-direction: column;',
				)
			);
		} elseif ( 'right' === $image_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-card',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
		}

		if ( $image_position_tablet && $image_position_responsive_status ) {
			if ( 'top' === $image_position_tablet ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-card',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => 'flex-direction: column;',
					)
				);
			} elseif ( 'right' === $image_position_tablet ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-card',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => 'flex-direction: row-reverse;',
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-card',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => 'flex-direction: row;',
					)
				);
			}
		}

		if ( $image_position_phone && $image_position_responsive_status ) {
			if ( 'top' === $image_position_phone ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-card',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => 'flex-direction: column;',
					)
				);
			} elseif ( 'right' === $image_position_phone ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-card',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => 'flex-direction: row-reverse;',
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-card',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => 'flex-direction: row;',
					)
				);
			}
		}

		// wrapper content overflow.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%%',
				'declaration' => "overflow:{$content_overflow}!important;",
			)
		);

		// Image overflow.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-card-figure',
				'declaration' => "overflow:{$image_overflow}!important;",
			)
		);

		// Button.
		$this->get_responsive_styles(
			'btn_spacing_top',
			'%%order_class%% .dtq-btn-card-wrap',
			array( 'primary' => 'padding-top' ),
			array( 'default' => '15px' ),
			$render_slug
		);

		$this->get_buttons_styles( 'button', $render_slug, '%%order_class%% .dtq-card .dtq-btn-card' );

		// Texts.
		$this->get_responsive_styles(
			'title_bottom_spacing',
			'%%order_class%% .dtq-card-title, .et-db #et-boc %%order_class%% .dtq-card-title',
			array( 'primary' => 'padding-bottom' ),
			array( 'default' => '10px' ),
			$render_slug
		);

		if ( 'on' === $use_icon ) {

			$this->generate_styles(
				array(
					'utility_arg'    => 'icon_font_family',
					'render_slug'    => $render_slug,
					'base_attr_name' => 'icon',
					'important'      => true,
					'selector'       => '%%order_class%% .dtq-card .dtq-card-icon',
					'processor'      => array(
						'ET_Builder_Module_Helper_Style_Processor',
						'process_extended_icon',
					),
				)
			);

			// Icon Padding.
			$this->get_responsive_styles(
				'icon_padding',
				'%%order_class%% .dtq-card .dtq-card-icon',
				array( 'primary' => 'padding' ),
				array( 'default' => '25px|25px|25px|25px' ),
				$render_slug
			);
		} elseif ( 'off' === $use_icon ) {
			// Image Padding.
			$this->get_responsive_styles(
				'image_padding',
				'%%order_class%% .dtq-card-figure img',
				array( 'primary' => 'padding' ),
				array( 'default' => '0px|0px|0px|0px' ),
				$render_slug
			);

			// Figure Height.
			if ( 'on' === $this->props['custom_height'] ) {
				$this->get_responsive_styles(
					'image_height',
					'%%order_class%% .dtq-card-figure',
					array( 'primary' => 'height' ),
					array( 'default' => '200px' ),
					$render_slug
				);
			}

			// Figure  width.
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-card-figure',
					'declaration' => sprintf( 'width:%1$s;max-width: %1$s;', $image_width ),
				)
			);
			if ( $image_width_tablet && $image_width_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-card-figure',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => sprintf( 'width:%1$s;max-width: %1$s;', $image_width_tablet ),
					)
				);
			}
			if ( $image_width_phone && $image_width_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-card-figure',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
						'declaration' => sprintf( 'width:%1$s;max-width: %1$s;', $image_width_phone ),
					)
				);
			}
		}

		// Content padding.
		$this->get_responsive_styles(
			'content_padding',
			'%%order_class%% .dtq-card-content',
			array( 'primary' => 'padding' ),
			array( 'default' => '25px|25px|25px|25px' ),
			$render_slug
		);

		// Icon.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-card-icon i',
				'declaration' => sprintf( 'color: %1$s; font-size: %2$s;', $this->props['icon_color'], $this->props['icon_size'] ),
			)
		);

		if ( 'on' === $use_icon ) {
			$this->get_custom_bg_style( $render_slug, 'icon', '%%order_class%% .dtq-card-icon', '%%order_class%%:hover .dtq-card-icon' );
		}

		$this->get_overlay_style( $render_slug, 'photo', '%%order_class%%' );
		$this->get_badge_styles( $render_slug, 'badge', '%%order_class%% .dtq-card-badge', '%%order_class%%:hover .dtq-card-badge' );

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'overlay_icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtq-overlay .dtq-overlay-icon',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);
	}
}

new DTQ_Card();
