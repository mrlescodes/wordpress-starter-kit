<?php
/**
 * Bootstrap
 *
 * Collection of bootstrap related functions and filters
 *
 * @package WSK_Theme
 */

/**
 * Adds bootstrap fluid image class to attachment images
 *
 * @param string[] $attrs Array of attribute values for the image markup, keyed by attribute name.
 */
function wskt_add_attachment_fluid_image_class( $attrs ) {
	$attrs['class'] .= ' img-fluid';

	return $attrs;
}
add_filter( 'wp_get_attachment_image_attributes', 'wskt_add_attachment_fluid_image_class' );

/**
 * Adds bootstrap fluid image class to editor images
 *
 * @param string[] $content The editor content.
 */
function wskt_add_editor_fluid_image_class( $content ) {
	$pattern     = '/<img(.*?)class=\"(.*?)\"(.*?)>/i';
	$replacement = '<img$1class="$2 img-fluid"$3>';
	$content     = preg_replace( $pattern, $replacement, $content );
	return $content;
}
add_filter( 'the_content', 'wskt_add_editor_fluid_image_class' );
