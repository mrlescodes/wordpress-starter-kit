<?php
/**
 * Utility functions
 *
 * @package WSK_Theme
 */

/**
 * Adds class to all elements with matching tag name in a DOMDocument
 *
 * @param DOMDocument $dom The DOMDocument.
 * @param string      $tag_name The element tag name.
 * @param string      $class The class to add to the element.
 */
function wskt_add_class_to_elements( &$dom, $tag_name, $class ) {
	$tags = $dom->getElementsByTagName( $tag_name );
	foreach ( $tags as $tag ) {
		wskt_append_attr_to_element( $tag, 'class', $class );
	}
}

/**
 * Adds an attribute to a DOMNode.
 *
 * @param DOMNode $element The DOMNode to add the attribute to.
 * @param string  $attr The attribute to add.
 * @param string  $value The value of the attribute to add.
 */
function wskt_append_attr_to_element( &$element, $attr, $value ) {
	if ( $element->hasAttribute( $attr ) ) {
		$attrs = explode( ' ', $element->getAttribute( $attr ) );
		if ( ! in_array( $value, $attrs, true ) ) {
			$attrs[] = $value;
		}
		$attrs = array_map( 'trim', array_filter( $attrs ) );
		$element->setAttribute( $attr, implode( ' ', $attrs ) );
	} else {
		$element->setAttribute( $attr, $value );
	}
}
