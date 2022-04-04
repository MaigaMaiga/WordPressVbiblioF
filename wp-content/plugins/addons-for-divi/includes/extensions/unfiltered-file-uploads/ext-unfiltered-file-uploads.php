<?php

namespace BrainAddons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Unfiltered_Uploads' ) ) :

	abstract class Unfiltered_Uploads {

		public function __construct() {
			add_filter( 'upload_mimes', array( $this, 'support_unfiltered_files_upload' ) );
			add_filter( 'wp_handle_upload_prefilter', array( $this, 'handle_upload_prefilter' ) );
			add_filter( 'wp_check_filetype_and_ext', array( $this, 'check_filetype_and_ext' ), 10, 4 );
		}

		abstract public function get_mime_type();

		abstract public function get_file_type();

		final public static function is_enabled() {

			$enabled = self::file_sanitizer_can_run();

			return $enabled;
		}

		final public function support_unfiltered_files_upload( $existing_mimes ) {

			$existing_mimes[ $this->get_file_type() ] = $this->get_mime_type();

			return $existing_mimes;
		}

		public function handle_upload_prefilter( $file ) {

			if ( ! $this->is_file_should_handled( $file ) ) {
				return $file;
			}

			$ext          = pathinfo( $file['name'], PATHINFO_EXTENSION );
			$file_type    = $this->get_file_type();
			$display_type = strtoupper( $file_type );

			if ( $file_type !== $ext ) {
				$file['error'] = sprintf( __( 'The uploaded %1$s file is not supported. Please upload a valid %2$s file', 'addons-for-divi' ), $ext, $display_type );
				return $file;
			}

			if ( ! self::is_enabled() ) {
				$file['error'] = sprintf( __( '%1$s file is not allowed for security reasons', 'addons-for-divi' ), $display_type );
				return $file;
			}

			return $file;
		}

		protected function is_file_should_handled( $file ) {
			return $this->get_mime_type() === $file['type'];
		}

		public static function file_sanitizer_can_run() {
			return class_exists( 'DOMDocument' ) && class_exists( 'SimpleXMLElement' );
		}

		public function check_filetype_and_ext( $data, $file, $filename, $mimes ) {

			if ( ! empty( $data['ext'] ) && ! empty( $data['type'] ) ) {
				return $data;
			}

			$wp_file_type = wp_check_filetype( $filename, $mimes );
			$file_type    = strtolower( $this->get_file_type() );

			if ( $file_type === $wp_file_type['ext'] ) {
				$data['ext']  = $file_type;
				$data['type'] = $this->get_mime_type();
			}

			return $data;
		}
	}

endif;
