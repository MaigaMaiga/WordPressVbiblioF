<?php
namespace BrainAddons;

class Popup_Maker {

	public $post_type = null;

	/**
	 * Construct
	 */
	public function __construct() {
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'init', array( $this, 'init' ), -999 );
		add_action( 'wp_footer', array( $this, 'page_popups_render' ), 10 );
	}

	/**
	 * Manually init required modules.
	 *
	 * @return void
	 */
	public function init() {
		$this->post_type = new Popup_Post_Type();
	}

	/**
	 * Add menu
	 */
	public function add_menu() {

		$inactive_extensions = get_option( 'ba_inactive_extensions', array() );

		if ( ! in_array( 'popup-maker', $inactive_extensions, true ) ) {

			add_submenu_page(
				'addons-for-divi',
				esc_html__( 'Options', 'addons-for-divi' ),
				esc_html__( 'Options', 'addons-for-divi' ),
				'manage_options',
				'addons-for-divi'
			);

			add_submenu_page(
				'addons-for-divi',
				esc_html__( 'Popups', 'addons-for-divi' ),
				esc_html__( 'Popups', 'addons-for-divi' ),
				'manage_options',
				'edit.php?post_type=brainaddons-popup'
			);

		}
	}

	/**
	 * Defaults
	 *
	 * @return void
	 */
	public static function defaults() {

		$defaults = array();
		return apply_filters( 'brainaddons_defaults', $defaults );
	}

	/**
	 * Body class
	 *
	 * @param  array $classes
	 * @return void
	 */
	public function body_class( $classes ) {

		$defaults = self::defaults();
		$options  = get_option( 'brain_conkit' );
		$options  = wp_parse_args( $options, $defaults );

		return $classes;
	}

	public function find_matched_conditions( $type = 'brain-popup' ) {
		$conditions = get_option( 'ba_display_conditions', array() );
		if ( empty( $conditions[ $type ] ) ) {
			return false;
		}

		$popup_id_list = array();
		foreach ( $conditions[ $type ] as $popup_id => $popup_conditions ) {
			if ( empty( $popup_conditions ) ) {
				continue;
			}

			$check_list   = array();
			$include_list = array();

			foreach ( $popup_conditions as $key => $condition ) {
				$include = filter_var( $condition['include'], FILTER_VALIDATE_BOOLEAN );
				$target  = isset( $condition['target'] ) ? $condition['target'] : false;

				if ( 'entire' === $target ) {
					$check_list['entire']   = true;
					$include_list['entire'] = $include;
					continue;
				}

				$key_value               = isset( $condition['post'] ) ? $condition['post'] : '';
				$target_value            = $key_value ? $key_value : '';
				$include_list[ $target ] = $include;

				if ( 'page_selected' === $target ) {
					$instance_check = is_page( $target_value );
					$page_for_posts = get_option( 'page_for_posts' );
					if ( $page_for_posts && $page_for_posts === $target_value ) {
						$instance_check = is_home();
					}
				} else {
					$instance_check = false;
				}

				$check = ( $instance_check && $include ) ? true : false;

				if ( ! $include ) {
					if ( array_key_exists( $target, $check_list ) ) {
						$check_list[ $target ] = false;
						continue;
					}
				}

				$check_list[ $target ] = $instance_check;
			}

			foreach ( $check_list as $check_key => $check ) {
				if ( $check ) {
					if ( ! $include_list[ $check_key ] ) {

						$key = array_search( $popup_id, $popup_id_list );
						if ( isset( $key ) ) {
							unset( $popup_id_list[ $key ] );
						}
						continue;
					}

					$popup_id_list[] = $popup_id;
				}
			}
		}

		if ( ! empty( $popup_id_list ) ) {
			return $popup_id_list;
		}

		return false;

	}

	public function page_popups_render() {

		$popup_id_list = array();

		$condition_popups = $this->find_matched_conditions();

		if ( ! empty( $condition_popups ) && is_array( $condition_popups ) ) {
			$popup_id_list = array_merge( $popup_id_list, $condition_popups );
		}

		if ( ! $popup_id_list || empty( $popup_id_list ) || ! is_array( $popup_id_list ) ) {
			return false;
		}

		$popup_id_list = array_unique( $popup_id_list );

		if ( ! empty( $popup_id_list ) ) {
			foreach ( $popup_id_list as $key => $popup_id ) {
				$this->popup_render( $popup_id );
			}
		}
	}

	public function popup_render( $popup_id ) {

		$is_et_fb_enabled = function_exists( 'et_core_is_fb_enabled' ) && et_core_is_fb_enabled();
		if ( $is_et_fb_enabled ) {
			return;
		}
		wp_enqueue_script( 'dtqj-anime' );

		$close_button_html = '';
		$overlay_html      = '';
		$popup_settings    = ba_all_values( $popup_id );
		$use_close_button  = isset( $popup_settings['ba_close_button'] ) ? $popup_settings['ba_close_button'] : '';
		$use_overlay       = isset( $popup_settings['ba_overlay'] ) ? $popup_settings['ba_overlay'] : '';

		if ( 'on' === $use_close_button ) {
			$close_button_html = '
            <div class="dtq-popup-close-button">
                <svg viewBox="0 0 16 16" id="close-thin" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#41444B" d="M8.707 8l7.147 7.146a.5.5 0 0 1-.708.708L8 8.707.854 15.854a.5.5 0 0 1-.708-.708L7.293 8 .146.854A.5.5 0 1 1 .854.146L8 7.293 15.146.146a.5.5 0 0 1 .708.708L8.707 8z"></path>
                </svg>
            </div>';
		}
		if ( 'on' === $use_overlay ) {
			$overlay_html = '<div class="dtq-popup-overlay"></div>';
		}

		$animation = isset( $popup_settings['ba_animation'] ) ? $popup_settings['ba_animation'] : 'fade';

		$popup_json = array(
			'id'              => $popup_id,
			'dtq-popup-id'    => 'dtq-popup-' . $popup_id,
			'animation'       => $animation,
			'open-trigger'    => $popup_settings['ba_popup_open_trigger'],
			'page-load-delay' => $popup_settings['ba_page_load_delay'],
			'scrolled-to'     => $popup_settings['ba_popup_scrolled_to_value'],
			'custom-selector' => $popup_settings['ba_custom_selector'],
		);

		$popup_json_data = htmlspecialchars( json_encode( $popup_json ) );
		include plugin_dir_path( __FILE__ ) . 'popup-container.php';
	}

	public function print_location_content( $popup_id = 0 ) {
		$post   = get_post( $popup_id );
		$output = do_shortcode( $post->post_content );
        echo $output; //phpcs:ignore
	}

}

new Popup_Maker();
