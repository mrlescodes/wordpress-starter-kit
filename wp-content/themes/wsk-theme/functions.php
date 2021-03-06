<?php
/**
 * Framework functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link http://codex.wordpress.org/Theme_Development
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WSK_Theme
 */

/**
 * Utility functions
 */
require_once 'inc/utilities.php';

/**
 * ACF
 */
require_once 'inc/acf.php';

/**
 * Bootstrap
 */
require_once 'inc/bootstrap.php';

/**
 * Bootstrap nav walker
 */
require_once 'inc/class-wp-bootstrap-navwalker.php';

/**
 * Theme configuration
 */
require_once 'inc/config.php';

/**
 * Gravity Forms customisations
 */
require_once 'inc/gravity-forms.php';

/**
 * Navigation menus
 */
require_once 'inc/nav-menus.php';

/**
 * Scripts and styles
 */
require_once 'inc/scripts-styles.php';

/**
 * Sidebars and widgets
 */
require_once 'inc/sidebars-widgets.php';

/**
 * Template tags
 */
require_once 'inc/template-tags.php';
