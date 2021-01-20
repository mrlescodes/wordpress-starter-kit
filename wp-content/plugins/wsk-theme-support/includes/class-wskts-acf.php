<?php
/**
 * WSK Theme Support - ACF
 *
 * @package WSK_Theme_Support/Classes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support ACF class.
 */
class WSKTS_ACF {

	/**
	 * WSKTS_ACF Constructor.
	 */
	public function __construct() {
		$this->add_options_sub_page();

		// Filters.
		add_filter( 'acf/init', array( __CLASS__, 'add_acf_google_api_key' ) );
		add_filter( 'acf/prepare_field/type=flexible_content', array( __CLASS__, 'filter_flexible_content_layouts' ) );
	}

	/**
	 * Adds the Theme Settings sub page.
	 */
	public static function add_options_sub_page() {
		if ( function_exists( 'acf_add_options_sub_page' ) ) {
			acf_add_options_sub_page(
				array(
					'page_title'  => __( 'Theme Settings', 'wsk-theme-support' ),
					'menu_title'  => __( 'Theme Settings', 'wsk-theme-support' ),
					'menu_slug'   => 'theme-settings',
					'parent_slug' => 'themes.php',
				)
			);
		}
	}

	/**
	 * Register Google API key with ACF.
	 */
	public static function add_acf_google_api_key() {
		if ( function_exists( 'acf_update_setting' ) && function_exists( 'wskts_get_google_api_key' ) ) {
			acf_update_setting( 'google_api_key', wskts_get_google_api_key() );
		}
	}

	/**
	 * Restrict flexible content layouts by specific criteria.
	 *
	 * @link https://support.advancedcustomfields.com/forums/topic/filter-for-flexible-content-layouts/
	 *
	 * @param array $field The ACF field.
	 */
	public static function filter_flexible_content_layouts( $field ) {
		global $post;

		// Add/update layout restrictions below.
		$restrictions = array(
			'example-layout-name' => array(
				'post_type' => array( 'project' ),
			),
		);

		$layouts          = $field['layouts'];
		$field['layouts'] = array();

		foreach ( $layouts as $layout ) {

			$layout_name = $layout['name'];

			// If the layout name isn't in our restrictions array then add it to the field.
			if ( ! array_key_exists( $layout_name, $restrictions ) ) {
				$field['layouts'][] = $layout;

				continue;
			}

			// Determine if this layout is enabled.
			$enabled = false;
			$rules   = $restrictions[ $layout_name ];

			foreach ( $rules as $rule_key => $rule_value ) {
				switch ( $rule_key ) {
					case 'post_type':
						$post_type = $post->post_type;

						if ( in_array( $post_type, $rule_value, true ) ) {
							$enabled = true;
						}

						break;
					default:
						break;
				}
			}

			// If the layout is enabled then add it to the field.
			if ( $enabled ) {
				$field['layouts'][] = $layout;
			}
		}

		return $field;
	}

}

return new WSKTS_ACF();
