<?php
/**
 * Theme Configuration
 *
 * @package WSK_Theme
 */

if ( ! function_exists( 'wskt_theme_config' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wskt_theme_config() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'wsk-theme', get_template_directory() . '/languages' );

		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'wskt_theme_config' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wskt_content_width() {
	// TODO: Set correct content width
	// This variable is intended to be overruled from themes.
	$GLOBALS['content_width'] = apply_filters( 'ttt_content_width', 640 );
}
add_action( 'after_setup_theme', 'wskt_content_width', 0 );

/**
 * Disable Gutenberg editor block editor.
 */
add_filter( 'use_block_editor_for_post', '__return_false' );
