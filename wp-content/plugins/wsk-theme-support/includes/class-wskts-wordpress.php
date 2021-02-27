<?php
/**
 * WSK Theme Support - WordPress
 *
 * @package WSK_Theme_Support/Classes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support WordPress class.
 */
class WSKTS_WordPress {

	/**
	 * WSKTS_WordPress Constructor.
	 */
	public function __construct() {
		// Actions.
		add_action( 'wp_head', array( __CLASS__, 'favicons' ) );

		// Filters.
		add_filter( 'wp_kses_allowed_html', array( __CLASS__, 'custom_wp_kses_allowed_html' ), 10, 2 );
		add_filter( 'get_the_archive_title', array( __CLASS__, 'archive_title' ) );
	}

	/**
	 * Adds the Favicons.
	 */
	public static function favicons() {
		?>
		<link rel="shortcut icon" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/favicon.ico" />

		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/apple-touch-icon-60x60.png" />
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/apple-touch-icon-152x152.png" />

		<link rel="icon" type="image/png" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/favicon-196x196.png" sizes="196x196" />
		<link rel="icon" type="image/png" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/favicon-96x96.png" sizes="96x96" />
		<link rel="icon" type="image/png" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/favicon-16x16.png" sizes="16x16" />
		<link rel="icon" type="image/png" href="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/favicon-128.png" sizes="128x128" />

		<meta name="application-name" content="<?php bloginfo( 'name' ); ?>">
		<meta name="msapplication-tooltip" content="<?php bloginfo( 'description' ); ?>">
		<meta name="msapplication-TileColor" content="#FFFFFF" />
		<meta name="msapplication-TileImage" content="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/mstile-144x144.png" />
		<meta name="msapplication-square70x70logo" content="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/mstile-70x70.png" />
		<meta name="msapplication-square150x150logo" content="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/mstile-150x150.png" />
		<meta name="msapplication-wide310x150logo" content="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/mstile-310x150.png" />
		<meta name="msapplication-square310x310logo" content="<?php echo esc_url( WSKTS_PLUGIN_URL ); ?>/dist/img/mstile-310x310.png" />
		<?php
	}

	/**
	 * Customise the allowed HTML tags.
	 *
	 * @param string|array $allowed_tags The allowable HTML tags.
	 * @param string|array $context      The context for which to retrieve tags.
	 */
	public static function custom_wp_kses_allowed_html( $allowed_tags, $context ) {
		// Add a custom context for escaping just SVG's.
		if ( 'svg' === $context ) {
			return wskts_allowed_svg_tags();
		}

		// Enable tabindex on link elements.
		$allowed_tags['a']['tabindex'] = true;

		// Add svg support to the post context.
		if ( 'post' === $context ) {
			// Get the allowed tags for SVG elements.
			$svg_allowed_tags = wskts_allowed_svg_tags();

			// Merge these tags with the allowed tags.
			$allowed_tags = array_merge( $allowed_tags, $svg_allowed_tags );
		}

		return $allowed_tags;
	}

	/**
	 * Clean up the default archive titles.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	public static function archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		}

		return $title;
	}
}

return new WSKTS_WordPress();
