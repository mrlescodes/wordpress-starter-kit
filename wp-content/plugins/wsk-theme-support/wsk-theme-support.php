<?php
/**
 * Plugin Name: WSK Theme Support
 * Plugin URI: https://github.com/mrlescodes/wordpress-starter-kit.git
 * Description: Adds supporting functionality required by the WordPress Starter Kit Theme .
 * Version: 1.0.0
 * Author: Mr Les
 * Author URI: https://www.mrles.co.uk
 * Text Domain: wsk-theme-support
 * Domain Path: /i18n/languages/
 *
 * @package WSK_Theme_Support
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WSKTS_PLUGIN_FILE' ) ) {
	define( 'WSKTS_PLUGIN_FILE', __FILE__ );
}

// Include the main WSK_Theme_Support class.
if ( ! class_exists( 'WSK_Theme_Support', false ) ) {
	include_once dirname( WSKTS_PLUGIN_FILE ) . '/includes/class-wsk-theme-support.php';
}

/**
 * Returns the main instance of WSK_Theme_Support.
 *
 * @return WSK_Theme_Support
 */
function WSKTS() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	return WSK_Theme_Support::instance();
}

// Global for backwards compatibility.
$GLOBALS['wsk_theme_support'] = WSKTS();
