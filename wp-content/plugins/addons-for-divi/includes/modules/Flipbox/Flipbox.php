<?php
class DTQ__Flipbox extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/flip-box-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->name       = esc_html__( 'Torque Flipbox', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'flipbox.svg';
		$this->slug       = 'ba_flipbox';
		$this->vb_support = 'on';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'front'    => esc_html__( 'Front Side', 'addons-for-divi' ),
					'back'     => esc_html__( 'Back Side', 'addons-for-divi' ),
					'settings' => esc_html__( 'Settings', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'front'       => esc_html__( 'Front Side', 'addons-for-divi' ),
					'back'        => esc_html__( 'Back Side', 'addons-for-divi' ),
					'front_media' => esc_html__( 'Front Media', 'addons-for-divi' ),
					'back_media'  => esc_html__( 'Back Media', 'addons-for-divi' ),
					'front_text'  => array(
						'title'             => esc_html__( 'Front Texts', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'       => array(
								'name' => esc_html__( 'Title', 'addons-for-divi' ),
							),
							'subtitle'    => array(
								'name' => esc_html__( 'Subtitle', 'addons-for-divi' ),
							),
							'description' => array(
								'name' => esc_html__( 'Description', 'addons-for-divi' ),
							),
						),
					),
					'back_text'   => array(
						'title'             => esc_html__( 'Back Texts', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'       => array(
								'name' => esc_html__( 'Title', 'addons-for-divi' ),
							),
							'subtitle'    => array(
								'name' => esc_html__( 'Subtitle', 'addons-for-divi' ),
							),
							'description' => array(
								'name' => esc_html__( 'Description', 'addons-for-divi' ),
							),
						),
					),
					'button'      => esc_html__( 'Button', 'addons-for-divi' ),
					'border'      => esc_html__( 'Border', 'addons-for-divi' ),
					'box_shadow'  => esc_html__( 'Box Shadow', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'front_icon'      => array(
				'label'    => esc_html__( 'Front Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-icon-front i',
			),
			'front_img'       => array(
				'label'    => esc_html__( 'Front Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-figure-front img',
			),
			'front_title'     => array(
				'label'    => esc_html__( 'Front Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-title-front',
			),
			'front_sub_title' => array(
				'label'    => esc_html__( 'Front Sub Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-subtitle-front',
			),
			'front_desc'      => array(
				'label'    => esc_html__( 'Front Description', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-desc-front',
			),
			'back_icon'       => array(
				'label'    => esc_html__( 'Back Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-icon-back i',
			),
			'back_img'        => array(
				'label'    => esc_html__( 'Back Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-figure-back img',
			),
			'back_title'      => array(
				'label'    => esc_html__( 'Back Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-title-back',
			),
			'back_sub_title'  => array(
				'label'    => esc_html__( 'Back Sub Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-subtitle-back',
			),
			'back_desc'       => array(
				'label'    => esc_html__( 'Back Description', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-desc-front',
			),
			'back_btn'        => array(
				'label'    => esc_html__( 'Back Button', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-flipbox-btn',
			),
		);
	}

	public function get_fields() {

		$front_content = array(
			'front_media_type'  => array(
				'label'       => esc_html__( 'Media Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select front side media type.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'front',
				'default'     => 'icon',
				'options'     => array(
					'none'  => esc_html__( 'None', 'addons-for-divi' ),
					'icon'  => esc_html__( 'Icon', 'addons-for-divi' ),
					'image' => esc_html__( 'Image', 'addons-for-divi' ),
				),
			),
			'front_icon'        => array(
				'label'       => esc_html__( 'Select Icon', 'addons-for-divi' ),
				'description' => esc_html__( 'Select front side icon.', 'addons-for-divi' ),
				'type'        => 'select_icon',
				'default'     => '&#xe60c;||divi||400',
				'toggle_slug' => 'front',
				'tab_slug'    => 'general',
				'show_if'     => array(
					'front_media_type' => 'icon',
				),
			),
			'front_img'         => array(
				'label'              => esc_html__( 'Upload Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display for the front side.', 'addons-for-divi' ),
				'type'               => 'upload',
				'default'            => DIVI_TORQUE_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'front',
				'show_if'            => array(
					'front_media_type' => 'image',
				),
			),
			'front_img_alt'     => array(
				'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the front side image alt text for your flip box.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'front',
				'show_if'     => array(
					'front_media_type' => 'image',
				),
			),
			'front_title'       => array(
				'label'           => esc_html__( 'Front Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the front side title for your flip box.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'front',
				'dynamic_content' => 'text',
			),
			'front_subtitle'    => array(
				'label'           => esc_html__( 'Front Sub Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the front side sub-title for your flip box.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'front',
				'dynamic_content' => 'text',
			),
			'front_description' => array(
				'label'           => esc_html__( 'Front Description', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the front side description text for your flip box.', 'addons-for-divi' ),
				'type'            => 'textarea',
				'toggle_slug'     => 'front',
				'dynamic_content' => 'text',
			),
		);

		$back_content = array(
			'back_media_type'  => array(
				'label'       => esc_html__( 'Media Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select back side media type.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'back',
				'default'     => 'icon',
				'options'     => array(
					'none'  => esc_html__( 'None', 'addons-for-divi' ),
					'icon'  => esc_html__( 'Icon', 'addons-for-divi' ),
					'image' => esc_html__( 'Image', 'addons-for-divi' ),
				),
			),
			'back_icon'        => array(
				'label'       => esc_html__( 'Select Icon', 'addons-for-divi' ),
				'description' => esc_html__( 'Select back side icon.', 'addons-for-divi' ),
				'type'        => 'select_icon',
				'toggle_slug' => 'back',
				'default'     => '&#x2b;||divi||400',
				'tab_slug'    => 'general',
				'show_if'     => array(
					'back_media_type' => 'icon',
				),
			),
			'back_img'         => array(
				'label'              => esc_html__( 'Upload Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image or type in the URL of the image you would like to display for the back side.', 'addons-for-divi' ),
				'type'               => 'upload',
				'default'            => DIVI_TORQUE_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'back',
				'show_if'            => array(
					'back_media_type' => 'image',
				),
			),
			'back_img_alt'     => array(
				'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the back side image alt text for your flip box.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'back',
				'show_if'     => array(
					'back_media_type' => 'image',
				),
			),
			'back_title'       => array(
				'label'           => esc_html__( 'Back Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the back side title for your flip box.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
			),
			'back_subtitle'    => array(
				'label'           => esc_html__( 'Back Sub Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the back side sub-title for your flip box.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
			),
			'back_description' => array(
				'label'           => esc_html__( 'Back Description', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the back side description text for your flip box.', 'addons-for-divi' ),
				'type'            => 'textarea',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
			),
			'use_button'       => array(
				'label'           => esc_html__( 'Use Button', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether button should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'back',
			),
			'button_text'      => array(
				'label'           => esc_html__( 'Button Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define the button text.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => 'Click Here',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
			'button_link'      => array(
				'label'           => esc_html__( 'Button Link', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the button link url for your button.', 'addons-for-divi' ),
				'type'            => 'text',
				'default'         => '',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
			'is_new_window'    => array(
				'label'           => esc_html__( 'Open Button link in new window', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether button URL should be opened in new window.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'back',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
		);

		$settings = array(
			'animation_type'     => array(
				'label'       => esc_html__( 'Animation Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select the animation type.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'flip',
				'options'     => array(
					'flip'      => esc_html__( 'Flip', 'addons-for-divi' ),
					'diagonal'  => esc_html__( 'Flip Diagonal', 'addons-for-divi' ),
					'shake'     => esc_html__( 'Flip Shake', 'addons-for-divi' ),
					'push'      => esc_html__( 'Push', 'addons-for-divi' ),
					'slide'     => esc_html__( 'Slide', 'addons-for-divi' ),
					'fade'      => esc_html__( 'Fade', 'addons-for-divi' ),
					'zoom_in'   => esc_html__( 'Zoom In', 'addons-for-divi' ),
					'zoom_out'  => esc_html__( 'Zoom Out', 'addons-for-divi' ),
					'rotate_3d' => esc_html__( 'Rotate 3D', 'addons-for-divi' ),
					'open_up'   => esc_html__( 'Open Up', 'addons-for-divi' ),
				),
			),
			'flank_color'        => array(
				'label'        => esc_html__( 'Divider Flank Color', 'addons-for-divi' ),
				'description'  => esc_html__( 'Pick a color to use for the flank color.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'default'      => '#dddddd',
				'toggle_slug'  => 'settings',
				'show_if'      => array(
					'animation_type' => 'rotate_3d',
				),
			),
			'direction'          => array(
				'label'       => esc_html__( 'Animation Direction', 'addons-for-divi' ),
				'description' => esc_html__( 'Select the animation direction.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'right',
				'options'     => array(
					'up'    => esc_html__( 'Up', 'addons-for-divi' ),
					'right' => esc_html__( 'Right', 'addons-for-divi' ),
					'down'  => esc_html__( 'Down', 'addons-for-divi' ),
					'left'  => esc_html__( 'Left', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => array( 'flip', 'push', 'slide' ),
				),
			),
			'direction_diagonal' => array(
				'label'       => esc_html__( 'Animation Direction', 'addons-for-divi' ),
				'description' => esc_html__( 'Select the animation direction.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'right',
				'options'     => array(
					'right' => esc_html__( 'Right', 'addons-for-divi' ),
					'left'  => esc_html__( 'Left', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => 'diagonal',
				),
			),
			'direction_alt'      => array(
				'label'       => esc_html__( 'Animation Direction', 'addons-for-divi' ),
				'description' => esc_html__( 'Select the animation direction.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'h',
				'options'     => array(
					'v' => esc_html__( 'Vertical', 'addons-for-divi' ),
					'h' => esc_html__( 'Horizontal', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => 'rotate_3d',
				),
			),
			'animation_3d'       => array(
				'label'           => esc_html__( 'Use 3d Animation', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether 3d animation should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'settings',
				'show_if'         => array(
					'animation_type' => 'flip',
				),
			),
			'duration'           => array(
				'label'          => esc_html__( 'Animation Duration', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define the length of time that the animation takes.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '600ms',
				'fixed_unit'     => 'ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 50,
					'max'  => 3000,
				),
				'toggle_slug'    => 'settings',
			),
			'main_height'        => array(
				'label'          => esc_html__( 'Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define height for your flip box.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '300px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'settings',
			),
		);

		$front_media = array(
			'front_img_position' => array(
				'label'       => esc_html__( 'Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Select image position for the front side.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'front_media',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'left'   => esc_html__( 'Left', 'addons-for-divi' ),
					'center' => esc_html__( 'Center', 'addons-for-divi' ),
					'right'  => esc_html__( 'Right', 'addons-for-divi' ),
				),
			),
			'front_img_padding'  => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom padding for your front side icon/image.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'front_media_type' => 'image',
				),
			),
			'front_icon_color'   => array(
				'label'        => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom color for your front side icon.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'front_media',
				'show_if'      => array(
					'front_media_type' => 'icon',
				),
			),
			'front_icon_size'    => array(
				'label'          => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom size for your front side icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '60px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'front_media_type' => 'icon',
				),
			),
			'front_img_height'   => array(
				'label'          => esc_html__( 'Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom height for your front side image/icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
			),
			'front_img_width'    => array(
				'label'          => esc_html__( 'Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom width for your front side image/icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
			),
		);

		$back_media = array(
			'back_img_position' => array(
				'label'       => esc_html__( 'Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Select image position for the back side.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'back_media',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__( 'Left', 'addons-for-divi' ),
					'center'     => esc_html__( 'Center', 'addons-for-divi' ),
					'flex-end'   => esc_html__( 'Right', 'addons-for-divi' ),
				),
			),
			'back_img_padding'  => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom padding for your back side icon/image.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'back_media_type' => 'image',
				),
			),
			'back_icon_color'   => array(
				'label'        => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description'  => esc_html__( 'Here you can define a custom color for your back side icon.', 'addons-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'back_media',
				'show_if'      => array(
					'back_media_type' => 'icon',
				),
			),
			'back_icon_size'    => array(
				'label'          => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom size for your back side icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '60px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'back_media_type' => 'icon',
				),
			),
			'back_img_height'   => array(
				'label'          => esc_html__( 'Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom height for your back side image/icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
			),
			'back_img_width'    => array(
				'label'          => esc_html__( 'Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom width for your back side image/icon.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
			),
		);

		$front_design = array(
			'front_alignment'   => array(
				'label'            => esc_html__( 'Content Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'text_align',
				'default_on_front' => 'center',
				'toggle_slug'      => 'front',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),
			'front_align_items' => array(
				'label'       => esc_html__( 'Content Vertical Alignment', 'addons-for-divi' ),
				'description' => esc_html__( 'Select front side content vertical alignment.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'front',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__( 'Start', 'addons-for-divi' ),
					'center'     => esc_html__( 'Center', 'addons-for-divi' ),
					'flex-end'   => esc_html__( 'End', 'addons-for-divi' ),
				),
			),
			'front_padding'     => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front',
				'tab_slug'       => 'advanced',
				'default'        => '30px|30px|30px|30px',
				'mobile_options' => true,
			),
			'front_ct_padding'  => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Set front side card content padding.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
		);

		$back_design = array(
			'back_alignment'   => array(
				'label'            => esc_html__( 'Content Alignment', 'addons-for-divi' ),
				'description'      => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'     => 'text_align',
				'default_on_front' => 'center',
				'toggle_slug'      => 'back',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),
			'back_align_items' => array(
				'label'       => esc_html__( 'Content Vertical Alignment', 'addons-for-divi' ),
				'description' => esc_html__( 'Select back side content vertical alignment.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'back',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__( 'Start', 'addons-for-divi' ),
					'center'     => esc_html__( 'Center', 'addons-for-divi' ),
					'flex-end'   => esc_html__( 'End', 'addons-for-divi' ),
				),
			),
			'back_padding'     => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back',
				'tab_slug'       => 'advanced',
				'default'        => '30px|30px|30px|30px',
				'mobile_options' => true,
			),
			'back_ct_padding'  => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Set back side card content padding.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
		);

		$front_bg = $this->custom_background_fields(
			'front',
			'',
			'advanced',
			'front',
			array( 'color', 'gradient', 'image' ),
			array(),
			'#efefef'
		);

		$back_bg = $this->custom_background_fields(
			'back',
			'',
			'advanced',
			'back',
			array( 'color', 'gradient', 'image' ),
			array(),
			'#efefef'
		);

		$front_img_bg = $this->custom_background_fields(
			'front_img',
			'',
			'advanced',
			'front_media',
			array( 'color', 'gradient', 'image' ),
			array(),
			''
		);

		$back_img_bg = $this->custom_background_fields(
			'back_img',
			'',
			'advanced',
			'back_media',
			array( 'color', 'gradient', 'image' ),
			array(),
			''
		);

		$texts_spacing = array(
			'front_subtitle_spacing' => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the front card subtitle.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'front_text',
				'sub_toggle'     => 'subtitle',
				'tab_slug'       => 'advanced',
			),
			'back_subtitle_spacing'  => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the back card subtitle.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'back_text',
				'sub_toggle'     => 'subtitle',
				'tab_slug'       => 'advanced',
			),
			'front_desc_spacing'     => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the front card description.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'front_text',
				'sub_toggle'     => 'description',
				'tab_slug'       => 'advanced',
			),
			'back_desc_spacing'      => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the back card description.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'back_text',
				'sub_toggle'     => 'description',
				'tab_slug'       => 'advanced',
			),
		);

		$button = array(
			'btn_spacing' => array(
				'label'          => esc_html__( 'Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the back card button.', 'addons-for-divi' ),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '15px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'button',
				'tab_slug'       => 'advanced',
			),
		);

		return array_merge(
			$front_content,
			$back_content,
			$settings,
			$front_design,
			$back_design,
			$front_media,
			$back_media,
			$back_bg,
			$front_bg,
			$front_img_bg,
			$back_img_bg,
			$texts_spacing,
			$button
		);
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['box_shadow']['card'] = array(
			'label'       => esc_html__( 'Box Shadow', 'addons-for-divi' ),
			'toggle_slug' => 'box_shadow',
			'css'         => array(
				'main'      => '%%order_class%% .dtq-flipbox-card',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['card'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-flipbox-card',
					'border_styles' => '%%order_class%% .dtq-flipbox-card',
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

		$advanced_fields['borders']['front_media'] = array(
			'toggle_slug' => 'front_media',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-flipbox-figure-front',
					'border_styles' => '%%order_class%% .dtq-flipbox-figure-front',
				),
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['back_media'] = array(
			'toggle_slug' => 'back_media',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-flipbox-figure-back',
					'border_styles' => '%%order_class%% .dtq-flipbox-figure-back',
				),
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['front_title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-flipbox-title-front',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'front_text',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '26px',
			),
			'line_height'     => array(
				'default' => '1.5em',
			),
		);

		$advanced_fields['fonts']['front_description'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-flipbox-desc-front',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'front_text',
			'sub_toggle'      => 'description',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
			'line_height'     => array(
				'default' => '1.6em',
			),
		);

		$advanced_fields['fonts']['back_title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-flipbox-title-back',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'back_text',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '26px',
			),
			'line_height'     => array(
				'default' => '1.5em',
			),
		);

		$advanced_fields['fonts']['back_description'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-flipbox-desc-back',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'back_text',
			'sub_toggle'      => 'description',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
			'line_height'     => array(
				'default' => '1.6em',
			),
		);

		$advanced_fields['button']['back_btn'] = array(
			'label'          => esc_html__( 'Button', 'addons-for-divi' ),
			'toggle_slug'    => 'button',
			'css'            => array(
				'main'      => '%%order_class%% .dtq-flipbox-btn',
				'important' => 'all',
			),
			'use_alignment'  => false,
			'box_shadow'     => array(
				'css' => array(
					'main' => '%%order_class%% .dtq-flipbox-btn',
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

		$advanced_fields['fonts']['front_subtitle'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-flipbox-subtitle-front',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'front_text',
			'sub_toggle'      => 'subtitle',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '18px',
			),
			'line_height'     => array(
				'default' => '1.5em',
			),
		);

		$advanced_fields['fonts']['back_subtitle'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-flipbox-subtitle-back',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'back_text',
			'sub_toggle'      => 'subtitle',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '18px',
			),
			'line_height'     => array(
				'default' => '1.5em',
			),
		);

		return $advanced_fields;
	}

	public function render_icon_front() {

		$icon_name = esc_attr( et_pb_process_font_icon( $this->props['front_icon'] ) );

		return sprintf(
			'<div class="dtq-flipbox-icon dtq-flipbox-icon-front">
                <i class="dtq-et-icon">%1$s</i>
            </div>',
			$icon_name
		);
	}

	public function render_icon_back() {

		$icon_name = esc_attr( et_pb_process_font_icon( $this->props['back_icon'] ) );
		return sprintf(
			'<div class="dtq-flipbox-icon dtq-flipbox-icon-back">
                <i class="dtq-et-icon">%1$s</i>
            </div>',
			$icon_name
		);
	}

	public function render_img_front() {
		return sprintf(
			'<div class="dtq-flipbox-img-front">
                <img src="%1$s" alt="%2$s"/>
            </div>',
			$this->props['front_img'],
			$this->props['front_img_alt']
		);
	}

	public function render_img_back() {
		return sprintf(
			'<div class="dtq-flipbox-img-back">
                <img src="%1$s" alt="%2$s"/>
            </div>',
			$this->props['back_img'],
			$this->props['back_img_alt']
		);
	}

	public function render_media_front() {
		$front_icon       = $this->props['front_icon'];
		$front_media_type = $this->props['front_media_type'];
		$front_img        = $this->props['front_img'];

		if ( 'none' === $front_media_type ) {
			return;
		}

		if ( ! empty( $front_icon ) || ! empty( $front_img ) ) {
			if ( 'icon' === $front_media_type ) {
				$media = $this->render_icon_front();
				// Inject Font Awesome Manually!.
				dtq_inject_fa_icons( $this->props['front_icon'] );
			} elseif ( 'image' === $front_media_type ) {
				$media = $this->render_img_front();
			}

			return sprintf(
				'<div class="dtq-flipbox-figure-front">
					%1$s
				</div>',
				$media
			);
		}
	}

	public function render_media_back() {
		$back_icon       = $this->props['back_icon'];
		$back_media_type = $this->props['back_media_type'];
		$back_img        = $this->props['back_img'];

		if ( 'none' === $back_media_type ) {
			return;
		}

		if ( ! empty( $back_icon ) || ! empty( $back_img ) ) {
			if ( 'icon' === $back_media_type ) {
				$media = $this->render_icon_back();
				// Inject Font Awesome Manually!.
				dtq_inject_fa_icons( $this->props['back_icon'] );
			} elseif ( 'image' === $back_media_type ) {
				$media = $this->render_img_back();
			}

			return sprintf(
				'<div class="dtq-flipbox-figure-back">
					%1$s
				</div>',
				$media
			);
		}
	}

	public function render_title_front() {
		$front_title = $this->props['front_title'];
		if ( ! empty( $front_title ) ) {
			return sprintf(
				'<h2 class="dtq-flipbox-title-front">%1$s</h2>',
				$front_title
			);
		}
	}

	public function render_title_back() {
		$back_title = $this->props['back_title'];
		if ( ! empty( $back_title ) ) {
			return sprintf(
				'<h2 class="dtq-flipbox-title-back">%1$s</h2>',
				$back_title
			);
		}
	}

	public function render_subtitle_front() {
		$front_subtitle = $this->props['front_subtitle'];
		if ( ! empty( $front_subtitle ) ) {
			return sprintf(
				'<h4 class="dtq-flipbox-subtitle-front">%1$s</h4>',
				$front_subtitle
			);
		}
	}

	public function render_subtitle_back() {
		$back_subtitle = $this->props['back_subtitle'];
		if ( ! empty( $back_subtitle ) ) {
			return sprintf(
				'<h4 class="dtq-flipbox-subtitle-back">%1$s</h4>',
				$back_subtitle
			);
		}
	}

	public function render_description_front() {
		$description = $this->props['front_description'];
		if ( ! empty( $description ) ) {
			return sprintf(
				'<div class="dtq-flipbox-desc-front">%1$s</div>',
				$description
			);
		}
	}

	public function render_description_back() {
		$description = $this->props['back_description'];
		if ( ! empty( $description ) ) {
			return sprintf(
				'<div class="dtq-flipbox-desc-back">%1$s</div>',
				$description
			);
		}
	}

	public function render_module_button() {

		if ( 'on' === $this->props['use_button'] ) {

			$button_custom = $this->props['custom_back_btn'];
			$button_text   = isset( $this->props['button_text'] ) ? $this->props['button_text'] : 'Click Here';
			$button_link   = isset( $this->props['button_link'] ) ? $this->props['button_link'] : '#';
			$button_url    = trim( $button_link );
			$new_tab       = $this->props['is_new_window'];

			$custom_icon_values = et_pb_responsive_options()->get_property_values( $this->props, 'back_btn_icon' );
			$custom_icon        = isset( $custom_icon_values['desktop'] ) ? $custom_icon_values['desktop'] : '';
			$custom_icon_tablet = isset( $custom_icon_values['tablet'] ) ? $custom_icon_values['tablet'] : '';
			$custom_icon_phone  = isset( $custom_icon_values['phone'] ) ? $custom_icon_values['phone'] : '';
			$multi_view         = et_pb_multi_view_options( $this );

			if ( function_exists( 'dtq_inject_fa_icons' ) ) {
				// Inject Font Awesome Manually!.
				dtq_inject_fa_icons( $this->props['back_btn_icon'] );
			}

			$button = $this->render_button(
				array(
					'button_id'           => $this->module_id( false ),
					'button_classname'    => array( 'dtq-flipbox-btn' ),
					'button_custom'       => $button_custom,
					'button_text'         => $button_text,
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
							'hover_selector' => '%%order_class%% .dtq-flipbox-btn',
							'visibility'     => array(
								'button_text' => '__not_empty',
							),
						)
					),
				)
			);

			return sprintf(
				'<div class="dtq-flipbox-btn-wrap">
                    %1$s
                </div>',
				$button
			);
		}
	}

	public function render( $attrs, $content, $render_slug ) {

		$this->render_css( $render_slug );

		$animation_type     = $this->props['animation_type'];
		$animation_3d       = $this->props['animation_3d'];
		$direction          = $this->props['direction'];
		$direction_alt      = $this->props['direction_alt'];
		$direction_diagonal = $this->props['direction_diagonal'];
		$classes            = array();

		array_push( $classes, 'dtq-flipbox--' . $animation_type );

		if ( 'on' === $animation_3d ) {
			array_push( $classes, 'dtq-flipbox-3d' );
		}

		if (
			'flip' === $animation_type ||
			'slide' === $animation_type ||
			'push' === $animation_type
		  ) {
			array_push( $classes, "dtq-$animation_type-$direction" );
		}

		if ( 'diagonal' === $animation_type ) {
			array_push( $classes, "dtq-$animation_type-$direction_diagonal" );
		}

		if ( 'rotate_3d' === $animation_type ) {
			array_push( $classes, "dtq-$animation_type-$direction_alt" );
		}

		return sprintf(
			'<div class="dtq-module dtq-flipbox %1$s">
                <div class="dtq-flipbox-inner">
					<div class="dtq-flipbox-card-container">
						<div class="dtq-flipbox-front-card dtq-flipbox-card">
							<div class="dtq-flipbox-card-inner">
								<div class="dtq-flipbox-front-content dtq-flipbox-content">
									%2$s
									<div class="dtq-flipbox-content-wrap">
										%3$s
										%9$s
										%6$s
									</div>
								</div>
							</div>
						</div>
						<div class="dtq-flipbox-back-card dtq-flipbox-card">
							<div class="dtq-flipbox-card-inner">
								<div class="dtq-flipbox-back-content dtq-flipbox-content">
									%4$s
									<div class="dtq-flipbox-content-wrap">
										%5$s
										%10$s
										%7$s
										%8$s
									</div>
								</div>
							</div>
						</div>
						<div class="dtq-flank"></div>
					</div>
				</div>
            </div>',
			join( ' ', $classes ), // 1.
			$this->render_media_front(), // 2.
			$this->render_title_front(), // 3.
			$this->render_media_back(), // 4.
			$this->render_title_back(), // 5.
			$this->render_description_front(), // 6.
			$this->render_description_back(), // 7.
			$this->render_module_button(), // 8.
			$this->render_subtitle_front(), // 9.
			$this->render_subtitle_back() // 10
		);
	}

	public function render_css( $render_slug ) {

		$front_img_position = $this->props['front_img_position'];
		$animation_type     = $this->props['animation_type'];
		$direction_alt      = $this->props['direction_alt'];
		$front_icon_size    = $this->props['front_icon_size'];
		$back_icon_color    = $this->props['back_icon_color'];
		$front_icon_color   = $this->props['front_icon_color'];
		$front_img_width    = $this->props['front_img_width'];
		$front_img_height   = $this->props['front_img_height'];
		$back_img_width     = $this->props['back_img_width'];
		$back_icon_size     = $this->props['back_icon_size'];
		$back_img_height    = $this->props['back_img_height'];
		$back_img_position  = $this->props['back_img_position'];
		$duration           = $this->props['duration'];
		$main_height        = $this->props['main_height'];
		$flank_color        = $this->props['flank_color'];
		$front_align_items  = $this->props['front_align_items'];
		$back_align_items   = $this->props['back_align_items'];

		if ( 'rotate_3d' === $animation_type ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-inner .dtq-flank',
					'declaration' => sprintf(
						'background: %1$s;',
						$flank_color
					),
				)
			);

			if ( 'v' === $direction_alt ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-flipbox-inner .dtq-flank',
						'declaration' => sprintf(
							'transform: rotateX(-90deg) translateZ(calc(%1$s - 100px))!important;',
							$main_height
						),
					)
				);
			}
		}

		$this->get_responsive_styles(
			'main_height',
			'%%order_class%% .dtq-flipbox-inner',
			array( 'primary' => 'height' ),
			array( 'default' => '300px' ),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-flipbox-front-card, %%order_class%% .dtq-flipbox-back-card, %%order_class%% .dtq-flipbox-card-container',
				'declaration' => "transition: all $duration ease;",
			)
		);

		// Front Side.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-flipbox-front-card',
				'declaration' => sprintf(
					'align-items: %1$s;',
					$front_align_items
				),
			)
		);

		if ( 'center' !== $front_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-front-content',
					'declaration' => sprintf(
						'align-items: %1$s;',
						$front_align_items
					),
				)
			);
		}

		$this->get_responsive_styles(
			'front_alignment',
			'%%order_class%% .dtq-flipbox-front-card',
			array( 'primary' => 'text-align' ),
			array( 'default' => 'auto' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'front_padding',
			'%%order_class%% .dtq-flipbox-front-card',
			array( 'primary' => 'padding' ),
			array( 'default' => '30px|30px|30px|30px' ),
			$render_slug
		);

		if ( 'center' !== $front_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-front-content',
					'declaration' => 'display: flex;',
				)
			);
		}

		if ( 'right' === $front_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-front-content',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-flipbox-icon-front',
				'declaration' => sprintf(
					'font-size: %1$s;',
					$front_icon_size
				),
			)
		);

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'front_icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtq-flipbox-icon-front',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'back_icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtq-flipbox-icon-back',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		if ( ! empty( $front_icon_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-icon-front',
					'declaration' => sprintf(
						'color: %1$s;',
						$front_icon_color
					),
				)
			);
		}

		if ( ! empty( $front_img_width ) ) {
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .dtq-flipbox-figure-front',
				array( 'primary' => 'width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .dtq-flipbox-figure-front',
				array( 'primary' => 'max-width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .dtq-flipbox-figure-front',
				array( 'primary' => 'flex' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		if ( ! empty( $front_img_height ) ) {
			$this->get_responsive_styles(
				'front_img_height',
				'%%order_class%% .dtq-flipbox-figure-front',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_height',
				'%%order_class%% .dtq-flipbox-figure-front img',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'front_img_padding',
			'%%order_class%% .dtq-flipbox-figure-front img',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'front_ct_padding',
			'%%order_class%% .dtq-flipbox-front-card .dtq-flipbox-content-wrap',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		// Back Side.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-flipbox-back-card',
				'declaration' => sprintf(
					'align-items: %1$s;',
					$back_align_items
				),
			)
		);

		if ( 'center' !== $back_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-back-content',
					'declaration' => sprintf(
						'align-items: %1$s;',
						$back_align_items
					),
				)
			);
		}

		$this->get_responsive_styles(
			'back_alignment',
			'%%order_class%% .dtq-flipbox-back-card',
			array( 'primary' => 'text-align' ),
			array( 'default' => 'auto' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_padding',
			'%%order_class%% .dtq-flipbox-back-card',
			array( 'primary' => 'padding' ),
			array( 'default' => '30px|30px|30px|30px' ),
			$render_slug
		);

		if ( 'center' !== $back_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-back-content',
					'declaration' => 'display: flex;',
				)
			);
		}

		if ( 'right' === $back_img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-back-content',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-flipbox-icon-back',
				'declaration' => sprintf(
					'font-size: %1$s;',
					$back_icon_size
				),
			)
		);

		if ( ! empty( $back_icon_color ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-flipbox-icon-back',
					'declaration' => sprintf(
						'color: %1$s;',
						$back_icon_color
					),
				)
			);
		}

		if ( ! empty( $back_img_width ) ) {
			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .dtq-flipbox-figure-back',
				array( 'primary' => 'width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);

			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .dtq-flipbox-figure-back',
				array( 'primary' => 'max-width' ),
				array( 'default' => 'auto' ),
				$render_slug
			);

			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .dtq-flipbox-figure-back',
				array( 'primary' => 'flex' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		if ( ! empty( $back_img_height ) ) {
			$this->get_responsive_styles(
				'back_img_height',
				'%%order_class%% .dtq-flipbox-figure-back',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'back_img_height',
				'%%order_class%% .dtq-flipbox-figure-back img',
				array( 'primary' => 'height' ),
				array( 'default' => 'auto' ),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'back_img_padding',
			'%%order_class%% .dtq-flipbox-figure-back img',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_ct_padding',
			'%%order_class%% .dtq-flipbox-back-card .dtq-flipbox-content-wrap',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		// Texts Spacing.
		$this->get_responsive_styles(
			'front_subtitle_spacing',
			'%%order_class%% .dtq-flipbox-subtitle-front',
			array( 'primary' => 'margin-top' ),
			array( 'default' => '0px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_subtitle_spacing',
			'%%order_class%% .dtq-flipbox-subtitle-back',
			array( 'primary' => 'margin-top' ),
			array( 'default' => '0px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'front_desc_spacing',
			'%%order_class%% .dtq-flipbox-desc-front',
			array( 'primary' => 'margin-top' ),
			array( 'default' => '0px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_desc_spacing',
			'%%order_class%% .dtq-flipbox-desc-back',
			array( 'primary' => 'margin-top' ),
			array( 'default' => '0px' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'btn_spacing',
			'%%order_class%% .dtq-flipbox-btn-wrap',
			array( 'primary' => 'margin-top' ),
			array( 'default' => '15px' ),
			$render_slug
		);

		$this->get_custom_bg_style( $render_slug, 'front', '%%order_class%% .dtq-flipbox-front-card', '' );
		$this->get_custom_bg_style( $render_slug, 'back', '%%order_class%% .dtq-flipbox-back-card', '' );
		$this->get_custom_bg_style( $render_slug, 'front_img', '%%order_class%% .dtq-flipbox-figure-front', '' );
		$this->get_custom_bg_style( $render_slug, 'back_img', '%%order_class%% .dtq-flipbox-figure-back', '' );
		$this->get_buttons_styles( 'button', $render_slug, '%%order_class%% .dtq-flipbox-back-card .et_pb_button' );

	}
}


new DTQ__Flipbox();
