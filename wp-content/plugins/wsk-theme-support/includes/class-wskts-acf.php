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
}

return new WSKTS_ACF();
