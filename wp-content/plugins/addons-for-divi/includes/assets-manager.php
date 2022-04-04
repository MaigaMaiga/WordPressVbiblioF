<?php

namespace DiviTorque\Includes;

defined( 'ABSPATH' ) || die();

class AssetsManager {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        if ( isset( $_GET['et_fb'] ) && '1' === $_GET['et_fb'] ) { // phpcs:ignore
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_vb' ) );
		}

	}

	public function enqueue_scripts() {

		$js_path  = DIVI_TORQUE_PLUGIN_ASSETS . 'js/';
		$css_path = DIVI_TORQUE_PLUGIN_ASSETS . 'css/';
		$version  = DIVI_TORQUE_PLUGIN_VERSION;

		// All vendor js.
		wp_register_script( 'dtqj-slick', $js_path . 'slick.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-twentytwenty', $js_path . 'twentytwenty.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-tippy', $js_path . 'tippy.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-event-move', $js_path . 'event_move.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-popper', $js_path . 'popper.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-typed', $js_path . 'typed.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-anime', $js_path . 'anime.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-text-animation', $js_path . 'text-animation.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-counter', $js_path . 'counter-up.min.js', array( 'jquery' ), $version, true );

		// Temp Fix.
		wp_enqueue_script( 'dtqj-magnific-popup', $js_path . 'magnific-popup.js', array( 'jquery' ), $version, true );
		wp_enqueue_style( 'dtqc-magnific', $css_path . 'magnific-popup.min.css', array(), $version, 'all' );

		// All vendor css.
		wp_register_style( 'dtqc-slick', $css_path . 'slick.min.css', array(), $version, 'all' );
		wp_register_style( 'dtqc-tippy', $css_path . 'tippy.min.css', array(), $version, 'all' );

		$prefix = defined( 'DTQ_DEBUG' ) && true === constant( 'DTQ_DEBUG' ) ? '' : '.min';
		wp_enqueue_style( 'dtqc-core', $css_path . 'core' . $prefix . '.css', null, $version );
		wp_enqueue_script( 'dtqj-main', $js_path . 'main' . $prefix . '.js', array( 'jquery' ), $version, true );
		wp_register_script( 'dtqj-marvin', $js_path . 'marvin' . $prefix . '.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'dtqj-default-vb', $js_path . 'dtq-default-vb.js', array( 'jquery' ), $version, true );

		wp_localize_script(
			'dtqj-main',
			'DTQ_PLUGIN',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'is_pro'  => divitorque_has_pro() ? true : false,
				'nonce'   => wp_create_nonce( 'ba_smart_post_nonce' ),
			)
		);
	}

	public function enqueue_scripts_vb() {
		wp_enqueue_style( 'dtqc-slick' );
		wp_enqueue_script( 'dtqj-default-vb' );
	}

}
