<?php
/**
 * WSK Theme Support - Security Functions
 *
 * Security functions available on both the front-end and admin.
 *
 * @package WSK_Theme_Support/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns an array of allowed HTML tags and attributes for SVG's.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/svg
 */
function wskts_allowed_svg_tags() {
	$allowed_svg_tags = array();

	// https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/Core.
	$core_attributes = array(
		'id'       => true,
		'lang'     => true,
		'tabindex' => true,
		'xml:base' => true,
		'xml:lang' => true,
	);

	// https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/Styling.
	$styling_attributes = array(
		'class' => true,
		'style' => true,
	);

	// https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/Presentation.
	$presentation_attributes = array(
		'clip-path'            => true,
		'clip-rule'            => true,
		'color'                => true,
		'color-interpolation'  => true,
		'color-rendering'      => true,
		'cursor'               => true,
		'display'              => true,
		'fill'                 => true,
		'fill-opacity'         => true,
		'fill-rule'            => true,
		'filter'               => true,
		'mask'                 => true,
		'opacity'              => true,
		'pointer-events'       => true,
		'shape-rendering'      => true,
		'stroke'               => true,
		'stroke-dasharray'     => true,
		'stroke-dashoffset'    => true,
		'stroke-linecap'       => true,
		'stroke-linejoin'      => true,
		'stroke-miterlimit'    => true,
		'stroke-opacity'       => true,
		'stroke-width'         => true,
		'transform'            => true,
		'vector-effect'        => true,
		'visibility'           => true,
	);

	/**
	 * Add tags for svg element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/svg.
	 */
	$allowed_svg_tags['svg'] = array(
		'height'              => true,
		'preserveAspectRatio' => true,
		'viewbox'             => true,
		'width'               => true,
		'x'                   => true,
		'xmlns'               => true,
		'y'                   => true,
	);

	/**
	 * Add tags for path element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/svg.
	 */
	$allowed_svg_tags['path'] = array(
		'd'          => true,
		'pathLength' => true,
	);

	/**
	 * Add tags for g element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/g.
	 */
	$allowed_svg_tags['g'] = array();

	/**
	 * Add tags for circle element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/circle.
	 */
	$allowed_svg_tags['circle'] = array(
		'cx'         => true,
		'cy'         => true,
		'r'          => true,
		'pathLength' => true,
	);

	/**
	 * Add tags for ellipse element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/ellipse.
	 */
	$allowed_svg_tags['ellipse'] = array(
		'cx'         => true,
		'cy'         => true,
		'rx'         => true,
		'ry'         => true,
		'pathLength' => true,
	);

	/**
	 * Add tags for line element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/line.
	 */
	$allowed_svg_tags['line'] = array(
		'x1'         => true,
		'x2'         => true,
		'y1'         => true,
		'y2'         => true,
		'pathLength' => true,
	);

	/**
	 * Add tags for polygon element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/polygon.
	 */
	$allowed_svg_tags['polyline'] = array(
		'points'     => true,
		'pathLength' => true,
	);

	/**
	 * Add tags for polygon element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/polygon.
	 */
	$allowed_svg_tags['polygon'] = array(
		'points'     => true,
		'pathLength' => true,
	);

	/**
	 * Add tags for rect element
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/rect.
	 */
	$allowed_svg_tags['rect'] = array(
		'x'          => true,
		'y'          => true,
		'width'      => true,
		'height'     => true,
		'rx'         => true,
		'ry'         => true,
		'pathLength' => true,
	);

	// Merge in common attributes.
	foreach ( $allowed_svg_tags as $allowed_svg_tag_key => $allowed_svg_tag ) {
		$allowed_svg_tags[ $allowed_svg_tag_key ] = array_merge( $allowed_svg_tags[ $allowed_svg_tag_key ], $core_attributes, $styling_attributes, $presentation_attributes );
	}

	return $allowed_svg_tags;
}

/**
 * Returns an array of allowed HTML tags which includes SVG's.
 */
function wskts_allowed_html_tags() {
	// Get the standard allowed tags for the post context.
	$post_allowed_tags = wp_kses_allowed_html( 'post' );

	// Get the allowed tags for SVG elements.
	$svg_allowed_tags = wskts_allowed_svg_tags();

	return array_merge( $post_allowed_tags, $svg_allowed_tags );
}
