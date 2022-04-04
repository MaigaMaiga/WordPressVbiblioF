<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function brainaddons_register_extensions() {

	$inactive_extensions = get_option( 'ba_inactive_extensions', array() );

	if ( ! in_array( 'popup-maker', $inactive_extensions, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'popup-maker/ext-post-type.php';
		require_once plugin_dir_path( __FILE__ ) . 'popup-maker/popup-settings.php';
		require_once plugin_dir_path( __FILE__ ) . 'popup-maker/ext-popup-maker.php';
	}

	if ( ! in_array( 'login-designer', $inactive_extensions, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'login-designer/ext-login-designer.php';
		require_once plugin_dir_path( __FILE__ ) . 'login-designer/ext-page-template.php';
		require_once plugin_dir_path( __FILE__ ) . 'login-designer/ext-installer.php';
	}

	if ( ! in_array( 'unfiltered-file-uploads', $inactive_extensions, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'unfiltered-file-uploads/ext-unfiltered-file-uploads.php';
		require_once plugin_dir_path( __FILE__ ) . 'unfiltered-file-uploads/ext-svg-handler.php';
		require_once plugin_dir_path( __FILE__ ) . 'unfiltered-file-uploads/ext-json-handler.php';
	}

	if ( ! in_array( 'library-shortcodes', $inactive_extensions, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'library-shortcodes/ext-library-shortcodes.php';
	}

	if ( ! in_array( 'post-duplicator', $inactive_extensions, true ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'post-duplicator/post-duplicator.php';
	}

}

// Kickoff.
brainaddons_register_extensions();
