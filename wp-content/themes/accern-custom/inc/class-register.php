<?php
/**
 * Register
 *
 * @package Accern_Custom
 */

namespace AccernCustom;

/**
 * Custom_Fields Class
 *
 * @package Accern_Custom
 */
class Register {

	/**
	 * Theme instance.
	 *
	 * @var object
	 */
	public $theme;

	/**
	 * Class constructor.
	 *
	 * @param object $plugin Plugin class.
	 */
	public function __construct( $theme ) {
		$this->theme = $theme;
	}

	/**
	 * Register the Team post type.
	 *
	 * @action init
	 */
	public function register_team() {
		$supports = array( 'title', 'editor', 'thumbnail' );
		$labels = array(
			'name'                  => esc_html__( ' Teams', 'accern-custom' ),
			'singular_name'         => esc_html__( ' Team', 'accern-custom' ),
			'all_items'             => esc_html__( ' Teams', 'accern-custom' ),
			'menu_name'             => _x( ' Teams', 'Admin menu name', 'accern-custom' ),
			'add_new'               => esc_html__( 'Add New', 'accern-custom' ),
			'add_new_item'          => esc_html__( 'Add new team', 'accern-custom' ),
			'edit'                  => esc_html__( 'Edit', 'accern-custom' ),
			'edit_item'             => esc_html__( 'Edit team', 'accern-custom' ),
			'new_item'              => esc_html__( 'New team', 'accern-custom' ),
			'view'                  => esc_html__( 'View team', 'accern-custom' ),
			'view_item'             => esc_html__( 'View team', 'accern-custom' ),
			'search_items'          => esc_html__( 'Search teams', 'accern-custom' ),
			'not_found'             => esc_html__( 'No teams found', 'accern-custom' ),
			'not_found_in_trash'    => esc_html__( 'No teams found in trash', 'accern-custom' ),
			'parent'                => esc_html__( 'Parent team', 'accern-custom' ),
			'featured_image'        => esc_html__( ' Team image', 'accern-custom' ),
			'set_featured_image'    => esc_html__( 'Set team image', 'accern-custom' ),
			'remove_featured_image' => esc_html__( 'Remove team image', 'accern-custom' ),
			'use_featured_image'    => esc_html__( 'Use as team image', 'accern-custom' ),
			'insert_into_item'      => esc_html__( 'Insert into team', 'accern-custom' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this team', 'accern-custom' ),
			'filter_items_list'     => esc_html__( 'Filter teams', 'accern-custom' ),
			'items_list_navigation' => esc_html__( ' Teams navigation', 'accern-custom' ),
			'items_list'            => esc_html__( ' Teams list', 'accern-custom' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => esc_html__( 'Team Members', 'accern-custom' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_icon'          => 'dashicons-groups',
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array(
				'slug' => 'team',
			),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => $supports,
			'show_in_rest'       => true,
			'taxonomy'           => array(
				'team_region',
			),
		);

		register_post_type( 'team', $args );
	}

	/**
	 * Register the Career post type.
	 *
	 * @action init
	 */
	public function register_career() {
		$supports = array( 'title', 'editor', 'thumbnail' );
		$labels = array(
			'name'                  => esc_html__( ' Careers', 'accern-custom' ),
			'singular_name'         => esc_html__( ' Career', 'accern-custom' ),
			'all_items'             => esc_html__( ' Careers', 'accern-custom' ),
			'menu_name'             => _x( ' Careers', 'Admin menu name', 'accern-custom' ),
			'add_new'               => esc_html__( 'Add New', 'accern-custom' ),
			'add_new_item'          => esc_html__( 'Add new career', 'accern-custom' ),
			'edit'                  => esc_html__( 'Edit', 'accern-custom' ),
			'edit_item'             => esc_html__( 'Edit career', 'accern-custom' ),
			'new_item'              => esc_html__( 'New career', 'accern-custom' ),
			'view'                  => esc_html__( 'View career', 'accern-custom' ),
			'view_item'             => esc_html__( 'View career', 'accern-custom' ),
			'search_items'          => esc_html__( 'Search careers', 'accern-custom' ),
			'not_found'             => esc_html__( 'No careers found', 'accern-custom' ),
			'not_found_in_trash'    => esc_html__( 'No careers found in trash', 'accern-custom' ),
			'parent'                => esc_html__( 'Parent career', 'accern-custom' ),
			'featured_image'        => esc_html__( ' Career image', 'accern-custom' ),
			'set_featured_image'    => esc_html__( 'Set career image', 'accern-custom' ),
			'remove_featured_image' => esc_html__( 'Remove career image', 'accern-custom' ),
			'use_featured_image'    => esc_html__( 'Use as career image', 'accern-custom' ),
			'insert_into_item'      => esc_html__( 'Insert into career', 'accern-custom' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this career', 'accern-custom' ),
			'filter_items_list'     => esc_html__( 'Filter careers', 'accern-custom' ),
			'items_list_navigation' => esc_html__( ' Careers navigation', 'accern-custom' ),
			'items_list'            => esc_html__( ' Careers list', 'accern-custom' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => esc_html__( 'Career Options', 'accern-custom' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_icon'          => 'dashicons-businessman',
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array(
				'slug' => 'career',
			),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => $supports,
			'show_in_rest'       => true,
			'taxonomy'           => array(
				'department',
			),
		);

		register_post_type( 'career', $args );
	}

	/**
	 * Register the Partner post type.
	 *
	 * @action init
	 */
	public function register_partner() {
		$supports = array( 'title', 'thumbnail' );
		$labels = array(
			'name'                  => esc_html__( ' Partners', 'accern-custom' ),
			'singular_name'         => esc_html__( ' Partner', 'accern-custom' ),
			'all_items'             => esc_html__( ' Partners', 'accern-custom' ),
			'menu_name'             => _x( ' Partners', 'Admin menu name', 'accern-custom' ),
			'add_new'               => esc_html__( 'Add New', 'accern-custom' ),
			'add_new_item'          => esc_html__( 'Add new partner', 'accern-custom' ),
			'edit'                  => esc_html__( 'Edit', 'accern-custom' ),
			'edit_item'             => esc_html__( 'Edit partner', 'accern-custom' ),
			'new_item'              => esc_html__( 'New partner', 'accern-custom' ),
			'view'                  => esc_html__( 'View partner', 'accern-custom' ),
			'view_item'             => esc_html__( 'View partner', 'accern-custom' ),
			'search_items'          => esc_html__( 'Search partners', 'accern-custom' ),
			'not_found'             => esc_html__( 'No partners found', 'accern-custom' ),
			'not_found_in_trash'    => esc_html__( 'No partners found in trash', 'accern-custom' ),
			'parent'                => esc_html__( 'Parent partner', 'accern-custom' ),
			'featured_image'        => esc_html__( ' Partner image', 'accern-custom' ),
			'set_featured_image'    => esc_html__( 'Set partner image', 'accern-custom' ),
			'remove_featured_image' => esc_html__( 'Remove partner image', 'accern-custom' ),
			'use_featured_image'    => esc_html__( 'Use as partner image', 'accern-custom' ),
			'insert_into_item'      => esc_html__( 'Insert into partner', 'accern-custom' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this partner', 'accern-custom' ),
			'filter_items_list'     => esc_html__( 'Filter partners', 'accern-custom' ),
			'items_list_navigation' => esc_html__( ' Partners navigation', 'accern-custom' ),
			'items_list'            => esc_html__( ' Partners list', 'accern-custom' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => esc_html__( 'Partners', 'accern-custom' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_icon'          => 'dashicons-networking',
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array(
				'slug' => 'partner',
			),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => $supports,
			'show_in_rest'       => true,
			'taxonomy'           => array(
				'association',
			),
		);

		register_post_type( 'partner', $args );
	}

	/**
	 * Register the Use Case post type.
	 *
	 * @action init
	 */
	public function register_usecase() {
		$supports = array( 'title' );
		$labels = array(
			'name'                  => esc_html__( ' Use Cases', 'accern-custom' ),
			'singular_name'         => esc_html__( ' Use Case', 'accern-custom' ),
			'all_items'             => esc_html__( ' Use Cases', 'accern-custom' ),
			'menu_name'             => _x( ' Use Cases', 'Admin menu name', 'accern-custom' ),
			'add_new'               => esc_html__( 'Add New', 'accern-custom' ),
			'add_new_item'          => esc_html__( 'Add new use case', 'accern-custom' ),
			'edit'                  => esc_html__( 'Edit', 'accern-custom' ),
			'edit_item'             => esc_html__( 'Edit use case', 'accern-custom' ),
			'new_item'              => esc_html__( 'New use case', 'accern-custom' ),
			'view'                  => esc_html__( 'View use case', 'accern-custom' ),
			'view_item'             => esc_html__( 'View use case', 'accern-custom' ),
			'search_items'          => esc_html__( 'Search use cases', 'accern-custom' ),
			'not_found'             => esc_html__( 'No use cases found', 'accern-custom' ),
			'not_found_in_trash'    => esc_html__( 'No use cases found in trash', 'accern-custom' ),
			'parent'                => esc_html__( 'Parent use case', 'accern-custom' ),
			'featured_image'        => esc_html__( ' Use Case image', 'accern-custom' ),
			'set_featured_image'    => esc_html__( 'Set use case image', 'accern-custom' ),
			'remove_featured_image' => esc_html__( 'Remove use case image', 'accern-custom' ),
			'use_featured_image'    => esc_html__( 'Use as use case image', 'accern-custom' ),
			'insert_into_item'      => esc_html__( 'Insert into use case', 'accern-custom' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this use case', 'accern-custom' ),
			'filter_items_list'     => esc_html__( 'Filter use cases', 'accern-custom' ),
			'items_list_navigation' => esc_html__( ' Use Cases navigation', 'accern-custom' ),
			'items_list'            => esc_html__( ' Use Cases list', 'accern-custom' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => esc_html__( 'Use Cases', 'accern-custom' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_icon'          => 'dashicons-analytics',
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array(
				'slug' => 'usecase',
			),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => $supports,
			'show_in_rest'       => true,
		);

		register_post_type( 'usecase', $args );
	}

	/**
	 * Register custom taxonomies.
	 *
	 * @action init
	 */
	public function register_taxonomies() {
		// Region labels.
		$region_labels = array(
			'name'              => _x( 'Regions', 'taxonomy general name', 'accern-custom' ),
			'singular_name'     => _x( 'Region', 'taxonomy singular name', 'accern-custom' ),
			'search_items'      => esc_html__( 'Search Regions', 'accern-custom' ),
			'all_items'         => esc_html__( 'All Regions', 'accern-custom' ),
			'parent_item'       => esc_html__( 'Parent Region', 'accern-custom' ),
			'parent_item_colon' => esc_html__( 'Parent Region:', 'accern-custom' ),
			'edit_item'         => esc_html__( 'Edit Region', 'accern-custom' ),
			'update_item'       => esc_html__( 'Update Region', 'accern-custom' ),
			'add_new_item'      => esc_html__( 'Add New Region', 'accern-custom' ),
			'new_item_name'     => esc_html__( 'New Region', 'accern-custom' ),
			'menu_name'         => esc_html__( 'Regions', 'accern-custom' ),
			'not_found'         => esc_html__( 'No region found.', 'accern-custom' ),
		);

		// Association labels.
		$association_labels = array(
			'name'              => _x( 'Associations', 'taxonomy general name', 'accern-custom' ),
			'singular_name'     => _x( 'Association', 'taxonomy singular name', 'accern-custom' ),
			'search_items'      => esc_html__( 'Search Associations', 'accern-custom' ),
			'all_items'         => esc_html__( 'All Associations', 'accern-custom' ),
			'parent_item'       => esc_html__( 'Parent Association', 'accern-custom' ),
			'parent_item_colon' => esc_html__( 'Parent Association:', 'accern-custom' ),
			'edit_item'         => esc_html__( 'Edit Association', 'accern-custom' ),
			'update_item'       => esc_html__( 'Update Association', 'accern-custom' ),
			'add_new_item'      => esc_html__( 'Add New Association', 'accern-custom' ),
			'new_item_name'     => esc_html__( 'New Association', 'accern-custom' ),
			'menu_name'         => esc_html__( 'Associations', 'accern-custom' ),
			'not_found'         => esc_html__( 'No association found.', 'accern-custom' ),
		);

		// Department labels.
		$department_labels = array(
			'name'              => _x( 'Departments', 'taxonomy general name', 'accern-custom' ),
			'singular_name'     => _x( 'Department', 'taxonomy singular name', 'accern-custom' ),
			'search_items'      => esc_html__( 'Search Departments', 'accern-custom' ),
			'all_items'         => esc_html__( 'All Departments', 'accern-custom' ),
			'parent_item'       => esc_html__( 'Parent Department', 'accern-custom' ),
			'parent_item_colon' => esc_html__( 'Parent Department:', 'accern-custom' ),
			'edit_item'         => esc_html__( 'Edit Department', 'accern-custom' ),
			'update_item'       => esc_html__( 'Update Department', 'accern-custom' ),
			'add_new_item'      => esc_html__( 'Add New Department', 'accern-custom' ),
			'new_item_name'     => esc_html__( 'New Department', 'accern-custom' ),
			'menu_name'         => esc_html__( 'Departments', 'accern-custom' ),
			'not_found'         => esc_html__( 'No department found.', 'accern-custom' ),
		);

		$taxonomies = array(
			'team' => array(
				'slug'         => 'team_region',
				'labels'       => $region_labels,
				'hierarchical' => true,
			),
			'partner' => array(
				'slug'         => 'association',
				'labels'       => $association_labels,
				'hierarchical' => true,
			),
			'career' => array(
				'slug'         => 'department',
				'labels'       => $department_labels,
				'hierarchical' => true,
			),
		);

		// Register all custom taxonomies
		foreach ( $taxonomies as $type => $info ) {
			$args = array(
				'hierarchical'       => $info['hierarchical'],
				'labels'             => $info['labels'],
				'show_ui'            => true,
				'show_admin_column'  => true,
				'query_var'          => true,
				'rewrite'            => array(
					'slug' => $info['slug'],
				),
				'show_in_nav_menus'  => true,
				'show_tagcloud'      => false,
				'show_in_quick_edit' => true,
			);

			register_taxonomy( $info['slug'], $type, $args );
		}
	}

	/**
	 * Register footer widget area.
	 *
	 * @action widgets_init
	 */
	public function footer_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'accern-custom' ),
		     'id'            => 'footer-1',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
			)
		);
		register_sidebar( array(
				'name'          => esc_html__( 'Footer 2', 'accern-custom' ),
				'id'            => 'footer-2',
				'description'   => '',
				'class'         => '',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>',
			)
		);
	}
}
