<?php
/**
 * Template tags
 *
 * @package WSK_Theme
 */

/**
 * Output the layout classes.
 *
 * @param string $layout_name    Name of the layout.
 * @param string $padder_variant Name of the padder variant. none | default | condensed | tight.
 */
function wskt_layout_classes( $layout_name = '', $padder_variant = 'default' ) {
	$layout_classes = array(
		'layout',
	);

	// Add layout name class.
	if ( $layout_name ) {
		$layout_classes[] = "layout--{$layout_name}";
	}

	// Add padding variant class.
	if ( 'default' === $padder_variant ) {
		$layout_classes[] = 'padder-y';
	} elseif ( 'none' !== $padder_variant ) {
		$layout_classes[] = 'padder-y-' . $padder_variant;
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
