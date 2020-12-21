<?php
/**
 * Sidebars and Widgets
 *
 * @package WSK_Theme
 */

/**
 * Register footer widgets.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wskt_widgets_init() {
	register_sidebar(
		array(
			'id'            => 'footer-1',
			'name'          => esc_html__( 'Footer #1', 'wsk-theme' ),
			'description'   => esc_html__( 'Add widgets here.', 'wsk-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'footer-2',
			'name'          => esc_html__( 'Footer 2', 'wsk-theme' ),
			'description'   => esc_html__( 'Add widgets here.', 'wsk-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'footer-3',
			'name'          => esc_html__( 'Footer 3', 'wsk-theme' ),
			'description'   => esc_html__( 'Add widgets here.', 'wsk-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);
}
add_action( 'widgets_init', 'wskt_widgets_init' );
