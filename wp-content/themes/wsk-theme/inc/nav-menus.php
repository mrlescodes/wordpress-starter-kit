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
		'main_menu'       => esc_html__( 'Main menu', 'wsk-theme' ),
		'footer_menu'     => esc_html__( 'Footer menu', 'wsk-theme' ),
		'sub_footer_menu' => esc_html__( 'Sub Footer menu', 'wsk-theme' ),
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
			'menu'           => esc_html__( 'The main menu', 'wsk-theme' ),
			'theme_location'  => 'main_menu',
			'depth'           => 2,
			'container'       => 'div',
			'container_class' => 'collapse navbar-collapse',
			'container_id'    => 'navbarSupportedContent',
			'menu_class'      => 'navbar-nav ml-auto',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(),
		)
	);
}

/**
 * Output footer menu.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
 */
function wskt_footer_menu() {
	wp_nav_menu(
		array(
			'menu'           => __( 'The footer menu', 'wsk-theme' ),
			'theme_location' => 'footer_menu',
		)
	);
}

/**
 * Output sub footer menu.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
 */
function wskt_sub_footer_menu() {
	wp_nav_menu(
		array(
			'menu'           => __( 'The sub footer menu', 'wsk-theme' ),
			'theme_location' => 'sub_footer_menu',
		)
	);
}
