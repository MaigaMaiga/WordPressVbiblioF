<?php
namespace BrainAddons\Ext\LoginDesigner;
class Installer {

	public function run() {
		$this->create_login_page();
		$this->timestamps();
	}

	public function timestamps() {
		flush_rewrite_rules();

		$installed = get_option( 'divi_torque_activation_date' );

		if ( ! $installed ) {
			update_option( 'divi_torque_activation_date', time() );
		}

		update_option( 'divi_torque_version', DIVI_TORQUE_PLUGIN_VERSION );
	}

	public function create_login_page() {

		global $wpdb;

		$version = get_option( 'divi_torque_version' );

		if ( $version && ! version_compare( $version, '1.2.0', '>=' ) ) {
			return;
		}

		// Set up options.
		$options = array();

		// Pull options from WP.
		$admin_options = get_option( 'BrainAddons_settings', array() );
		$option_value  = array_key_exists( 'login_page', $admin_options ) ? $admin_options['login_page'] : false;

		$page_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_name = 'divi-login-designer' LIMIT 1;" );

		if ( $page_id ) {

			wp_update_post(
				array(
					'ID'          => $page_id,
					'post_status' => 'publish',
				)
			);

		} else {

			$page_id = wp_insert_post(
				array(
					'post_type'      => 'page',
					'post_author'    => get_current_user_id(),
					'post_status'    => 'publish',
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
					'post_title'     => __( 'Divi Login Designer', 'addons-for-divi' ),
					'post_content'   => __( 'This page is used for Divi Login Designer extension. It will not be visible to your readers. Do not delete it.', 'addons-for-divi' ),
					'post_name'      => 'divi-login-designer',
				)
			);
		}

		if ( ! is_wp_error( $page_id ) ) {
			$options['login_page'] = $page_id;
			$page_id               = isset( $page_id ) ? $page_id : $option_value;
			$merged_options        = array_merge( $admin_options, $options );
			$admin_options         = $merged_options;

			update_option( 'brainaddons_settings', $admin_options );
		}

		update_post_meta( $page_id, '_wp_page_template', 'ext-template-login-designer.php' );

	}

}

