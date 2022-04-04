<?php

namespace BrainAddons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Svg_Handler extends Unfiltered_Uploads {

	public static function get_name() {
		return 'svg-handler';
	}

	public function get_mime_type() {
		return 'image/svg+xml';
	}

	public function get_file_type() {
		return 'svg';
	}

	public function wp_prepare_attachment_for_js( $attachment_data, $attachment, $meta ) {
		if ( 'image' !== $attachment_data['type'] ||
			'svg+xml' !== $attachment_data['subtype'] ||
			! class_exists( 'SimpleXMLElement' )
		) {
			return $attachment_data;
		}

		$svg = $attachment->ID;

		if ( ! $svg ) {
			return $attachment_data;
		}

		try {
			$svg = new \SimpleXMLElement( $svg );
		} catch ( \Exception $e ) {
			return $attachment_data;
		}

		$src    = $attachment_data['url'];
		$width  = (int) $svg['width'];
		$height = (int) $svg['height'];

		$attachment_data['image'] = compact( 'src', 'width', 'height' );
		$attachment_data['thumb'] = compact( 'src', 'width', 'height' );

		$attachment_data['sizes']['full'] = array(
			'height'      => $height,
			'width'       => $width,
			'url'         => $src,
			'orientation' => $height > $width ? 'portrait' : 'landscape',
		);
		return $attachment_data;
	}

	public function __construct() {
		parent::__construct();

		add_filter( 'wp_prepare_attachment_for_js', array( $this, 'wp_prepare_attachment_for_js' ), 10, 3 );
	}

}

new Svg_Handler();
