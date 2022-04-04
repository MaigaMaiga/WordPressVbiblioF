<?php
defined( 'ABSPATH' ) || die();

function ba_get_b64_icon() {
	return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIxIDExLjk5N0MyMC45OTg0IDEzLjQzNTYgMjAuNjUwNCAxNC44NTMgMTkuOTg1MSAxNi4xMzA2QzE5LjMxOTggMTcuNDA4MiAxOC4zNTY2IDE4LjUwODkgMTcuMTc1OSAxOS4zNDA3QzE1Ljk5NTIgMjAuMTcyNSAxNC42MzEzIDIwLjcxMTMgMTMuMTk4NCAyMC45MTE5QzExLjc2NTQgMjEuMTEyNiAxMC4zMDQ5IDIwLjk2OTMgOC45MzkwNyAyMC40OTRDOC4xNzM5MiAyMC4yMjczIDcuNDQ3ODIgMTkuODYwNyA2Ljc3OTg1IDE5LjQwMzdDNS45OTE1NyAxOC44NTg2IDUuMzY0ODYgMTguMTI1MiA1LjM2NDg2IDE3LjEzMjJDNi4zODMzNCAxNy45Njg0IDcuNjI1OTIgMTguNDg5NiA4LjkzOTA3IDE4LjYzMTRDOS4xODY3MiAxOC42NTg4IDkuNDM1NzMgMTguNjcyNCA5LjY4NDkyIDE4LjY3MkMxMS40MzM1IDE4LjY3MzggMTMuMTE1NSAxOC4wMDUgMTQuMzgwNSAxNi44MDQ4QzE1LjY0NTUgMTUuNjA0NiAxNi4zOTYxIDEzLjk2NTYgMTYuNDc1OSAxMi4yMjlDMTYuNDc1OSAxMi4xMjUyIDE2LjQ4NDEgMTIuMDE5NyAxNi40ODQxIDExLjkxNDJDMTYuNDg0MSAxMS44MDg4IDE2LjQ4NDEgMTEuNjc3NCAxNi40NzQzIDExLjU2MDVDMTYuNDY0NSAxMS40NDM3IDE2LjQ1NjMgMTEuMzAyNiAxNi40NDMzIDExLjE3NDRDMTYuNDIwNCAxMC45Njk5IDE2LjM4OTQgMTAuNzY4NyAxNi4zNDg2IDEwLjU2OTJDMTYuMDM3IDkuMDQwNjIgMTUuMjAzMyA3LjY2NjIxIDEzLjk4ODggNi42Nzg5NUMxMi43NzQzIDUuNjkxNyAxMS4yNTM3IDUuMTUyMzYgOS42ODQ5MiA1LjE1MjM2QzguMTE2MSA1LjE1MjM2IDYuNTk1NTUgNS42OTE3IDUuMzgxMDQgNi42Nzg5NUM0LjE2NjU0IDcuNjY2MjEgMy4zMzI4MSA5LjA0MDYyIDMuMDIxMjIgMTAuNTY5MkgzQzMuMzYyOTIgOC4zMzUyMyA0LjU1ODU3IDYuMzE5MDEgNi4zNDkwMyA0LjkyMTczQzguMTM5NDkgMy41MjQ0NiAxMC4zOTM1IDIuODQ4NTYgMTIuNjYyNSAzLjAyODU1QzE0LjkzMTUgMy4yMDg1MyAxNy4wNDkyIDQuMjMxMiAxOC41OTQxIDUuODkzMDVDMjAuMTM5MSA3LjU1NDg5IDIwLjk5OCA5LjczNDA5IDIxIDExLjk5N1YxMS45OTdaIiBmaWxsPSIjYTdhYWFkIi8+CjxwYXRoIGQ9Ik0xMy4xODM1IDcuMjA0MjlDMTIuNDM4NSA2LjkwNjY2IDExLjY0MjggNi43NTQ2MSAxMC44Mzk5IDYuNzU2NDhDOC4zNDI4NCA2Ljc1NjQ4IDYuMjI3NjkgOC4xODEwNCA1LjQ5NjUzIDEwLjE1MDhDNS40NDk3NyAxMC4yNzQyIDUuMzY2MzIgMTAuMzgwNSA1LjI1NzI3IDEwLjQ1NTVDNS4xNDgyMyAxMC41MzA2IDUuMDE4NzcgMTAuNTcwOSA0Ljg4NjE0IDEwLjU3MVYxMC41NzFDNC43ODMyNSAxMC41NzE0IDQuNjgxNzIgMTAuNTQ3NyA0LjU4OTgxIDEwLjUwMTdDNC40OTc5MSAxMC40NTU3IDQuNDE4MjQgMTAuMzg4OCA0LjM1NzMgMTAuMzA2NEM0LjI5NjM2IDEwLjIyNCA0LjI1NTg4IDEwLjEyODQgNC4yMzkxNSAxMC4wMjc1QzQuMjIyNDMgOS45MjY1OCA0LjIyOTkzIDkuODIzMTYgNC4yNjEwNiA5LjcyNTY3QzQuOTE1NTEgNy42NTM3MyA3LjA4NjE1IDYuMTI4NTcgOS42NzYyMyA2LjEyODU3QzEwLjkyODggNi4xMTk2NyAxMi4xNTM3IDYuNDk1MzQgMTMuMTgzNSA3LjIwNDI5VjcuMjA0MjlaIiBmaWxsPSIjYTdhYWFkIi8+CjxwYXRoIG9wYWNpdHk9IjAuOSIgZD0iTTE2LjQ3OTkgMTEuOTEzOUMxNi40Nzk5IDEyLjAxOTQgMTYuNDc5OSAxMi4xMjQ5IDE2LjQ3MTcgMTIuMjI4N0MxNi4zOTIzIDEzLjk2NDUgMTUuNjQyOSAxNS42MDI5IDE0LjM3OTIgMTYuODAzM0MxMy4xMTU1IDE4LjAwMzYgMTEuNDM1IDE4LjY3MzQgOS42ODcyNSAxOC42NzMzQzkuNDM4MDcgMTguNjczNyA5LjE4OTA2IDE4LjY2MDIgOC45NDE0IDE4LjYzMjdDNy42MjgyNSAxOC40OTA5IDYuMzg1NjcgMTcuOTY5NyA1LjM2NzE5IDE3LjEzMzZWMTYuNDM3NUM2LjIzNDYxIDE3LjExNzkgNy4yNTQxNiAxNy41ODA1IDguMzM5NTIgMTcuNzg2MUM5LjQyNDg4IDE3Ljk5MTcgMTAuNTQ0MSAxNy45MzQ0IDExLjYwMjUgMTcuNjE4OUMxMi42NjA4IDE3LjMwMzQgMTMuNjI3MSAxNi43MzkxIDE0LjQxOTYgMTUuOTczN0MxNS4yMTIxIDE1LjIwODMgMTUuODA3NCAxNC4yNjQzIDE2LjE1NTEgMTMuMjIxN0MxNi4yMDU3IDEzLjA2OTIgMTYuMjUxNCAxMi45MTE4IDE2LjI5MjIgMTIuNzU0NEMxNi4zMzk1IDEyLjU2NjIgMTYuMzgwMyAxMi4zNzQ3IDE2LjQxMTMgMTIuMThDMTYuNDI5MSAxMi4wMzUyIDE2LjQzOTQgMTEuODg5NSAxNi40NDI0IDExLjc0MzZDMTYuNDQyNCAxMS43MTc2IDE2LjQ0MjQgMTEuNjkxNyAxNi40NDI0IDExLjY2NTdDMTYuNDQyMSAxMS41MDMxIDE2LjQzMjkgMTEuMzQwNiAxNi40MTQ2IDExLjE3OUgxNi40Mzc1QzE2LjQ1MDUgMTEuMzA3MSAxNi40NjE5IDExLjQzNTMgMTYuNDY4NSAxMS41NjUxQzE2LjQ3NSAxMS42OTQ5IDE2LjQ3OTkgMTEuNzk1NSAxNi40Nzk5IDExLjkxMzlaIiBmaWxsPSIjYTdhYWFkIi8+CjxwYXRoIGQ9Ik0xNi40Njg4IDExLjU2MDRDMTYuNDY4OCAxMS40MzA2IDE2LjQ1MDkgMTEuMzAyNCAxNi40Mzc4IDExLjE3NDJIMTYuNDE1QzE2LjQzMzIgMTEuMzM1OCAxNi40NDI1IDExLjQ5ODMgMTYuNDQyNyAxMS42NjFDMTYuNDQyNyAxMS42ODY5IDE2LjQ0MjcgMTEuNzEyOSAxNi40NDI3IDExLjczODhDMTYuNDM5OCAxMS44ODQ4IDE2LjQyOTQgMTIuMDMwNCAxNi40MTE3IDEyLjE3NTNDMTYuMzgwNyAxMi4zNyAxNi4zMzk5IDEyLjU2MTQgMTYuMjkyNiAxMi43NDk3QzE2LjI1MTggMTIuOTExOSAxNi4yMDYxIDEzLjA2NDQgMTYuMTU1NSAxMy4yMTY5QzE2LjEwOTggMTMuMzM4NiAxNi4wNTc1IDEzLjQ1NzEgMTYuMDAyIDEzLjU3MzlDMTUuNjU2MSAxNC4yODk0IDEzLjcxNzIgMTYuNDE4MSAxMC44Mjg0IDE2LjU3MDdDMTAuMjY5IDE2LjYwNjYgOS43MDc3MiAxNi41NDEyIDkuMTcxODggMTYuMzc3NlYxMi40NTI3QzkuMTcyMDMgMTIuMzYwNCA5LjE2NTQ4IDEyLjI2ODMgOS4xNTIyOSAxMi4xNzY5QzkuMDgzMzQgMTEuNzAyMyA4LjgzNTk3IDExLjI3MTMgOC40NjAwNSAxMC45NzA5QzguMDg0MTMgMTAuNjcwNCA3LjYwNzYxIDEwLjUyMjggNy4xMjY1NSAxMC41NTc4QzYuNjQ1NDkgMTAuNTkyOCA2LjE5NTY1IDEwLjgwNzggNS44Njc3MiAxMS4xNTk0QzUuNTM5NzggMTEuNTExMSA1LjM1ODEzIDExLjk3MzIgNS4zNTkzOCAxMi40NTI3VjE3LjEzMzdDNi4zNzc4NyAxNy45Njk4IDcuNjIwNDUgMTguNDkxIDguOTMzNTkgMTguNjMyOUM5LjE4MTI1IDE4LjY2MDMgOS40MzAyNiAxOC42NzM4IDkuNjc5NDUgMTguNjczNEMxMS40MjgzIDE4LjY3NTIgMTMuMTEwNSAxOC4wMDYyIDE0LjM3NTYgMTYuODA1N0MxNS42NDA2IDE1LjYwNTEgMTYuMzkxIDEzLjk2NTcgMTYuNDcwNSAxMi4yMjg4QzE2LjQ3MDUgMTIuMTI1IDE2LjQ3ODYgMTIuMDE5NSAxNi40Nzg2IDExLjkxNDFDMTYuNDc4NiAxMS44MDg2IDE2LjQ3NTMgMTEuNjcyMyAxNi40Njg4IDExLjU2MDRaIiBmaWxsPSIjYTdhYWFkIi8+Cjwvc3ZnPg==';
}

function divitorque_has_pro() {
	return defined( 'DIVI_TORQUE_PRO_VERSION' ) || defined( 'BRAIN_ADDONS_PRO_VERSION' );
}

function ba_has_pro() {
	return defined( 'BRAIN_ADDONS_PRO_VERSION' );
}

function divitorque_dashboard_link() {
	return add_query_arg( array( 'page' => 'addons-for-divi' ), admin_url( 'admin.php' ) );
}

function ba_get_svg_user_icon() {
	return '<svg viewBox="84.8 395.9 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
        <path d="m109.4 420c3.3 0 6.1-1.2 8.4-3.5s3.5-5.1 3.5-8.4-1.2-6.1-3.5-8.4-5.1-3.5-8.4-3.5-6.1 1.2-8.4 3.5-3.5 5.1-3.5 8.4 1.2 6.1 3.5 8.4 5.2 3.5 8.4 3.5zm-6.3-18.3c1.8-1.8 3.9-2.6 6.4-2.6s4.6 0.9 6.4 2.6c1.8 1.8 2.6 3.9 2.6 6.4s-0.9 4.6-2.6 6.4c-1.8 1.8-3.9 2.6-6.4 2.6s-4.6-0.9-6.4-2.6c-1.8-1.8-2.6-3.9-2.6-6.4-0.1-2.5 0.8-4.6 2.6-6.4z"/><path d="m130.3 434.2c-0.1-1-0.2-2-0.4-3.1s-0.5-2.2-0.8-3.1c-0.3-1-0.8-2-1.3-2.9-0.6-1-1.2-1.8-1.9-2.5-0.8-0.7-1.7-1.3-2.8-1.8-1.1-0.4-2.3-0.6-3.6-0.6-0.5 0-1 0.2-1.9 0.8-0.6 0.4-1.3 0.8-2 1.3-0.6 0.4-1.5 0.8-2.6 1.1s-2.1 0.5-3.2 0.5-2.1-0.2-3.2-0.5-2-0.7-2.6-1.1c-0.7-0.5-1.4-0.9-2-1.3-0.9-0.6-1.4-0.8-1.9-0.8-1.3 0-2.5 0.2-3.6 0.6s-2 1-2.8 1.8c-0.7 0.7-1.4 1.6-1.9 2.5s-1 1.9-1.3 2.9-0.6 2-0.8 3.1-0.3 2.2-0.4 3.1-0.1 1.9-0.1 2.9c0 2.6 0.8 4.7 2.4 6.2s3.7 2.3 6.3 2.3h23.8c2.6 0 4.7-0.8 6.3-2.3s2.4-3.6 2.4-6.2c0-1-0.1-2-0.1-2.9zm-4.4 7c-1.1 1-2.5 1.5-4.3 1.5h-23.7c-1.8 0-3.2-0.5-4.3-1.5-1-1-1.5-2.3-1.5-4.1 0-0.9 0-1.8 0.1-2.7s0.2-1.8 0.4-2.8 0.4-1.9 0.7-2.8c0.3-0.8 0.6-1.6 1.1-2.4 0.4-0.7 0.9-1.4 1.4-1.9s1.1-0.9 1.9-1.2c0.7-0.3 1.4-0.4 2.3-0.4 0.1 0.1 0.3 0.2 0.6 0.3 0.6 0.4 1.3 0.8 2 1.3 0.9 0.5 2 1 3.3 1.5 1.3 0.4 2.7 0.7 4.1 0.7s2.7-0.2 4.1-0.7c1.3-0.4 2.4-0.9 3.3-1.5 0.8-0.5 1.4-0.9 2-1.3 0.3-0.2 0.5-0.3 0.6-0.3 0.8 0 1.6 0.2 2.3 0.4 0.7 0.3 1.4 0.7 1.9 1.2s1 1.1 1.4 1.9 0.8 1.6 1.1 2.4 0.5 1.8 0.7 2.8 0.3 2 0.4 2.8c0.1 0.9 0.1 1.8 0.1 2.7-0.4 1.8-0.9 3.1-2 4.1z"/>
    </svg>
    ';
}

function ba_get_svg_clock_icon() {
	return '<svg enable-background="new 0 0 443.294 443.294" viewBox="0 0 443.29 443.29" xmlns="http://www.w3.org/2000/svg"><path d="m221.65 0c-122.21 0-221.65 99.433-221.65 221.65s99.433 221.65 221.65 221.65 221.65-99.433 221.65-221.65-99.433-221.65-221.65-221.65zm0 415.59c-106.94 0-193.94-87-193.94-193.94s87-193.94 193.94-193.94 193.94 87 193.94 193.94-87 193.94-193.94 193.94z"/><path d="m235.5 83.118h-27.706v144.26l87.176 87.176 19.589-19.589-79.059-79.059z"/>
    </svg>';
}

function ba_get_img_masking_shapes( $shape ) {
	$masking_shapes = array(
		'none'    => '',

		'shape_1' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 86.4"><path class="st0" opacity="0.2" d="M0,69.3c0,0,76.2-89.2,215-32.8s185,32.8,185,32.8v17H0V69.3z"></path><path class="st0" opacity="0.2" d="M0,69.3v17h400v-17c0,0-7.7-93.8-145.8-59.1S89.7,119,0,69.3z"></path><path class="st1" d="M0,69.3c0,0,50.3-63.1,197.3-14.2S400,69.3,400,69.3v17H0V69.3z"></path></svg>',

		'shape_2' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 273.3 34"><path d="M0,34h273.3l0-32C119.7-8.7,0,34,0,34z"/></svg>',

		'shape_3' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 35"><path 	class="st0" d="M0,33.6C63.8,11.8,130.8,0.2,200,0.2s136.2,11.6,200,33.4v1.2H0V33.6z"></path></svg>',
	);

	return $masking_shapes[ $shape ];
}

function brainaddons_login_page() {

	$options = get_option( 'brainaddons_settings', array() );
	$page    = array_key_exists( 'login_page', $options ) ? get_post( $options['login_page'] ) : false;

	return $page;
}

function ba_get_post_types() {

	$post_types = get_post_types(
		array(
			'public' => true,
		),
		'objects'
	);

	$options = array();

	foreach ( $post_types as $post_type ) {
		$options[ $post_type->name ] = $post_type->label;
	}

	// Deprecated 'Media' post type.
	$key = array_search( 'Media', $options, true );
	if ( 'attachment' === $key ) {
		unset( $options[ $key ] );
	}

	return apply_filters( 'uael_loop_post_types', $options );
}

function ba_get_taxonomies() {

	$taxonomies = get_taxonomies( array( 'show_in_nav_menus' => true ), 'objects' );

	$options = array( '' => '' );

	foreach ( $taxonomies as $taxonomy ) {
		$options[ $taxonomy->name ] = $taxonomy->label;
	}

	return $options;
}

function ba_get_date_link( $post_id = null ) {

	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	$year  = get_the_date( 'Y', $post_id );
	$month = get_the_time( 'm', $post_id );
	$day   = get_the_time( 'd', $post_id );
	$url   = get_day_link( $year, $month, $day );

	return $url;
}

function ba_get_excerpt( $post_id = null, $length = null ) {
	if ( empty( $length ) ) {
		$length = 35;
	}
	return wpautop( strip_shortcodes( truncate_post( $length, false, '', true ) ) );
}

function ba_prev_arrow_icon() {
	return '<span class="dtq-svg-iconset svg-baseline"><svg aria-hidden="true" class="dtq-svg-icon dtq-arrow-left-alt-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="29" height="28" viewBox="0 0 29 28"><title>Previous</title><path d="M28 12.5v3c0 0.281-0.219 0.5-0.5 0.5h-19.5v3.5c0 0.203-0.109 0.375-0.297 0.453s-0.391 0.047-0.547-0.078l-6-5.469c-0.094-0.094-0.156-0.219-0.156-0.359v0c0-0.141 0.063-0.281 0.156-0.375l6-5.531c0.156-0.141 0.359-0.172 0.547-0.094 0.172 0.078 0.297 0.25 0.297 0.453v3.5h19.5c0.281 0 0.5 0.219 0.5 0.5z"></path>
	</svg></span>';
}

function ba_next_arrow_icon() {
	return '<span class="dtq-svg-iconset svg-baseline"><svg aria-hidden="true" class="dtq-svg-icon dtq-arrow-right-alt-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="27" height="28" viewBox="0 0 27 28"><title>Continue</title><path d="M27 13.953c0 0.141-0.063 0.281-0.156 0.375l-6 5.531c-0.156 0.141-0.359 0.172-0.547 0.094-0.172-0.078-0.297-0.25-0.297-0.453v-3.5h-19.5c-0.281 0-0.5-0.219-0.5-0.5v-3c0-0.281 0.219-0.5 0.5-0.5h19.5v-3.5c0-0.203 0.109-0.375 0.297-0.453s0.391-0.047 0.547 0.078l6 5.469c0.094 0.094 0.156 0.219 0.156 0.359v0z"></path></svg></span>';
}

function ba_related_posts_args( $post_id ) {
	$categories = get_the_terms( $post_id, 'category' );
	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		$categories = array();
	}
	$category_list = wp_list_pluck( $categories, 'term_id' );
	$related_args  = array(
		'post_type'      => 'post',
		'posts_per_page' => 6,
		'no_found_rows'  => true,
		'post_status'    => 'publish',
		'post__not_in'   => array( $post_id ),
		'orderby'        => 'rand',
		'category__in'   => $category_list,

	);

	return $related_args;
}

function dt_if_not_migrated() {
	$not_migrated = get_option( 'ba_version' );
	if ( $not_migrated ) {
		return true;
	}
	return false;
}

function dt_backend_helpers( $helpers ) {

	$helpers['ifMigrated'] = dt_if_not_migrated() ? 'false' : 'true';

	return $helpers;

}

add_filter( 'et_fb_backend_helpers', 'dt_backend_helpers' );

function dtq_global_assets_list( $global_list ) {

	$assets_list   = array();
	$assets_prefix = et_get_dynamic_assets_path();

	$assets_list['et_icons_fa'] = array(
		'css' => "{$assets_prefix}/css/icons_fa_all.css",
	);

	return array_merge( $global_list, $assets_list );
}

function dtq_inject_fa_icons( $icon_data ) {
	if ( function_exists( 'et_pb_maybe_fa_font_icon' ) && et_pb_maybe_fa_font_icon( $icon_data ) ) {
		add_filter( 'et_global_assets_list', 'dtq_global_assets_list' );
		add_filter( 'et_late_global_assets_list', 'dtq_global_assets_list' );
	}
}
