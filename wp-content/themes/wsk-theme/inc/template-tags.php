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
