<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'BrainAddons_Login_Template' ) ) :

	class BrainAddons_Login_Template {

		private static $instance;

		private $templates;

		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new BrainAddons_Login_Template();
			}

			return self::$instance;
		}

		private function __construct() {
			$this->templates = array();
			add_filter( 'wp_insert_post_data', array( $this, 'register_project_templates' ) );
			add_filter( 'template_include', array( $this, 'view_project_template' ) );
			add_action( 'login_head', array( $this, 'noindex_meta' ), 9 );
			$this->templates = array(
				'ext-template-login-designer.php' => esc_html__( 'Login Designer', 'addons-for-divi' ),
			);
		}

		public function noindex_meta() {
			remove_action( 'login_head', 'wp_no_robots' );
			echo '<meta name="robots" content="noindex, nofollow" />' . "\n";
		}

		public function register_project_templates( $atts ) {

			$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

			$templates = wp_get_theme()->get_page_templates();
			if ( empty( $templates ) ) {
				$templates = array();
			}

			wp_cache_delete( $cache_key, 'themes' );

			$templates = array_merge( $templates, $this->templates );

			wp_cache_add( $cache_key, $templates, 'themes', 1800 );

			return $atts;
		}

		public function view_project_template( $template ) {
			global $post;

			if ( ! $post ) {
				return $template;
			}

			if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
				return $template;
			}

			$file = plugin_dir_path( __FILE__ ) . get_post_meta(
				$post->ID,
				'_wp_page_template',
				true
			);

			if ( file_exists( $file ) ) {
				return $file;
			} else {
				echo esc_url( $file );
			}

			return $template;
		}
	}

endif;

add_action( 'plugins_loaded', array( 'BrainAddons_Login_Template', 'get_instance' ) );
