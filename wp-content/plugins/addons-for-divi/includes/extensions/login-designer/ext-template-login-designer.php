<?php
/**
 * Template Name: Divi Login Designer
 */

if ( ! is_customize_preview() ) {

	$login_page = get_permalink( brainaddons_login_page() );

	$url = add_query_arg(
		array(
			'autofocus[panel]' => 'divi_login_designer',
			'return'           => admin_url( 'index.php' ),
			'url'              => rawurlencode( $login_page ),
		),
		admin_url( 'customize.php' )
	);

	wp_safe_redirect( $url );
}

?>

<!DOCTYPE html>
<html>
	<head>
	<?php
	$login_title = sprintf(
		__( '%1$s &lsaquo; %2$s &#8212; WordPress', 'addons-for-divi' ),
		__( 'Log In', 'addons-for-divi' ),
		get_bloginfo( 'name', 'display' )
	);
	?>
	<title><?php echo esc_attr( $login_title ); ?></title>
	<?php
		wp_enqueue_style( 'login' );
		do_action( 'login_enqueue_scripts' );
		do_action( 'login_head' );
	?>
	</head>
	<?php

		do_action( 'login_form_login' );

		$action = 'login'; // phpcs:ignore

		$login_link_separator = apply_filters( 'login_link_separator', ' | ' );

	if ( is_multisite() ) {
		$login_header_url   = network_home_url();
		$login_header_title = get_network()->site_name;
	} else {
		$login_header_url   = __( 'https://wordpress.org/', 'addons-for-divi' );
		$login_header_title = __( 'Powered by WordPress', 'addons-for-divi' );
	}

		$login_header_url = apply_filters( 'login_headerurl', $login_header_url );

		$login_header_title = apply_filters( 'login_headertitle', $login_header_title );

	if ( is_multisite() ) {
		$login_header_text = get_bloginfo( 'name', 'display' );
	} else {
		$login_header_text = $login_header_title;
	}

		$classes = array( 'login-action-' . $action, 'wp-core-ui' );

	if ( is_rtl() ) {
		$classes[] = 'rtl';
	}

		$classes = apply_filters( 'login_body_class', $classes, $action );
	?>

	<body class="login <?php echo esc_attr( implode( ' ', $classes ) ); ?>">

	<?php do_action( 'login_header' ); ?>

		<div id="login">

			<h1>
				<a href="<?php echo esc_url( $login_header_url ); ?>" title="<?php echo esc_attr( $login_header_title ); ?>" tabindex="-1">
					<?php echo $login_header_text; // phpcs:ignore ?>
				</a>
			</h1>

			<form name="loginform" id="loginform">
			<p>
					<label id="brainaddons-username-label" for="user_login">
						<span id="brainaddons-username-label-text"><?php echo esc_html__( 'Username or Email Address', 'addons-for-divi' ); ?></span>
						<div id="brainaddons-username">
							<input autocomplete="off" type="text" name="log" id="user_login" class="input" value="email@example.com" size="20" />
						</div>
					</label>
				</p>

				<p>
					<label id="brainaddons-password-label" for="user_pass">
						<span id="brainaddons-password-label-text"><?php echo esc_html__( 'Password', 'addons-for-divi' ); ?></span>
						<div id="brainaddons-password">
							<input autocomplete="off" type="password" name="pwd" id="user_pass" class="input" value="password" size="20" />
							<?php if ( version_compare( $GLOBALS['wp_version'], '5.2', '>' ) ) { ?>
								<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php echo esc_attr__( 'Show Password', 'addons-for-divi' ); ?>">
									<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
								</button>
							<?php } ?>
						</div>
					</label>
				</p>

				<?php do_action( 'login_form' ); ?>

				<div class="brainaddons-form-footer">
					<p class="forgetmenot">
						<label for="rememberme">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
							<?php esc_html_e( 'Remember Me' ); ?>
						</label>
					</p>

					<p class="submit">
						<span id="brainaddons-button">
							<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php echo esc_html__( 'Log In', 'addons-for-divi' ); ?>" />
						</span>
					</p>
				</div>
			</form>

			<p id="nav">
				<?php
				if ( get_option( 'users_can_register' ) ) :
					$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register', 'addons-for-divi' ) );
					/** This filter is documented in wp-includes/general-template.php */
					echo esc_url( apply_filters( 'register', $registration_url ) );
					echo esc_html( $login_link_separator );
				endif;
				?>
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'addons-for-divi' ); ?></a>

			</p>

			<p id="backtoblog">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
					/* translators: %s: site title */
					printf( _x( '&larr; Back to %s', 'site', 'addons-for-divi' ), esc_html( get_bloginfo( 'title', 'display' ) ) ); // phpcs:ignore
					?>
				</a>
			</p>

		</div>

			<?php do_action( 'login_footer' ); ?>
	</body>

</html>

<?php
wp_footer();
