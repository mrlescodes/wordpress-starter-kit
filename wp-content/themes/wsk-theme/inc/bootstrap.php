<?php
/**
 * Bootstrap
 *
 * Collection of bootstrap related functions and filters
 *
 * @package WSK_Theme
 */

/**
 * Adds bootstrap fluid image class to images
 *
 * @param string[] $attrs Array of attribute values for the image markup, keyed by attribute name.
 */
function wskt_add_fluid_image_class( $attrs ) {
	$attrs['class'] .= ' img-fluid';

	return $attrs;
}
add_filter( 'wp_get_attachment_image_attributes', 'wskt_add_fluid_image_class' );
