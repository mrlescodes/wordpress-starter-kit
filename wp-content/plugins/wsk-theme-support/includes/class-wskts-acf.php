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

}

return new WSKTS_ACF();
