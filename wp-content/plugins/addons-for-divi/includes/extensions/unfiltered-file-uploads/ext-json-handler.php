<?php

namespace BrainAddons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Json_Handler extends Unfiltered_Uploads {
	
	public static function get_name() {
		return 'json-handler';
	}

	public function get_mime_type() {
		return 'application/json';
	}

	public function get_file_type() {
		return 'json';
	}

}

new Json_Handler();
