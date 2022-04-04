<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'vbiblioLanding' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'eci/dW-F4Mtj/@7;wJT/!45OXEsLTJ|/>ml)uh0Y#sMEU|YHCR$jShTGaj)Itpie' );
define( 'SECURE_AUTH_KEY',  'dx_A]8}*p@Did~3_[u[8y,!$S:+4dl@G(GKi,4}J r4v!<#![%euc/GPC(  e}zR' );
define( 'LOGGED_IN_KEY',    '<3`=1hOYoiW;s0NDd!=mJ~ez<aPnie}[O~b$$t_$OUV{@N^L<=%R[F%(cUyAjpyG' );
define( 'NONCE_KEY',        '`A,M-Cd>^]w;>F;3xLy6ax</cd}|99z4(Gpf#ArL0 *{K3Z@?vesxZz-1L!{Ig+1' );
define( 'AUTH_SALT',        'I#^[?i>BG6:XsN!J:+i}jkidMcp5LGzMV)6F_1~!8^Hfg/?-*5@|nd+,![Z-%[3c' );
define( 'SECURE_AUTH_SALT', '.O#JM*eN;LS*L3JTZcU[op~GsyGxnEwaf|J_*s:6m _I=[5ha|L0*]o3Y!h,RCj!' );
define( 'LOGGED_IN_SALT',   'Ntc{},0$HP&wa 8i3[ApQ&iLsdrk_y^[pWBFBE($Tl4,2<r5JH{10V6I#75@pI{[' );
define( 'NONCE_SALT',       'Lp~ph,7*9Ld^Em5QW4d8gYEkh[YC3YTKlN?rXj_$1{bU? 2Xt(nFXR)COYxqz>P{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
