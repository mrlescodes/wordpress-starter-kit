<?php
/**
 * Template tags
 *
 * @package WSK_Theme
 */

/**
 * Output the layout classes.
 *
 * @param string $layout_name Name of the layout.
 */
function wskt_layout_classes( $layout_name = '' ) {
	$layout_classes = array(
		'layout',
	);

	// Add layout name class.
	if ( $layout_name ) {
		$layout_classes[] = "layout--{$layout_name}";
	}

	echo esc_attr( implode( ' ', $layout_classes ) );
}

/**
 * Output background image style string.
 *
 * @param array $background_image Array of bg image attributes.
 */
function wskt_bg_image_styles( $background_image = array() ) {
	$default_attrs = array(
		'image'    => '',
	);

	$attrs = wp_parse_args( $background_image, $default_attrs );

	if ( ! $attrs['image'] ) {
		return;
	}

	$bg_image_styles = array();

	// TODO: Set correct size.
	$bg_image_src = wp_get_attachment_image_src( $attrs['image']['id'], 'full' );
	$bg_image_src = array_shift( $bg_image_src );

	$bg_image_styles[] = sprintf( 'background-image: url(%s);', esc_url( $bg_image_src ) );

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo sprintf( 'style="%s"', implode( ' ', $bg_image_styles ) );
}

/**
 * Posts Pagination
 *
 * Customise the pagination function to use Bootstrap styles.
 *
 * @param WP_Query|null $wp_query The query object for the posts.
 */
function wskt_posts_pagination( $wp_query = null ) {
	// Use global $wp_query if custom query not given.
	if ( null === $wp_query ) {
		global $wp_query;
	}

	$bignum = 999999999;

	$page_links = paginate_links(
		array(
			'type'      => 'array',
			'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'end_size'  => 1,
			'mid_size'  => 1,
			'prev_next' => true,
			'prev_text' => esc_html__( 'Prev', 'wsk-theme' ),
			'next_text' => esc_html__( 'Next', 'wsk-theme' ),
		)
	);

	if ( is_array( $page_links ) ) {
		$pagination  = sprintf( '<nav aria-label="%s">', esc_attr__( 'Posts pagination', 'wsk-theme' ) );
		$pagination .= '<ul class="pagination">';

		foreach ( $page_links as $page_link ) {
			// Prepare list item class.
			$li_classes = array( 'page-item' );
			if ( strpos( $page_link, 'current' ) ) {
				$li_classes[] = 'active';
			}
			if ( strpos( $page_link, 'prev' ) ) {
				$li_classes[] = 'prev';
			}
			if ( strpos( $page_link, 'next' ) ) {
				$li_classes[] = 'next';
			}

			// Clean up the link classes.
			$page_link = str_replace( 'prev ', '', $page_link );
			$page_link = str_replace( 'next ', '', $page_link );
			$page_link = str_replace( ' current', '', $page_link );
			$page_link = str_replace( 'page-numbers', 'page-link', $page_link );

			$pagination .= sprintf( '<li class="%s">%s</li>', implode( ' ', $li_classes ), $page_link );
		}

		$pagination .= '</ul>';
		$pagination .= '</nav>';

		echo wp_kses( $pagination, 'html' );
	}
}

/**
 * Output the post thumbnail
 */
function wskt_post_thumbnail() {
	// TODO: Set correct size.
	$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail( null, 'full', array( 'class' => 'card-img-top' ) ) : '<div class="card-img-top card-img-fallback"></div>';

	printf( '<a href="%s">%s</a>', esc_url( get_the_permalink() ), wp_kses( $thumbnail, 'html' ) );
}

/**
 * Output the post date
 */
function wskt_post_date() {
	$time_string = '<time class="updated" datetime="%1$s">%2$s</time> ';

	$time_string = sprintf(
		$time_string,
		get_the_time( 'Y-m-j' ),
		get_the_time( get_option( 'date_format' ) )
	);

	echo '<span class="posted-on">' . wp_kses_post( $time_string ) . '</span>';
}
