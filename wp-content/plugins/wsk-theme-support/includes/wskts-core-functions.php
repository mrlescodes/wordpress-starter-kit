<?php
/**
 * WSK Theme Support - Core Functions
 *
 * Core functions available on both the front-end and admin.
 *
 * @package WSK_Theme_Support/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get template part.
 *
 * @param string $slug Template slug.
 * @param string $name Template name (default: '').
 */
function wskts_get_template_part( $slug, $name = '' ) {
	$template = '';

	if ( $name ) {
		// Look in yourtheme/slug-name.php and yourtheme/$template_path/slug-name.php.
		$template = locate_template(
			array(
				"{$slug}-{$name}.php",
				WSKTS()->template_path() . "{$slug}-{$name}.php",
			)
		);

		if ( ! $template ) {
			$fallback = WSKTS()->plugin_path() . "/templates/{$slug}-{$name}.php";
			$template = file_exists( $fallback ) ? $fallback : '';
		}
	}

	if ( ! $template ) {
		// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/$template_path/slug.php.
		$template = locate_template(
			array(
				"{$slug}.php",
				WSKTS()->template_path() . "{$slug}.php",
			)
		);
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'wskts_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}

/**
 * Get other templates passing attributes and including the file.
 *
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 */
function wskts_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	$template = wskts_locate_template( $template_name, $template_path, $default_path );

	// Allow 3rd party plugin filter template file from their plugin.
	$filter_template = apply_filters( 'wskts_get_template', $template, $template_name, $args, $template_path, $default_path );

	if ( $filter_template !== $template ) {
		if ( ! file_exists( $filter_template ) ) {
			/* translators: %s template */
			_doing_it_wrong( __FUNCTION__, sprintf( esc_html__( '%s does not exist.', 'wsk-theme-support' ), '<code>' . esc_html( $filter_template ) . '</code>' ), '1.0.0' );
			return;
		}
		$template = $filter_template;
	}

	$action_args = array(
		'template_name' => $template_name,
		'template_path' => $template_path,
		'located'       => $template,
		'args'          => $args,
	);

	if ( ! empty( $args ) && is_array( $args ) ) {
		if ( isset( $args['action_args'] ) ) {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'action_args should not be overwritten when calling wskts_get_template.', 'wsk-theme-support' ), '1.0.0' );
			unset( $args['action_args'] );
		}
		extract( $args ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
	}

	do_action( 'wskts_before_template_part', $action_args['template_name'], $action_args['template_path'], $action_args['located'], $action_args['args'] );

	include $action_args['located'];

	do_action( 'wskts_after_template_part', $action_args['template_name'], $action_args['template_path'], $action_args['located'], $action_args['args'] );
}

/**
 * Like wskts_get_template, but returns the HTML instead of outputting.
 *
 * @see wskts_get_template
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 */
function wskts_get_template_html( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	ob_start();
	wskts_get_template( $template_name, $args, $template_path, $default_path );
	return ob_get_clean();
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 * yourtheme/$template_path/$template_name
 * yourtheme/$template_name
 * $default_path/$template_name
 *
 * @param string $template_name Template name.
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 */
function wskts_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = WSKTS()->template_path();
	}

	if ( ! $default_path ) {
		$default_path = WSKTS()->plugin_path() . '/templates/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name,
		)
	);

	// Get default template/.
	if ( ! $template ) {
		$template = $default_path . $template_name;
	}

	// Return what we found.
	return apply_filters( 'wskts_locate_template', $template, $template_name, $template_path );
}
