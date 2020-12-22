<?php
/**
 * WSK Theme Support - Admin Assets
 *
 * @package WSK_Theme_Support/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support Admin assets class.
 */
class WSKTS_Admin_Assets {

	/**
	 * WSKTS_Admin_Assets Constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public static function admin_styles() {
		// Register styles.
		wp_register_style( 'wskts-style-admin-main', WSKTS()->plugin_url() . '/dist/css/style-admin-main.css', array(), WSKTS_VERSION );

		// Enqueue styles.
		wp_enqueue_style( 'wskts-style-admin-main' );
	}

	/**
	 * Enqueue scripts.
	 */
	public static function admin_scripts() {
		// Register scripts.
		wp_register_script( 'wskts-script-admin-main', WSKTS()->plugin_url() . '/dist/js/script-admin-main.js', array(), WSKTS_VERSION, true );

		// Enqueue scripts.
		wp_enqueue_script( 'wskts-script-admin-main' );
	}

}

return new WSKTS_Admin_Assets();
