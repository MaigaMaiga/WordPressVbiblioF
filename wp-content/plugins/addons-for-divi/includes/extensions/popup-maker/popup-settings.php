<?php

// Toggles.
function ba_get_toggles( $builder_settings_toggles ) {
	if ( is_singular( 'brainaddons-popup' ) ) {
		return array_merge(
			array(
				'general_settings'   => esc_html__( 'General Settings', 'addons-for-divi' ),
				'popup_container'    => esc_html__( 'Popup Container', 'addons-for-divi' ),
				'popup_close_button' => esc_html__( 'Close Button', 'addons-for-divi' ),
				'popup_overlay'      => esc_html__( 'Popup Overlay', 'addons-for-divi' ),
			),
			$builder_settings_toggles
		);
	}
	return $builder_settings_toggles;
}

add_filter( 'et_builder_page_settings_modal_toggles', 'ba_get_toggles' );

function ba_all_fields() {

	$pro_options = array(
		'ba_close_button_color'      => array(
			'type'                 => 'color-alpha',
			'id'                   => 'ba_close_button_color',
			'meta_key'             => '_ba_close_button_color',
			'label'                => esc_html__( 'Close Color', 'addons-for-divi' ),
			'default'              => '#000',
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_close_button',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),
		'ba_close_button_radius'     => array(
			'type'                 => 'custom_padding',
			'id'                   => 'ba_close_button_radius',
			'meta_key'             => '_ba_close_button_radius',
			'label'                => esc_html__( 'Close Button Radius', 'addons-for-divi' ),
			'default'              => '0px|0px|0px|0px|false|false',
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_close_button',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),
		'ba_animation'               => array(
			'type'                 => 'select',
			'id'                   => 'ba_animation',
			'label'                => esc_html__( 'Animation', 'addons-for-divi' ),
			'default'              => 'fade',
			'options'              => array(
				'fade'           => esc_html__( 'Fade', 'addons-for-divi' ),
				'zoom-in'        => esc_html__( 'ZoomIn', 'addons-for-divi' ),
				'zoom-out'       => esc_html__( 'ZoomOut', 'addons-for-divi' ),
				'rotate'         => esc_html__( 'Rotate', 'addons-for-divi' ),
				'move-up'        => esc_html__( 'MoveUp', 'addons-for-divi' ),
				'flip-x'         => esc_html__( 'Horizontal Flip', 'addons-for-divi' ),
				'flip-y'         => esc_html__( 'Vertical Flip', 'addons-for-divi' ),
				'bounce-in'      => esc_html__( 'BounceIn', 'addons-for-divi' ),
				'bounce-out'     => esc_html__( 'BounceOut', 'addons-for-divi' ),
				'slide-in-up'    => esc_html__( 'SlideInUp', 'addons-for-divi' ),
				'slide-in-right' => esc_html__( 'SlideInRight', 'addons-for-divi' ),
				'slide-in-down'  => esc_html__( 'SlideInDown', 'addons-for-divi' ),
				'slide-in-left'  => esc_html__( 'SlideInLeft', 'addons-for-divi' ),
			),
			'tab_slug'             => 'content',
			'toggle_slug'          => 'general_settings',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),
		'ba_position_x'              => array(
			'type'                 => 'select',
			'id'                   => 'ba_position_x',
			'label'                => esc_html__( 'Horizontal Position', 'addons-for-divi' ),
			'default'              => 'center',
			'autoload'             => false,
			'options'              => array(
				'flex-start' => __( 'Left', 'addons-for-divi' ),
				'center'     => __( 'Center', 'addons-for-divi' ),
				'flex-end'   => __( 'Right', 'addons-for-divi' ),
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),
		'ba_position_y'              => array(
			'type'                 => 'select',
			'id'                   => 'ba_position_y',
			'label'                => esc_html__( 'Vertical Position', 'addons-for-divi' ),
			'default'              => 'center',
			'autoload'             => false,
			'options'              => array(
				'flex-start' => __( 'Top', 'addons-for-divi' ),
				'center'     => __( 'Middle', 'addons-for-divi' ),
				'flex-end'   => __( 'Bottom', 'addons-for-divi' ),
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),
		'ba_container_padding'       => array(
			'type'                 => 'custom_padding',
			'id'                   => 'ba_container_padding',
			'meta_key'             => '_ba_container_padding',
			'label'                => esc_html__( 'Padding', 'addons-for-divi' ),
			'default'              => '20px|20px|20px|20px|false|false',
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),
		'ba_container_border_radius' => array(
			'type'                 => 'custom_padding',
			'id'                   => 'ba_container_border_radius',
			'meta_key'             => '_ba_container_border_radius',
			'label'                => esc_html__( 'Border Radius', 'addons-for-divi' ),
			'default'              => '0px|0px|0px|0px|false|false',
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),
	);

	$pro_trigger = array(
		'try-exit-trigger' => esc_html__( 'Try Exit', 'addons-for-divi' ),
		'custom-selector'  => esc_html__( 'Custom Selector Click', 'addons-for-divi' ),
	);

	$free_trigger = array(
		'attach'         => esc_html__( 'Not Selected', 'addons-for-divi' ),
		'page-load'      => esc_html__( 'On page load(s)', 'addons-for-divi' ),
		'scroll-trigger' => esc_html__( 'Page Scrolled(%)', 'addons-for-divi' ),
	);

	$all_trigger = divitorque_has_pro() ? array_merge( $free_trigger, $pro_trigger ) : $free_trigger;

	$free_options = array(

		'ba_close_button'            => array(
			'label'                => __( 'Use Close Button', 'addons-for-divi' ),
			'type'                 => 'yes_no_button',
			'id'                   => 'ba_close_button',
			'meta_key'             => '_ba_close_button',
			'default'              => 'on',
			'options'              => array(
				'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
				'off' => esc_html__( 'No', 'addons-for-divi' ),
			),
			'affects'              => array(
				'ba_close_icon_x_position',
				'ba_close_icon_y_position',
				'ba_close_button_color',
				'ba_close_button_radius',
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_close_button',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_close_icon_x_position'   => array(
			'type'                 => 'text',
			'id'                   => 'ba_close_icon_x_position',
			'label'                => esc_html__( 'Icon Transform ( Translate X )', 'addons-for-divi' ),
			'description'          => esc_html__( 'Change the position of the Close button moving it along the x-axis. Default: 0', 'addons-for-divi' ),
			'default'              => '0',
			'depends_show_if'      => 'on',
			'depends_on'           => array(
				'ba_close_button',
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_close_button',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_close_icon_y_position'   => array(
			'type'                 => 'text',
			'id'                   => 'ba_close_icon_y_position',
			'label'                => esc_html__( 'Icon Transform ( Translate Y )', 'addons-for-divi' ),
			'description'          => esc_html__( 'Change the position of the Close button moving it along the y-axis. Default: 0', 'addons-for-divi' ),
			'default'              => '0',
			'depends_show_if'      => 'on',
			'depends_on'           => array(
				'ba_close_button',
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_close_button',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_popup_open_trigger'      => array(
			'type'                 => 'select',
			'id'                   => 'ba_popup_open_trigger',
			'label'                => esc_html__( 'Open event', 'addons-for-divi' ),
			'default'              => 'attach',
			'options'              => $all_trigger,
			'affects'              => array(
				'ba_page_load_delay',
				'ba_popup_scrolled_to_value',
			),
			'tab_slug'             => 'content',
			'toggle_slug'          => 'general_settings',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_page_load_delay'         => array(
			'type'                 => 'range',
			'id'                   => 'ba_page_load_delay',
			'meta_key'             => '_ba_page_load_delay',
			'label'                => esc_html__( 'Open delay', 'addons-for-divi' ),
			'default'              => 1,
			'range_settings'       => array(
				'step' => 1,
				'min'  => 0,
				'max'  => 60,
			),
			'unitless'             => true,
			'depends_show_if'      => 'page-load',
			'depends_on'           => array(
				'ba_popup_open_trigger',
			),
			'tab_slug'             => 'content',
			'toggle_slug'          => 'general_settings',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_custom_selector'         => array(
			'label'                => esc_html__( 'Custom Selector', 'addons-for-divi' ),
			'type'                 => 'text',
			'id'                   => 'ba_custom_selector',
			'meta_key'             => '_ba_custom_selector',
			'depends_show_if'      => 'custom-selector',
			'default'              => '.custom',
			'depends_on'           => array(
				'ba_popup_open_trigger',
			),
			'tab_slug'             => 'content',
			'toggle_slug'          => 'general_settings',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_popup_scrolled_to_value' => array(
			'type'                 => 'range',
			'id'                   => 'ba_popup_scrolled_to_value',
			'meta_key'             => '_ba_popup_scrolled_to_value',
			'label'                => esc_html__( 'Scroll Page Progress(%)', 'addons-for-divi' ),
			'default'              => 10,
			'range_settings'       => array(
				'step' => 1,
				'min'  => 0,
				'max'  => 100,
			),
			'unitless'             => true,
			'depends_show_if'      => 'scroll-trigger',
			'depends_on'           => array(
				'ba_popup_open_trigger',
			),
			'tab_slug'             => 'content',
			'toggle_slug'          => 'general_settings',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_container_width'         => array(
			'type'                 => 'range',
			'id'                   => 'ba_container_width',
			'meta_key'             => '_ba_container_width',
			'label'                => esc_html__( 'Width', 'addons-for-divi' ),
			'default'              => '500',
			'range_settings'       => array(
				'step' => 1,
				'min'  => 3,
				'max'  => 2000,
			),
			'unitless'             => true,
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_container_width_unit'    => array(
			'type'                 => 'select',
			'id'                   => 'ba_container_width_unit',
			'label'                => esc_html__( 'Width Unit', 'addons-for-divi' ),
			'default'              => 'px',
			'unitless'             => true,
			'options'              => array(
				'px' => __( 'Pixel', 'addons-for-divi' ),
				'%'  => __( 'Percent', 'addons-for-divi' ),
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_use_container_height'    => array(
			'label'                => __( 'Custom Height', 'addons-for-divi' ),
			'id'                   => 'ba_use_container_height',
			'meta_key'             => '_ba_use_container_height',
			'type'                 => 'yes_no_button',
			'default'              => 'off',
			'options'              => array(
				'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
				'off' => esc_html__( 'No', 'addons-for-divi' ),
			),
			'affects'              => array(
				'ba_container_height',
				'ba_container_height_unit',
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_container_height'        => array(
			'type'                 => 'range',
			'id'                   => 'ba_container_height',
			'meta_key'             => '_ba_container_height',
			'label'                => esc_html__( 'Height', 'addons-for-divi' ),
			'default'              => '500',
			'range_settings'       => array(
				'step' => 1,
				'min'  => 3,
				'max'  => 1000,
			),
			'depends_show_if'      => 'on',
			'depends_on'           => array(
				'ba_use_container_height',
			),
			'unitless'             => true,
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_container_height_unit'   => array(
			'type'                 => 'select',
			'id'                   => 'ba_container_height_unit',
			'label'                => esc_html__( 'Height Unit', 'addons-for-divi' ),
			'default'              => 'px',
			'autoload'             => false,
			'options'              => array(
				'px' => __( 'Pixel', 'addons-for-divi' ),
				'%'  => __( 'Percent', 'addons-for-divi' ),
			),
			'depends_show_if'      => 'on',
			'depends_on'           => array(
				'ba_use_container_height',
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_container_color'         => array(
			'type'                 => 'color-alpha',
			'id'                   => 'ba_container_color',
			'meta_key'             => '_ba_container_color',
			'label'                => esc_html__( 'Container Background', 'addons-for-divi' ),
			'default'              => '#ffffff',
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_container',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_overlay'                 => array(
			'label'                => __( 'Use Overlay', 'addons-for-divi' ),
			'id'                   => 'ba_overlay',
			'meta_key'             => '_ba_overlay',
			'type'                 => 'yes_no_button',
			'default'              => 'on',
			'options'              => array(
				'on'  => esc_html__( 'Yes', 'addons-for-divi' ),
				'off' => esc_html__( 'No', 'addons-for-divi' ),
			),
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_overlay',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

		'ba_overlay_color'           => array(
			'type'                 => 'color-alpha',
			'id'                   => 'ba_overlay_color',
			'meta_key'             => '_ba_overlay_color',
			'label'                => esc_html__( 'Overlay Color', 'addons-for-divi' ),
			'default'              => '#000',
			'tab_slug'             => 'design',
			'toggle_slug'          => 'popup_overlay',
			'depends_on_post_type' => array( 'brainaddons-popup' ),
		),

	);

	$all_options = array_merge( $free_options, $pro_options );

	return divitorque_has_pro() ? $all_options : $free_options;
}

// Settings.
function ba_popup_add_settings( $fields ) {
	return array_merge( $fields, ba_all_fields() );
}

add_filter( 'et_builder_page_settings_definitions', 'ba_popup_add_settings' );

// All values.
function ba_all_values( $post_id = 0 ) {

	$post_id = $post_id ? $post_id : get_the_ID();
	$values  = array();

	$fields = ba_all_fields();

	if ( divitorque_has_pro() ) {
		$ba_container_padding       = get_post_meta( $post_id, '_ba_container_padding', true );
		$default                    = $fields['ba_container_padding']['default'];
		$ba_container_padding       = ! empty( $ba_container_padding ) ? $ba_container_padding : $default;
		$ba_container_border_radius = get_post_meta( $post_id, '_ba_container_border_radius', true );
		$default                    = $fields['ba_container_border_radius']['default'];
		$ba_container_border_radius = ! empty( $ba_container_border_radius ) ? $ba_container_border_radius : $default;
		$ba_position_x              = get_post_meta( $post_id, '_ba_position_x', true );
		$default                    = $fields['ba_position_x']['default'];
		$ba_position_x              = ! empty( $ba_position_x ) ? $ba_position_x : $default;
		$ba_position_y              = get_post_meta( $post_id, '_ba_position_y', true );
		$default                    = $fields['ba_position_y']['default'];
		$ba_position_y              = ! empty( $ba_position_y ) ? $ba_position_y : $default;
		$ba_animation               = get_post_meta( $post_id, '_ba_animation', true );
		$default                    = $fields['ba_animation']['default'];
		$ba_animation               = ! empty( $ba_animation ) ? $ba_animation : $default;
		$ba_close_button_color      = get_post_meta( $post_id, '_ba_close_button_color', true );
		$default                    = $fields['ba_close_button_color']['default'];
		$ba_close_button_color      = ! empty( $ba_close_button_color ) ? $ba_close_button_color : $default;
		$ba_close_button_radius     = get_post_meta( $post_id, '_ba_close_button_radius', true );
		$default                    = $fields['ba_close_button_radius']['default'];
		$ba_close_button_radius     = ! empty( $ba_close_button_radius ) ? $ba_close_button_radius : $default;
	}

	$ba_container_width       = get_post_meta( $post_id, '_ba_container_width', true );
	$default                  = $fields['ba_container_width']['default'];
	$ba_container_width       = ! empty( $ba_container_width ) ? $ba_container_width : $default;
	$ba_container_width_unit  = get_post_meta( $post_id, '_ba_container_width_unit', true );
	$default                  = $fields['ba_container_width_unit']['default'];
	$ba_container_width_unit  = ! empty( $ba_container_width_unit ) ? $ba_container_width_unit : $default;
	$ba_use_container_height  = get_post_meta( $post_id, '_ba_use_container_height', true );
	$default                  = $fields['ba_use_container_height']['default'];
	$ba_use_container_height  = ! empty( $ba_use_container_height ) ? $ba_use_container_height : $default;
	$ba_container_height_unit = get_post_meta( $post_id, '_ba_container_height_unit', true );
	$default                  = $fields['ba_container_height_unit']['default'];
	$ba_container_height_unit = ! empty( $ba_container_height_unit ) ? $ba_container_height_unit : $default;
	$ba_container_height      = get_post_meta( $post_id, '_ba_container_height', true );
	$default                  = $fields['ba_container_height']['default'];
	$ba_container_height      = ! empty( $ba_container_height ) ? $ba_container_height : $default;
	$ba_container_color       = get_post_meta( $post_id, '_ba_container_color', true );
	$default                  = $fields['ba_container_color']['default'];
	$ba_container_color       = ! empty( $ba_container_color ) ? $ba_container_color : $default;

	$ba_popup_open_trigger      = get_post_meta( $post_id, '_ba_popup_open_trigger', true );
	$default                    = $fields['ba_popup_open_trigger']['default'];
	$ba_popup_open_trigger      = ! empty( $ba_popup_open_trigger ) ? $ba_popup_open_trigger : $default;
	$ba_page_load_delay         = get_post_meta( $post_id, '_ba_page_load_delay', true );
	$default                    = $fields['ba_page_load_delay']['default'];
	$ba_page_load_delay         = ! empty( $ba_page_load_delay ) ? $ba_page_load_delay : $default;
	$ba_popup_scrolled_to_value = get_post_meta( $post_id, '_ba_popup_scrolled_to_value', true );
	$default                    = $fields['ba_popup_scrolled_to_value']['default'];
	$ba_popup_scrolled_to_value = ! empty( $ba_popup_scrolled_to_value ) ? $ba_popup_scrolled_to_value : $default;
	$ba_custom_selector         = get_post_meta( $post_id, '_ba_custom_selector', true );
	$default                    = $fields['ba_custom_selector']['default'];
	$ba_custom_selector         = ! empty( $ba_custom_selector ) ? $ba_custom_selector : $default;
	$ba_overlay                 = get_post_meta( $post_id, '_ba_overlay', true );
	$default                    = $fields['ba_overlay']['default'];
	$ba_overlay                 = ! empty( $ba_overlay ) ? $ba_overlay : $default;
	$ba_overlay_color           = get_post_meta( $post_id, '_ba_overlay_color', true );
	$default                    = $fields['ba_overlay_color']['default'];
	$ba_overlay_color           = ! empty( $ba_overlay_color ) ? $ba_overlay_color : $default;
	$ba_close_button            = get_post_meta( $post_id, '_ba_close_button', true );
	$default                    = $fields['ba_close_button']['default'];
	$ba_close_button            = ! empty( $ba_close_button ) ? $ba_close_button : $default;
	$ba_close_icon_x_position   = get_post_meta( $post_id, '_ba_close_icon_x_position', true );
	$default                    = $fields['ba_close_icon_x_position']['default'];
	$ba_close_icon_x_position   = ! empty( $ba_close_icon_x_position ) ? $ba_close_icon_x_position : $default;
	$ba_close_icon_y_position   = get_post_meta( $post_id, '_ba_close_icon_y_position', true );
	$default                    = $fields['ba_close_icon_y_position']['default'];
	$ba_close_icon_y_position   = ! empty( $ba_close_icon_y_position ) ? $ba_close_icon_y_position : $default;

	$pro_values = array();

	if ( divitorque_has_pro() ) {
		$pro_values = array(
			'ba_container_padding'       => $ba_container_padding,
			'ba_container_border_radius' => $ba_container_border_radius,
			'ba_position_x'              => $ba_position_x,
			'ba_position_y'              => $ba_position_y,
			'ba_animation'               => $ba_animation,
			'ba_close_button_radius'     => $ba_close_button_radius,
			'ba_close_button_color'      => strtolower( $ba_close_button_color ),
		);
	}

	$values = array(
		'ba_container_width'         => $ba_container_width,
		'ba_container_width_unit'    => $ba_container_width_unit,
		'ba_use_container_height'    => $ba_use_container_height,
		'ba_container_height'        => $ba_container_height,
		'ba_container_height_unit'   => $ba_container_height_unit,
		'ba_container_color'         => strtolower( $ba_container_color ),
		'ba_popup_open_trigger'      => $ba_popup_open_trigger,
		'ba_overlay'                 => $ba_overlay,
		'ba_overlay_color'           => $ba_overlay_color,
		'ba_page_load_delay'         => $ba_page_load_delay,
		'ba_popup_scrolled_to_value' => $ba_popup_scrolled_to_value,
		'ba_custom_selector'         => $ba_custom_selector,
		'ba_close_button'            => $ba_close_button,
		'ba_close_icon_x_position'   => $ba_close_icon_x_position,
		'ba_close_icon_y_position'   => $ba_close_icon_y_position,
	);

	$all_values = array_merge( $pro_values, $values );

	return ba_has_pro() ? $all_values : $values;
}

// Values.
function ba_popup_settings_values( $builder_settings_values, $post_id ) {

	$post_id = $post_id ? $post_id : get_the_ID();
	$values  = ba_all_values( $post_id );
	return array_merge( $builder_settings_values, $values );
}

// Print css.
function ba_custom_css( $post_id = 0 ) {

	$post_id         = $post_id ? $post_id : get_the_ID();
	$page_settings   = ba_all_values( $post_id );
	$selector_prefix = '#dtq-popup-' . $post_id;

	$output = '';

	if ( isset( $page_settings['ba_container_color'] ) ) {
		$output .= sprintf(
			'%2$s .dtq-popup-container .dtq-popup-container-inner { background-color: %1$s !important; }',
			esc_html( $page_settings['ba_container_color'] ),
			esc_html( $selector_prefix )
		);
	}

	if ( isset( $page_settings['ba_close_icon_x_position'] ) && isset( $page_settings['ba_close_icon_y_position'] ) ) {
		$output .= sprintf(
			'%1$s .dtq-popup-container .dtq-popup-close-button {
                transform: translateX(%2$spx) translateY(%3$spx) !important;
            }',
			esc_html( $selector_prefix ),
			esc_html( $page_settings['ba_close_icon_x_position'] ),
			esc_html( $page_settings['ba_close_icon_y_position'] )
		);
	}

	if ( isset( $page_settings['ba_close_button_radius'] ) ) {
		$output .= sprintf(
			'%2$s .dtq-popup-container .dtq-popup-close-button { %1$s }',
			esc_html( ba_process_border_radius( $page_settings['ba_close_button_radius'] ) ),
			esc_html( $selector_prefix )
		);
	}

	if ( isset( $page_settings['ba_close_button_color'] ) ) {
		$output .= sprintf(
			'%2$s .dtq-popup-container .dtq-popup-close-button { background-color: %1$s !important; }',
			esc_html( $page_settings['ba_close_button_color'] ),
			esc_html( $selector_prefix )
		);
	}

	if ( isset( $page_settings['ba_container_width'] ) ) {
		$output .= sprintf(
			'%3$s .dtq-popup-container { width: %1$s%2$s !important; }',
			esc_html( $page_settings['ba_container_width'] ),
			esc_html( $page_settings['ba_container_width_unit'] ),
			esc_html( $selector_prefix )
		);
	}

	if ( isset( $page_settings['ba_use_container_height'] ) && 'on' === $page_settings['ba_use_container_height'] ) {
		if ( isset( $page_settings['ba_container_height'] ) && isset( $page_settings['ba_container_height_unit'] ) ) {
			$output .= sprintf(
				'%3$s, %3$s .dtq-popup-container { height: %1$s%2$s !important; }',
				esc_html( $page_settings['ba_container_height'] ),
				esc_html( $page_settings['ba_container_height_unit'] ),
				esc_html( $selector_prefix )
			);
		}
	}

	if ( isset( $page_settings['ba_container_padding'] ) ) {
		$output .= sprintf(
			'%2$s .dtq-popup-container .dtq-popup-container-inner { %1$s }',
			esc_html( ba_process_margin_padding( $page_settings['ba_container_padding'] ) ),
			esc_html( $selector_prefix )
		);
	}

	if ( isset( $page_settings['ba_container_border_radius'] ) ) {
		$output .= sprintf(
			'%2$s .dtq-popup-container .dtq-popup-container-inner { %1$s }',
			esc_html( ba_process_border_radius( $page_settings['ba_container_border_radius'] ) ),
			esc_html( $selector_prefix )
		);
	}

	if ( isset( $page_settings['ba_position_x'] ) ) {
		$output .= sprintf(
			'.et-fb-app-frame %2$s .dtq-popup-inner, %2$s.dtq-popup-front-mode .dtq-popup-inner{ justify-content: %1$s !important; }',
			esc_html( $page_settings['ba_position_x'] ),
			esc_html( $selector_prefix )
		);
	}

	if ( isset( $page_settings['ba_position_y'] ) ) {
		$output .= sprintf(
			'.et-fb-app-frame %2$s .dtq-popup-inner, %2$s.dtq-popup-front-mode .dtq-popup-inner { align-items: %1$s !important; }',
			esc_html( $page_settings['ba_position_y'] ),
			esc_html( $selector_prefix )
		);
	}

	if ( isset( $page_settings['ba_overlay_color'] ) ) {
		$output .= sprintf(
			'%2$s .dtq-popup-inner .dtq-popup-overlay { background-color: %1$s !important; }',
			esc_html( $page_settings['ba_overlay_color'] ),
			esc_html( $selector_prefix )
		);
	}

	return $output;
}

// Process Margin/Padding.
function ba_process_margin_padding( $value = '0|0|0|0', $type = 'padding' ) {

	if ( empty( $value ) ) {
		return;
	}

	$_top    = '';
	$_right  = '';
	$_bottom = '';
	$_left   = '';
	$suffix  = '';
	$_value  = explode( '|', $value );

	if ( ! empty( $_value[0] ) ) {
		$_top = "{$type}-top:" . $_value[0] . $suffix . ';';
	}

	if ( ! empty( $_value[1] ) ) {
		$_right = "{$type}-right:" . $_value[1] . $suffix . ';';
	}

	if ( ! empty( $_value[2] ) ) {
		$_bottom = "{$type}-bottom:" . $_value[2] . $suffix . ';';
	}

	if ( ! empty( $_value[3] ) ) {
		$_left = "{$type}-left:" . $_value[3] . $suffix . ';';
	}

	return esc_html( "{$_top} {$_right} {$_bottom} {$_left}" );

}

// Border Radius.
function ba_process_border_radius( $value = '0|0|0|0' ) {

	if ( empty( $value ) ) {
		return;
	}

	$_top_left     = '';
	$_top_right    = '';
	$_bottom_right = '';
	$_bottom_left  = '';
	$suffix        = '';
	$_value        = explode( '|', $value );

	if ( ! empty( $_value[0] ) ) {
		$_top_left = 'border-top-left-radius:' . $_value[0] . $suffix . ';';
	}

	if ( ! empty( $_value[1] ) ) {
		$_top_right = 'border-top-right-radius:' . $_value[1] . $suffix . ';';
	}

	if ( ! empty( $_value[2] ) ) {
		$_bottom_right = 'border-bottom-right-radius:' . $_value[2] . $suffix . ';';
	}

	if ( ! empty( $_value[3] ) ) {
		$_bottom_left = 'border-bottom-left-radius:' . $_value[3] . $suffix . ';';
	}

	return esc_html( "{$_top_left} {$_top_right} {$_bottom_right} {$_bottom_left}" );

}
