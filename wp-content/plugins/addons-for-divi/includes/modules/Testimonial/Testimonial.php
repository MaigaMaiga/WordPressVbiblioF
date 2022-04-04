<?php
class DTQ_Testimonial extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/testimonial-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_testimonial';
		$this->name       = esc_html__( 'Torque Testimonial', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'testimonial.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__( 'Content', 'addons-for-divi' ),
					'elements' => esc_html__( 'Elements', 'addons-for-divi' ),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'common'     => esc_html__( 'General', 'addons-for-divi' ),
					'quote_icon' => esc_html__( 'Quote Icon', 'addons-for-divi' ),
					'image'      => esc_html__( 'Reviewer Image', 'addons-for-divi' ),
					'rating'     => esc_html__( 'Rating', 'addons-for-divi' ),
					'name'       => esc_html__( 'Name Text', 'addons-for-divi' ),
					'title'      => esc_html__( 'Title Text', 'addons-for-divi' ),
					'review'     => esc_html__( 'Review Text', 'addons-for-divi' ),
					'bubble'     => esc_html__( 'Bubble', 'addons-for-divi' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'image'        => array(
				'label'    => esc_html__( 'Reviewer Wrapper', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-reviewer',
			),
			'image'        => array(
				'label'    => esc_html__( 'Reviewer Image', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-img img',
			),
			'name'         => array(
				'label'    => esc_html__( 'Reviewer Name', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-reviewer-text h3',
			),
			'title'        => array(
				'label'    => esc_html__( 'Reviewer Title', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-reviewer-text .dtq-testimonial-title',
			),
			'rating'       => array(
				'label'    => esc_html__( 'Rating', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-rating',
			),
			'star'         => array(
				'label'    => esc_html__( 'Rating Star', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-rating span',
			),
			'review'       => array(
				'label'    => esc_html__( 'Review', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-review',
			),
			'icon_wrapper' => array(
				'label'    => esc_html__( 'Quote Icon Wrapper', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-icon-wrap',
			),
			'icon'         => array(
				'label'    => esc_html__( 'Quote Icon', 'addons-for-divi' ),
				'selector' => '%%order_class%% .dtq-testimonial-icon-wrap svg',
			),
		);
	}

	public function get_fields() {

		$primary_fields = array(
			'icon_placement' => array(
				'label'       => esc_html__( 'Icon Placement', 'addons-for-divi' ),
				'description' => esc_html__( 'Define Placement for the quote icon.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'quote_icon',
				'tab_slug'    => 'advanced',
				'default'     => 'background',
				'options'     => array(
					'_default'   => esc_html__( 'Default', 'addons-for-divi' ),
					'absolute'   => esc_html__( 'Absolute', 'addons-for-divi' ),
					'background' => esc_html__( 'Background', 'addons-for-divi' ),
				),
			),
		);

		$fields = array(

			'image'                  => array(
				'label'              => esc_html__( 'Reviewer Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload reviewer image or type in the URL of the image you would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'content',
			),

			'image_alt'              => array(
				'label'       => esc_html__( 'Image Alt Text', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define the HTML ALT text for your image.', 'addons-for-divi' ),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'name'                   => array(
				'label'           => esc_html__( 'Reviewer Name', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the name of the reviewer.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'title'                  => array(
				'label'           => esc_html__( 'Reviewer Title', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the title/position of the reviewer.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
				'description'     => esc_html__( '.', 'addons-for-divi' ),
			),

			'use_rating'             => array(
				'label'           => esc_html__( 'Use Rating', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether rating should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'toggle_slug'     => 'content',
			),

			'rating'                 => array(
				'label'       => esc_html__( 'Rating', 'addons-for-divi' ),
				'description' => esc_html__( 'Define your rating number from the list.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => '5',
				'options'     => array(
					'1' => esc_html__( '1', 'addons-for-divi' ),
					'2' => esc_html__( '2', 'addons-for-divi' ),
					'3' => esc_html__( '3', 'addons-for-divi' ),
					'4' => esc_html__( '4', 'addons-for-divi' ),
					'5' => esc_html__( '5', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'use_rating' => 'on',
				),
			),

			'testimonial'            => array(
				'label'           => esc_html__( 'Review', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the testimonial.', 'addons-for-divi' ),
				'type'            => 'textarea',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'use_custom_icon'        => array(
				'label'           => esc_html__( 'Upload Custom Quote Icon', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether custom icon should be used.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
			),

			'selected_icon'          => array(
				'label'       => esc_html__( 'Select Quote Icon', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define quote icon from the list.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => '5',
				'options'     => array(
					'5' => esc_html__( 'Icon 5', 'addons-for-divi' ),
					'4' => esc_html__( 'Icon 4', 'addons-for-divi' ),
					'3' => esc_html__( 'Icon 3', 'addons-for-divi' ),
					'2' => esc_html__( 'Icon 2', 'addons-for-divi' ),
					'1' => esc_html__( 'Icon 1', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'use_custom_icon' => 'off',
				),
			),

			'icon_img'               => array(
				'label'              => esc_html__( 'Upload Quote Icon Image', 'addons-for-divi' ),
				'description'        => esc_html__( 'Upload your custom quote icon or type in the URL of the icon image you would like to display.', 'addons-for-divi' ),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an Image', 'addons-for-divi' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'addons-for-divi' ),
				'update_text'        => esc_attr__( 'Set As Image', 'addons-for-divi' ),
				'toggle_slug'        => 'content',
				'show_if'            => array(
					'use_custom_icon' => 'on',
				),
			),

			// elements.
			'hide_quote'             => array(
				'label'           => esc_html__( 'Hide Quote Icon', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can choose whether quote should be hidden.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'toggle_slug'     => 'elements',
			),

			'reviewer_position'      => array(
				'label'       => esc_html__( 'Reviewer Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define reviewer position.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'elements',
				'options'     => array(
					'top'    => esc_html__( 'Top', 'addons-for-divi' ),
					'bottom' => esc_html__( 'Bottom', 'addons-for-divi' ),
				),
			),

			'img_position'           => array(
				'label'       => esc_html__( 'Reviewer Image Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define reviewer image position.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'elements',
				'default'     => 'relative',
				'options'     => array(
					'top'      => esc_html__( 'Top', 'addons-for-divi' ),
					'left'     => esc_html__( 'Left', 'addons-for-divi' ),
					'right'    => esc_html__( 'Right', 'addons-for-divi' ),
					'absolute' => esc_html__( 'Absolute', 'addons-for-divi' ),
					'relative' => esc_html__( 'Relative to Reviewer', 'addons-for-divi' ),
				),
			),

			'ratings_position'       => array(
				'label'       => esc_html__( 'Rating Position', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define rating position.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'elements',
				'default'     => '_default',
				'options'     => array(
					'_default' => esc_html__( 'Default', 'addons-for-divi' ),
					'bottom'   => esc_html__( 'Bottom', 'addons-for-divi' ),
					'reviewer' => esc_html__( 'Relative to Reviewer', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'use_rating' => 'on',
				),
			),

			'review_design'          => array(
				'label'       => esc_html__( 'Review Design', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define review design layout.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'elements',
				'default'     => 'normal',
				'options'     => array(
					'normal' => esc_html__( 'Normal', 'addons-for-divi' ),
					'bubble' => esc_html__( 'Bubble', 'addons-for-divi' ),
				),
			),

			// links.
			'website_url'            => array(
				'label'           => esc_html__( 'Personal Website URL', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define personal website URL of the reviewer.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'link_options',
				'tab_slug'        => 'general',
				'dynamic_content' => 'url',

			),
			'company_url'            => array(
				'label'           => esc_html__( 'Company URL', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define company Website URL of the reviewer.', 'addons-for-divi' ),
				'type'            => 'text',
				'toggle_slug'     => 'link_options',
				'tab_slug'        => 'general',
				'dynamic_content' => 'url',

			),

			// General.
			'alignment'              => array(
				'label'        => esc_html__( 'Content Alignment', 'addons-for-divi' ),
				'description'  => esc_html__( 'Align content to the left, right or center.', 'addons-for-divi' ),
				'type'         => 'text_align',
				'options'      => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon' => 'module_align',
				'default'      => 'center',
				'toggle_slug'  => 'common',
				'tab_slug'     => 'advanced',
			),
			'content_padding'        => array(
				'label'          => esc_html__( 'Content Padding', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom padding for the content.', 'addons-for-divi' ),
				'type'           => 'custom_padding',
				'default'        => '30px|30px|30px|30px',
				'mobile_options' => true,
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'img_position' => array( 'left', 'right' ),
				),
			),

			// Quote Icon.
			'icon_alignment'         => array(
				'label'           => esc_html__( 'Icon Alignment', 'addons-for-divi' ),
				'description'     => esc_html__( 'Align icon to the left, right or center.', 'addons-for-divi' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'options_icon'    => 'module_align',
				'default'         => 'center',
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
				'show_if_not'     => array(
					'icon_placement' => 'absolute',
				),
			),
			'icon_color'             => array(
				'label'       => esc_html__( 'Icon Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for your icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'quote_icon',
				'default'     => '#333',
				'show_if'     => array(
					'use_custom_icon' => 'off',
				),
			),
			'icon_bg'                => array(
				'label'       => esc_html__( 'Icon Background', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom background color for your icon.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'quote_icon',
				'default'     => 'transparent',
				'show_if'     => array(
					'use_custom_icon' => 'on',
				),
			),
			'icon_size'              => array(
				'label'           => esc_html__( 'Icon Size', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom size for your icon.', 'addons-for-divi' ),
				'type'            => 'range',
				'default'         => '70px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'mobile_options'  => true,
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
			),
			'icon_opacity'           => array(
				'label'           => esc_html__( 'Icon Opacity', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define the opacity for the icon. Set the value from 0 - 1. The lower value, the more transparent.', 'addons-for-divi' ),
				'type'            => 'range',
				'default'         => '.2',
				'option_category' => 'basic_option',
				'unitless'        => true,
				'range_settings'  => array(
					'min'  => 0,
					'step' => .01,
					'max'  => 1,
				),
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
			),
			'icon_padding'           => array(
				'label'       => esc_html__( 'Icon Padding', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define custom padding for the icon.', 'addons-for-divi' ),
				'type'        => 'custom_padding',
				'default'     => '0px|0px|0px|0px',
				'toggle_slug' => 'quote_icon',
				'tab_slug'    => 'advanced',
				'show_if'     => array(
					'use_custom_icon' => 'off',
				),
			),
			'icon_top_spacing'       => array(
				'label'           => esc_html__( 'Icon Spacing Top', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the top of the icon.', 'addons-for-divi' ),
				'type'            => 'range',
				'default'         => '40px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
				'show_if_not'     => array(
					'icon_placement' => 'absolute',
				),
			),
			'icon_bottom_spacing'    => array(
				'label'           => esc_html__( 'Icon Spacing Bottom', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the bottom of the icon.', 'addons-for-divi' ),
				'type'            => 'range',
				'default'         => '5px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'quote_icon',
				'tab_slug'        => 'advanced',
				'show_if_not'     => array(
					'icon_placement' => 'absolute',
				),
			),

			// image.
			'image_placement'        => array(
				'label'       => esc_html__( 'Image Placement', 'addons-for-divi' ),
				'description' => esc_html__( 'Define reviewer image placement.', 'addons-for-divi' ),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'image',
				'default'     => 'left_top',
				'options'     => array(
					'left_top'     => esc_html__( 'Left Top', 'addons-for-divi' ),
					'left_bottom'  => esc_html__( 'Left Bottom', 'addons-for-divi' ),
					'right_top'    => esc_html__( 'Right Top', 'addons-for-divi' ),
					'right_bottom' => esc_html__( 'Right Bottom', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'img_position' => 'absolute',
				),
			),

			'img_is_center_x'        => array(
				'label'           => esc_html__( 'Use Horizontal Position Center', 'addons-for-divi' ),
				'description'     => esc_html__( 'If enabled reviewer image will be placed horizontally center.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'image',
				'tab_slug'        => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'show_if'         => array(
					'img_position' => 'absolute',
				),
			),

			'img_offset_x'           => array(
				'label'          => esc_html__( 'Image Offset X', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define horizontal offset value.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '50%',
				'range_settings' => array(
					'min'  => -600,
					'max'  => 600,
					'step' => 1,
				),
				'show_if'        => array(
					'img_position'    => 'absolute',
					'img_is_center_x' => 'off',
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),

			'img_is_center_y'        => array(
				'label'           => esc_html__( 'Use Vertical Position Center', 'addons-for-divi' ),
				'description'     => esc_html__( 'If enabled reviewer image will be placed vertically center.', 'addons-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'image',
				'tab_slug'        => 'advanced',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
					'off' => esc_html__( 'No', 'addons-for-divi' ),
				),
				'show_if'         => array(
					'img_position' => 'absolute',
				),
			),

			'img_offset_y'           => array(
				'label'          => esc_html__( 'Image Offset Y', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define vertical offset value.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => -600,
					'max'  => 600,
					'step' => 1,
				),
				'show_if'        => array(
					'img_position'    => 'absolute',
					'img_is_center_y' => 'off',
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',

			),

			'image_placement_alt'    => array(
				'label'       => esc_html__( 'Image Placement', 'addons-for-divi' ),
				'description' => esc_html__( 'Define reviewer image placement.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'image',
				'tab_slug'    => 'advanced',
				'default'     => 'top',
				'options'     => array(
					'top'   => esc_html__( 'Top', 'addons-for-divi' ),
					'left'  => esc_html__( 'Left', 'addons-for-divi' ),
					'right' => esc_html__( 'Right', 'addons-for-divi' ),
				),
				'show_if'     => array(
					'img_position' => 'relative',
				),
			),

			'image_spacing'          => array(
				'label'          => esc_html__( 'Image Spacing Left/Right', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define custom spacing for the image left/right.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'img_position'        => 'relative',
					'image_placement_alt' => array( 'left', 'right' ),
				),
			),

			'image_width'            => array(
				'label'          => esc_html__( 'Image Width', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define static width for the image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 800,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'image_height'           => array(
				'label'          => esc_html__( 'Image Height', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define static height for the image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 800,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'image_spacing_top'      => array(
				'label'          => esc_html__( 'Image Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '10px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 300,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'img_position'        => 'relative',
					'image_placement_alt' => 'top',
				),
			),

			'image_spacing_bottom'   => array(
				'label'          => esc_html__( 'Image Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the image.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '10px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 300,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'image_placement_alt' => 'top',
					'img_position'        => 'relative',
				),
			),

			// rating.
			'ratings_spacing_top'    => array(
				'label'          => esc_html__( 'Rating Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the rating.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '0px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'rating',
				'show_if'        => array(
					'use_rating' => 'on',
				),
			),

			'ratings_spacing_bottom' => array(
				'label'          => esc_html__( 'Rating Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the rating.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '0px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'rating',
				'show_if'        => array(
					'use_rating' => 'on',
				),
			),

			'stars_size'             => array(
				'label'          => esc_html__( 'Stars Size', 'addons-for-divi' ),
				'description'    => esc_html__( 'Control the size of the stars by increasing or decreasing the range.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '20px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'rating',
				'show_if'        => array(
					'use_rating' => 'on',
				),
			),

			'stars_color'            => array(
				'label'       => esc_html__( 'Stars Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for stars.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'rating',
				'default'     => '#F3B325',
				'show_if'     => array(
					'use_rating' => 'on',
				),
			),

			'stars_spacing_between'  => array(
				'label'          => __( 'Stars Spacing Between', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define the spacing between stars.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '5px',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 20,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'rating',
				'show_if'        => array(
					'use_rating' => 'on',
				),
			),

			// texts.
			'name_bottom_spacing'    => array(
				'label'           => esc_html__( 'Name Spacing Bottom', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the bottom of the reviewer name.', 'addons-for-divi' ),
				'type'            => 'range',
				'default'         => '5px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'name',
				'tab_slug'        => 'advanced',
			),

			'title_bottom_spacing'   => array(
				'label'           => esc_html__( 'Title Spacing Bottom', 'addons-for-divi' ),
				'description'     => esc_html__( 'Here you can define a custom spacing at the bottom of the reviewer title.', 'addons-for-divi' ),
				'type'            => 'range',
				'default'         => '5px',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'title',
				'tab_slug'        => 'advanced',
			),

			// Review.
			'review_top_spacing'     => array(
				'label'          => esc_html__( 'Review Spacing Top', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the top of the review.', 'addons-for-divi' ),
				'type'           => 'range',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'review',
				'tab_slug'       => 'advanced',
			),

			'review_bottom_spacing'  => array(
				'label'          => esc_html__( 'Review Spacing Bottom', 'addons-for-divi' ),
				'description'    => esc_html__( 'Here you can define a custom spacing at the bottom of the review.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'review',
				'tab_slug'       => 'advanced',
			),

			// Bubble.
			'bubble_padding'         => array(
				'label'       => esc_html__( 'Bubble Padding', 'addons-for-divi' ),
				'description' => esc_html__( 'Define custom padding for the bubble area.', 'addons-for-divi' ),
				'type'        => 'custom_padding',
				'toggle_slug' => 'bubble',
				'tab_slug'    => 'advanced',
				'default'     => '15px|15px|15px|15px',
				'show_if'     => array(
					'review_design' => 'bubble',
				),
			),

			'bubble_radius'          => array(
				'label'       => esc_html__( 'Bubble Border Radius', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can control the corner radius of this bubble area. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'addons-for-divi' ),
				'type'        => 'border-radius',
				'toggle_slug' => 'bubble',
				'tab_slug'    => 'advanced',
				'default'     => 'off|6px|6px|6px|6px',
				'show_if'     => array(
					'review_design' => 'bubble',
				),
			),

			'arrow_color'            => array(
				'label'       => esc_html__( 'Arrow Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Define custom color for the bubble arrow.', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'bubble',
				'default'     => '#efefef',
				'show_if'     => array(
					'review_design' => 'bubble',
				),
			),

			'arrow_placement'        => array(
				'label'            => esc_html__( 'Arrow Placement', 'addons-for-divi' ),
				'description'      => esc_html__( 'Place the bubble arrow at the left, right or center.', 'addons-for-divi' ),
				'type'             => 'select',
				'options'          => array(
					'left'   => esc_html__( 'Left', 'addons-for-divi' ),
					'right'  => esc_html__( 'Right', 'addons-for-divi' ),
					'center' => esc_html__( 'Center', 'addons-for-divi' ),
				),
				'default_on_front' => 'center',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'bubble',
				'show_if'          => array(
					'review_design' => 'bubble',
				),
			),

			'arrow_position_x'       => array(
				'label'          => esc_html__( 'Arrow Custom Position', 'addons-for-divi' ),
				'description'    => esc_html__( 'Define arrow offset left/right value.', 'addons-for-divi' ),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'bubble',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'review_design'   => 'bubble',
					'arrow_placement' => array( 'left', 'right' ),
				),
			),

		);

		$defaults = array(
			'position' => 'right_top',
			'offset_x' => '15px',
			'offset_y' => '15px',
		);

		$abs_quote = $this->get_absolute_element_options(
			'icon',
			esc_html__( 'Icon', 'addons-for-divi' ),
			'quote_icon',
			$defaults,
			array( 'icon_placement' => 'absolute' )
		);

		$quote_icon_bg = $this->custom_background_fields(
			'icon',
			esc_html__( 'Icon', 'addons-for-divi' ),
			'advanced',
			'quote_icon',
			array( 'color', 'gradient', 'hover' ),
			array( 'use_custom_icon' => 'off' ),
			''
		);

		$bubble_bg = $this->custom_background_fields(
			'bubble',
			esc_html__( 'Bubble', 'addons-for-divi' ),
			'advanced',
			'bubble',
			array( 'color', 'gradient', 'hover' ),
			array( 'review_design' => 'bubble' ),
			'#efefef'
		);

		// Default values.
		if ( dt_if_not_migrated() ) {
			$fields['hide_quote']['default']         = 'off';
			$fields['use_rating']['default']         = 'off';
			$fields['reviewer_position']['default']  = 'bottom';
			$fields['review_top_spacing']['default'] = '0px';
			$fields['ratings_position']['default']   = '_default';
		} else {
			$fields['hide_quote']['default']         = 'on';
			$fields['use_rating']['default']         = 'on';
			$fields['reviewer_position']['default']  = 'top';
			$fields['review_top_spacing']['default'] = '10px';
			$fields['ratings_position']['default']   = 'bottom';
		}

		return array_merge( $primary_fields, $bubble_bg, $abs_quote, $fields, $quote_icon_bg );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['max_width']   = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['box_shadow']['item'] = array(
			'label'       => esc_html__( 'Item Box Shadow', 'addons-for-divi' ),
			'toggle_slug' => 'common',
			'css'         => array(
				'main'      => '%%order_class%% .dtq-testimonial-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['image'] = array(
			'label_prefix' => esc_html__( 'Image', 'addons-for-divi' ),
			'toggle_slug'  => 'image',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-testimonial-img',
					'border_styles' => '%%order_class%% .dtq-testimonial-img',
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

		$advanced_fields['borders']['icon'] = array(
			'label_prefix' => esc_html__( 'Icon', 'addons-for-divi' ),
			'toggle_slug'  => 'quote_icon',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-testimonial-icon span',
					'border_styles' => '%%order_class%% .dtq-testimonial-icon span',
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

		$advanced_fields['borders']['item'] = array(
			'label_prefix' => esc_html__( 'Item', 'addons-for-divi' ),
			'toggle_slug'  => 'common',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtq-testimonial-inner',
					'border_styles' => '%%order_class%% .dtq-testimonial-inner',
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

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-testimonial-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtq-testimonial-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['name'] = array(
			'label'           => esc_html__( 'Name', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-testimonial-reviewer-text h3, .et-db #et-boc %%order_class%% .dtq-testimonial-reviewer-text h3',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'name',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
			'font_size'       => array(
				'default' => '22px',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__( 'Title', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-testimonial-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'title',
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

		$advanced_fields['fonts']['review'] = array(
			'label'           => esc_html__( 'Review', 'addons-for-divi' ),
			'css'             => array(
				'main'      => '%%order_class%% .dtq-testimonial-review',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'review',
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

		return $advanced_fields;
	}

	public function render_rating( $pos ) {

		$html             = '';
		$ratings_position = $this->props['ratings_position'];
		$use_rating       = $this->props['use_rating'];
		$rating           = $this->props['rating'];

		for ( $i = 0; $i < intval( $rating ); $i++ ) {
			$html = $html . '<span>★</span>';
		}

		if ( $use_rating === 'on' && $ratings_position === $pos ) {
			return sprintf(
				'<div class="dtq-testimonial-rating">
                    %1$s
                </div>',
				$html
			);
		}

	}

	public function render_quote_icon( $class, $placement ) {

		$icons = array(
			'1' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.591 24.006"><g><path d="M232.2,72.969l-1.078,4.955c-7.76-.356-13.138-3.584-13.138-13.078V53.918h13.553V67.653H226.4C226.406,70.7,228.317,72.491,232.2,72.969Z" transform="translate(-198.609 -53.918)"/><path d="M14.216,72.969l-1.078,4.955C5.378,77.569,0,74.341,0,64.846V53.918H13.556V67.654H8.42C8.42,70.7,10.331,72.491,14.216,72.969Z" transform="translate(0 -53.918)"/></g> </svg>',

			'2' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 24"><g transform="translate(0 -4)"><g><g><path d="M0,4V28L12,16V4Z"/><path d="M20,4V28L32,16V4Z"/></g></g></g></svg>',

			'3' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.003 24.007"><path d="M17.66,18.228v1.582a7.789,7.789,0,0,1-.643,4.1A14.32,14.32,0,0,1,14.2,27.624a31.335,31.335,0,0,1-4.9,3.907,18.986,18.986,0,0,1-5.588,2.324.391.391,0,0,1-.593-.2.7.7,0,0,1,.1-.593,35.575,35.575,0,0,0,2.967-3.313,14.785,14.785,0,0,0,1.879-3.115h-.1a10.7,10.7,0,0,1-3.115-.692,5.451,5.451,0,0,1-1.929-1.385Q1.44,22.679,1.44,18.327v-.1q0-4.352,1.484-6.132a7.047,7.047,0,0,1,5.044-2.077,1.533,1.533,0,0,1,.643-.1H10.49a1.533,1.533,0,0,1,.643.1A7.047,7.047,0,0,1,16.177,12.1Q17.66,13.877,17.66,18.228Zm19.781,0v.1a8.193,8.193,0,0,1-.1,1.484,8.137,8.137,0,0,1-.593,4.1,12.666,12.666,0,0,1-2.868,3.709,28.055,28.055,0,0,1-4.8,3.907A18.986,18.986,0,0,1,23.5,33.855h-.1q-.3.2-.495-.2a.43.43,0,0,1,.1-.593,35.575,35.575,0,0,0,2.967-3.313,14.785,14.785,0,0,0,1.879-3.115h-.1a7.184,7.184,0,0,1-5.143-2.077q-1.385-1.78-1.385-6.231v-.1q0-4.451,1.385-6.132a7.184,7.184,0,0,1,5.143-2.077,1.533,1.533,0,0,1,.643-.1H30.27a1.533,1.533,0,0,1,.643.1A7.047,7.047,0,0,1,35.957,12.1q1.484,1.78,1.484,6.132Z" transform="translate(37.443 33.925) rotate(180)"/></svg>',

			'4' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.453 24.005"><path id="Path_12" data-name="Path 12" d="M.98,24h12.6a.98.98,0,0,0,.981-.98v-12.6a.98.98,0,0,0-.981-.981H8.258V.98A.98.98,0,0,0,7.279,0H4.129A.98.98,0,0,0,3.2.67L.051,10.116A.973.973,0,0,0,0,10.428v12.6A.98.98,0,0,0,.98,24Zm0,0" transform="translate(18.895)"/><path id="Path_13" data-name="Path 13" d="M290.18,24h12.6a.98.98,0,0,0,.98-.98v-12.6a.98.98,0,0,0-.98-.981h-5.319V.98a.98.98,0,0,0-.98-.98h-3.149a.98.98,0,0,0-.93.67l-3.15,9.446a.982.982,0,0,0-.051.31v12.6a.979.979,0,0,0,.98.98Zm0,0" transform="translate(-289.199 0)"/></svg>',

			'5' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.579 23.997"><g transform="translate(0 -53.918)"><g transform="translate(0 53.918)"><g><path id="Path_14" data-name="Path 14" d="M232.2,58.871l-1.077-4.953c-7.757.356-13.138,3.582-13.138,13.073V77.915h13.551V64.19H226.4C226.4,61.141,228.314,59.349,232.2,58.871Z" transform="translate(-198.616 -53.918)"/><path id="Path_15" data-name="Path 15" d="M14.211,58.871l-1.073-4.953C5.377,54.274,0,57.5,0,66.991V77.915H13.552V64.19H8.416C8.416,61.141,10.326,59.349,14.211,58.871Z" transform="translate(0 -53.918)"/></g></g></g></svg>',
		);

		$selected_icon   = $this->props['selected_icon'];
		$icon_placement  = $this->props['icon_placement'];
		$hide_quote      = $this->props['hide_quote'];
		$use_custom_icon = $this->props['use_custom_icon'];
		$icon            = '';

		if ( 'off' === $use_custom_icon ) {
			$icon = $icons[ $selected_icon ];
		}

		if ( $hide_quote === 'off' && $icon_placement === $placement ) {
			return sprintf(
				'<div class="dtq-testimonial-icon %1$s">
                	<span>%2$s</span>
            	</div> ',
				$class,
				$icon
			);
		}

	}

	public function render_review() {

		$testimonial      = $this->props['testimonial'];
		$testimonial_html = sprintf( '<p>%1$s</p>', $testimonial );

		return sprintf(
			'<div class="dtq-testimonial-review">%2$s %1$s</div>',
			! empty( $testimonial ) ? $testimonial_html : '',
			$this->render_quote_icon( 'dtq-icon-default', '_default' )
		);

	}

	public function _render_image( $pos ) {
		$image        = $this->props['image'];
		$img_position = $this->props['img_position'];
		$image_alt    = $this->props['image_alt'];

		if ( ! empty( $image ) ) {
			if ( in_array( $img_position, $pos ) ) {
				return sprintf(
					'
                        <figure class="dtq-testimonial-img">
                            <img class="dtq-img-cover" src="%1$s" alt="%2$s" />
                        </figure>',
					$image,
					$image_alt
				);
			}
		}
	}

	public function render_reviewer( $pos ) {

		$reviewer_position = $this->props['reviewer_position'];
		$name              = $this->props['name'];
		$title             = $this->props['title'];
		$link_target       = $this->props['link_option_url_new_window'];
		$company_url       = $this->props['company_url'];
		$website_url       = $this->props['website_url'];
		$name_html         = '';
		$title_html        = '';

		if ( ! empty( $name ) ) {
			if ( ! empty( $website_url ) ) {
				$name_html = sprintf( '<a href="%2$s" target="%3$s"><h3>%1$s</h3></a>', $name, $website_url, $link_target );
			} else {
				$name_html = sprintf( '<h3>%1$s</h3>', $name );
			}
		}

		if ( ! empty( $title ) ) {
			if ( ! empty( $company_url ) ) {
				$title_html = sprintf( '<a class="dtq-testimonial-title" href="%2$s" target="%3$s"><p>%1$s</p></a>', $title, $company_url, $link_target );
			} else {
				$title_html = sprintf( '<div class="dtq-testimonial-title">%1$s</div>', $title );
			}
		}

		if ( $reviewer_position === $pos ) {
			return sprintf(
				'<div class="dtq-testimonial-reviewer">
                    %1$s
                    <div class="dtq-testimonial-reviewer-text">
                        %2$s %3$s %4$s
                    </div>
                </div>',
				$this->_render_image( array( 'relative' ) ),
				$name_html,
				$title_html,
				$this->render_rating( 'reviewer' )
			);
		}

	}

	public function render( $attrs, $content, $render_slug ) {

		$this->render_css( $render_slug );

		$alignment    = $this->props['alignment'];
		$img_position = $this->props['img_position'];

		return sprintf(
			'<div class="dtq-module dtq-testimonial dtq-align-%1$s">
                %3$s %5$s
                <div class="dtq-testimonial-inner dtq-bg-support img-pos-%2$s">
                     %4$s %11$s
                    <div class="dtq-testimonial-content">
                        %6$s %7$s %8$s
                        %9$s %10$s
                    </div>
                    %12$s
                </div>
			</div>',
			$alignment,
			$img_position,
			$this->render_quote_icon( 'dtq-icon-absolute', 'absolute' ),
			$this->render_quote_icon( 'dtq-icon-bg', 'background' ),
			$this->_render_image( array( 'absolute' ) ),
			$this->render_reviewer( 'top' ),
			$this->render_rating( '_default' ),
			$this->render_review(),
			$this->render_reviewer( 'bottom' ),
			$this->render_rating( 'bottom' ),
			$this->_render_image( array( 'top', 'left' ) ),
			$this->_render_image( array( 'right' ) )
		);
	}


	public function render_css( $render_slug ) {

		$alignment              = $this->props['alignment'];
		$image_spacing          = $this->props['image_spacing'];
		$image_spacing_top      = $this->props['image_spacing_top'];
		$image_spacing_bottom   = $this->props['image_spacing_bottom'];
		$ratings_spacing_top    = $this->props['ratings_spacing_top'];
		$ratings_spacing_bottom = $this->props['ratings_spacing_bottom'];
		$title_bottom_spacing   = $this->props['title_bottom_spacing'];
		$stars_size             = $this->props['stars_size'];
		$stars_color            = $this->props['stars_color'];
		$stars_spacing_between  = $this->props['stars_spacing_between'];
		$name_bottom_spacing    = $this->props['name_bottom_spacing'];
		$review_bottom_spacing  = $this->props['review_bottom_spacing'];
		$review_top_spacing     = $this->props['review_top_spacing'];
		$icon_alignment         = $this->props['icon_alignment'];
		$use_custom_icon        = $this->props['use_custom_icon'];
		$icon_img               = $this->props['icon_img'];
		$icon_color             = $this->props['icon_color'];
		$icon_bg                = $this->props['icon_bg'];
		$icon_top_spacing       = $this->props['icon_top_spacing'];
		$icon_bottom_spacing    = $this->props['icon_bottom_spacing'];
		$icon_padding           = $this->props['icon_padding'];
		$icon_opacity           = $this->props['icon_opacity'];
		$icon_placement         = $this->props['icon_placement'];
		$img_position           = $this->props['img_position'];
		$image_placement_alt    = $this->props['image_placement_alt'];
		$img_offset_x           = $this->props['img_offset_x'];
		$img_offset_y           = $this->props['img_offset_y'];
		$image_placement        = $this->props['image_placement'];
		$img_is_center_y        = $this->props['img_is_center_y'];
		$img_is_center_x        = $this->props['img_is_center_x'];
		$image__placement       = explode( '_', $image_placement );
		$val_x                  = 0;
		$val_y                  = 0;

		// content.
		if ( $img_position === 'left' || $img_position === 'right' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-content',
					'declaration' => 'flex: 1 1;',
				)
			);

			$this->get_responsive_styles(
				'content_padding',
				'%%order_class%% .dtq-testimonial-content',
				array(
					'primary' => 'padding',
				),
				array( 'default' => '30px|30px|30px|30px' ),
				$render_slug
			);

		}

		// Quote Icon.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-testimonial-inner .dtq-testimonial-icon',
				'declaration' => sprintf( 'text-align: %1$s!important;', $icon_alignment ),
			)
		);

		if ( 'right' === $icon_alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-inner .dtq-testimonial-icon',
					'declaration' => sprintf( 'justify-content: flex-end!important;' ),
				)
			);
		} elseif ( 'center' === $icon_alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-inner .dtq-testimonial-icon',
					'declaration' => sprintf( 'justify-content: center!important;' ),
				)
			);
		}

		if ( 'off' === $use_custom_icon ) {

			$this->get_custom_bg_style( $render_slug, 'icon', '%%order_class%% .dtq-testimonial-icon span', '%%order_class%%:hover .dtq-testimonial-icon span' );

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-icon span',
					'declaration' => sprintf(
						'%1$s
                    	opacity: %2$s;',
						$this->process_margin_padding( $icon_padding, 'padding', false ),
						$icon_opacity
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-icon svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$icon_color
					),
				)
			);
			// Icon Size.
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtq-testimonial-icon svg',
				array( 'primary' => 'width' ),
				array( 'default' => '70px' ),
				$render_slug
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-icon span',
					'declaration' => sprintf(
						'background: %1$s;
						opacity: %2$s;
						background-image: url(%3$s);
						background-position: center;
						background-repeat: no-repeat;
						background-size: contain;',
						$icon_bg,
						$icon_opacity,
						$icon_img
					),
				)
			);

			// Icon Size.
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtq-testimonial-icon span',
				array( 'primary' => 'width' ),
				array( 'default' => '70px' ),
				$render_slug
			);
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtq-testimonial-icon span',
				array( 'primary' => 'height' ),
				array( 'default' => '70px' ),
				$render_slug
			);
		}

		if ( 'absolute' !== $icon_placement ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-icon span',
					'declaration' => sprintf(
						'margin-top: %1$s;margin-bottom: %2$s;',
						$icon_top_spacing,
						$icon_bottom_spacing
					),
				)
			);
		} else {
			$this->get_absolute_element_styles( $render_slug, 'icon', '%%order_class%% .dtq-icon-absolute' );
		}

		// Image.
		if ( 'absolute' === $img_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-img',
					'declaration' => 'position: absolute; z-index: 99;',
				)
			);

			// image offset X.
			if ( 'on' === $img_is_center_x ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-img',
						'declaration' => sprintf( '%1$s: 50%%;', $image__placement[0] ),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-img',
						'declaration' => sprintf( '%1$s: %2$s;', $image__placement[0], $img_offset_x ),
					)
				);
			}

			// image offset Y.
			if ( 'on' === $img_is_center_y ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-img',
						'declaration' => sprintf( '%1$s:50%%;', $image__placement[1] ),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-img',
						'declaration' => sprintf( '%1$s: %2$s;', $image__placement[1], $img_offset_y ),
					)
				);
			}

			if ( 'right_top' === $image_placement ) {
				if ( 'on' === $img_is_center_y ) {
					$val_y = '-50%';
				}
				if ( 'on' === $img_is_center_x ) {
					$val_x = '50%';
				}
			} elseif ( 'right_bottom' === $image_placement ) {
				if ( $img_is_center_y === 'on' ) {
					$val_y = '50%';
				}
				if ( $img_is_center_x === 'on' ) {
					$val_x = '50%';
				}
			} elseif ( $image_placement === 'left_bottom' ) {
				if ( $img_is_center_y === 'on' ) {
					$val_y = '50%';
				}
				if ( $img_is_center_x === 'on' ) {
					$val_x = '-50%';
				}
			} elseif ( $image_placement === 'left_top' ) {
				if ( $img_is_center_y === 'on' ) {
					$val_y = '-50%';
				}
				if ( $img_is_center_x === 'on' ) {
					$val_x = '-50%';
				}
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-img',
					'declaration' => "transform : translateX({$val_x}) translateY({$val_y});",
				)
			);
		}

		// image placement left/right.
		if ( $img_position === 'relative' ) {
			if ( $image_placement_alt !== 'top' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-reviewer',
						'declaration' => 'display: flex; align-items: center;',
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-inner .dtq-testimonial-reviewer *',
						'declaration' => 'text-align:' . $image_placement_alt . ';',
					)
				);
			}

			if ( $image_placement_alt === 'right' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-reviewer',
						'declaration' => 'flex-direction: row-reverse;',
					)
				);
			}
		}

		// Image Height.
		$this->get_responsive_styles(
			'image_height',
			'%%order_class%% .dtq-testimonial-img',
			array(
				'primary' => 'height',
			),
			array(
				'default'     => '65px',
				'conditional' => array(
					'name'   => 'img_position',
					'values' => array(
						array(
							'a' => 'left',
							'b' => 'initial',
						),
						array(
							'a' => 'right',
							'b' => 'initial',
						),
					),
				),
			),
			$render_slug
		);

		// Image width.
		$this->get_responsive_styles(
			'image_width',
			'%%order_class%% .dtq-testimonial-img',
			array(
				'primary' => 'width',
			),
			array(
				'default'     => '65px',
				'conditional' => array(
					'name'   => 'img_position',
					'values' => array(
						array(
							'a' => 'left',
							'b' => '50%',
						),
						array(
							'a' => 'right',
							'b' => '50%',
						),
					),
				),
			),
			$render_slug
		);

		// Image spacing.
		if ( $img_position === 'relative' ) {
			if ( $image_placement_alt === 'top' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-img',
						'declaration' => sprintf( 'margin-bottom: %1$s; margin-top: %2$s;', $image_spacing_bottom, $image_spacing_top ),
					)
				);
			} elseif ( $image_placement_alt === 'left' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-img',
						'declaration' => sprintf( 'margin-right: %1$s;', $image_spacing ),
					)
				);
			} elseif ( $image_placement_alt === 'right' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-img',
						'declaration' => sprintf( 'margin-left: %1$s;', $image_spacing ),
					)
				);
			}
		} elseif ( $img_position === 'top' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-img',
					'declaration' => sprintf( 'margin-bottom: %1$s; margin-top: %2$s;', $image_spacing_bottom, $image_spacing_top ),
				)
			);
		}

		// ratings
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-testimonial-rating',
				'declaration' => sprintf( 'padding-bottom: %1$s; padding-top: %2$s;', $ratings_spacing_bottom, $ratings_spacing_top ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-testimonial-rating span',
				'declaration' => sprintf( 'color: %1$s; font-size: %2$s;', $stars_color, $stars_size ),
			)
		);

		if ( $alignment === 'center' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-rating span',
					'declaration' => sprintf( 'margin: 0 calc(%1$s / 2);', $stars_spacing_between ),
				)
			);
		} elseif ( $alignment === 'right' ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-rating span',
					'declaration' => sprintf( 'margin-left: %1$s;', $stars_spacing_between ),
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-rating span',
					'declaration' => sprintf( 'margin-right: %1$s;', $stars_spacing_between ),
				)
			);
		}

		// Text
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-testimonial-reviewer-text h3',
				'declaration' => sprintf( 'padding-bottom: %1$s;', $name_bottom_spacing ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-testimonial-title',
				'declaration' => sprintf( 'padding-bottom: %1$s;', $title_bottom_spacing ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtq-testimonial-review',
				'declaration' => sprintf( 'margin-bottom: %1$s; margin-top: %2$s;', $review_bottom_spacing, $review_top_spacing ),
			)
		);

		// Bubble.
		$review_design     = $this->props['review_design'];
		$bubble_padding    = $this->props['bubble_padding'];
		$arrow_color       = $this->props['arrow_color'];
		$arrow_placement   = $this->props['arrow_placement'];
		$arrow_position_x  = $this->props['arrow_position_x'];
		$reviewer_position = $this->props['reviewer_position'];
		$bubble_radius     = explode( '|', $this->props['bubble_radius'] );

		if ( $review_design === 'bubble' ) {
			$this->get_custom_bg_style( $render_slug, 'bubble', '%%order_class%% .dtq-testimonial-review', '%%order_class%%:hover .dtq-testimonial-review' );

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-review',
					'declaration' => sprintf(
						'
                    position: relative;
                    border-radius: %1$s %2$s %3$s %4$s;
                    %5$s',
						$bubble_radius[1],
						$bubble_radius[2],
						$bubble_radius[3],
						$bubble_radius[4],
						$this->process_margin_padding( $bubble_padding, 'padding', false )
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-testimonial-review:after',
					'declaration' => 'content: ""; width: 0;height: 0;position: absolute;border-style: solid;',
				)
			);

			if ( $reviewer_position === 'bottom' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-review:after',
						'declaration' => sprintf(
							'
                        border-width: 13px 13px 0 13px;
                        border-color: %1$s transparent transparent transparent;
                        top: 100%%;',
							$arrow_color
						),
					)
				);
			} elseif ( $reviewer_position === 'top' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-review:after',
						'declaration' => sprintf(
							'
                        border-width: 0 13px 13px 13px;
                        border-color: transparent transparent %1$s transparent;
                        bottom: 100%%;',
							$arrow_color
						),
					)
				);
			}

			if ( $arrow_placement === 'left' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-review:after',
						'declaration' => 'left:' . $arrow_position_x . ';',
					)
				);
			} elseif ( $arrow_placement === 'right' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-review:after',
						'declaration' => 'right:' . $arrow_position_x . ';',
					)
				);
			} elseif ( $arrow_placement === 'center' ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-testimonial-review:after',
						'declaration' => 'left: 50%; transform: translateX(-13px);',
					)
				);
			}
		}

	}
}

new DTQ_Testimonial();
