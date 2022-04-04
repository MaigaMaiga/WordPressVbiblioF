<?php
class DTQ_AnimatedText extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/animated-text-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->slug       = 'ba_animated_text';
		$this->vb_support = 'on';
		$this->name       = esc_html__( 'Torque Animated Text', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'animated-text.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'addons-for-divi' ),
					'settings' => esc_html__( 'Settings', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'general'       => esc_html__( 'General', 'addons-for-divi' ),
					'texts'         => esc_html__( 'Text', 'addons-for-divi' ),
					'prefix'        => array(
						'title'             => esc_html__( 'Prefix', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__( 'General', 'addons-for-divi' ),
							),
							'text'    => array(
								'name' => esc_html__( 'Typography', 'addons-for-divi' ),
							),
						),
					),
					'animated_text' => array(
						'title'             => esc_html__( 'Animated Text', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__( 'General', 'addons-for-divi' ),
							),
							'text'    => array(
								'name' => esc_html__( 'Typography', 'addons-for-divi' ),
							),
						),
					),
					'suffix'        => array(
						'title'             => esc_html__( 'Suffix', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__( 'General', 'addons-for-divi' ),
							),
							'text'    => array(
								'name' => esc_html__( 'Typography', 'addons-for-divi' ),
							),
						),
					),
					'cursor'        => esc_html__( 'Cursor', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'prefix'        => array(
				'label'    => esc_html__( 'Prefix', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-animated-text-prefix',
			),
			'animated_text' => array(
				'label'    => esc_html__( 'Animated Text', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-animated-text-main',
			),
			'suffix'        => array(
				'label'    => esc_html__( 'Suffix', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-animated-text-suffix',
			),
		);
	}

	public function get_fields() {

		$content = array(
			'prefix'        => array(
				'label'       => esc_html__( 'Prefix', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the prefix text.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),
			'animated_text' => array(
				'label'           => esc_html__( 'Animated Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the main animated text. Add a new item for a new slide animation.', 'addons-for-divi' ),
				'type'            => 'options_list',
				'option_category' => 'basic_option',
				'default'         => '[{"value":"Divi Torque","checked":0,"dragID":-1},{"value":"Animated Text","checked":0,"dragID":0}]',
				'toggle_slug'     => 'content',
			),
			'suffix'        => array(
				'label'       => esc_html__( 'Suffix', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the suffix text.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),
		);

		$settings = array(
			'animation_type' => array(
				'label'       => esc_html__( 'Animation Mode', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the animation type from the list.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'typed',
				'options'     => array(
					'typed' => esc_html__( 'Text Typing', 'addons-for-divi' ),
					'tilt'  => esc_html__( 'Text Tilt', 'addons-for-divi' ),
					'slide' => esc_html__( 'Animated Slide', 'addons-for-divi' ),
				),
			),
		);

		$tilt_settings = array(
			'tilt_in'      => array(
				'label'       => esc_html__( 'In Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the text in animation.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'flip',
				'options'     => array(
					'flash'             => esc_html__( 'flash', 'addons-for-divi' ),
					'bounce'            => esc_html__( 'bounce', 'addons-for-divi' ),
					'shake'             => esc_html__( 'shake', 'addons-for-divi' ),
					'tada'              => esc_html__( 'tada', 'addons-for-divi' ),
					'swing'             => esc_html__( 'swing', 'addons-for-divi' ),
					'wobble'            => esc_html__( 'wobble', 'addons-for-divi' ),
					'pulse'             => esc_html__( 'pulse', 'addons-for-divi' ),
					'flip'              => esc_html__( 'flip', 'addons-for-divi' ),
					'flipInX'           => esc_html__( 'flipInX', 'addons-for-divi' ),
					'flipInY'           => esc_html__( 'flipInY', 'addons-for-divi' ),
					'fadeIn'            => esc_html__( 'fadeIn', 'addons-for-divi' ),
					'fadeInUp'          => esc_html__( 'fadeInUp', 'addons-for-divi' ),
					'fadeInDown'        => esc_html__( 'fadeInDown', 'addons-for-divi' ),
					'fadeInLeft'        => esc_html__( 'fadeInLeft', 'addons-for-divi' ),
					'fadeInRight'       => esc_html__( 'fadeInRight', 'addons-for-divi' ),
					'fadeInUpBig'       => esc_html__( 'fadeInUpBig', 'addons-for-divi' ),
					'fadeInDownBig'     => esc_html__( 'fadeInDownBig', 'addons-for-divi' ),
					'fadeInLeftBig'     => esc_html__( 'fadeInLeftBig', 'addons-for-divi' ),
					'fadeInRightBig'    => esc_html__( 'fadeInRightBig', 'addons-for-divi' ),
					'bounceIn'          => esc_html__( 'bounceIn', 'addons-for-divi' ),
					'bounceInDown'      => esc_html__( 'bounceInDown', 'addons-for-divi' ),
					'bounceInUp'        => esc_html__( 'bounceInUp', 'addons-for-divi' ),
					'bounceInLeft'      => esc_html__( 'bounceInLeft', 'addons-for-divi' ),
					'bounceInRight'     => esc_html__( 'bounceInRight', 'addons-for-divi' ),
					'rotateIn'          => esc_html__( 'rotateIn', 'addons-for-divi' ),
					'rotateInDownLeft'  => esc_html__( 'rotateInDownLeft', 'addons-for-divi' ),
					'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'addons-for-divi' ),
					'rotateInUpLeft'    => esc_html__( 'rotateInUpLeft', 'addons-for-divi' ),
					'rotateInUpRight'   => esc_html__( 'rotateInUpRight', 'addons-for-divi' ),
					'rollIn'            => esc_html__( 'rollIn', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => 'tilt',
				),
			),
			'tilt_out'     => array(
				'label'       => esc_html__( 'Out Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Define the text out animation.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'rotateOutDownLeft',
				'options'     => array(
					'flash'              => esc_html__( 'flash', 'addons-for-divi' ),
					'bounce'             => esc_html__( 'bounce', 'addons-for-divi' ),
					'shake'              => esc_html__( 'shake', 'addons-for-divi' ),
					'tada'               => esc_html__( 'tada', 'addons-for-divi' ),
					'swing'              => esc_html__( 'swing', 'addons-for-divi' ),
					'wobble'             => esc_html__( 'wobble', 'addons-for-divi' ),
					'pulse'              => esc_html__( 'pulse', 'addons-for-divi' ),
					'flip'               => esc_html__( 'flip', 'addons-for-divi' ),
					'flipOutX'           => esc_html__( 'flipOutX', 'addons-for-divi' ),
					'flipOutY'           => esc_html__( 'flipOutY', 'addons-for-divi' ),
					'fadeOut'            => esc_html__( 'fadeOut', 'addons-for-divi' ),
					'fadeOutUp'          => esc_html__( 'fadeOutUp', 'addons-for-divi' ),
					'fadeOutDown'        => esc_html__( 'fadeOutDown', 'addons-for-divi' ),
					'fadeOutLeft'        => esc_html__( 'fadeOutLeft', 'addons-for-divi' ),
					'fadeOutRight'       => esc_html__( 'fadeOutRight', 'addons-for-divi' ),
					'fadeOutUpBig'       => esc_html__( 'fadeOutUpBig', 'addons-for-divi' ),
					'fadeOutDownBig'     => esc_html__( 'fadeOutDownBig', 'addons-for-divi' ),
					'fadeOutLeftBig'     => esc_html__( 'fadeOutLeftBig', 'addons-for-divi' ),
					'fadeOutRightBig'    => esc_html__( 'fadeOutRightBig', 'addons-for-divi' ),
					'bounceOut'          => esc_html__( 'bounceOut', 'addons-for-divi' ),
					'bounceOutDown'      => esc_html__( 'bounceOutDown', 'addons-for-divi' ),
					'bounceOutUp'        => esc_html__( 'bounceOutUp', 'addons-for-divi' ),
					'bounceOutLeft'      => esc_html__( 'bounceOutLeft', 'addons-for-divi' ),
					'bounceOutRight'     => esc_html__( 'bounceOutRight', 'addons-for-divi' ),
					'rotateOut'          => esc_html__( 'rotateOut', 'addons-for-divi' ),
					'rotateOutDownLeft'  => esc_html__( 'rotateOutDownLeft', 'addons-for-divi' ),
					'rotateOutDownRight' => esc_html__( 'rotateOutDownRight', 'addons-for-divi' ),
					'rotateOutUpLeft'    => esc_html__( 'rotateOutUpLeft', 'addons-for-divi' ),
					'rotateOutUpRight'   => esc_html__( 'rotateOutUpRight', 'addons-for-divi' ),
					'rollOut'            => esc_html__( 'rollOut', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => 'tilt',
				),
			),
			'tilt_delay'   => array(
				'label'          => esc_html__( 'Animation Delay', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can set the time for the animation gap between text in and out.', 'addons-for-divi' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '50ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'animation_type' => 'tilt',
				),
			),
			'tilt_sync'    => array(
				'label'       => esc_html__( 'Sync', 'addons-for-divi' ),
				'description' => esc_html__( 'Select where to use synchronize text tilt animation.', 'addons-for-divi' ),
				'type'        => 'multiple_checkboxes',
				'default'     => 'off|off',
				'toggle_slug' => 'settings',
				'options'     => array(
					'in'  => esc_html__( 'In Animation', 'addons-for-divi' ),
					'out' => esc_html__( 'Out Animation', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => 'tilt',
				),
			),
			'tilt_reverse' => array(
				'label'       => esc_html__( 'Reverse', 'addons-for-divi' ),
				'description' => esc_html__( 'Select where to use synchronize text reverse animation.', 'addons-for-divi' ),
				'type'        => 'multiple_checkboxes',
				'default'     => 'off|off',
				'toggle_slug' => 'settings',
				'options'     => array(
					'in'  => esc_html__( 'In Animation', 'addons-for-divi' ),
					'out' => esc_html__( 'Out Animation', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => 'tilt',
				),
			),
			'tilt_shuffle' => array(
				'label'       => esc_html__( 'Shuffle', 'addons-for-divi' ),
				'description' => esc_html__( 'Select where to use shuffle text tilt animation.', 'addons-for-divi' ),
				'type'        => 'multiple_checkboxes',
				'default'     => 'off|off',
				'toggle_slug' => 'settings',
				'options'     => array(
					'in'  => esc_html__( 'In Animation', 'addons-for-divi' ),
					'out' => esc_html__( 'Out Animation', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => 'tilt',
				),
			),
		);

		$typed_settings = array(
			'animation_speed' => array(
				'label'          => esc_html__( 'Animation Speed', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease text animation speed.', 'addons-for-divi' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '100ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'animation_type' => 'typed',
				),
			),
			'start_delay'     => array(
				'label'          => esc_html__( 'Start Delay', 'addons-for-divi' ),
				'description'    => esc_html__( 'Specifies a delay for the start of text animation.', 'addons-for-divi' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '300ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'animation_type' => 'typed',
				),
			),
			'back_speed'      => array(
				'label'          => esc_html__( 'Type Back Speed', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease typing back animation speed.', 'addons-for-divi' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '50ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'animation_type' => 'typed',
				),
			),
			'back_delay'      => array(
				'label'          => esc_html__( 'Type Back Delay', 'addons-for-divi' ),
				'description'    => esc_html__( 'Specifies a delay for the start of typing back animation.', 'addons-for-divi' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '500ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'animation_type' => 'typed',
				),
			),
			'use_loop'        => array(
				'label'           => esc_html__( 'Animation Loop', 'addons-for-divi' ),
				'description'     => esc_html__( 'Choose whether the endless of times an animation should be played or not.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'settings',
				'show_if'         => array(
					'animation_type' => 'typed',
				),
			),
			'show_cursor'     => array(
				'label'           => esc_html__( 'Show Cursor', 'addons-for-divi' ),
				'description'     => esc_html__( 'Show or hide cursor during text animation.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'on',
				'toggle_slug'     => 'settings',
				'show_if'         => array(
					'animation_type' => 'typed',
				),
			),
		);

		$slide_settings = array(
			'slide_animation' => array(
				'label'       => esc_html__( 'Slide Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Select sliding animation from the list.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'flipInX',
				'options'     => array(
					'flash'             => esc_html__( 'flash', 'addons-for-divi' ),
					'bounce'            => esc_html__( 'bounce', 'addons-for-divi' ),
					'shake'             => esc_html__( 'shake', 'addons-for-divi' ),
					'swing'             => esc_html__( 'swing', 'addons-for-divi' ),
					'wobble'            => esc_html__( 'wobble', 'addons-for-divi' ),
					'pulse'             => esc_html__( 'pulse', 'addons-for-divi' ),
					'flipInX'           => esc_html__( 'flipInX', 'addons-for-divi' ),
					'flipInY'           => esc_html__( 'flipInY', 'addons-for-divi' ),
					'fadeIn'            => esc_html__( 'fadeIn', 'addons-for-divi' ),
					'fadeInUp'          => esc_html__( 'fadeInUp', 'addons-for-divi' ),
					'fadeInDown'        => esc_html__( 'fadeInDown', 'addons-for-divi' ),
					'fadeInLeft'        => esc_html__( 'fadeInLeft', 'addons-for-divi' ),
					'fadeInRight'       => esc_html__( 'fadeInRight', 'addons-for-divi' ),
					'fadeInUpBig'       => esc_html__( 'fadeInUpBig', 'addons-for-divi' ),
					'fadeInDownBig'     => esc_html__( 'fadeInDownBig', 'addons-for-divi' ),
					'fadeInLeftBig'     => esc_html__( 'fadeInLeftBig', 'addons-for-divi' ),
					'fadeInRightBig'    => esc_html__( 'fadeInRightBig', 'addons-for-divi' ),
					'bounceIn'          => esc_html__( 'bounceIn', 'addons-for-divi' ),
					'bounceInDown'      => esc_html__( 'bounceInDown', 'addons-for-divi' ),
					'bounceInUp'        => esc_html__( 'bounceInUp', 'addons-for-divi' ),
					'bounceInLeft'      => esc_html__( 'bounceInLeft', 'addons-for-divi' ),
					'bounceInRight'     => esc_html__( 'bounceInRight', 'addons-for-divi' ),
					'rotateIn'          => esc_html__( 'rotateIn', 'addons-for-divi' ),
					'rotateInDownLeft'  => esc_html__( 'rotateInDownLeft', 'addons-for-divi' ),
					'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'addons-for-divi' ),
					'rotateInUpLeft'    => esc_html__( 'rotateInUpLeft', 'addons-for-divi' ),
					'rotateInUpRight'   => esc_html__( 'rotateInUpRight', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'animation_type' => 'slide',
				),
			),
			'slide_gap'       => array(
				'label'          => esc_html__( 'Slide Gap', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can set the duration of the slide change.', 'addons-for-divi' ),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '1500ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1500,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'animation_type' => 'slide',
				),
			),
		);

		$general = array(
			'text_alignment' => array(
				'label'           => esc_html__( 'Text Alignment', 'addons-for-divi' ),
				'description'     => esc_html__( 'Align text to the left, right or center.', 'addons-for-divi' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'    => 'text_align',
				'default'         => 'left',
				'mobile_options'  => true,
				'toggle_slug'     => 'general',
				'tab_slug'        => 'advanced',
			),
			'layout'         => array(
				'label'       => esc_html__( 'Layout', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define block/inline type layout for the module text.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'general',
				'tab_slug'    => 'advanced',
				'default'     => 'inline',
				'options'     => array(
					'block'  => esc_html__( 'Block', 'addons-for-divi' ),
					'inline' => esc_html__( 'Inline', 'addons-for-divi' ),
				),
			),
		);

		$prefix = array(
			'prefix_padding'      => array(
				'label'          => __( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom padding for the prefix text.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'prefix',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'prefix_margin'       => array(
				'label'          => __( 'Margin', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom margin for the prefix text.', 'addons-for-divi' ),
				'type'           => 'custom_margin',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'prefix',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'prefix_bg'           => array(
				'label'          => esc_html__( 'Background', 'addons-for-divi' ),
				'description'    => esc_html__( 'Pick a color to use for the prefix text background.', 'addons-for-divi' ),
				'type'           => 'color-alpha',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'prefix',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'prefix_radius'       => array(
				'label'       => esc_html__( 'Border Radius', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a border radius value for the prefix text.', 'addons-for-divi' ),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'prefix',
				'sub_toggle'  => 'general',
				'default'     => 'off|0px|0px|0px|0px',
			),
			'prefix_stroke'       => array(
				'label'          => esc_html__( 'Text Stroke', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define the weight of prefix text stroke.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 20,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'prefix',
				'sub_toggle'     => 'text',
			),
			'prefix_stroke_color' => array(
				'label'       => esc_html__( 'Stroke Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Pick a color to use for the prefix text stroke.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'prefix',
				'sub_toggle'  => 'text',
			),
		);

		$animated_text = array(
			'animated_padding'      => array(
				'label'          => __( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom padding for the animated text.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'animated_text',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'animated_margin'       => array(
				'label'          => __( 'Margin', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom margin for the animated text.', 'addons-for-divi' ),
				'type'           => 'custom_margin',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'animated_text',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'animated_bg'           => array(
				'label'          => esc_html__( 'Background', 'addons-for-divi' ),
				'description'    => esc_html__( 'Pick a color to use for the animated text background.', 'addons-for-divi' ),
				'type'           => 'color-alpha',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'animated_text',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'animated_radius'       => array(
				'label'       => esc_html__( 'Border Radius', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a border radius value for the animated text.', 'addons-for-divi' ),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'animated_text',
				'sub_toggle'  => 'general',
				'default'     => 'off|0px|0px|0px|0px',
			),
			'animated_stroke'       => array(
				'label'          => esc_html__( 'Text Stroke', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define the weight of animated text stroke.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 20,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'animated_text',
				'sub_toggle'     => 'text',
			),
			'animated_stroke_color' => array(
				'label'       => esc_html__( 'Stroke Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Pick a color to use for the animated text stroke.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'animated_text',
				'sub_toggle'  => 'text',
			),
		);

		$suffix = array(
			'suffix_padding'      => array(
				'label'          => __( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom padding for the suffix text.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'suffix',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'suffix_margin'       => array(
				'label'          => __( 'Margin', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom margin for the suffix text.', 'addons-for-divi' ),
				'type'           => 'custom_margin',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'suffix',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'suffix_bg'           => array(
				'label'          => esc_html__( 'Background', 'addons-for-divi' ),
				'description'    => esc_html__( 'Pick a color to use for the suffix text background.', 'addons-for-divi' ),
				'type'           => 'color-alpha',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'suffix',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
			),
			'suffix_radius'       => array(
				'label'       => esc_html__( 'Border Radius', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a border radius value for the suffix text.', 'addons-for-divi' ),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'suffix',
				'sub_toggle'  => 'general',
				'default'     => 'off|0px|0px|0px|0px',
			),
			'suffix_stroke'       => array(
				'label'          => esc_html__( 'Text Stroke', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define the weight of suffix text stroke.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 20,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'suffix',
				'sub_toggle'     => 'text',
			),
			'suffix_stroke_color' => array(
				'label'       => esc_html__( 'Stroke Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Pick a color to use for the suffix text stroke.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'suffix',
				'sub_toggle'  => 'text',
			),
		);

		$cursor = array(
			'cursor_gap'    => array(
				'label'          => esc_html__( 'Spacing Gap', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define spacing between text and cursor pointer.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '8px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'cursor',
				'show_if'        => array(
					'animation_type' => 'typed',
					'show_cursor'    => 'on',
				),
			),
			'cursor_width'  => array(
				'label'          => esc_html__( 'Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define custom width for the cursor pointer.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '3px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'cursor',
				'show_if'        => array(
					'animation_type' => 'typed',
					'show_cursor'    => 'on',
				),
			),
			'cursor_height' => array(
				'label'          => esc_html__( 'Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define custom height for the cursor pointer.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '100%',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'cursor',
				'show_if'        => array(
					'animation_type' => 'typed',
					'show_cursor'    => 'on',
				),
			),
			'cursor_color'  => array(
				'label'       => esc_html__( 'Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Pick a color to use for the cursor pointer.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#333333',
				'toggle_slug' => 'cursor',
				'show_if'     => array(
					'animation_type' => 'typed',
					'show_cursor'    => 'on',
				),
			),
		);

		return array_merge(
			$content,
			$settings,
			$typed_settings,
			$tilt_settings,
			$slide_settings,
			$general,
			$prefix,
			$animated_text,
			$suffix,
			$cursor
		);
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'margin'    => '%%order_class%%',
				'padding'   => '%%order_class%%',
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['animated'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-animated-text-head',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'header_level'    => array(
				'default' => 'h3',
			),
			'font_size'       => array(
				'default' => '22px',
			),
		);

		$advanced_fields['fonts']['prefix'] = array(
			'label'           => esc_html__( 'Prefix', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-module .dtq-animated-text-prefix',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'prefix',
			'sub_toggle'      => 'text',
		);

		$advanced_fields['fonts']['suffix'] = array(
			'label'           => esc_html__( 'Suffix', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-module .dtq-animated-text-suffix',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'suffix',
			'sub_toggle'      => 'text',
		);

		$advanced_fields['fonts']['main'] = array(
			'label'           => esc_html__( 'Animated', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-module .dtq-animated-text-main, %%order_class%% .dtq-module .dtq-animated-text-tilt',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'animated_text',
			'sub_toggle'      => 'text',
		);

		return $advanced_fields;
	}

	protected function render_prefix() {
		if ( ! empty( $this->props['prefix'] ) ) {
			return sprintf(
				'<div class="dtq-animated-text-prefix"><span>%1$s</span>%2$s</div>',
				$this->props['prefix'],
				'inline' === $this->props['layout'] ? '&nbsp;' : ''
			);
		}
	}

	protected function render_suffix() {
		if ( ! empty( $this->props['suffix'] ) ) {
			return sprintf(
				'<div class="dtq-animated-text-suffix">%2$s<span>%1$s</span></div>',
				$this->props['suffix'],
				'inline' === $this->props['layout'] ? '&nbsp;' : ''
			);
		}
	}

	protected function render_animation_html() {

		$animated_text = str_replace(
			array( '&#91;', '&#93;' ),
			array( '[', ']' ),
			$this->props['animated_text']
		);

		$json  = json_decode( $animated_text );
		$items = '';

		foreach ( $json as $item ) {
			$items = $items . '<li>' . $item->value . '</li>';
		}

		if ( 'typed' === $this->props['animation_type'] ) {
			return '<div class="dtq-text-animation dtq-animated-text-main dtq-typed-text"></div>';
		} elseif ( 'tilt' === $this->props['animation_type'] ) {
			return sprintf(
				'<div class="dtq-animated-text-tilt">
					<ul class="texts dtq-animated-text-main">%1$s</ul>
				</div>',
				$items
			);
		} elseif ( 'slide' === $this->props['animation_type'] ) {
			return sprintf(
				'<ul class="dtq-animated-text-slide dtq-animated-text-main">%1$s</ul>',
				$items
			);
		}
	}

	public function render( $attrs, $content, $render_slug ) {

		$this->apply_css( $render_slug );

		$animation_type = $this->props['animation_type'];
		$animated_level = et_pb_process_header_level( $this->props['animated_level'], 'h3' );
		$animated_level = esc_html( $animated_level );
		$order_class    = self::get_module_order_class( $render_slug );
		$order_number   = str_replace( '_', '', str_replace( $this->slug, '', $order_class ) );
		$settings       = array();

		if ( 'typed' === $animation_type ) {
			wp_enqueue_script( 'dtqj-typed' );
			$animated_text = str_replace(
				array( '&#91;', '&#93;' ),
				array( '[', ']' ),
				$this->props['animated_text']
			);

			$json  = json_decode( $animated_text );
			$items = array();

			foreach ( $json as $item ) {
				array_push( $items, $item->value );
			}

			$settings['strings']    = $items;
			$settings['showCursor'] = false;
			$settings['loop']       = 'on' === $this->props['use_loop'] ? true : false;
			$settings['typeSpeed']  = intval( $this->props['animation_speed'] );
			$settings['startDelay'] = intval( $this->props['start_delay'] );
			$settings['backSpeed']  = intval( $this->props['back_speed'] );
			$settings['backDelay']  = intval( $this->props['back_delay'] );
			$settings['showCursor'] = true;

		} elseif ( 'tilt' === $animation_type ) {
			wp_enqueue_script( 'dtqj-text-animation' );

			$tilt_sync    = explode( '|', $this->props['tilt_sync'] );
			$tilt_reverse = explode( '|', $this->props['tilt_reverse'] );
			$tilt_shuffle = explode( '|', $this->props['tilt_shuffle'] );

			// Settings.
			$settings['loop'] = true;
			// Tilt in.
			$settings['in']['effect']     = $this->props['tilt_in'];
			$settings['in']['delayScale'] = 1.5;
			$settings['in']['delay']      = intval( $this->props['tilt_delay'] );
			$settings['in']['sync']       = 'on' === $tilt_sync[0] ? true : false;
			$settings['in']['reverse']    = 'on' === $tilt_reverse[0] ? true : false;
			$settings['in']['shuffle']    = 'on' === $tilt_shuffle[0] ? true : false;
			// Tilt Out.
			$settings['out']['effect']     = $this->props['tilt_out'];
			$settings['out']['delayScale'] = 1.5;
			$settings['out']['delay']      = intval( $this->props['tilt_delay'] );
			$settings['out']['sync']       = 'on' === $tilt_sync[1] ? true : false;
			$settings['out']['reverse']    = 'on' === $tilt_reverse[1] ? true : false;
			$settings['out']['shuffle']    = 'on' === $tilt_shuffle[1] ? true : false;
		} elseif ( 'slide' === $this->props['animation_type'] ) {
			$settings['slide_gap'] = $this->props['slide_gap'];
		}

		$data_settings = sprintf( 'data-settings="%1$s"', htmlspecialchars( wp_json_encode( $settings ), ENT_QUOTES, 'UTF-8' ) );

		return sprintf(
			'<div id="dtq-animated-text-%3$s" class="dtq-module dtq-animated-text dtq-front" %2$s data-type="%7$s">
				<%1$s class="dtq-animated-text-head">
					%4$s %5$s %6$s
				</%1$s>
			</div>',
			$animated_level,
			$data_settings,
			$order_number,
			$this->render_prefix(),
			$this->render_animation_html(),
			$this->render_suffix(),
			$this->props['animation_type']
		);
	}

	public function apply_css( $render_slug ) {

		$this->get_responsive_styles(
			'text_alignment',
			'%%order_class%%',
			array( 'primary' => 'text-align' ),
			array( 'default' => 'left' ),
			$render_slug
		);

		if ( 'inline' === $this->props['layout'] ) {
			$this->get_responsive_styles(
				'text_alignment',
				'%%order_class%% .dtq-animated-text-head',
				array( 'primary' => 'justify-content' ),
				array( 'default' => 'left' ),
				$render_slug
			);
		}

		// Prefix.
		if ( ! empty( $this->props['prefix_stroke'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-prefix span',
					'declaration' => sprintf(
						' -webkit-text-stroke-width: %1$s;
                    	-webkit-text-stroke-color: %2$s;',
						$this->props['prefix_stroke'],
						$this->props['prefix_stroke_color']
					),
				)
			);
		}

		if ( ! empty( $this->props['prefix_text_color'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-prefix span',
					'declaration' => sprintf(
						' -webkit-text-fill-color: %1$s;',
						$this->props['prefix_text_color']
					),
				)
			);
		}

		$this->get_responsive_styles(
			'prefix_padding',
			'%%order_class%% .dtq-module .dtq-animated-text-prefix span',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'prefix_margin',
			'%%order_class%% .dtq-module .dtq-animated-text-prefix span',
			array( 'primary' => 'margin' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'prefix_bg',
			'%%order_class%% .dtq-module .dtq-animated-text-prefix span',
			array( 'primary' => 'background' ),
			array( 'default' => 'transparent' ),
			$render_slug
		);

		$prefix_radius = explode( '|', $this->props['prefix_radius'] );
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-prefix span',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$prefix_radius[1],
					$prefix_radius[2],
					$prefix_radius[3],
					$prefix_radius[4]
				),
			)
		);

		// Suffix.
		if ( ! empty( $this->props['suffix_stroke'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-suffix span',
					'declaration' => sprintf(
						' -webkit-text-stroke-width: %1$s;
                    	-webkit-text-stroke-color: %2$s;',
						$this->props['suffix_stroke'],
						$this->props['suffix_stroke_color']
					),
				)
			);
		}

		if ( ! empty( $this->props['suffix_text_color'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-suffix span',
					'declaration' => sprintf(
						' -webkit-text-fill-color: %1$s;',
						$this->props['suffix_text_color']
					),
				)
			);
		}

		$this->get_responsive_styles(
			'suffix_padding',
			'%%order_class%% .dtq-module .dtq-animated-text-suffix span',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'suffix_margin',
			'%%order_class%% .dtq-module .dtq-animated-text-suffix span',
			array( 'primary' => 'margin' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'suffix_bg',
			'%%order_class%% .dtq-module .dtq-animated-text-suffix span',
			array( 'primary' => 'background' ),
			array( 'default' => 'transparent' ),
			$render_slug
		);

		$suffix_radius = explode( '|', $this->props['suffix_radius'] );
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-suffix span',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$suffix_radius[1],
					$suffix_radius[2],
					$suffix_radius[3],
					$suffix_radius[4]
				),
			)
		);

		// Animated Text.
		if ( ! empty( $this->props['animated_stroke'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-main',
					'declaration' => sprintf(
						' -webkit-text-stroke-width: %1$s;
                    	-webkit-text-stroke-color: %2$s;',
						$this->props['animated_stroke'],
						$this->props['animated_stroke_color']
					),
				)
			);
		}

		if ( ! empty( $this->props['main_text_color'] ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-main',
					'declaration' => sprintf(
						' -webkit-text-fill-color: %1$s;',
						$this->props['main_text_color']
					),
				)
			);
		}

		$this->get_responsive_styles(
			'animated_padding',
			'%%order_class%% .dtq-module .dtq-animated-text-main',
			array( 'primary' => 'padding' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'animated_margin',
			'%%order_class%% .dtq-module .dtq-animated-text-main',
			array( 'primary' => 'margin' ),
			array( 'default' => '0|0|0|0' ),
			$render_slug
		);

		$this->get_responsive_styles(
			'animated_bg',
			'%%order_class%% .dtq-module .dtq-animated-text-main',
			array( 'primary' => 'background' ),
			array( 'default' => 'transparent' ),
			$render_slug
		);

		$animated_radius = explode( '|', $this->props['animated_radius'] );
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-module .dtq-animated-text-main',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$animated_radius[1],
					$animated_radius[2],
					$animated_radius[3],
					$animated_radius[4]
				),
			)
		);

		// Cursor.
		if ( 'on' === $this->props['show_cursor'] ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-text-animation:after',
					'declaration' => sprintf(
						'display: block;
						right: -%1$s;
						width: %2$s;
						background: %3$s;
						height: %4$s;',
						$this->props['cursor_gap'],
						$this->props['cursor_width'],
						$this->props['cursor_color'],
						$this->props['cursor_height']
					),
				)
			);
		}

		// Others.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-animated-text-slide li.text-in',
				'declaration' => sprintf(
					'animation: %1$s 700ms;',
					$this->props['slide_animation']
				),
			)
		);

		if ( 'inline' === $this->props['layout'] ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-animated-text-head',
					'declaration' => 'display: flex; align-items: center;',
				)
			);
		}

	}
}

new DTQ_AnimatedText();
