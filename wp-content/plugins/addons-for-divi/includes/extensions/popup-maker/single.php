<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$popup_id = get_the_ID();

add_filter( 'et_builder_page_settings_values', 'ba_popup_settings_values', $popup_id, 10, 1 );

$uniq_popup_id = 'dtq-popup-' . $popup_id;
$popup_styles  = ba_custom_css( $popup_id );
$page_settings = ba_all_values( $popup_id );

$close_button_html = '';
$ba_close_button   = 'on' === $page_settings['ba_close_button'] ? true : false;

if ( $ba_close_button ) {
	$close_button_html = '<div class="dtq-popup-close-button">
	<svg viewBox="0 0 16 16" id="close-thin" xmlns="http://www.w3.org/2000/svg"><path fill="#41444B" d="M8.707 8l7.147 7.146a.5.5 0 0 1-.708.708L8 8.707.854 15.854a.5.5 0 0 1-.708-.708L7.293 8 .146.854A.5.5 0 1 1 .854.146L8 7.293 15.146.146a.5.5 0 0 1 .708.708L8.707 8z"></path></svg>
</div>';
}
$overlay_html = '';
$use_overlay  = 'on' === $page_settings['ba_overlay'] ? true : false;

if ( $use_overlay ) {
	$overlay_html = '<div class="dtq-popup-overlay"></div>';
}

get_header();

echo '<style type="text/css">#wpadminbar { display: none !important; }</style>';

?>
	<style type="text/css"> <?php echo esc_attr( $popup_styles ); ?></style>
	<div id="<?php echo esc_attr( $uniq_popup_id ); ?>" class="dtq-popup-edit-area">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="dtq-popup dtq-popup-single-preview">
				<div class="dtq-popup-inner">
					<?php echo et_core_intentionally_unescaped( $overlay_html, 'html' ); //phpcs:ignore ?>
					<div class="dtq-popup-container">
						<?php echo et_core_intentionally_unescaped( $close_button_html, 'html' ); //phpcs:ignore ?>
						<div class="dtq-popup-container-inner">
							<div class="dtq-popup-container-overlay"></div>
							<div class="dtq-popup-container-content">
								<?php
								while ( have_posts() ) :
									the_post();
									wp_enqueue_script( 'dtqj-anime' );
									wp_enqueue_script( 'dtqj-marvin' );
									the_content();
									endwhile;
								?>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
	<?php get_footer(); ?>
