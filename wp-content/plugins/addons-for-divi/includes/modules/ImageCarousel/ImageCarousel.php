<?php
class DTQ_Image_Carousel extends BA_Builder_Module {

	protected $module_credits = array(
		'module_uri' => 'https://divitorque.com/image-carousel-module/',
		'author'     => 'DiviTorque',
		'author_uri' => 'https://divitorque.com/',
	);

	public function init() {

		$this->vb_support = 'on';
		$this->slug       = 'ba_image_carousel';
		$this->child_slug = 'ba_image_carousel_child';
		$this->name       = esc_html__( 'Torque Image Carousel', 'addons-for-divi' );
		$this->icon_path  = plugin_dir_path( __FILE__ ) . 'image-carousel.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
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
		return $this->get_carousel_option_fields( array( 'lightbox' ), array(), array() );
	}

	public function get_advanced_fields_config() {

		$advanced_fields = array();

		$advanced_fields['text']         = false;
		$advanced_fields['borders']      = false;
		$advanced_fields['text_shadow']  = false;
		$advanced_fields['link_options'] = false;
		$advanced_fields['fonts']        = false;

		return $advanced_fields;
	}

	public function render( $attrs, $content, $render_slug ) {

		wp_enqueue_script( 'dtqj-slick' );
		wp_enqueue_style( 'dtqc-slick' );
		$this->render_css( $render_slug );

		$content          = $this->props['content'];
		$is_center        = $this->props['is_center'];
		$center_mode_type = $this->props['center_mode_type'];
		$use_lightbox     = $this->props['use_lightbox'];
		$custom_cursor    = $this->props['custom_cursor'];
		$classes          = array();

		array_push( $classes, "dtq-lightbox-{$use_lightbox}" );

		if ( 'on' === $is_center ) {
			array_push( $classes, 'dtq-centered' );
			array_push( $classes, "dtq-centered--{$center_mode_type}" );
		}

		if ( 'on' === $custom_cursor ) {
			array_push( $classes, 'dtq-cursor' );
		}

		$output = sprintf(
			'<div class="dtq-carousel dtq-image-carousel dtq-carousel-frontend %3$s" %2$s >
                    %1$s
                </div>',
			$content,
			$this->get_carousel_options_data(),
			join( ' ', $classes )
		);

		return $output;
	}

	public function render_css( $render_slug ) {
		$this->render_carousel_css( $render_slug );
	}

}

new DTQ_Image_Carousel();
