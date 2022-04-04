<?php

$brainaddons_background_choices = $this->get_background_choices();

$wp_customize->add_panel(
    'divi_login_designer',
    array(
        'title'    => esc_html__( 'Login Designer', 'addons-for-divi' ),
        'type'     => 'brainaddons-panel',
        'priority' => -20,
    )
);

// Background.
$wp_customize->add_section(
    'login_designer_bg__section',
    array(
        'title'    => esc_html__( 'Background', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_login_designer',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_bg_image]',
    array(
        'default'           => '',
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'brain_addons[login_designer_bg_image]',
        array(
            'label'    => esc_html__( 'Background Image', 'addons-for-divi' ),
            'section'  => 'login_designer_bg__section',
            'settings' => 'brain_addons[login_designer_bg_image]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_bg_color]',
    array(
        'default'           => $ld_defaults['login_designer_bg_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_bg_color]',
        array(
            'label'   => esc_html__( 'Background Color', 'addons-for-divi' ),
            'section' => 'login_designer_bg__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_bg_position]',
    array(
        'default'           => $ld_defaults['login_designer_bg_position'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'brain_addons[login_designer_bg_position]',
    array(
        'type'    => 'select',
        'label'   => esc_html__( 'Position', 'addons-for-divi' ),
        'section' => 'login_designer_bg__section',
        'choices' => $brainaddons_background_choices['position'],
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_bg_repeat]',
    array(
        'default'           => $ld_defaults['login_designer_bg_repeat'],
        'type'              => 'option',
        'default'           => 'no-repeat',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'brain_addons[login_designer_bg_repeat]',
    array(
        'type'    => 'select',
        'label'   => esc_html__( 'Repeat', 'addons-for-divi' ),
        'section' => 'login_designer_bg__section',
        'choices' => $brainaddons_background_choices['repeat'],
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_bg_size]',
    array(
        'default'           => $ld_defaults['login_designer_bg_size'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'brain_addons[login_designer_bg_size]',
    array(
        'type'    => 'select',
        'label'   => esc_html__( 'Size', 'addons-for-divi' ),
        'section' => 'login_designer_bg__section',
        'choices' => $brainaddons_background_choices['size'],
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_bg_attach]',
    array(
        'default'           => $ld_defaults['login_designer_bg_attach'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'brain_addons[login_designer_bg_attach]',
    array(
        'type'    => 'select',
        'label'   => esc_html__( 'Attachment', 'addons-for-divi' ),
        'section' => 'login_designer_bg__section',
        'choices' => $brainaddons_background_choices['attach'],
    )
);

// Logo.
$wp_customize->add_section(
    'login_designer_logo__section',
    array(
        'title'    => esc_html__( 'Logo', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_login_designer',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_logo]',
    array(
        'default'           => '',
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control(
    new WP_Customize_Media_Control(
        $wp_customize,
        'brain_addons[login_designer_logo]',
        array(
            'label'       => esc_html__( 'Upload', 'addons-for-divi' ),
            'description' => esc_html__( 'Add your own logo. Logos will display at 50% height and width to account for retina devices. Modify the height and width below.', 'addons-for-divi' ),
            'section'     => 'login_designer_logo__section',
            'settings'    => 'brain_addons[login_designer_logo]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_logo_url]',
    array(
        'default'           => $ld_defaults['login_designer_logo_url'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    'brain_addons[login_designer_logo_url]',
    array(
        'label'          => esc_html__( 'URL', 'addons-for-divi' ),
        'description'    => esc_html__( 'The page where your logo will take you. ', 'addons-for-divi' ),
        'section'        => 'login_designer_logo__section',
        'type'           => 'dropdown-pages',
        'allow_addition' => false,
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_logo_width]',
    array(
        'default'           => $ld_defaults['login_designer_logo_width'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_logo_width]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Width', 'addons-for-divi' ),
            'section'    => 'login_designer_logo__section',
            'default'    => $ld_defaults['login_designer_logo_width'],
            'input_attr' => array(
                'min'  => 30,
                'max'  => 300,
                'step' => 1,
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_logo_height]',
    array(
        'default'           => $ld_defaults['login_designer_logo_height'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_logo_height]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Height', 'addons-for-divi' ),
            'section'    => 'login_designer_logo__section',
            'default'    => $ld_defaults['login_designer_logo_height'],
            'input_attr' => array(
                'min'  => 30,
                'max'  => 300,
                'step' => 1,
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_logo_margin_bottom]',
    array(
        'default'           => $ld_defaults['login_designer_logo_margin_bottom'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_logo_margin_bottom]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Position', 'addons-for-divi' ),
            'section'    => 'login_designer_logo__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 200,
                'default' => $ld_defaults['login_designer_logo_margin_bottom'],
            ),
        )
    )
);

// Form.
$wp_customize->add_section(
    'login_designer_form__section',
    array(
        'title'    => esc_html__( 'Form', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_login_designer',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_bg_image]',
    array(
        'default'           => '',
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'brain_addons[login_designer_form_bg_image]',
        array(
            'label'    => esc_html__( 'Background Image', 'addons-for-divi' ),
            'section'  => 'login_designer_form__section',
            'settings' => 'brain_addons[login_designer_form_bg_image]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_bg_color]',
    array(
        'default'           => $ld_defaults['login_designer_form_bg_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_form_bg_color]',
        array(
            'label'   => esc_html__( 'Background Color', 'addons-for-divi' ),
            'section' => 'login_designer_form__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_width]',
    array(
        'default'           => $ld_defaults['login_designer_form_width'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_form_width]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Width', 'addons-for-divi' ),
            'section'    => 'login_designer_form__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 800,
                'default' => $ld_defaults['login_designer_form_width'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_side_padding]',
    array(
        'default'           => $ld_defaults['login_designer_form_side_padding'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_form_side_padding]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Side Padding', 'addons-for-divi' ),
            'section'    => 'login_designer_form__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 600,
                'default' => $ld_defaults['login_designer_form_side_padding'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_vertical_padding]',
    array(
        'default'           => $ld_defaults['login_designer_form_vertical_padding'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_form_vertical_padding]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Vertical Padding', 'addons-for-divi' ),
            'section'    => 'login_designer_form__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 600,
                'default' => $ld_defaults['login_designer_form_vertical_padding'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_radius]',
    array(
        'default'           => $ld_defaults['login_designer_form_radius'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_form_radius]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Border Radius', 'addons-for-divi' ),
            'section'    => 'login_designer_form__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_form_radius'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_shadow]',
    array(
        'default'           => $ld_defaults['login_designer_form_shadow'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_form_shadow]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Shadow', 'addons-for-divi' ),
            'section'    => 'login_designer_form__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_form_shadow'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_shadow_opacity]',
    array(
        'default'           => $ld_defaults['login_designer_form_shadow_opacity'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_form_shadow_opacity]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Shadow Opacity', 'addons-for-divi' ),
            'section'    => 'login_designer_form__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_form_shadow_opacity'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_form_border_color]',
    array(
        'default'           => $ld_defaults['login_designer_form_border_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_form_border_color]',
        array(
            'label'   => esc_html__( 'Border Color', 'addons-for-divi' ),
            'section' => 'login_designer_form__section',
        )
    )
);

// Fields.
$wp_customize->add_section(
    'login_designer_fields__section',
    array(
        'title'    => esc_html__( 'Fields', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_login_designer',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_fields_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[login_designer_fields_title]',
        array(
            'type'        => 'brainaddons-title',
            'label'       => esc_html__( 'Fields', 'addons-for-divi' ),
            'description' => esc_html__( 'Customize display appearance of the login input fields.', 'addons-for-divi' ),
            'section'     => 'login_designer_fields__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_fields_bg_color]',
    array(
        'default'           => $ld_defaults['login_designer_fields_bg_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_fields_bg_color]',
        array(
            'label'   => esc_html__( 'Background Color', 'addons-for-divi' ),
            'section' => 'login_designer_fields__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_side_padding]',
    array(
        'default'           => $ld_defaults['login_designer_field_side_padding'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_side_padding]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Side Padding', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 600,
                'default' => $ld_defaults['login_designer_field_side_padding'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_side_padding]',
    array(
        'default'           => $ld_defaults['login_designer_field_side_padding'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_side_padding]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Side Padding', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 600,
                'default' => $ld_defaults['login_designer_field_side_padding'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_padding_bottom]',
    array(
        'default'           => $ld_defaults['login_designer_field_padding_bottom'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_padding_bottom]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Padding Bottom', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 600,
                'default' => $ld_defaults['login_designer_field_padding_bottom'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_padding_top]',
    array(
        'default'           => $ld_defaults['login_designer_field_padding_top'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_padding_top]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Padding Top', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 600,
                'default' => $ld_defaults['login_designer_field_padding_top'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_margin_bottom]',
    array(
        'default'           => $ld_defaults['login_designer_field_margin_bottom'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_margin_bottom]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Margin Bottom', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 600,
                'default' => $ld_defaults['login_designer_field_margin_bottom'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_border]',
    array(
        'default'           => $ld_defaults['login_designer_field_border'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_border]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Border', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_field_border'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_border_color]',
    array(
        'default'           => $ld_defaults['login_designer_field_border_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_field_border_color]',
        array(
            'label'   => esc_html__( 'Border Color', 'addons-for-divi' ),
            'section' => 'login_designer_fields__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_radius]',
    array(
        'default'           => $ld_defaults['login_designer_field_radius'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_radius]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Border Radius', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_field_radius'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_shadow]',
    array(
        'default'           => $ld_defaults['login_designer_field_shadow'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_shadow]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Shadow', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_field_shadow'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_shadow_opacity]',
    array(
        'default'           => $ld_defaults['login_designer_field_shadow_opacity'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_shadow_opacity]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Shadow Opacity', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_field_shadow_opacity'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_shadow_inset]',
    array(
        'default'           => $ld_defaults['login_designer_field_shadow_inset'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[login_designer_field_shadow_inset]',
        array(
            'label'    => esc_html__( 'Shadow Inset', 'addons-for-divi' ),
            'section'  => 'login_designer_fields__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[login_designer_field_shadow_inset]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_font_size]',
    array(
        'default'           => $ld_defaults['login_designer_field_font_size'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_field_font_size]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Font Size', 'addons-for-divi' ),
            'section'    => 'login_designer_fields__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_field_font_size'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_field_color]',
    array(
        'default'           => $ld_defaults['login_designer_field_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_field_color]',
        array(
            'label'   => esc_html__( 'Text Color', 'addons-for-divi' ),
            'section' => 'login_designer_fields__section',
        )
    )
);

$wp_customize->add_section(
    'login_designer_remember__section',
    array(
        'title'    => esc_html__( 'Remember', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_login_designer',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_remember_field_font_size]',
    array(
        'default'           => $ld_defaults['login_designer_remember_field_font_size'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_remember_field_font_size]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Font Size', 'addons-for-divi' ),
            'section'    => 'login_designer_remember__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_remember_field_font_size'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_remember_field_position]',
    array(
        'default'           => $ld_defaults['login_designer_remember_field_position'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_remember_field_position]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Position', 'addons-for-divi' ),
            'section'    => 'login_designer_remember__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_remember_field_position'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_remember_field_color]',
    array(
        'default'           => $ld_defaults['login_designer_remember_field_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_remember_field_color]',
        array(
            'label'   => esc_html__( 'Color', 'addons-for-divi' ),
            'section' => 'login_designer_remember__section',
        )
    )
);

// Label.
$wp_customize->add_section(
    'login_designer_label__section',
    array(
        'title'    => esc_html__( 'Labels', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_login_designer',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_label_font_size]',
    array(
        'default'           => $ld_defaults['login_designer_label_font_size'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_label_font_size]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Font Size', 'addons-for-divi' ),
            'section'    => 'login_designer_label__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_label_font_size'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_label_position]',
    array(
        'default'           => $ld_defaults['login_designer_label_position'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_label_position]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Label Position', 'addons-for-divi' ),
            'section'    => 'login_designer_label__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_label_position'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_label_color]',
    array(
        'default'           => $ld_defaults['login_designer_label_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_label_color]',
        array(
            'label'   => esc_html__( 'Label Color', 'addons-for-divi' ),
            'section' => 'login_designer_label__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_username_label]',
    array(
        'default'           => $ld_defaults['login_designer_username_label'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control(
    'brain_addons[login_designer_username_label]',
    array(
        'label'   => esc_html__( 'Username', 'addons-for-divi' ),
        'section' => 'login_designer_label__section',
        'type'    => 'text',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_password_label]',
    array(
        'default'           => $ld_defaults['login_designer_password_label'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control(
    'brain_addons[login_designer_password_label]',
    array(
        'label'   => esc_html__( 'Password', 'addons-for-divi' ),
        'section' => 'login_designer_label__section',
        'type'    => 'text',
    )
);

// Button.
$wp_customize->add_section(
    'login_designer_button__section',
    array(
        'title'    => esc_html__( 'Button', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_login_designer',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_bg]',
    array(
        'default'           => $ld_defaults['login_designer_button_bg'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_button_bg]',
        array(
            'label'   => esc_html__( 'Background', 'addons-for-divi' ),
            'section' => 'login_designer_button__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_padding_top]',
    array(
        'default'           => $ld_defaults['login_designer_button_padding_top'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_button_padding_top]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Padding Top', 'addons-for-divi' ),
            'section'    => 'login_designer_button__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_button_padding_top'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_padding_bottom]',
    array(
        'default'           => $ld_defaults['login_designer_button_padding_bottom'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_button_padding_bottom]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Padding Bottom', 'addons-for-divi' ),
            'section'    => 'login_designer_button__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_button_padding_bottom'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_side_padding]',
    array(
        'default'           => $ld_defaults['login_designer_button_side_padding'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_button_side_padding]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Side Padding', 'addons-for-divi' ),
            'section'    => 'login_designer_button__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $ld_defaults['login_designer_button_side_padding'],
            ),
        )
    )
);
$wp_customize->add_setting(
    'brain_addons[login_designer_button_radius]',
    array(
        'default'           => $ld_defaults['login_designer_button_radius'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_button_radius]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Border Radius', 'addons-for-divi' ),
            'section'    => 'login_designer_button__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_button_radius'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_border]',
    array(
        'default'           => $ld_defaults['login_designer_button_border'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_button_border]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Border', 'addons-for-divi' ),
            'section'    => 'login_designer_button__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_button_border'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_border_color]',
    array(
        'default'           => $ld_defaults['login_designer_button_border_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_button_border_color]',
        array(
            'label'   => esc_html__( 'Border Color', 'addons-for-divi' ),
            'section' => 'login_designer_button__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_shadow]',
    array(
        'default'           => $ld_defaults['login_designer_button_shadow'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_button_shadow]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Shadow', 'addons-for-divi' ),
            'section'    => 'login_designer_button__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_button_shadow'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_shadow_opacity]',
    array(
        'default'           => $ld_defaults['login_designer_button_shadow_opacity'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_button_shadow_opacity]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Shadow Opacity', 'addons-for-divi' ),
            'section'    => 'login_designer_button__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_button_shadow_opacity'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_color]',
    array(
        'default'           => $ld_defaults['login_designer_button_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_button_color]',
        array(
            'label'   => esc_html__( 'Color', 'addons-for-divi' ),
            'section' => 'login_designer_button__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_button_font_size]',
    array(
        'default'           => $ld_defaults['login_designer_button_font_size'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_button_font_size]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Font Size', 'addons-for-divi' ),
            'section'    => 'login_designer_button__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 20,
                'default' => $ld_defaults['login_designer_button_font_size'],
            ),
        )
    )
);

// Below Form.
$wp_customize->add_section(
    'login_designer_below__section',
    array(
        'title'    => esc_html__( 'Below Form', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_login_designer',
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_lost_password]',
    array(
        'default'           => $ld_defaults['login_designer_lost_password'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[login_designer_lost_password]',
        array(
            'label'    => esc_html__( 'Lost Password', 'addons-for-divi' ),
            'section'  => 'login_designer_below__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[login_designer_lost_password]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_back_to]',
    array(
        'default'           => $ld_defaults['login_designer_back_to'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[login_designer_back_to]',
        array(
            'label'    => esc_html__( 'Back to', 'addons-for-divi' ),
            'section'  => 'login_designer_below__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[login_designer_back_to]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_below_font_size]',
    array(
        'default'           => $ld_defaults['login_designer_below_font_size'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_below_font_size]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Font Size', 'addons-for-divi' ),
            'section'    => 'login_designer_below__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_below_font_size'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_below_position]',
    array(
        'default'           => $ld_defaults['login_designer_below_position'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[login_designer_below_position]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Position', 'addons-for-divi' ),
            'section'    => 'login_designer_below__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $ld_defaults['login_designer_below_position'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[login_designer_below_color]',
    array(
        'default'           => $ld_defaults['login_designer_below_color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[login_designer_below_color]',
        array(
            'label'   => esc_html__( 'Color', 'addons-for-divi' ),
            'section' => 'login_designer_below__section',
        )
    )
);
