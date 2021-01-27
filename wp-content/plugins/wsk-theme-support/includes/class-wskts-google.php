<?php
/**
 * WSK Theme Support - Google
 *
 * @package WSK_Theme_Support/Classes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support Google class.
 */
class WSKTS_Google {

	/**
	 * API Key.
	 *
	 * @var string the Google API key to enable API access.
	 */
	private $api_key = '';

	/**
	 * WSKTS_Google Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function styles() {
		// Register styles.
		wp_register_style( 'wskts-style-map', WSKTS()->plugin_url() . '/dist/css/style-map.css', array(), WSKTS_VERSION );

		// Enqueue styles.
		wp_enqueue_style( 'wskts-style-map' );
	}

	/**
	 * Enqueue scripts.
	 */
	public function scripts() {
		// Register scripts.
		wp_register_script( 'wskts-script-google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $this->get_api_key(), array(), WSKTS_VERSION, true );
		wp_register_script( 'wskts-script-map', WSKTS()->plugin_url() . '/dist/js/script-map.js', array(), WSKTS_VERSION, true );

		// Localize scripts.
		wp_localize_script(
			'wskts-script-map',
			'wskts',
			array(
				'pluginUrl' => WSKTS()->plugin_url(),
			)
		);

		// Enqueue scripts on contact page template.
		if ( is_page_template( 'page-templates/contact.php' ) ) {
			wp_enqueue_script( 'wskts-script-google-maps' );
			wp_enqueue_script( 'wskts-script-map' );
		}
	}

	/**
	 * Return the API Key.
	 */
	public function get_api_key() {
		return $this->api_key;
	}

}
