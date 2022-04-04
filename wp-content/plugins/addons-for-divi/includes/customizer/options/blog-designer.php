<?php

$wp_customize->add_panel(
    'divi_blog_designer',
    array(
        'title'    => esc_html__( 'Blog Designer', 'addons-for-divi' ),
        'type'     => 'brainaddons-panel',
        'priority' => -20,
    )
);

$wp_customize->add_section(
    'blog_designer_archive__section',
    array(
        'title'    => esc_html__( 'Blog / Archive', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_blog_designer',
    )
);

$wp_customize->add_section(
    'blog_designer_single__section',
    array(
        'title'    => esc_html__( 'Single Post', 'addons-for-divi' ),
        'priority' => 10,
        'type'     => 'brainaddons-section',
        'panel'    => 'divi_blog_designer',
    )
);

// Blog / Archive.
$wp_customize->add_setting(
    'brain_addons[blog_designer_nosidebar]',
    array(
        'default'           => $bd_defaults['blog_designer_nosidebar'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_nosidebar]',
        array(
            'label'    => esc_html__( 'Hide Sidebar', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_nosidebar]',
        )
    )
);

// Layout.
$wp_customize->add_setting(
    'brain_addons[blog_designer_layout]',
    array(
        'default'           => $bd_defaults['blog_designer_layout'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_blog_layout' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Radio_Image(
        $wp_customize,
        'brain_addons[blog_designer_layout]',
        array(
            'type'    => 'brainaddons-radio-image',
            'label'   => esc_html__( 'Layout', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
            'choices' => array(

                'layout-1' => array(
                    'label' => __( 'Layout 1', 'addons-for-divi' ),
                    'path'  => self::fetch_svg_icon( $customizer_imgs . 'default.svg' ),
                ),

                'layout-3' => array(
                    'label' => __( 'Layout 3', 'addons-for-divi' ),
                    'path'  => self::fetch_svg_icon( $customizer_imgs . 'right-post.svg' ),
                ),

                'layout-2' => array(
                    'label' => __( 'Layout 2', 'addons-for-divi' ),
                    'path'  => self::fetch_svg_icon( $customizer_imgs . 'left-post.svg' ),
                ),
            ),
        )
    )
);

//Grid.
$wp_customize->add_setting(
    'brain_addons[blog_designer_grid_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[blog_designer_grid_title]',
        array(
            'type'    => 'brainaddons-title',
            'label'   => esc_html__( 'Grid Layout', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_grid_layout]',
    array(
        'default'           => $bd_defaults['blog_designer_grid_layout'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'brain_addons[blog_designer_grid_layout]',
    array(
        'type'    => 'select',
        'label'   => esc_html__( 'Grid Layout', 'addons-for-divi' ),
        'section' => 'blog_designer_archive__section',
        'choices' => array(
            '1' => '1 Column',
            '2' => '2 Columns',
            '3' => '3 Columns',
            '4' => '4 Columns',
        ),
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_masonry_layout]',
    array(
        'default'           => $bd_defaults['blog_designer_masonry_layout'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_masonry_layout]',
        array(
            'label'    => esc_html__( 'Masonry Layout', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_masonry_layout]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_column_gap]',
    array(
        'default'           => $bd_defaults['blog_designer_column_gap'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_column_gap]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Column Gap (px)', 'addons-for-divi' ),
            'section'    => 'blog_designer_archive__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 200,
                'default' => $bd_defaults['blog_designer_column_gap'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_row_gap]',
    array(
        'default'           => $bd_defaults['blog_designer_row_gap'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_row_gap]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Row Gap (px)', 'addons-for-divi' ),
            'section'    => 'blog_designer_archive__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 200,
                'default' => $bd_defaults['blog_designer_row_gap'],
            ),
        )
    )
);

//Post Item Layout
$wp_customize->add_setting(
    'brain_addons[blog_designer_post_common]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[blog_designer_post_common]',
        array(
            'type'    => 'brainaddons-title',
            'label'   => esc_html__( 'Post Item', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_site_background]',
    array(
        'default'           => $bd_defaults['blog_designer_site_background'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_site_background]',
        array(
            'label'   => esc_html__( 'Site Background', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_content_background]',
    array(
        'default'           => $bd_defaults['blog_designer_content_background'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_content_background]',
        array(
            'label'   => esc_html__( 'Content Background', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_content_padding]',
    array(
        'default'           => $bd_defaults['blog_designer_content_padding'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_content_padding]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Content Padding (px)', 'addons-for-divi' ),
            'section'    => 'blog_designer_archive__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 200,
                'default' => $bd_defaults['blog_designer_content_padding'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_content_shadow]',
    array(
        'default'           => $bd_defaults['blog_designer_content_shadow'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_content_shadow]',
        array(
            'label'    => esc_html__( 'Content Box Shadow', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_content_shadow]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_content_round]',
    array(
        'default'           => $bd_defaults['blog_designer_content_round'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_content_round]',
        array(
            'label'    => esc_html__( 'Content Round', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_content_round]',
        )
    )
);

//Post Item Layout
$wp_customize->add_setting(
    'brain_addons[blog_designer_post_item_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[blog_designer_post_item_title]',
        array(
            'type'    => 'brainaddons-title',
            'label'   => esc_html__( 'Post Item Layout', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_post_featured]',
    array(
        'default'           => $bd_defaults['blog_designer_post_featured'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_post_featured]',
        array(
            'label'    => esc_html__( 'Featured', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_post_featured]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_post_title]',
    array(
        'default'           => $bd_defaults['blog_designer_post_title'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_post_title]',
        array(
            'label'    => esc_html__( 'Title', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_post_title]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_post_meta]',
    array(
        'default'           => $bd_defaults['blog_designer_post_meta'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_post_meta]',
        array(
            'label'    => esc_html__( 'Meta', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_post_meta]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_post_excerpt]',
    array(
        'default'           => $bd_defaults['blog_designer_post_excerpt'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_post_excerpt]',
        array(
            'label'    => esc_html__( 'Excerpt', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_post_excerpt]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_readmore]',
        array(
            'label'    => esc_html__( 'Readmore', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_readmore]',
        )
    )
);

// Featured
$wp_customize->add_setting(
    'brain_addons[blog_designer_featured_image_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[blog_designer_featured_image_title]',
        array(
            'type'    => 'brainaddons-title',
            'label'   => esc_html__( 'Featured Image', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_featured_image_inherit]',
    array(
        'default'           => $bd_defaults['blog_designer_featured_image_inherit'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_featured_image_inherit]',
        array(
            'label'    => esc_html__( 'Custom Height', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_featured_image_inherit]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_featured_image_height]',
    array(
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_featured_image_height]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Height (px)', 'addons-for-divi' ),
            'section'    => 'blog_designer_archive__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 500,
                'default' => '',
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_featured_image_space]',
    array(
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_featured_image_space]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Margin Bottom (px)', 'addons-for-divi' ),
            'section'    => 'blog_designer_archive__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => -100,
                'max'     => 100,
                'default' => '',
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_remove_featured_image_padding]',
    array(
        'default'           => $bd_defaults['blog_designer_remove_featured_image_padding'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_remove_featured_image_padding]',
        array(
            'label'    => esc_html__( 'Remove Featured Image Padding', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_remove_featured_image_padding]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_featured_image_hover]',
    array(
        'default'           => $bd_defaults['blog_designer_featured_image_hover'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'brain_addons[blog_designer_featured_image_hover]',
    array(
        'type'    => 'select',
        'label'   => esc_html__( 'Hover Animation', 'addons-for-divi' ),
        'section' => 'blog_designer_archive__section',
        'choices' => array(
            'none'     => esc_html__( 'None', 'addons-for-divi' ),
            'zoon_in'  => esc_html__( 'Zoom In', 'addons-for-divi' ),
            'zoon_out' => esc_html__( 'Zoom Out', 'addons-for-divi' ),
            'fade'     => esc_html__( 'Fade', 'addons-for-divi' ),
        ),
    )
);

// Readmore.
$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[blog_designer_readmore_title]',
        array(
            'type'    => 'brainaddons-title',
            'label'   => esc_html__( 'Readmore', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_text]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_text'],
        'type'              => 'option',
        'sanitize_callback' => 'esc_html',
    )
);

$wp_customize->add_control(
    'brain_addons[blog_designer_readmore_text]',
    array(
        'label'   => esc_html__( 'Read More Text', 'addons-for-divi' ),
        'section' => 'blog_designer_archive__section',
        'type'    => 'text',
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_fullwidth]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_fullwidth'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_readmore_fullwidth]',
        array(
            'label'    => esc_html__( 'Readmore Full Width', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_readmore_fullwidth]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_font_size]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_font_size'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_readmore_font_size]',
        array(
            'label'      => esc_html__( 'Text Size (px)', 'addons-for-divi' ),
            'section'    => 'blog_designer_archive__section',
            'type'       => 'range-value',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $bd_defaults['blog_designer_readmore_font_size'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_text_color]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_text_color'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_readmore_text_color]',
        array(
            'label'    => esc_html__( 'Text Color', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'settings' => 'brain_addons[blog_designer_readmore_text_color]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_bg_color]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_bg_color'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_readmore_bg_color]',
        array(
            'label'    => esc_html__( 'Background Color', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'settings' => 'brain_addons[blog_designer_readmore_bg_color]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_padding]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_padding'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_readmore_padding]',
        array(
            'label'       => esc_html__( 'Inner Padding (px)', 'addons-for-divi' ),
            'section'     => 'blog_designer_archive__section',
            'type'        => 'range-value',
            'step'        => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $bd_defaults['blog_designer_readmore_padding'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_border_width]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_border_width'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_readmore_border_width]',
        array(
            'label'       => esc_html__( 'Border Width (px)', 'addons-for-divi' ),
            'section'     => 'blog_designer_archive__section',
            'type'        => 'range-value',
            'step'        => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 10,
                'default' => $bd_defaults['blog_designer_readmore_border_width'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_border_color]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_border_color'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_readmore_border_color]',
        array(
            'label'    => esc_html__( 'Border Color', 'addons-for-divi' ),
            'section'  => 'blog_designer_archive__section',
            'settings' => 'brain_addons[blog_designer_readmore_border_color]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_border_radius]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_border_radius'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_readmore_border_radius]',
        array(
            'label'       => esc_html__( 'Border Radius (px)', 'addons-for-divi' ),
            'section'     => 'blog_designer_archive__section',
            'type'        => 'range-value',
            'step'        => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 50,
                'default' => $bd_defaults['blog_designer_readmore_border_radius'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_spacing]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_spacing'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_readmore_spacing]',
        array(
            'label'       => esc_html__( 'Letter Spacing (px)', 'addons-for-divi' ),
            'section'     => 'blog_designer_archive__section',
            'type'        => 'range-value',
            'step'        => 1,
            'input_attr' => array(
                'min'     => -2,
                'max'     => 10,
                'default' => $bd_defaults['blog_designer_readmore_spacing'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_font_weight]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_font_weight'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_readmore_font_weight]',
        array(
            'label'   => esc_html__( 'Font Weight', 'addons-for-divi' ),
            'section' => 'blog_designer_archive__section',
            'type'        => 'range-value',
            'step'        => 100,
            'input_attr' => array(
                'min'     => 100,
                'max'     => 900,
                'default' => $bd_defaults['blog_designer_readmore_font_weight'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_readmore_top_space]',
    array(
        'default'           => $bd_defaults['blog_designer_readmore_top_space'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_readmore_top_space]',
        array(
            'label'       => esc_html__( 'Top Spacing (px)', 'addons-for-divi' ),
            'section'     => 'blog_designer_archive__section',
            'type'        => 'range-value',
            'step'        => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 100,
                'default' => $bd_defaults['blog_designer_readmore_top_space'],
            ),
        )
    )
);

// Single.
$wp_customize->add_setting(
    'brain_addons[blog_designer_single_nosidebar]',
    array(
        'default'           => $bd_defaults['blog_designer_single_nosidebar'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_nosidebar]',
        array(
            'label'    => esc_html__( 'Hide Sidebar', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_single_nosidebar]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_custom_width]',
    array(
        'default'           => $bd_defaults['blog_designer_single_custom_width'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_custom_width]',
        array(
            'label'    => esc_html__( 'Custom Width', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_single_custom_width]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_page_width]',
    array(
        'default'           => $bd_defaults['blog_designer_single_page_width'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_single_page_width]',
        array(
            'label'       => esc_html__( 'Width (px)', 'addons-for-divi' ),
            'section'     => 'blog_designer_single__section',
            'type'        => 'range-value',
            'step'        => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 1920,
                'default' => $bd_defaults['blog_designer_single_page_width'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_content_padding]',
    array(
        'default'           => $bd_defaults['blog_designer_single_content_padding'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_single_content_padding]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Content Padding (px)', 'addons-for-divi' ),
            'section'    => 'blog_designer_single__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 200,
                'default' => $bd_defaults['blog_designer_single_content_padding'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_content_margin]',
    array(
        'default'           => $bd_defaults['blog_designer_single_content_margin'],
        'type'              => 'option',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new BrainAddons_Range(
        $wp_customize,
        'brain_addons[blog_designer_single_content_margin]',
        array(
            'type'       => 'range-value',
            'label'      => esc_html__( 'Bottom Margin (px)', 'addons-for-divi' ),
            'section'    => 'blog_designer_single__section',
            'step'       => 1,
            'input_attr' => array(
                'min'     => 0,
                'max'     => 200,
                'default' => $bd_defaults['blog_designer_single_content_margin'],
            ),
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_site_background]',
    array(
        'default'           => $bd_defaults['blog_designer_site_background'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_site_background]',
        array(
            'label'   => esc_html__( 'Site Background', 'addons-for-divi' ),
            'section' => 'blog_designer_single__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_content_background]',
    array(
        'default'           => $bd_defaults['blog_designer_single_content_background'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_content_background]',
        array(
            'label'   => esc_html__( 'Content Background', 'addons-for-divi' ),
            'section' => 'blog_designer_single__section',
        )
    )
);

// Single Content Elements.
$wp_customize->add_setting(
    'brain_addons[blog_designer_single_content_elements_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_content_elements_title]',
        array(
            'type'    => 'brainaddons-title',
            'label'   => esc_html__( 'Single Elements', 'addons-for-divi' ),
            'section' => 'blog_designer_single__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_post_featured]',
    array(
        'default'           => $bd_defaults['blog_designer_single_post_featured'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_post_featured]',
        array(
            'label'    => esc_html__( 'Featured', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_single_post_featured]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_post_title]',
    array(
        'default'           => $bd_defaults['blog_designer_single_post_title'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_post_title]',
        array(
            'label'    => esc_html__( 'Title', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_single_post_title]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_post_meta]',
    array(
        'default'           => $bd_defaults['blog_designer_single_post_meta'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_post_meta]',
        array(
            'label'    => esc_html__( 'Meta', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_single_post_meta]',
        )
    )
);

// Extra
$wp_customize->add_setting(
    'brain_addons[blog_designer_single_extra_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_extra_title]',
        array(
            'type'    => 'brainaddons-title',
            'label'   => esc_html__( 'Extra', 'addons-for-divi' ),
            'section' => 'blog_designer_single__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_author_info]',
    array(
        'default'           => $bd_defaults['blog_designer_single_author_info'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_author_info]',
        array(
            'label'    => esc_html__( 'Show Post Author Box?', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_single_author_info]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_post_navigation]',
    array(
        'default'           => $bd_defaults['blog_designer_single_post_navigation'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_post_navigation]',
        array(
            'label'    => esc_html__( 'Show Post Navigation?', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_single_post_navigation]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_single_related_posts]',
    array(
        'default'           => $bd_defaults['blog_designer_single_related_posts'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_related_posts]',
        array(
            'label'    => esc_html__( 'Show Related Posts?', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_single_related_posts]',
        )
    )
);

// Extra Design.

// Related Posts.
$wp_customize->add_setting(
    'brain_addons[blog_designer_single_related_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new BrainAddons_Title_Control(
        $wp_customize,
        'brain_addons[blog_designer_single_related_title]',
        array(
            'type'    => 'brainaddons-title',
            'label'   => esc_html__( 'Related Posts', 'addons-for-divi' ),
            'section' => 'blog_designer_single__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_related_posts_fullwidth]',
    array(
        'default'           => $bd_defaults['blog_designer_related_posts_fullwidth'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_related_posts_fullwidth]',
        array(
            'label'    => esc_html__( 'Full Width', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_related_posts_fullwidth]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_related_posts_excerpt]',
    array(
        'default'           => $bd_defaults['blog_designer_related_posts_excerpt'],
        'type'              => 'option',
        'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
    )
);

$wp_customize->add_control(
    new BrainAddons_Toggle_Control(
        $wp_customize,
        'brain_addons[blog_designer_related_posts_excerpt]',
        array(
            'label'    => esc_html__( 'Excerpt', 'addons-for-divi' ),
            'section'  => 'blog_designer_single__section',
            'type'     => 'brainaddons-toggle',
            'settings' => 'brain_addons[blog_designer_related_posts_excerpt]',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_related_posts_column]',
    array(
        'default'           => $bd_defaults['blog_designer_related_posts_column'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'brain_addons[blog_designer_related_posts_column]',
    array(
        'type'    => 'select',
        'label'   => esc_html__( 'Slider Column', 'addons-for-divi' ),
        'section' => 'blog_designer_single__section',
        'choices' => array(
            '2' => '2 Columns',
            '3' => '3 Columns',
            '4' => '4 Columns',
        ),
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_related_posts_background]',
    array(
        'default'           => $bd_defaults['blog_designer_related_posts_background'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_related_posts_background]',
        array(
            'label'   => esc_html__( 'Background', 'addons-for-divi' ),
            'section' => 'blog_designer_single__section',
        )
    )
);

$wp_customize->add_setting(
    'brain_addons[blog_designer_related_posts_title_color]',
    array(
        'default'           => $bd_defaults['blog_designer_related_posts_title_color'],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'brain_addons[blog_designer_related_posts_title_color]',
        array(
            'label'   => esc_html__( 'Title Color', 'addons-for-divi' ),
            'section' => 'blog_designer_single__section',
        )
    )
);