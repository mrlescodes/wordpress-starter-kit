<?php
/**
 * Nav Menus
 *
 * @package WSK_Theme
 */

/**
 * Register custom navigation menu locations.
 *
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
register_nav_menus(
	array(
		'main_menu' => esc_html__( 'Main menu', 'wsk-theme' ),
	)
);

/**
 * Output main menu.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
 */
function wskt_main_menu() {
	wp_nav_menu(
		array(
			'menu'            => esc_html__( 'The main menu', 'wsk-theme' ),
			'theme_location'  => 'main_menu',
			'depth'           => 2,
			'container'       => 'div',
			'container_class' => 'collapse navbar-collapse',
			'container_id'    => 'navbarSupportedContent',
			'menu_class'      => 'navbar-nav ms-auto',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(),
		)
	);
}

/**
 * Customise the nav menu widget attributes.
 *
 * @param array   $nav_menu_args An array of arguments passed to wp_nav_menu() to retrieve a navigation menu.
 * @param WP_Term $nav_menu Nav menu object for the current menu.
 * @param array   $args Display arguments for the current widget.
 * @param array   $instance Array of settings for the current widget.
 */
function wskt_add_menu_class( $nav_menu_args, $nav_menu, $args, $instance ) {
	$nav_menu_args['menu_class'] = 'list-unstyled';

	return $nav_menu_args;
}
add_filter( 'widget_nav_menu_args', 'wskt_add_menu_class', 1, 4 );

/**
 * Customise the nav menu widget link attributes.
 *
 * @param array    $attrs Array of the HTML attributes applied to the menu item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 */
function wskt_add_menu_link_class( $attrs, $item, $args, $depth ) {

	// Add muted link class to all menus except the main_menu.
	if ( 'main_menu' !== $args->theme_location ) {
		$attrs['class'] = 'link-muted';
	}

	return $attrs;
}
add_filter( 'nav_menu_link_attributes', 'wskt_add_menu_link_class', 1, 4 );
