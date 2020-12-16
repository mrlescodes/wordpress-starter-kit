<?php
/**
 * WSK Theme Support - Install
 *
 * Installation related functions and actions.
 *
 * @package WSK_Theme_Support/Classes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support Install class.
 */
class WSKTS_Install {

	/**
	 * Initialise WSKTS_Install.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'install' ) );
	}

	/**
	 * Install WSKTS.
	 */
	public static function install() {
		if ( ! is_blog_installed() ) {
			return;
		}

		// Check if we are not already running this routine.
		if ( 'yes' === get_transient( 'wskts_installing' ) ) {
			return;
		}

		// If we made it till here nothing is running yet, lets set the transient now.
		set_transient( 'wskts_installing', 'yes', MINUTE_IN_SECONDS * 10 );

		self::setup_environment();

		delete_transient( 'wskts_installing' );

		do_action( 'wskts_installed' );
	}


	/**
	 * Setup WSKTS environment - post types.
	 */
	private static function setup_environment() {
		WSKTS_Post_Types::register_post_types();
	}
}

WSKTS_Install::init();
