<?php
/**
 * WSK Theme Support - Shortcodes
 *
 * @package WSK_Theme_Support/Classes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support Shortcodes class.
 */
class WSKTS_Shortcodes {

	/**
	 * Initialise Shortcodes.
	 */
	public static function init() {
		$shortcodes = array(
			'blockquote' => array( __CLASS__, 'blockquote' ),
			'lead'       => array( __CLASS__, 'lead' ),
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( $shortcode, $function );
		}
	}

	/**
	 * Blockquote Shortcode
	 *
	 * Wraps a text block in blockquote markup
	 *
	 * @param array $attrs Array of Shortcode attributes.
	 * @param mixed $content The Shortcode content.
	 */
	public static function blockquote( $attrs, $content = '' ) {
		$attrs = shortcode_atts(
			array(
				'cite' => '',
			),
			$attrs
		);

		if ( empty( $content ) ) {
			return;
		}

		$html  = '<blockquote class="blockquote">';
		$html .= $content;
		if ( ! empty( $attrs['cite'] ) ) {
			$html .= sprintf( '<footer class="blockquote-footer">%s</footer>', $attrs['cite'] );
		}
		$html .= '</blockquote>';

		return $html;
	}

	/**
	 * Lead Paragraph Shortcode
	 *
	 * Wraps a text block in a leading paragraph tag.
	 *
	 * @param array $attrs Array of Shortcode attributes.
	 * @param mixed $content The Shortcode content.
	 */
	public static function lead( $attrs, $content = '' ) {
		if ( empty( $content ) ) {
			return;
		}

		return sprintf( '<p class="lead">%s</p>', $content );
	}
}
