<?php
/*
 * Plugin Name: DiviTorque
 * Plugin URI:  https://divitorque.com/
 * Description: DiviTorque is a plugin that turns Divi theme into a powerful Swiss army knife.
 * Version:     3.5.0
 * Author:      DiviTorque
 * Author URI:  https://divitorque.com/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: addons-for-divi
 * Domain Path: /languages
 * 
 * @package DiviTorque
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * 
 * Copyright 2022 DiviTorque <https://divitorque.com>
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

define( 'DIVI_TORQUE_PLUGIN_VERSION', '3.5.0' );
define( 'DIVI_TORQUE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DIVI_TORQUE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'DIVI_TORQUE_PLUGIN_ASSETS', trailingslashit( DIVI_TORQUE_PLUGIN_URL . 'assets' ) );
define( 'DIVI_TORQUE_PLUGIN_FILE', __FILE__ );
define( 'DIVI_TORQUE_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'DIVI_TORQUE_REDIRECTION_FLAG', 'divitorque_activation_redirect' );

do_action( 'divitorque_loaded' );

// Compatibility - BrainAddons
define( 'BRAIN_ADDONS_PLUGIN_VERSION', '2.3.3' );
define( 'BRAIN_ADDONS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BRAIN_ADDONS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'BRAIN_ADDONS_PLUGIN_ASSETS', trailingslashit( BRAIN_ADDONS_PLUGIN_URL . 'assets' ) );
define( 'BRAIN_ADDONS_PLUGIN_FILE', __FILE__ );
define( 'BRAIN_ADDONS_PLUGIN_BASE', plugin_basename( __FILE__ ) );

do_action( 'brainaddons_loaded' );

if ( !class_exists( 'DIVI_TORQUE_PLUGIN' ) ):

    final class DIVI_TORQUE_PLUGIN {

        private static $instance;

        private function __construct() {
            register_activation_hook( __FILE__, array( $this, 'activate' ) );
            add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
        }

        public static function instance() {

            if ( !isset( self::$instance ) && !( self::$instance instanceof DIVI_TORQUE_PLUGIN ) ) {
                self::$instance = new DIVI_TORQUE_PLUGIN();
                self::$instance->init();
                self::$instance->includes();
            }

            return self::$instance;
        }

        private function init() {
            add_action( 'divi_extensions_init', array( $this, 'initialize_extension' ) );
        }

        public function init_plugin() {

            if ( is_admin() ) {
                new DiviTorque\Includes\Admin();
            } else {
                new DiviTorque\Includes\AssetsManager();
            }

            if ( is_admin() ) {
                $this->initFeedback();
            }

        }

        public function activate() {
            
            update_option( 'divitorque_version', DIVI_TORQUE_PLUGIN_VERSION );
            add_option( DIVI_TORQUE_REDIRECTION_FLAG, true );
            
            if ( false === get_transient( 'divitorque-notice-rating' ) ) {
                set_transient( 'divitorque-notice-rating', true, WEEK_IN_SECONDS );
            }

            $inactive_extensions = get_option( 'ba_inactive_extensions', array() );
            if ( !in_array( 'login-designer', $inactive_extensions, true ) ) {
                $installer = new BrainAddons\Ext\LoginDesigner\Installer();
                $installer->run();
            }

            if ( !in_array( 'popup-maker', $inactive_extensions, true ) ) {
                $installer = new BrainAddons\Popup_Post_Type();
                $installer->register_post_type();
                flush_rewrite_rules();
            }
        }

        private function includes() {
            require_once DIVI_TORQUE_PLUGIN_DIR . '/freemius.php';
            require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/functions.php';

            if ( is_admin() ) {
                require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/admin.php';
                require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/admin/feedback.php';
            }

            require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/customizer/customizer.php';
            require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/extensions/extensions.php';
            require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/admin/static-icons.php';
            require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/assets-manager.php';
            require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/functions-forms.php';
        }

        public function initialize_extension() {
            require_once DIVI_TORQUE_PLUGIN_DIR . 'includes/divi-extension.php';
        }

        private function initFeedback() {

            $feedback = true;

            if ( $feedback ) {
                new DiviTorque_Admin_Feedback();
            }
        }

    }
endif;

function divitorque_plugin() {
    return DIVI_TORQUE_PLUGIN::instance();
}

divitorque_plugin();