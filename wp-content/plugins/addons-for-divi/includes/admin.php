<?php

namespace DiviTorque\Includes;

defined( 'ABSPATH' ) || die();

class Admin {

	const MODULES_NONCE = 'ba_save_admin';

	public function __construct() {
		add_action( 'admin_menu', array( __CLASS__, 'add_menu' ), 21 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), 21 );
		add_action( 'wp_ajax_' . self::MODULES_NONCE, array( __CLASS__, 'save_data' ) );
		add_action( 'ba_save_admin_data', array( __CLASS__, 'save_modules_data' ) );
		add_action( 'ba_save_admin_data', array( __CLASS__, 'save_extensions_data' ) );
		add_action( 'admin_init', array( __CLASS__, 'activation_redirect' ) );
	}

	public static function activation_redirect() {
		if ( get_option( DIVI_TORQUE_REDIRECTION_FLAG, false ) ) {
			delete_option( DIVI_TORQUE_REDIRECTION_FLAG );
			if ( ! get_option( DIVI_TORQUE_REDIRECTION_FLAG, false ) || ! divitorque_has_pro() ) {
				die( wp_redirect( divitorque_dashboard_link() ) );
			} else {
				die( wp_redirect( divitorque_dashboard_link() ) );
			}
		}
	}

	public static function add_menu() {
		add_menu_page(
			__( 'DiviTorque', 'addons-for-divi' ),
			__( 'DiviTorque', 'addons-for-divi' ),
			'manage_options',
			'addons-for-divi',
			array( __CLASS__, 'render_main' ),
			ba_get_b64_icon(),
			110
		);
	}

	public static function enqueue_scripts() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$prefix = defined( 'DTQ_DEBUG' ) && true === constant( 'DTQ_DEBUG' ) ? '' : '.min';

		wp_enqueue_style(
			'torque-admin',
			DIVI_TORQUE_PLUGIN_ASSETS . 'admin/css/admin' . $prefix . '.css',
			array(),
			DIVI_TORQUE_PLUGIN_VERSION,
			'all'
		);

		wp_enqueue_script(
			'torque-admin-js',
			DIVI_TORQUE_PLUGIN_ASSETS . 'admin/js/admin' . $prefix . '.js',
			array( 'jquery' ),
			DIVI_TORQUE_PLUGIN_VERSION,
			true
		);

		wp_localize_script(
			'torque-admin-js',
			'DTQ_PLUGIN',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( self::MODULES_NONCE ),
				'action'  => self::MODULES_NONCE,
			)
		);

	}

	public static function save_data() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( ! check_ajax_referer( self::MODULES_NONCE, 'nonce' ) ) {
			wp_send_json_error();
		}

		$posted_data = ! empty( $_POST['data'] ) ? $_POST['data'] : '';
		$data        = array();

		parse_str( $posted_data, $data );
		do_action( 'ba_save_admin_data', $data );
		wp_send_json_success();

	}

	public static function save_modules_data( $data ) {
		$modules          = ! empty( $data['modules'] ) ? $data['modules'] : array();
		$inactive_modules = array_values( array_diff( array_keys( self::get_modules() ), $modules ) );
		self::save_inactive_modules( $inactive_modules );
	}

	public static function get_inactive_modules() {
		return get_option( 'ba_inactive_modules', array() );
	}

	public static function save_inactive_modules( $modules = array() ) {
		update_option( 'ba_inactive_modules', $modules );
	}

	public static function get_modules() {
		$modules_map = self::get_free_modules();
		$modules_map = array_merge( $modules_map, self::get_pro_modules() );
		uksort( $modules_map, array( __CLASS__, 'sort_widgets' ) );
		return $modules_map;
	}

	public static function sort_widgets( $k1, $k2 ) {
		return strcasecmp( $k1, $k2 );
	}

	public static function save_extensions_data( $data ) {
		$extensions          = ! empty( $data['extensions'] ) ? $data['extensions'] : array();
		$inactive_extensions = array_values( array_diff( array_keys( self::get_all_extensions() ), $extensions ) );
		self::save_inactive_extensions( $inactive_extensions );
	}

	public static function get_inactive_extensions() {

		return get_option( 'ba_inactive_extensions', array() );
	}

	public static function save_inactive_extensions( $extensions = array() ) {

		update_option( 'ba_inactive_extensions', $extensions );
	}

	private static function get_all_extensions() {

		$extensions_map = array(
			'blog-designer'           => array(
				'title'       => __( 'Blog Designer', 'addons-for-divi' ),
				'desc'        => __( 'Blog Designer is a good handy and premium solution for everyone who is looking for a responsive blog page with the divi website.', 'addons-for-divi' ),
				'link_enable' => true,
				'is_pro'      => true,
				'section'     => 'blog_designer_archive__section',
			),

			'popup-maker'             => array(
				'title'       => __( 'Popup Maker', 'addons-for-divi' ),
				'desc'        => __( 'It is incredibly versatile & flexible. Bend it to create any type of popup, modal, or content overlay for your website.', 'addons-for-divi' ),
				'link_enable' => false,
				'is_pro'      => false,
				'section'     => '',
			),

			'login-designer'          => array(
				'title'   => __( 'Login Designer', 'addons-for-divi' ),
				'desc'    => __( 'Design and build an on-brand custom WordPress login page.', 'addons-for-divi' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => true,
			),

			'unfiltered-file-uploads' => array(
				'title'   => __( 'Unfiltered File Uploads', 'addons-for-divi' ),
				'desc'    => __( 'Please note! Allowing uploads SVG & JSON files is a potential security risk. We recommend you only enable this feature if you understand the security risks involved.' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => true,
			),

			'library-shortcodes'      => array(
				'title'   => __( 'Divi Library Shortcodes', 'addons-for-divi' ),
				'desc'    => __( 'This extension allows you to display any Divi library template as a shortcode. Embed any Divi library template inside any divi module or inside a .php files by using a shortcode.' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => true,
			),

			'post-duplicator'         => array(
				'title'   => __( 'Post Duplicator', 'addons-for-divi' ),
				'desc'    => __( 'Post Duplicator extension provides functionality to make a clone of page or post. Also supports copying the custom post type and Divi pages including all attributes.' ),
				'demo'    => '',
				'icon'    => '',
				'is_pro'  => false,
				'is_free' => true,
			),

		);

		return $extensions_map;
	}

	private static function get_free_modules() {

		$modules_map = array(

			'advanced-divider'      => array(
				'title' => __( 'Advanced Divider', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/advanced-divider-module/',
				'icon'  => 'advanced_divider',
			),
			'advanced-team'         => array(
				'title'  => __( 'Advanced Team', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/team-module',
				'icon'   => 'team',
				'is_pro' => false,
			),
			'alert'                 => array(
				'title' => __( 'Alert', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/alert-module',
				'icon'  => 'alert',
			),
			'animated-text'         => array(
				'title' => __( 'Animated Text', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/animated-text-module',
				'icon'  => 'animated_text',
			),
			'business-hour'         => array(
				'title' => __( 'Business Hour', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/business-hour-module',
				'icon'  => 'business_hour',
			),
			'card'                  => array(
				'title' => __( 'Card', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/card-module/',
				'icon'  => 'card',
			),
			'cf7-module'            => array(
				'title' => __( 'CF7 Styler', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/cf7-styler-module/',
				'icon'  => 'cf7_styler',
			),
			'dual-button'           => array(
				'title' => __( 'Dual Button', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/dual-button-module',
				'icon'  => 'dual_button',
			),
			'flipbox'               => array(
				'title'  => __( 'Flipbox', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/flip-box-module',
				'icon'   => 'flipbox',
				'is_pro' => false,
			),
			'gradient-heading'      => array(
				'title' => __( 'Gradient Heading', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/gradient-heading-module',
				'icon'  => 'advanced_heading',
			),
			'icon-box'              => array(
				'title' => __( 'Icon Box', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/icon-box-module/',
				'icon'  => 'icon_box',
			),
			'image-carousel'        => array(
				'title' => __( 'Image Carousel', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/image-carousel-module',
				'icon'  => 'image_carousel',
			),
			'image-compare'         => array(
				'title' => __( 'Image Compare', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/image-compare-module',
				'icon'  => 'image_compare',
			),
			'info-box'              => array(
				'title' => __( 'Info Box', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/info-box-module',
				'icon'  => 'info_box',
			),
			'logo-carousel'         => array(
				'title' => __( 'Logo Carousel', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/logo-carousel-module',
				'icon'  => 'logo_carousel',
			),
			'logo-grid'             => array(
				'title' => __( 'Logo Grid', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/logo-grid-module/',
				'icon'  => 'logo_grid',
			),
			'news-ticker'           => array(
				'title' => __( 'News Ticker', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/news-ticker-module',
				'icon'  => 'news_ticker',
			),
			'number'                => array(
				'title' => __( 'Number', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/number-module',
				'icon'  => 'number',
			),
			'post-list'             => array(
				'title' => __( 'Post List', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/post-list-module',
				'icon'  => 'post_list',
			),
			'review'                => array(
				'title' => __( 'Review', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/review-module',
				'icon'  => 'review',
			),
			'scroll-image'          => array(
				'title' => __( 'Scroll Image', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/scroll-image-module',
				'icon'  => 'scroll_image',
			),
			'skill-bars'            => array(
				'title' => __( 'Skill Bars', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/skill-bars-module',
				'icon'  => 'skill_bars',
			),
			'testimonial'           => array(
				'title' => __( 'Testimonial', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/testimonial-module',
				'icon'  => 'testimonial',
			),
			'twitter-feed'          => array(
				'title' => __( 'Twitter Feed', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/twitter-feed-module/',
				'icon'  => 'twitter_feed',
			),
			'twitter-feed-carousel' => array(
				'title' => __( 'Twitter Feed Carousel', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/twitter-feed-carousel-module',
				'icon'  => 'twitter_feed_carousel',
			),
			'video-popup'           => array(
				'title' => __( 'Video Popup', 'addons-for-divi' ),
				'demo'  => 'https://divitorque.com/video-popup-module',
				'icon'  => 'video_popup',
			),
		);

		return $modules_map;
	}

	private static function get_pro_modules() {

		$modules_map = array(
			'advanced-heading'     => array(
				'title'  => __( 'Advanced Heading', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/advanced-heading-module',
				'icon'   => 'advanced_heading',
				'is_pro' => true,
			),
			'animated-gallery'     => array(
				'title'  => __( 'Animated Gallery', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/animated-gallery-module',
				'icon'   => 'animated-gallery',
				'is_pro' => true,
			),
			'author-box'           => array(
				'title'  => __( 'Author Box', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/',
				'icon'   => 'author_list',
				'is_pro' => true,
			),
			'author-list'          => array(
				'title'  => __( 'Author List', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/author-list-module',
				'icon'   => 'author_list',
				'is_pro' => true,
			),
			'content-toggle'       => array(
				'title'  => __( 'Content Toggle', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/content-toggle-module',
				'icon'   => 'content_toggle',
				'is_pro' => true,
			),
			'floating-image'       => array(
				'title'  => __( 'Floating Image', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/floating-image-module',
				'icon'   => 'floating_image',
				'is_pro' => true,
			),
			'horizontal-timeline'  => array(
				'title'  => __( 'Horizontal Timeline', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/horizontal-timeline-module/',
				'icon'   => 'horizontal_timeline',
				'is_pro' => true,
			),
			'hotspots'             => array(
				'title'  => __( 'Hotspots', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/hotspots-module',
				'icon'   => 'hotspots',
				'is_pro' => true,
			),
			'hover-box'            => array(
				'title'  => __( 'Hover Box', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/hover-box-module',
				'icon'   => 'hover_box',
				'is_pro' => true,
			),
			'image-accordion'      => array(
				'title'  => __( 'Image Accordion', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/image-accordion-module',
				'icon'   => 'image_accordion',
				'is_pro' => true,
			),
			'image-hover'          => array(
				'title'  => __( 'Image Hover', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/image-hover-module',
				'icon'   => 'hover_box',
				'is_pro' => true,
			),
			'image-magnifier'      => array(
				'title'  => __( 'Image Magnifier', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/image-magnifier-module',
				'icon'   => 'image_magnifier',
				'is_pro' => true,
			),
			'image-masking'        => array(
				'title'  => __( 'Image Masking', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/image-masking-module',
				'icon'   => 'image_masking',
				'is_pro' => true,
			),
			'inline-svg'           => array(
				'title'  => __( 'Inline SVG', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/inline-svg-module',
				'icon'   => 'inline_svg',
				'is_pro' => true,
			),
			'instagram-carousel'   => array(
				'title'  => __( 'Instagram Carousel', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/instagram-carousel-module',
				'icon'   => 'instagram_carousel',
				'is_pro' => true,
			),
			'instagram-feed'       => array(
				'title'  => __( 'Instagram Feed', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/instagram-feed-module',
				'icon'   => 'instagram_feed',
				'is_pro' => true,
			),
			'list-group'           => array(
				'title'  => __( 'List Group', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/list-group-module',
				'icon'   => 'list_group',
				'is_pro' => true,
			),
			'lottie-animation'     => array(
				'title'  => __( 'Lottie Animation', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/lottie-animation-module',
				'icon'   => 'lottie',
				'is_pro' => true,
			),
			'news-ticker-pro'      => array(
				'title'  => __( 'News Ticker Pro', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/news-ticker-pro-module/',
				'icon'   => 'news_ticker',
				'is_pro' => true,
			),
			'post-carousel'        => array(
				'title'  => __( 'Post Carousel', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/post-carousel-module/',
				'icon'   => 'post_carousel',
				'is_pro' => true,
			),
			'post-grid'            => array(
				'title'  => __( 'Post Grid', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/post-grid-module/',
				'icon'   => 'post_grid',
				'is_pro' => true,
			),
			'post-masonry'         => array(
				'title'  => __( 'Post Masonry', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/post-masonry-module/',
				'icon'   => 'post_masonry',
				'is_pro' => true,
			),
			'post-tiles'           => array(
				'title'  => __( 'Post Tiles', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/post-tiles-module/',
				'icon'   => 'post_tiles',
				'is_pro' => true,
			),
			'price-menu'           => array(
				'title'  => __( 'Price Menu', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/price-menu-module',
				'icon'   => 'price_menu',
				'is_pro' => true,
			),
			'smart-post-list'      => array(
				'title'  => __( 'Smart Post List', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/smart-post-module',
				'icon'   => 'smart_post_list',
				'is_pro' => true,
			),
			'social-share'         => array(
				'title'  => __( 'Social Share', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/social-share-module',
				'icon'   => 'social_share',
				'is_pro' => true,
			),
			'team-carousel'        => array(
				'title'  => __( 'Team Carousel', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/team-carousel-module',
				'icon'   => 'team_carousel',
				'is_pro' => true,
			),
			'testimonial-carousel' => array(
				'title'  => __( 'Testimonial Carousel', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/testimonial-carousel-module',
				'icon'   => 'testimonial_carousel',
				'is_pro' => true,
			),
			'vertical-timeline'    => array(
				'title'  => __( 'Vertical Timeline', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/vertical-timeline-module/',
				'icon'   => 'vertical_timeline',
				'is_pro' => true,
			),
			'video-carousel'       => array(
				'title'  => __( 'Video Carousel', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/video-carousel-module/',
				'icon'   => 'video_carousel',
				'is_pro' => true,
			),
			'text-highlight'       => array(
				'title'  => __( 'Text Highlight', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/text-highlight-module/',
				'icon'   => 'animated_text',
				'is_pro' => true,
			),
			'off-canvas'           => array(
				'title'  => __( 'Off-canvas', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/off-canvas-module/',
				'icon'   => 'off_canvas',
				'is_pro' => true,
			),
			'mega-menu'            => array(
				'title'  => __( 'Mega Menu', 'addons-for-divi' ),
				'demo'   => 'https://divitorque.com/mega-menu-module/',
				'icon'   => 'mega_menu',
				'is_pro' => true,
			),
		);

		return $modules_map;
	}

	public static function get_extensions() {

		$extensions_map = self::get_all_extensions();
		return $extensions_map;
	}

	public static function get_admin_templates() {
		return array(
			'foodie'        => array(
				'name'     => 'Foodie',
				'image'    => 'foodie.jpg',
				'demo'     => 'https://library.divitorque.com/foodie-demo/',
				'download' => 'https://divitorque.com/foodie/',
				'is_pro'   => true,
			),
			'torqe-digital' => array(
				'name'     => 'Torque Digital',
				'image'    => 'torque-digital.jpg',
				'demo'     => 'https://library.divitorque.com/torque-digital-demo/',
				'download' => 'https://divitorque.com/torque-digital/',
				'is_pro'   => false,
			),
			'justice'       => array(
				'name'     => 'Justice',
				'image'    => 'justice.jpg',
				'demo'     => 'https://library.divitorque.com/justice-demo/',
				'download' => 'https://divitorque.com/justice/',
				'is_pro'   => false,
			),
			'travel'        => array(
				'name'     => 'Travel',
				'image'    => 'travel.jpg',
				'demo'     => 'https://library.divitorque.com/travel-demo/',
				'download' => 'https://divitorque.com/travel/',
				'is_pro'   => true,
			),
			'pet-care'      => array(
				'name'     => 'Pet Care',
				'image'    => 'pet-care.jpg',
				'demo'     => 'https://library.divitorque.com/pet-care-demo/',
				'download' => 'https://divitorque.com/pet-care/',
				'is_pro'   => true,
			),
			'news-magazine' => array(
				'name'     => 'News Magazine',
				'image'    => 'news-magazine.jpg',
				'demo'     => 'https://library.divitorque.com/news-magazine-demo/',
				'download' => 'https://divitorque.com/news-magazine/',
				'is_pro'   => true,
			),
			'medical'       => array(
				'name'     => 'Medical',
				'image'    => 'medical.jpg',
				'demo'     => 'https://library.divitorque.com/medical-demo/',
				'download' => 'https://divitorque.com/medical/',
				'is_pro'   => true,
			),
			'event'         => array(
				'name'     => 'Event',
				'image'    => 'event.jpg',
				'demo'     => 'https://library.divitorque.com/event-demo/',
				'download' => 'https://divitorque.com/event/',
				'is_pro'   => true,
			),
			'education'     => array(
				'name'     => 'Education',
				'image'    => 'education.jpg',
				'demo'     => 'https://library.divitorque.com/education-demo/',
				'download' => 'https://divitorque.com/education/',
				'is_pro'   => true,
			),
		);
	}

	public static function get_tabs() {

		$icon_url = DIVI_TORQUE_PLUGIN_ASSETS . 'imgs/admin/';

		$tabs = array(
			'home'       => array(
				'title'    => esc_html__( 'General', 'addons-for-divi' ),
				'renderer' => array( __CLASS__, 'render_home' ),
			),

			'modules'    => array(
				'title'    => esc_html__( 'Modules', 'addons-for-divi' ),
				'renderer' => array( __CLASS__, 'render_modules' ),
			),

			'extensions' => array(
				'title'    => esc_html__( 'Extension', 'addons-for-divi' ),
				'renderer' => array( __CLASS__, 'render_extensions' ),
			),

			'templates'  => array(
				'title'    => esc_html__( 'Starter templates', 'addons-for-divi' ),
				'renderer' => array( __CLASS__, 'render_templates' ),
			),

			'pro'        => array(
				'title'    => esc_html__( 'Get Pro', 'addons-for-divi' ),
				'renderer' => array( __CLASS__, 'render_pro' ),
			),
		);

		return $tabs;
	}

	private static function load_template( $template ) {
		$file = DIVI_TORQUE_PLUGIN_DIR . 'includes/admin/view/admin-' . $template . '.php';
		if ( is_readable( $file ) ) {
			include $file;
		}
	}

	public static function render_main() {
		self::load_template( 'main' );
	}

	public static function render_home() {
		self::load_template( 'home' );
	}

	public static function render_modules() {
		self::load_template( 'modules' );
	}

	public static function render_extensions() {
		self::load_template( 'extensions' );
	}

	public static function render_templates() {
		self::load_template( 'templates' );
	}

	public static function render_pro() {
		self::load_template( 'pro' );
	}

}
