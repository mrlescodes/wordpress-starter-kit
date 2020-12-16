<?php
/**
 * WSK Theme Support - Admin
 *
 * @package WSK_Theme_Support/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support Admin class.
 */
class WSKTS_Admin {

	/**
	 * WSKTS_Admin Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( __CLASS__, 'includes' ) );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public static function includes() {
		include_once WSKTS_ABSPATH . 'includes/admin/class-wskts-admin-assets.php';
	}
}

return new WSKTS_Admin();
