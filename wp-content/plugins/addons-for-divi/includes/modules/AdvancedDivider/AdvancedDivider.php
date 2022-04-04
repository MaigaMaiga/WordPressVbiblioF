<?php
class DTQ_Advanced_Divider extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/advanced-divider-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_advanced_divider';
		$this->name       = esc_html__( 'Torque Divider', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'advanced-divider.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'addons-for-divi' ),
					'text_mask'    => esc_html__( 'Mask', 'addons-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'divider'   => esc_html__( 'Divider', 'addons-for-divi' ),
					'text'      => array(
						'title'             => esc_html__( 'Divider Text', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__( 'General', 'addons-for-divi' ),
							),
							'typo'    => array(
								'name' => esc_html__( 'Typography', 'addons-for-divi' ),
							),
						),
					),
					'icon'      => esc_html__( 'Icon/Image', 'addons-for-divi' ),
					'border'    => esc_html__( 'Border', 'addons-for-divi' ),
					'text_mask' => esc_html__( 'Mask', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'title'  => array(
				'label'    => esc_html__( 'Divider Text', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-divider__text span',
			),
			'icon'   => array(
				'label'    => esc_html__( 'Divider Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-divider__icon i',
			),
			'image'  => array(
				'label'    => esc_html__( 'Divider Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-divider__image img',
			),
			'border' => array(
				'label'    => esc_html__( 'Divider Border', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-divider__border',
			),
		);
	}

	public function get_fields() {

		$content = array(
			'active_element' => array(
				'label'       => esc_html__( 'Divider Element', 'addons-for-divi' ),
				'description' => esc_html__( 'You can insert an element like text, icon, or image on the divider', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'main_content',
				'default'     => 'icon',
				'options'     => array(
					'text'  => esc_html__( 'Text', 'addons-for-divi' ),
					'icon'  => esc_html__( 'Icon', 'addons-for-divi' ),
					'image' => esc_html__( 'Image', 'addons-for-divi' ),
				),
			),
			'img_url'        => array(
				'label'              => esc_html__( 'Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image for divider, or type in the URL to the image you would like to display', 'addons-for-divi' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'main_content',
				'show_if'            => array(
					'active_element' => 'image',
				),
			),
			'title'          => array(
				'label'           => esc_html__( 'Divider Text', 'addons-for-divi' ),
				'description'     => esc_html__( 'Text will appear on the divider', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'active_element' => 'text',
				),
			),
			'icon'           => array(
				'label'           => esc_html__( 'Select Icon', 'addons-for-divi' ),
				'description'     => esc_html__( 'Choose an icon to display with your divider', 'addons-for-divi' ),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
				'default'         => '&#xe0ed;||divi||400',
				'show_if'         => array(
					'active_element' => 'icon',
				),
			),
			'use_mask'       => array(
				'label'           => esc_html__( 'Use Mask', 'addons-for-divi' ),
				'description'     => esc_html__( 'Select whether you want to use the mask or not', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'text_mask',
				'show_if_not'     => array(
					'active_element' => 'image',
				),
			),
			'mask_url'       => array(
				'label'              => esc_html__( 'Upload Mask Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload an image for the masking, or type in the URL to the image you would like to show into the masking', 'addons-for-divi' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'text_mask',
				'show_if'            => array(
					'active_element' => array( 'icon', 'text' ),
					'use_mask'       => 'on',
				),
			),
		);

		$divider = array(
			'content_alignment' => array(
				'label'           => esc_html__( 'Content Alignment', 'addons-for-divi' ),
				'description'     => esc_html__( 'This controls how your content is aligned within the divider', 'addons-for-divi' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'    => 'module_align',
				'default'         => 'center',
				'toggle_slug'     => 'divider',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
			),
			'use_shape'         => array(
				'label'           => esc_html__( 'Use Bottom Shape', 'addons-for-divi' ),
				'description'     => esc_html__( 'Insert a shape on the divider bottom', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'divider',
			),
			'shape'             => array(
				'label'       => esc_html__( 'Select Shape', 'addons-for-divi' ),
				'description' => esc_html__( 'Choice your desire shape for the divider bottom', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'divider',
				'default'     => 'shape_1',
				'options'     => array(
					'shape_1'  => esc_html__( 'Shape 1', 'addons-for-divi' ),
					'shape_2'  => esc_html__( 'Shape 2', 'addons-for-divi' ),
					'shape_3'  => esc_html__( 'Shape 3', 'addons-for-divi' ),
					'shape_4'  => esc_html__( 'Shape 4', 'addons-for-divi' ),
					'shape_5'  => esc_html__( 'Shape 5', 'addons-for-divi' ),
					'shape_6'  => esc_html__( 'Shape 6', 'addons-for-divi' ),
					'shape_7'  => esc_html__( 'Shape 7', 'addons-for-divi' ),
					'shape_8'  => esc_html__( 'Shape 8', 'addons-for-divi' ),
					'shape_9'  => esc_html__( 'Shape 9', 'addons-for-divi' ),
					'shape_10' => esc_html__( 'Shape 10', 'addons-for-divi' ),
					'shape_11' => esc_html__( 'Shape 11', 'addons-for-divi' ),
					'shape_12' => esc_html__( 'Shape 12', 'addons-for-divi' ),
					'shape_13' => esc_html__( 'Shape 13', 'addons-for-divi' ),
					'shape_14' => esc_html__( 'Shape 14', 'addons-for-divi' ),
					'shape_15' => esc_html__( 'Shape 15', 'addons-for-divi' ),
					'shape_16' => esc_html__( 'Shape 16', 'addons-for-divi' ),
					'shape_17' => esc_html__( 'Shape 17', 'addons-for-divi' ),
					'shape_18' => esc_html__( 'Shape 18', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'use_shape' => 'on',
				),
			),
			'shape_width'       => array(
				'label'          => esc_html__( 'Shape Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease default divider bottom shape width', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '280px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 800,
				),
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
			'shape_weight'      => array(
				'label'          => esc_html__( 'Shape Weight', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease default divider bottom shape weight', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '1',
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 8,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
			'shape_color'       => array(
				'label'       => esc_html__( 'Shape Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Choose your desired color for the divider bottom shape', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'divider',
				'default'     => '#333333',
				'show_if'     => array(
					'use_shape' => 'on',
				),
			),
			'shape_margin'      => array(
				'label'          => esc_html__( 'Shape Margin', 'addons-for-divi' ),
				'description'    => esc_html__( 'Shape Margin adds extra space to the outside of the elements, increasing the distance between the element and other items on the page These controls help you to put divider bottom shape on your desire position', 'addons-for-divi' ),
				'type'           => 'custom_margin',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
		);

		$icon_img = array(
			'icon_color'   => array(
				'label'       => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Choose your desired color for the divider icon', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => $this->default_color,
				'show_if'     => array(
					'active_element' => 'icon',
					'use_mask'       => 'off',
				),
			),
			'icon_bg'      => array(
				'label'       => esc_html__( 'Icon Background', 'addons-for-divi' ),
				'description' => esc_html__( 'Set the background color of divider icon', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'show_if'     => array(
					'active_element' => 'icon',
					'use_mask'       => 'off',
				),
			),
			'icon_size'    => array(
				'label'          => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease the size of divider icon', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '40px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'icon',
				),
			),
			'icon_padding' => array(
				'label'          => esc_html__( 'Icon Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Icon padding adds extra space to the inside of the icon, increasing the distance between the edge of the icon', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'icon',
				),
			),
			'img_width'    => array(
				'label'          => esc_html__( 'Image Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease divider image width. This control helps you to reduce or extend the image size', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '100px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 500,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'image',
				),
			),
		);

		$border = array(
			'border_type'          => array(
				'label'       => esc_html__( 'Border Type', 'addons-for-divi' ),
				'description' => esc_html__( 'Select different types of border for the divider', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'classic',
				'options'     => array(
					'none'    => esc_html__( 'None', 'addons-for-divi' ),
					'classic' => esc_html__( 'Classic', 'addons-for-divi' ),
					'pattern' => esc_html__( 'Pattern', 'addons-for-divi' ),
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_style_classic' => array(
				'label'       => esc_html__( 'Border Style', 'addons-for-divi' ),
				'description' => esc_html__( 'Select different types of border style for the divider', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'double',
				'options'     => array(
					'solid'  => esc_html__( 'Solid', 'addons-for-divi' ),
					'double' => esc_html__( 'Double', 'addons-for-divi' ),
					'dotted' => esc_html__( 'Dotted', 'addons-for-divi' ),
					'dashed' => esc_html__( 'Dashed', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'border_type' => 'classic',
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_style_pattern' => array(
				'label'       => esc_html__( 'Border Style', 'addons-for-divi' ),
				'description' => esc_html__( 'Select different types of border style for the divider', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'curved',
				'options'     => array(
					'curved' => esc_html__( 'Curved', 'addons-for-divi' ),
					'zigzag' => esc_html__( 'Zigzag', 'addons-for-divi' ),
					'square' => esc_html__( 'Square', 'addons-for-divi' ),
					'curly'  => esc_html__( 'Curly', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'border_type' => 'pattern',
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_gap'           => array(
				'label'          => esc_html__( 'Border Spacing', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease default divider spacing relative to the divider content', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '20px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_color'         => array(
				'label'       => esc_html__( 'Border Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Choose your desired color for the divider border', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => $this->default_color,
				'show_if_not' => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_weight'        => array(
				'label'          => esc_html__( 'Border Weight', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease divider border weight', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '6px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_height'        => array(
				'label'          => esc_html__( 'Border Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease divider border height', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
				'show_if'        => array(
					'border_type' => 'pattern',
				),
			),
			'border_offset'        => array(
				'label'          => esc_html__( 'Border offset Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Increase or decrease offset value relative to the divider content', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '0px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => -50,
					'step' => 1,
					'max'  => 50,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
		);

		$mask_style = array(
			'mask_repeat' => array(
				'label'       => esc_html__( 'Image Repeat', 'addons-for-divi' ),
				'description' => esc_html__( ' Select whether you want to repeat mask image or not', 'addons-for-divi' ),
				'type'        => 'select',
				'options'     => array(
					'repeat'    => esc_html__( 'Repeat', 'addons-for-divi' ),
					'no-repeat' => esc_html__( 'No Repeat', 'addons-for-divi' ),
				),
				'default'     => 'repeat',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
			'mask_size'   => array(
				'label'       => esc_html__( 'Image Size', 'addons-for-divi' ),
				'description' => esc_html__( 'Select mask image size', 'addons-for-divi' ),
				'type'        => 'select',
				'options'     => array(
					'contain' => esc_html__( 'Actual Size', 'addons-for-divi' ),
					'cover'   => esc_html__( 'Fit', 'addons-for-divi' ),
				),
				'default'     => 'cover',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
			'mask_pos'    => array(
				'label'       => esc_html__( 'Image Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Select the mask image position', 'addons-for-divi' ),
				'type'        => 'select',
				'options'     => array(
					'left top'      => esc_html__( 'Left Top', 'addons-for-divi' ),
					'left center'   => esc_html__( 'Left Center', 'addons-for-divi' ),
					'left bottom'   => esc_html__( 'Left Bottom', 'addons-for-divi' ),
					'right top'     => esc_html__( 'Right Top', 'addons-for-divi' ),
					'right center'  => esc_html__( 'Right Center', 'addons-for-divi' ),
					'right bottom'  => esc_html__( 'Right Bottom', 'addons-for-divi' ),
					'center top'    => esc_html__( 'Center Top', 'addons-for-divi' ),
					'center center' => esc_html__( 'Center Center', 'addons-for-divi' ),
					'center bottom' => esc_html__( ' Center Bottom', 'addons-for-divi' ),
					'custom'        => esc_html__( 'Custom Position', 'addons-for-divi' ),
				),
				'default'     => 'center center',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
			'mask_hz_pos' => array(
				'label'       => esc_html__( 'Horizontal  Value', 'addons-for-divi' ),
				'description' => esc_html__( 'Set horizontal masking image position value', 'addons-for-divi' ),
				'type'        => 'text',
				'default'     => '0%',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'mask_pos'       => 'custom',
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
			'mask_vr_pos' => array(
				'label'       => esc_html__( 'Vertical  Value', 'addons-for-divi' ),
				'description' => esc_html__( 'Set vertical masking image position value', 'addons-for-divi' ),
				'type'        => 'text',
				'default'     => '0%',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'text_mask',
				'show_if'     => array(
					'mask_pos'       => 'custom',
					'use_mask'       => 'on',
					'active_element' => array( 'icon', 'text' ),
				),
			),
		);

		$text_style = array(
			'text_padding'    => array(
				'label'          => esc_html__( 'Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Text padding adds extra space to the inside of the text, increasing the distance between the edge of the text', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'text',
				'sub_toggle'     => 'general',
			),
			'text_background' => array(
				'label'          => esc_html__( 'Background', 'addons-for-divi' ),
				'description'    => esc_html__( 'Set the background color of divider text', 'addons-for-divi' ),
				'type'           => 'color-alpha',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'sub_toggle'     => 'general',
				'toggle_slug'    => 'text',
			),
			'text_radius'     => array(
				'label'          => esc_html__( 'Border Radius', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can control the corner radius of the text. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'addons-for-divi' ),
				'type'           => 'border-radius',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'text',
				'sub_toggle'     => 'general',
				'default'        => 'off|0|0|0|0',
			),
		);

		return array_merge( $content, $border, $text_style, $icon_img, $divider, $mask_style );
	}

	public function get_advanced_fields_config() {
		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['borders']     = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtq-divider__text',
				'important' => 'all',
			),
			'header_level'    => array(
				'default' => 'h1',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'sub_toggle'      => 'typo',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '30px',
			),
		);

		$advanced_fields['borders']['icon'] = array(
			'toggle_slug' => 'icon',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-divider__element i,%%order_class%% .dtq-divider__element img',
					'border_styles' => '%%order_class%% .dtq-divider__element i,%%order_class%% .dtq-divider__element img',
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

		return $advanced_fields;
	}

	public function render_title() {
		$title                 = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level( $title_level, 'h2' );
		$processed_title_level = esc_html( $processed_title_level );

		if ( ! empty( $title ) ) {
			return sprintf(
				'<%1$s class="dtq-divider__element dtq-divider__text"><span>%2$s</span></%1$s>',
				$processed_title_level,
				$title
			);
		}
	}

	public function render_icon() {
		$icon = $this->props['icon'];
		$icon = esc_attr( et_pb_process_font_icon( $icon ) );

		// Inject Font Awesome Manually!.
		dtq_inject_fa_icons( $this->props['icon'] );

		if ( ! empty( $icon ) ) {
			return sprintf(
				'<div class="dtq-divider__icon dtq-divider__element">
                    <i class="dtq-icon dtq-et-icon">%1$s</i>
                </div>',
				$icon
			);
		}
	}

	public function render_uploaded_image() {
		$img_url = $this->props['img_url'];

		if ( ! empty( $img_url ) ) {
			return sprintf(
				'
                <div class="dtq-divider__image dtq-divider__element">
                    <img src="%1$s" alt="" />
                </div>',
				$img_url
			);
		}
	}

	public function render_element() {
		$active_element = $this->props['active_element'];
		if ( 'text' === $active_element ) {
			return $this->render_title();
		} elseif ( 'icon' === $active_element ) {
			return $this->render_icon();
		} elseif ( 'image' === $active_element ) {
			return $this->render_uploaded_image();
		}
	}

	public function render_left_border() {
		$use_shape = $this->props['use_shape'];
		if ( 'off' === $use_shape ) {
			return '<div class="dtq-divider__border dtq-divider__border-start"></div>';
		}
	}

	public function render_right_border() {
		$use_shape = $this->props['use_shape'];
		if ( 'off' === $use_shape ) {
			return '<div class="dtq-divider__border dtq-divider__border-end"></div>';
		}
	}

	public function render_shape() {
		include 'shapes.php';

		$use_shape = $this->props['use_shape'];
		$shape     = $this->props['shape'];

		if ( 'on' === $use_shape ) {
			return '<div class="dtq-divider__shape">' . $shapes[ $shape ] . '</div>';
		}
	}

	public function render( $attrs, $content, $render_slug ) {

		$this->render_css( $render_slug );

		return sprintf(
			'<div class="dtq-module dtq-divider">
                %1$s
                %2$s
                %3$s
                %4$s
            </div>',
			$this->render_left_border(),
			$this->render_element(),
			$this->render_right_border(),
			$this->render_shape()
		);
	}

	protected function render_css( $render_slug ) {

		$use_mask                            = $this->props['use_mask'];
		$mask_url                            = $this->props['mask_url'];
		$active_element                      = $this->props['active_element'];
		$content_alignment                   = $this->props['content_alignment'];
		$content_alignment_tablet            = $this->props['content_alignment_tablet'];
		$content_alignment_phone             = $this->props['content_alignment_phone'];
		$content_alignment_last_edited       = $this->props['content_alignment_last_edited'];
		$content_alignment_responsive_status = et_pb_get_responsive_status( $content_alignment_last_edited );
		$border_gap                          = $this->props['border_gap'];
		$mask_size                           = $this->props['mask_size'];
		$mask_pos                            = $this->props['mask_pos'];
		$mask_hz_pos                         = $this->props['mask_hz_pos'];
		$mask_vr_pos                         = $this->props['mask_vr_pos'];
		$icon_color                          = $this->props['icon_color'];
		$icon_size                           = $this->props['icon_size'];
		$icon_bg                             = $this->props['icon_bg'];
		$img_width                           = $this->props['img_width'];
		$border_type                         = $this->props['border_type'];
		$border_style_classic                = $this->props['border_style_classic'];
		$border_style_pattern                = $this->props['border_style_pattern'];
		$border_height                       = $this->props['border_height'];
		$border_color                        = $this->props['border_color'];
		$border_weight                       = $this->props['border_weight'];
		$mask_repeat                         = $this->props['mask_repeat'];
		$use_shape                           = $this->props['use_shape'];
		$shape_weight                        = $this->props['shape_weight'];
		$shape_color                         = $this->props['shape_color'];

		if ( 'image' !== $active_element
			&& 'on' === $use_mask
			&& ! empty( $mask_url )
		) {

			$selector = '%%order_class%% .dtq-divider__icon i';
			if ( 'text' === $active_element ) {
				$selector = '%%order_class%% .dtq-divider__text';
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => sprintf(
						'
                    color: transparent!important;
                    background-image: url("%1$s");
                    background-size: %2$s;
                    background-repeat: %3$s;
                    -webkit-background-clip: text;
                    -moz-background-clip: text;
                    -o-background-clip: text;
                    background-clip: text;',
						$mask_url,
						$mask_size,
						$mask_repeat
					),
				)
			);

			if ( 'custom' !== $mask_pos ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'declaration' => sprintf( 'background-position: %1$s;', $mask_pos ),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'declaration' => sprintf( 'background-position: %1$s %2$s;', $mask_vr_pos, $mask_hz_pos ),
					)
				);
			}
		}

		if ( 'off' === $use_shape ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-divider',
					'declaration' => 'align-items: center;',
				)
			);

			if ( 'left' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-divider__element',
						'declaration' => sprintf( 'padding-right: %1$s;', $border_gap ),
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-divider__border-start',
						'declaration' => 'display: none;',
					)
				);
			} elseif ( 'right' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-divider__element',
						'declaration' => sprintf( 'padding-left: %1$s;', $border_gap ),
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-divider__border-end',
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
						'declaration' => 'display: none;',
					)
				);
			} elseif ( 'center' === $content_alignment ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-divider__element',
						'declaration' => sprintf( 'padding-left: %1$s; padding-right: %1$s;', $border_gap ),
					)
				);
			}

			if ( $content_alignment_tablet && $content_alignment_responsive_status ) {
				if ( 'left' === $content_alignment_tablet ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__element',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => sprintf( 'padding-right: %1$s;', $border_gap ),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-start',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => 'display: none;',
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => 'display: block;',
						)
					);
				} elseif ( 'right' === $content_alignment_tablet ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__element',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => sprintf( 'padding-left: %1$s;', $border_gap ),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => 'display: none;',
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-start',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => 'display: block;',
						)
					);
				} elseif ( 'center' === $content_alignment_tablet ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__element',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => sprintf( 'padding-left: %1$s; padding-right: %1$s;', $border_gap ),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-start, %%order_class%% .dtq-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
							'declaration' => 'display: block;',
						)
					);
				}
			}

			if ( $content_alignment_phone && $content_alignment_responsive_status ) {
				if ( 'left' === $content_alignment_phone ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__element',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => sprintf( 'padding-right: %1$s;', $border_gap ),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-start',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => 'display: none;',
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => 'display: block;',
						)
					);
				} elseif ( 'right' === $content_alignment_phone ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__element',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => sprintf( 'padding-left: %1$s;', $border_gap ),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => 'display: none;',
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-start',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => 'display: block;',
						)
					);
				} elseif ( 'center' === $content_alignment_phone ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__element',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => sprintf( 'padding-left: %1$s; padding-right: %1$s;', $border_gap ),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border-start, %%order_class%% .dtq-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
							'declaration' => 'display: block;',
						)
					);
				}
			}

			 // Border Offset.
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-divider__border',
					'declaration' => sprintf(
						'margin-top: %1$s;',
						$this->props['border_offset']
					),
				)
			);

			// Border type.
			if ( 'none' !== $border_type ) {
				if ( '#' === $border_color[0] ) {
					$border_color = $this->hex_to_rgb( $border_color );
				}

				if ( 'classic' === $border_type ) {

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border',
							'declaration' => sprintf(
								'border-top: %1$s %2$s %3$s;',
								$border_weight,
								$border_style_classic,
								$border_color
							),
						)
					);
				} elseif ( 'pattern' === $border_type ) {

					$pattern_bg = $this->get_pattern( $border_style_pattern, $border_color, $border_weight );

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__border',
							'declaration' => sprintf(
								'background-image: url("%1$s");
                            	height: %2$s;
                            	background-size: %2$s 100%%;',
								$pattern_bg,
								$border_height
							),
						)
					);
				}
			}
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-divider',
					'declaration' => 'flex-direction: column;',
				)
			);

			$this->get_responsive_styles(
				'content_alignment',
				'%%order_class%% .dtq-divider',
				array( 'primary' => 'align-items' ),
				array( 'default' => 'center' ),
				$render_slug
			);

			// shape margin.
			$this->get_responsive_styles(
				'shape_margin',
				'%%order_class%% .dtq-divider__shape',
				array( 'primary' => 'margin' ),
				array( 'default' => '0px|0px|0px|0px' ),
				$render_slug
			);

			// shape width.
			$this->get_responsive_styles(
				'shape_width',
				'%%order_class%% .dtq-divider__shape svg',
				array(
					'primary'   => 'width',
					'important' => true,
				),
				array( 'default' => '280px' ),
				$render_slug
			);

			// shape weight & color.
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-divider__shape svg *',
					'declaration' => "stroke-width: {$shape_weight}!important;stroke: {$shape_color}!important;",
				)
			);

		}

		// Icon.
		if ( 'icon' === $active_element ) {

			$this->generate_styles(
				array(
					'utility_arg'    => 'icon_font_family',
					'render_slug'    => $render_slug,
					'base_attr_name' => 'icon',
					'important'      => true,
					'selector'       => '%%order_class%% .dtq-divider__icon i',
					'processor'      => array(
						'ET_Builder_Module_Helper_Style_Processor',
						'process_extended_icon',
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-divider__icon i',
					'declaration' => sprintf(
						'
                    font-size: %1$s;',
						$icon_size
					),
				)
			);

			$this->get_responsive_styles(
				'icon_padding',
				'%%order_class%% .dtq-divider__icon i',
				array( 'primary' => 'padding' ),
				array( 'default' => '0px|0px|0px|0px' ),
				$render_slug
			);

			if ( 'off' === $use_mask ) {

				if ( ! empty( $icon_bg ) ) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtq-divider__icon i',
							'declaration' => sprintf(
								'background: %1$s;',
								$icon_bg
							),
						)
					);
				}

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-divider__icon i',
						'declaration' => sprintf(
							'color: %1$s;',
							$icon_color
						),
					)
				);
			}
		}

		// image.
		if ( 'image' === $active_element ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-divider__element img',
					'declaration' => sprintf(
						'width: %1$s;',
						$img_width
					),
				)
			);
		}

		// Text Style.
		$this->get_responsive_styles(
			'text_padding',
			'%%order_class%% .dtq-divider__text span',
			array( 'primary' => 'padding' ),
			array( 'default' => '0px|0px|0px|0px' ),
			$render_slug
		);

		if ( ! empty( $this->props['text_background'] ) ) {
			$this->get_responsive_styles(
				'text_background',
				'%%order_class%% .dtq-divider__text span',
				array( 'primary' => 'background' ),
				array( 'default' => 'transparent' ),
				$render_slug
			);
		}

		$text_radius = explode( '|', $this->props['text_radius'] );
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-divider__text span',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$text_radius[1],
					$text_radius[2],
					$text_radius[3],
					$text_radius[4]
				),
			)
		);

	}
}


new DTQ_Advanced_Divider();
