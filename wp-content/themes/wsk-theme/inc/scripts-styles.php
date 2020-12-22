<?php
/**
 * Scripts and styles
 *
 * Include scripts and styles.
 *
 * @package WSK_Theme
 */

/**
 * Enqueue scripts and styles for the front end.
 */
function wskt_scripts_and_styles() {
	if ( ! is_admin() ) {
		/**
		* Register stylesheets.
		*
		* @link https://developer.wordpress.org/reference/functions/wp_register_style/
		* ========================================================================== */

		// Main stylesheet.
		wp_register_style( 'wskt-styles', get_stylesheet_directory_uri() . '/dist/css/styles.css', array(), '1.0.0' );

		/**
		* Register scripts.
		*
		* @link https://developer.wordpress.org/reference/functions/wp_register_script/
		* ========================================================================== */

		// Main JS.
		wp_register_script( 'wskt-scripts', get_stylesheet_directory_uri() . '/dist/js/scripts.js', array( 'jquery' ), '1.0.0', true );

		/**
		* Enqueue stylesheets.
		*
		* @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
		* ========================================================================== */

		wp_enqueue_style( 'wskt-styles' );

		/**
		* Enqueue scripts.
		*
		* @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
		* ========================================================================== */

		wp_enqueue_script( 'wskt-scripts' );

		/**
		* Localize the main Javascript file so that we can make the following WordPress
		* variables available to the main JS file.
		* USAGE: console.log(wskt.url);
		*
		* @link https://developer.wordpress.org/reference/functions/wp_localize_script/
		*/
		wp_localize_script(
			'wskt-scripts',
			'wskt',
			array(
				'templateDirectory' => get_template_directory_uri(),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'wskt_scripts_and_styles', 999 );
