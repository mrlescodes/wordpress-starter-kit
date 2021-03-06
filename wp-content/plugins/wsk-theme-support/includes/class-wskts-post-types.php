<?php
/**
 * WSK Theme Support - Post Types
 *
 * Registers post types.
 *
 * @package WSK_Theme_Support/Classes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WSK Theme Support Post Types Class.
 */
class WSKTS_Post_Types {

	/**
	 * Initialise Post Types.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_post_types' ) );
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );

		add_action( 'wskts_after_register_post_types', array( __CLASS__, 'flush_rewrite_rules' ) );
		add_action( 'wskts_after_register_taxonomies', array( __CLASS__, 'flush_rewrite_rules' ) );
	}

	/**
	 * Register post types.
	 */
	public static function register_post_types() {
		if ( ! is_blog_installed() ) {
			return;
		}

		do_action( 'wskts_before_register_post_types' );

		self::register_project_post_type();

		do_action( 'wskts_after_register_post_types' );
	}

	/**
	 * Register taxonomies.
	 */
	public static function register_taxonomies() {
		if ( ! is_blog_installed() ) {
			return;
		}

		do_action( 'wskts_before_register_taxonomies' );

		self::register_project_sector_taxonomy();

		do_action( 'wskts_after_register_taxonomies' );
	}

	/**
	 * Register project post type.
	 */
	public static function register_project_post_type() {
		if ( ! post_type_exists( 'project' ) ) {
			register_post_type(
				'project',
				apply_filters(
					'wskts_register_project_post_type',
					array(
						'labels'              => array(
							'name'               => __( 'Projects', 'wsk-theme-support' ),
							'singular_name'      => __( 'Project', 'wsk-theme-support' ),
							'add_new_item'       => __( 'Add New Project', 'wsk-theme-support' ),
							'edit_item'          => __( 'Edit Project', 'wsk-theme-support' ),
							'new_item'           => __( 'New Project', 'wsk-theme-support' ),
							'view_item'          => __( 'View Project', 'wsk-theme-support' ),
							'view_items'         => __( 'View Projects', 'wsk-theme-support' ),
							'search_items'       => __( 'Search Projects', 'wsk-theme-support' ),
							'not_found'          => __( 'No projects found', 'wsk-theme-support' ),
							'not_found_in_trash' => __( 'No projects found in Trash', 'wsk-theme-support' ),
							'all_items'          => __( 'All Projects', 'wsk-theme-support' ),
						),
						'description'         => __( 'This is the project post type', 'wsk-theme-support' ),
						'public'              => true,
						'exclude_from_search' => false,
						'publicly_queryable'  => true,
						'show_ui'             => true,
						'show_in_nav_menus'   => false,
						'show_in_menu'        => true,
						'show_in_admin_bar'   => false,
						'menu_position'       => 7,
						'menu_icon'           => 'dashicons-hammer', // Use dashicons for menu icon: https://developer.wordpress.org/resource/dashicons/.
						'capability_type'     => 'post',
						'hierarchical'        => false,
						'supports'            => array(
							'title',
							'excerpt',
							'thumbnail',
							'page-attributes',
						),
						'has_archive'         => false,
					)
				)
			);
		}
	}

	/**
	 * Register project sector taxonomy.
	 */
	public static function register_project_sector_taxonomy() {
		if ( post_type_exists( 'project' ) ) {
			register_taxonomy(
				'project-sector',
				array( 'project' ),
				apply_filters(
					'wskts_register_project_sector_taxonomy',
					array(
						'hierarchical'      => true,
						'labels'            => array(
							'name'              => _x( 'Project Sectors', 'taxonomy general name', 'wsk-theme-support' ),
							'singular_name'     => _x( 'Project Sector', 'taxonomy singular name', 'wsk-theme-support' ),
							'all_items'         => __( 'All Project Sectors', 'wsk-theme-support' ),
							'edit_item'         => __( 'Edit Project Sector', 'wsk-theme-support' ),
							'view_item'         => __( 'View Project Sector', 'wsk-theme-support' ),
							'update_item'       => __( 'Update Project Sector', 'wsk-theme-support' ),
							'add_new_item'      => __( 'Add New Project Sector', 'wsk-theme-support' ),
							'new_item_name'     => __( 'New Project Sector', 'wsk-theme-support' ),
							'parent_item'       => __( 'Parent Project Sector', 'wsk-theme-support' ),
							'parent_item_colon' => __( 'Parent Project Sector:', 'wsk-theme-support' ),
							'search_items'      => __( 'Search Project Sectors', 'wsk-theme-support' ),
						),
						'show_admin_column' => true,
						'show_ui'           => true,
						'query_var'         => true,
						'rewrite'           => array( 'slug' => 'project-sector' ),
					)
				)
			);
		}
	}

	/**
	 * Flush rewrite rules.
	 */
	public static function flush_rewrite_rules() {
		flush_rewrite_rules();
	}
}

WSKTS_Post_Types::init();
