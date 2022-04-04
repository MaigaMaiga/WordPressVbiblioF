<?php
class DTQ_Logo_Carousel extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com//logo-carousel-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->name       = esc_html__( 'Torque Logo Carousel', 'addons-for-divi' );
		$this->slug       = 'ba_logo_carousel';
		$this->vb_support = 'on';
		$this->child_slug = 'ba_logo_carousel_child';
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'logo-carousel.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'logo_settings'     => esc_html__( 'Logo Settings', 'addons-for-divi' ),
					'carousel_settings' => array(
						'title'             => esc_html__( 'Carousel Settings', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general'  => array(
								'name' => esc_html__( 'General', 'addons-for-divi' ),
							),
							'advanced' => array(
								'name' => esc_html__( 'Advanced', 'addons-for-divi' ),
							),
						),
					),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'nav'  => array(
						'title'             => esc_html__( 'Navigation', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'nav_common' => array(
								'name' => esc_html__( 'Common', 'addons-for-divi' ),
							),
							'nav_left'   => array(
								'name' => esc_html__( 'Left', 'addons-for-divi' ),
							),
							'nav_right'  => array(
								'name' => esc_html__( 'Right', 'addons-for-divi' ),
							),
						),
					),
					'pagi' => array(
						'title'             => esc_html__( 'Pagination', 'addons-for-divi' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'pagi_common' => array(
								'name' => esc_html__( 'Common', 'addons-for-divi' ),
							),
							'pagi_active' => array(
								'name' => esc_html__( 'Active', 'addons-for-divi' ),
							),
						),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'logo'      => array(
				'label'    => esc_html__( 'Logo', 'addons-for-divi' ),
				'selector' => '%%order_class%% .ba_logo_carousel_child img',
			),
			'nav_prev'  => array(
				'label'    => esc_html__( 'Prev (Navigation)', 'addons-for-divi' ),
				'selector' => '%%order_class%% .slick-arrow.slick-prev',
			),
			'nav_next'  => array(
				'label'    => esc_html__( 'Next (Navigation)', 'addons-for-divi' ),
				'selector' => '%%order_class%% .slick-arrow.slick-next',
			),
			'pagi_dots' => array(
				'label'    => esc_html__( 'Pagination Wrapper', 'addons-for-divi' ),
				'selector' => '%%order_class%% .slick-dots',
			),
			'pagi_item' => array(
				'label'    => esc_html__( 'Pagination Item', 'addons-for-divi' ),
				'selector' => '%%order_class%% .slick-dots li',
			),
			'pagi_dot'  => array(
				'label'    => esc_html__( 'Pagination Dot', 'addons-for-divi' ),
				'selector' => '%%order_class%% .slick-dots button',
			),
		);
	}

	public function get_fields() {

		$carousel_options = $this->get_carousel_option_fields( array(), array(), array() );

		$logo_options = array(

			'logo_height' => array(
				'label'           => esc_html__( 'Height', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define custom logo height.', 'addons-for-divi' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => 'auto',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'step' => 1,
					'min'  => 1,
					'max'  => 1000,
				),
				'toggle_slug'     => 'logo_settings',
				'mobile_options'  => true,
			),

			'logo_width'  => array(
				'label'           => esc_html__( 'Width', 'addons-for-divi' ),
				'description'     => esc_html__( 'Define custom logo width.', 'addons-for-divi' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => 'auto',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'step' => 1,
					'min'  => 1,
					'max'  => 1000,
				),
				'toggle_slug'     => 'logo_settings',
				'mobile_options'  => true,
			),

			'logo_hover'  => array(
				'label'       => esc_html__( 'Logo Hover Animation', 'addons-for-divi' ),
				'description' => esc_html__( 'Select hover animation for the logo.', 'addons-for-divi' ),
				'type'        => 'select',
				'toggle_slug' => 'logo_settings',
				'default'     => 'zoom_in',
				'options'     => array(
					'no_hover'      => esc_html__( 'None', 'addons-for-divi' ),
					'zoom_in'       => esc_html__( 'Zoom In', 'addons-for-divi' ),
					'zoom_out'      => esc_html__( 'Zoom Out', 'addons-for-divi' ),
					'fade'          => esc_html__( 'Fade', 'addons-for-divi' ),
					'black_n_white' => esc_html__( 'Black and White', 'addons-for-divi' ),
				),
			),
		);

		return array_merge( $carousel_options, $logo_options );
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['borders']     = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		return $advanced_fields;
	}

	public function render( $attrs, $content, $render_slug ) {

		wp_enqueue_script( 'dtqj-slick' );
		wp_enqueue_style( 'dtqc-slick' );
		$this->render_css( $render_slug );

		$content          = $this->props['content'];
		$logo_hover       = $this->props['logo_hover'];
		$is_center        = $this->props['is_center'];
		$center_mode_type = $this->props['center_mode_type'];
		$custom_cursor    = $this->props['custom_cursor'];
		$classes          = array();

		array_push( $classes, $logo_hover );

		if ( 'on' === $is_center ) {
			array_push( $classes, 'dtq-centered' );
			array_push( $classes, "dtq-centered--{$center_mode_type}" );
		}

		if ( 'on' === $custom_cursor ) {
			array_push( $classes, 'dtq-cursor' );
		}

		$output = sprintf(
			'<div class = "dtq-carousel dtq-logo-carousel dtq-carousel-frontend %3$s" %2$s >
                %1$s
            </div>',
			$content,
			$this->get_carousel_options_data(),
			join( ' ', $classes )
		);

		return $output;
	}

	public function render_logo_css( $render_slug ) {

		$logo_height                   = $this->props['logo_height'];
		$logo_height_tablet            = $this->props['logo_height_tablet'];
		$logo_height_phone             = $this->props['logo_height_phone'];
		$logo_height_last_edited       = $this->props['logo_height_last_edited'];
		$logo_height_responsive_status = et_pb_get_responsive_status( $logo_height_last_edited );

		$logo_width                   = $this->props['logo_width'];
		$logo_width_tablet            = $this->props['logo_width_tablet'];
		$logo_width_phone             = $this->props['logo_width_phone'];
		$logo_width_last_edited       = $this->props['logo_width_last_edited'];
		$logo_width_responsive_status = et_pb_get_responsive_status( $logo_width_last_edited );

		if ( $logo_height !== 'auto' ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-logo-carousel-item',
					'declaration' => sprintf( 'height: %1$s;display: flex; justify-content: center; align-items: center;', $logo_height ),
				)
			);

			if ( $logo_height_tablet && $logo_height_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-logo-carousel-item',
						'declaration' => sprintf( 'height: %1$s;display: flex; justify-content: center; align-items: center; ', $logo_height_tablet ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					)
				);
			}

			if ( $logo_height_phone && $logo_height_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-logo-carousel-item',
						'declaration' => sprintf( 'height: %1$s; display: flex; justify-content: center; align-items: center;`', $logo_height_phone ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					)
				);
			}
		}

		if ( 'auto' !== $logo_width ) {

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtq-logo-carousel-item img',
					'declaration' => sprintf( 'width: %1$s;', $logo_width ),
				)
			);

			if ( $logo_width_tablet && $logo_width_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-logo-carousel-item img',
						'declaration' => sprintf( 'width: %1$s;', $logo_width_tablet ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					)
				);
			}

			if ( $logo_width_phone && $logo_width_responsive_status ) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtq-logo-carousel-item img',
						'declaration' => sprintf( 'width: %1$s;`', $logo_width_phone ),
						'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					)
				);
			}
		}
	}

	public function render_css( $render_slug ) {
		$this->render_carousel_css( $render_slug );
		$this->render_logo_css( $render_slug );
	}

}

new DTQ_Logo_Carousel();
