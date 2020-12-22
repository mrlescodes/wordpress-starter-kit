<?php
/**
 * WSK Theme Support - Setup
 *
 * @package WSK_Theme_Support
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main WSK Theme Support Class.
 *
 * @class WSK_Theme_Support
 */
final class WSK_Theme_Support {

	/**
	 * WSK_Theme_Support version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * The single instance of the class.
	 *
	 * @since 1.0.0
	 * @var WSK_Theme_Support
	 */
	protected static $_instance = null; // phpcs:ignore PSR2.Classes.PropertyDeclaration.Underscore

	/**
	 * Google instance.
	 *
	 * @var WSKTS_Google
	 */
	public $google = null;

	/**
	 * Main WSK_Theme_Support Instance.
	 *
	 * Ensures only one instance of WSK_Theme_Support is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see WSKTS()
	 * @return WSK_Theme_Support - Main instance.
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
	 * WSK_Theme_Support Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Define WSKTS Constants.
	 */
	private function define_constants() {
		$this->define( 'WSKTS_ABSPATH', dirname( WSKTS_PLUGIN_FILE ) . '/' );
		$this->define( 'WSKTS_PLUGIN_BASENAME', plugin_basename( WSKTS_PLUGIN_FILE ) );
		$this->define( 'WSKTS_PLUGIN_URL', untrailingslashit( plugins_url( '/', WSKTS_PLUGIN_FILE ) ) );
		$this->define( 'WSKTS_VERSION', $this->version );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Returns true if the request is a non-legacy REST API request.
	 *
	 * Legacy REST requests should still run some extra code for backwards compatibility.
	 *
	 * @todo: replace this function once core WP function is available: https://core.trac.wordpress.org/ticket/42061.
	 *
	 * @return bool
	 */
	public function is_rest_api_request() {
		if ( empty( $_SERVER['REQUEST_URI'] ) ) {
			return false;
		}

		$rest_prefix         = trailingslashit( rest_get_url_prefix() );
		$is_rest_api_request = ( false !== strpos( $_SERVER['REQUEST_URI'], $rest_prefix ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

		return apply_filters( 'wsk_theme_support_is_rest_api_request', $is_rest_api_request );
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! $this->is_rest_api_request();
		}
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		/**
		 * Class autoloader.
		 */
		include_once WSKTS_ABSPATH . 'includes/class-wskts-autoloader.php';

		/**
		 * Functions.
		 */
		$function_includes = array(
			'google',
			'security',
		);

		foreach ( $function_includes as $function_include ) {
			include_once WSKTS_ABSPATH . 'includes/wskts-' . $function_include . '-functions.php';
		}

		/**
		 * Classes.
		 */
		$includes = array(
			'acf',
			'assets',
			'google',
			'install',
			'post-types',
			'shortcodes',
			'wordpress',
		);

		foreach ( $includes as $include ) {
			include_once WSKTS_ABSPATH . 'includes/class-wskts-' . $include . '.php';
		}

		/**
		 * Admin classes.
		 */
		if ( $this->is_request( 'admin' ) ) {
			include_once WSKTS_ABSPATH . 'includes/admin/class-wskts-admin.php';
		}
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		register_activation_hook( WSKTS_PLUGIN_FILE, array( 'WSKTS_Install', 'install' ) );

		add_action( 'init', array( $this, 'init' ), 100 );
		add_action( 'init', array( 'WSKTS_Shortcodes', 'init' ), 100 );
	}

	/**
	 * Init WSK_Theme_Support when WordPress Initialises.
	 */
	public function init() {
		// Before init action.
		do_action( 'before_wskts_init' );

		// Set up localisation.
		$this->load_plugin_textdomain();

		// Init action.
		do_action( 'wskts_init' );
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/wsk-theme-support/wsk-theme-support-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/wsk-theme-support-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		if ( function_exists( 'determine_locale' ) ) {
			$locale = determine_locale();
		} else {
			// @todo Remove when start supporting WP 5.0 or later.
			$locale = is_admin() ? get_user_locale() : get_locale();
		}

		$locale = apply_filters( 'plugin_locale', $locale, 'wsk-theme-support' );

		unload_textdomain( 'wsk-theme-support' );
		load_textdomain( 'wsk-theme-support', WP_LANG_DIR . '/wsk-theme-support/wsk-theme-support-' . $locale . '.mo' );
		load_plugin_textdomain( 'wsk-theme-support', false, plugin_basename( dirname( WSKTS_PLUGIN_FILE ) ) . '/i18n/languages' );
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', WSKTS_PLUGIN_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( WSKTS_PLUGIN_FILE ) );
	}

	/**
	 * Get the template path.
	 *
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'wskts_template_path', 'wsk-theme-support/' );
	}

	/**
	 * Get Ajax URL.
	 *
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

	/**
	 * Get Google class instance.
	 *
	 * @return WSKTS_Google
	 */
	public function google() {
		return WSKTS_Google::instance();
	}
}
