<?php
class BaPostHelper {

	public static function get_post_thumb( $args, $render_empty_figure ) {

		$thumb_id               = get_post_thumbnail_id( get_the_ID() );
		$alt                    = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
		$overlay_icon           = $args['overlay_icon'];
		$processed_overlay_icon = esc_attr( et_pb_process_font_icon( $overlay_icon ) );
		$overlay_icon           = ! empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';

		if ( has_post_thumbnail() ) {
			return sprintf(
				'
                <figure class="dtq-post-thumb">
                    <a href="%1$s">
                        <div class="dtq-overlay" data-icon="%4$s"></div>
                        <img src="%2$s" alt="%3$s">
                    </a>
                </figure>',
				esc_url( get_the_permalink() ),
				esc_url( get_the_post_thumbnail_url() ),
				$alt,
				$overlay_icon
			);
		} else {
			if ( $render_empty_figure === true ) {
				return '<figure class="dtq-post-thumb dtq-empty-thumb"></figure>';
			}
		}
	}

	public static function get_post_title( $tag ) {
		return sprintf(
			'
            <%1$s class="dtq-post-title">
                <a href="%2$s">%3$s</a>
            </%1$s>
        ',
			$tag,
			esc_url( get_the_permalink() ),
			get_the_title()
		);
	}

	// public static function get_post_categories() {
		// return '<div class="dtq-post-categories">' . et_builder_get_the_term_list( ', ' ) . '</div>';
	// }

	public static function get_post_categories( $show_first_category, $include_categories, $class_name ) {
		if ( 'off' === $show_first_category ) {
			return sprintf(
				'<div class="%2$s">%1$s</div>',
				et_builder_get_the_term_list( ', ' ),
				$class_name
			);
		} else {

			$pattern            = '/,?current/';
			$include_categories = preg_replace( $pattern, '', $include_categories );
			$pattern            = '/^,?/';
			$include_categories = preg_replace( $pattern, '', $include_categories );

			if ( ! empty( $include_categories ) ) {
				$categories_ids = explode( ',', $include_categories );
			} else {
				$categories_ids = get_terms(
					array( 'category' ),
					array( 'fields' => 'ids' )
				);
			}

			// print_r( $categories_ids );

			return sprintf(
				'<div class="%3$s"><a rel="tag" href="%2$s">%1$s</a></div>',
				get_the_category_by_ID( $categories_ids[0] ),
				get_category_link( $categories_ids[0] ),
				$class_name
			);
		}
	}

	public static function get_post_button(
		$button_text = 'Read More',
		$icon_name = '5',
		$classes = ''
		) {
		return sprintf(
			'
            <div class="dtq-post-btn-wrap %4$s">
                <a href="%1$s" target="_self" class="et_pb_button dtq-post-btn" data-icon="%2$s">
                    %3$s
                </a>
            </div>',
			esc_url( get_the_permalink() ),
			$icon_name,
			$button_text,
			$classes
		);
	}

	public static function get_post_excerpt( $length = '150' ) {
		$post_id = get_the_ID();
		return mb_strimwidth( get_the_excerpt( $post_id ), 0, $length, '...' );
	}

	public static function get_post_excerpt_html( $length = '150' ) {
		return sprintf( '<div class="dtq-post-excerpt">%1$s</div>', self::get_post_excerpt( $length ) );
	}

}
