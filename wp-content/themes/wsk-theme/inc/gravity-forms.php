<?php
/**
 * Gravity Forms
 *
 * Customisations to gravity forms to make it play nice with our theme
 *
 * @package WSK_Theme
 */

/**
 * Filter to show "Hide label" option in GForms admin
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/**
 * Prevent the jump to anchor on Gravity Forms submission
 *
 * @link https://docs.gravityforms.com/gform_confirmation_anchor/
 */
add_filter( 'gform_confirmation_anchor', '__return_false' );

/**
 * Add bootstrap classes to fields
 *
 * @link https://docs.gravityforms.com/gform_field_content/
 *
 * @param string $content The field content.
 * @param array  $field The Field Object.
 * @param string $value The field value.
 * @param int    $lead_id The entry ID.
 * @param int    $form_id The form ID.
 */
function wskt_add_bootstrap_classes_to_fields( $content, $field, $value, $lead_id, $form_id ) {
	// Only apply classes to the front end.
	if ( ! is_admin() ) {
		$field_type = $field->type;

		$dom = new DOMDocument();
		$dom->loadHTML( $content );

		// Add bootstrap label class.
		wskt_add_class_to_elements( $dom, 'label', 'form-label' );

		switch ( $field_type ) {
			case 'text':
			case 'number':
			case 'name':
			case 'date':
			case 'phone':
			case 'website':
			case 'email':
			case 'list':
			case 'post_title':
			case 'post_tags':
			case 'post_custom_field':
			case 'quantity':
				wskt_add_class_to_elements( $dom, 'input', 'form-control' );
				break;
			case 'textarea':
			case 'post_content':
			case 'post_excerpt':
				wskt_add_class_to_elements( $dom, 'textarea', 'form-control' );
				break;
			case 'select':
			case 'multiselect':
			case 'post_category':
			case 'option':
				wskt_add_class_to_elements( $dom, 'select', 'form-control' );
				break;
			case 'checkbox':
			case 'radio':
				wskt_add_class_to_elements( $dom, 'li', 'form-check' );
				wskt_add_class_to_elements( $dom, 'input', 'form-check-input' );
				wskt_add_class_to_elements( $dom, 'label', 'form-check-label' );
				break;
			case 'time':
			case 'address':
				wskt_add_class_to_elements( $dom, 'input', 'form-control' );
				wskt_add_class_to_elements( $dom, 'select', 'form-control' );
				break;
			case 'fileupload':
			case 'post_image':
				wskt_add_class_to_elements( $dom, 'input', 'form-control-file' );
				break;
			case 'consent':
				$divs = $dom->getElementsByTagName( 'div' );
				if ( $divs[0] ) {
					wskt_append_attr_to_element( $divs[0], 'class', 'form-check' );
				}

				$inputs = $dom->getElementsByTagName( 'input' );
				if ( $inputs[0] ) {
					wskt_append_attr_to_element( $inputs[0], 'class', 'form-check-input' );
				}

				$labels = $dom->getElementsByTagName( 'label' );
				if ( $labels[1] ) {
					wskt_append_attr_to_element( $labels[1], 'class', 'form-check-label' );
				}
				break;
		}

		$content = $dom->saveHTML();
	}

	return $content;
}
add_filter( 'gform_field_content', 'wskt_add_bootstrap_classes_to_fields', 10, 5 );

/**
 * Convert the submit input to a button
 *
 * @link https://docs.gravityforms.com/gform_submit_button/
 *
 * @param string $button The Button content.
 * @param array  $form The Form object.
 */
function wskt_convert_input_to_button( $button, $form ) {
	$dom = new DOMDocument();
	$dom->loadHTML( $button );
	$input      = $dom->getElementsByTagName( 'input' )->item( 0 );
	$new_button = $dom->createElement( 'button' );
	$new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
	$input->removeAttribute( 'value' );

	foreach ( $input->attributes as $attribute ) {
		if ( 'class' === $attribute->name ) {
			$attribute->value = str_replace( 'button', 'btn btn-primary', $attribute->value );
		}
		$new_button->setAttribute( $attribute->name, $attribute->value );
	}

	$input->parentNode->replaceChild( $new_button, $input );
	return $dom->saveHtml( $new_button );
}
add_filter( 'gform_next_button', 'wskt_convert_input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'wskt_convert_input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'wskt_convert_input_to_button', 10, 2 );
