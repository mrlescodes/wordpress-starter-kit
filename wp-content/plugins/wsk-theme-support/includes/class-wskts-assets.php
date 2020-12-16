<?php
/**
 * WSK Theme Support - Assets
 *
 * @package WSK_Theme_Support/Classes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support Assets class.
 */
class WSKTS_Assets {

	/**
	 * WSKTS_Assets Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public static function styles() {}

	/**
	 * Enqueue scripts.
	 */
	public static function scripts() {}
}

return new WSKTS_Assets();
