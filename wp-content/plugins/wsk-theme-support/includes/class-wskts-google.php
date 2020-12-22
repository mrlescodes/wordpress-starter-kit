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
	 * The single instance of the class
	 *
	 * @since 1.0.0
	 * @var WSKTS_Google
	 */
	protected static $_instance = null; // phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

	/**
	 * Main WSKTS_Google Instance.
	 *
	 * Ensures only one instance of WSKTS_Google is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @return WSKTS_Google Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cloning is forbidden.', 'wsk-theme-support' ), '1.0.0' );
	}

	/**
	 * Unserialising instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Unserialising instances of this class is forbidden.', 'wsk-theme-support' ), '1.0.0' );
	}

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
