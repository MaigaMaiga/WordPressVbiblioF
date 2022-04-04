<?php

namespace BrainAddons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Library_Shortcodes' ) ) :
	class Library_Shortcodes {

		public function __construct() {
			add_filter( 'manage_et_pb_layout_posts_columns', array( $this, 'columns_head_et_pb_layout' ), 10 );
			add_action( 'manage_et_pb_layout_posts_custom_column', array( $this, 'columns_content_et_pb_layout' ), 10, 2 );
			add_shortcode( 'divi_library_shortcode', array( $this, 'shortcode_callback' ) );
		}

		public function columns_head_et_pb_layout( $defaults ) {

			$column_title = esc_html__( 'Shortcode', 'addons-for-divi' );

			$defaults['shortcode_id'] = $column_title;

			return $defaults;
		}

		public function columns_content_et_pb_layout( $column_name, $post_id ) {

			if ( 'shortcode_id' === $column_name ) {
				echo sprintf( '<code class="dtq-divi-shortcode">[divi_library_shortcode id="%1$s"]</code>', esc_attr( $post_id ) );
			}
		}

		public function shortcode_callback( $atts ) {

			$atts = shortcode_atts(
				array(
					'id' => '',
				),
				$atts,
				'divi_library_shortcode'
			);

			if ( ! empty( $_GET['et_fb'] ) ) { //phpcs:ignore

				$shortcode = do_shortcode(
					sprintf(
						'[et_pb_section global_module="%1$s"][/et_pb_section]',
						esc_attr( $atts['id'] )
					)
				);

				return $shortcode;

			} else {

				$shortcode = do_shortcode(
					sprintf(
						'[et_pb_section global_module="%1$s"][/et_pb_section]',
						esc_attr( $atts['id'] )
					)
				);

				return $shortcode;

			}
		}

	}

endif;

new Library_Shortcodes();
