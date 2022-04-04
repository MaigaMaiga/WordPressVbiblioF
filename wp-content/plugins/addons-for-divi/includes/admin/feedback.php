<?php

defined( 'ABSPATH' ) or die();

class DiviTorque_Admin_Feedback {

    public function __construct() {
        add_action( 'wp_ajax_divitorque-dismiss-notice', array( $this, 'ajax_dismiss_notice' ) );
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
    }

    public function admin_notices() {

        $_old_notice           = get_user_meta( get_current_user_id(), 'brainaddons-notice-rating', true );
        $_old_notice_transient = get_transient( 'brainaddons-notice-rating' );

        if ( 'dismissed' == $_old_notice || $_old_notice_transient ) {
            return;
        }

        // DiviTorque: V3
        $notice           = get_user_meta( get_current_user_id(), 'divitorque-notice-rating', true );
        $notice_transient = get_transient( 'divitorque-notice-rating' );

        if ( 'dismissed' == $notice || $notice_transient ) {
            return;
        }

        ?>
		<div class="dtq-notice notice is-dismissible">
			<div class="dtq-notice-container">
				<div class="dtq-notice-image">
					<img src="https://ps.w.org/addons-for-divi/assets/icon.svg?rev=2629350" alt="divitorque-logo">
				</div>
				<div class="dtq-notice-content">
					<div class="dtq-notice-heading">
						<?php esc_html_e( 'Hello! Seems like you are using DiviTorque plugin to build your Divi website - Thanks a lot!', 'addons-for-divi' );?>
					</div>
					<?php esc_html_e( 'Could you please do us a BIG favor and give it a 5-star rating on WordPress? This would boost our motivation and help other users make a comfortable decision while choosing the Divi Torque plugin.', 'addons-for-divi' );?>
					<br/>
					<div class="dtq-review-notice-container">
						<a href="https://wordpress.org/support/plugin/addons-for-divi/reviews/?filter=5#new-post" class="dtq-review-deserve button-primary" target="_blank">
							<?php esc_html_e( 'Ok, you deserve it', 'addons-for-divi' );?>
						</a>
						<span class="dashicons dashicons-calendar"></span>
						<a href="#" class="dtq-review-later">
							<?php esc_html_e( 'Nope, maybe later', 'addons-for-divi' );?>
						</a>
						<span class="dashicons dashicons-smiley"></span>
						<a href="#" class="dtq-review-done">
							<?php esc_html_e( 'I already did', 'addons-for-divi' );?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
}

    public function ajax_dismiss_notice() {

        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( !check_ajax_referer( 'ba_save_admin', 'nonce' ) ) {
            wp_send_json_error();
        }

        if ( $_POST['repeat'] == 'true' ) {
            set_transient( 'divitorque-notice-rating', true, WEEK_IN_SECONDS );
        } else {
            update_user_meta( get_current_user_id(), 'divitorque-notice-rating', 'dismissed' );
        }

        wp_send_json_success();

    }

}
