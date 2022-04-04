<?php

$figure    = '';
$author    = '';
$date      = '';
$separator = '';
$excerpt   = '';
$meta      = '';

if ( 'on' === $show_thumb ) {
	if ( has_post_thumbnail() ) {
		$figure = sprintf(
			'<figure class="dtq-post-list-thumb">
				<img class="dtq-img-cover" src="%1$s" />
			</figure>',
			esc_url( get_the_post_thumbnail_url() )
		);
	}
} else {
	if ( 'on' === $show_icon ) {
		$figure = sprintf(
			'<div class="dtq-post-list-icon">
				<i class="dtq-et-font-icon">%1$s</i>
			</div>',
			$list_icon
		);
	}
}

if ( 'on' === $show_author ) {
	$author = sprintf(
		'<div class="dtq-post-list-author">
			By %1$s
		</div>',
		get_the_author()
	);
}

if ( 'on' === $show_date ) {
	$date = sprintf(
		'<div class="dtq-post-list-date">
			%1$s
		</div>',
		get_the_time( $date_format )
	);
}

if ( 'on' === $show_author && 'on' === $show_date ) {
	$separator = '<span class="dtq-separator">|</span>';
}

if ( 'on' === $show_excerpt ) {
	$excerpt = sprintf(
		'<p class="dtq-post-list-excerpt">%1$s</p>',
		BaPostHelper::get_post_excerpt( $excerpt_length )
	);
}

if ( 'on' === $show_author || 'on' === $show_date ) {
	$meta = sprintf(
		'<div class="dtq-post-list-meta">
			%1$s %2$s %3$s
		</div>',
		$author,
		$separator,
		$date
	);
}

printf(
	'<li class="dtq-post-list-child">
		<a class="dtq-post-list-child-inner" href="%1$s">
			%5$s
			<div class="dtq-post-list-content">
				<h3 class="dtq-post-list-title">%2$s</h3>
				%3$s
				%4$s
			</div>
		</a>
	</li>',
	esc_url( get_the_permalink() ),
	et_core_intentionally_unescaped( get_the_title(), 'html' ),
	et_core_intentionally_unescaped( $meta, 'html' ),
	et_core_intentionally_unescaped( $excerpt, 'html' ),
	et_core_intentionally_unescaped( $figure, 'html' )
);
