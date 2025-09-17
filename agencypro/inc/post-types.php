<?php
/**
 * Custom Post Type and Taxonomy registrations for AgencyPro Theme
 *
 * @package AgencyPro
 */

if ( ! function_exists('agencypro_register_post_types') ) {

    // Register Custom Post Types and Taxonomies
    function agencypro_register_post_types() {

        // Portfolio CPT
        $labels_project = array(
            'name'                  => _x( 'Projects', 'Post Type General Name', 'agencypro' ),
            'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'agencypro' ),
            'menu_name'             => __( 'Portfolio', 'agencypro' ),
            'name_admin_bar'        => __( 'Project', 'agencypro' ),
            'archives'              => __( 'Project Archives', 'agencypro' ),
            'attributes'            => __( 'Project Attributes', 'agencypro' ),
            'parent_item_colon'     => __( 'Parent Project:', 'agencypro' ),
            'all_items'             => __( 'All Projects', 'agencypro' ),
            'add_new_item'          => __( 'Add New Project', 'agencypro' ),
            'add_new'               => __( 'Add New', 'agencypro' ),
            'new_item'              => __( 'New Project', 'agencypro' ),
            'edit_item'             => __( 'Edit Project', 'agencypro' ),
            'update_item'           => __( 'Update Project', 'agencypro' ),
            'view_item'             => __( 'View Project', 'agencypro' ),
            'view_items'            => __( 'View Projects', 'agencypro' ),
            'search_items'          => __( 'Search Project', 'agencypro' ),
            'not_found'             => __( 'Not found', 'agencypro' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'agencypro' ),
            'featured_image'        => __( 'Featured Image', 'agencypro' ),
            'set_featured_image'    => __( 'Set featured image', 'agencypro' ),
            'remove_featured_image' => __( 'Remove featured image', 'agencypro' ),
            'use_featured_image'    => __( 'Use as featured image', 'agencypro' ),
            'insert_into_item'      => __( 'Insert into project', 'agencypro' ),
            'uploaded_to_this_item' => __( 'Uploaded to this project', 'agencypro' ),
            'items_list'            => __( 'Projects list', 'agencypro' ),
            'items_list_navigation' => __( 'Projects list navigation', 'agencypro' ),
            'filter_items_list'     => __( 'Filter projects list', 'agencypro' ),
        );
        $args_project = array(
            'label'                 => __( 'Project', 'agencypro' ),
            'description'           => __( 'Portfolio projects', 'agencypro' ),
            'labels'                => $labels_project,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-portfolio',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        );
        register_post_type( 'project', $args_project );

        // Service CPT
        $labels_service = array(
            'name'                  => _x( 'Services', 'Post Type General Name', 'agencypro' ),
            'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'agencypro' ),
            'menu_name'             => __( 'Services', 'agencypro' ),
            'all_items'             => __( 'All Services', 'agencypro' ),
            'add_new_item'          => __( 'Add New Service', 'agencypro' ),
            'add_new'               => __( 'Add New', 'agencypro' ),
            'new_item'              => __( 'New Service', 'agencypro' ),
            'edit_item'             => __( 'Edit Service', 'agencypro' ),
            'update_item'           => __( 'Update Service', 'agencypro' ),
            'view_item'             => __( 'View Service', 'agencypro' ),
        );
        $args_service = array(
            'label'                 => __( 'Service', 'agencypro' ),
            'description'           => __( 'Services offered', 'agencypro' ),
            'labels'                => $labels_service,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ), // Added 'thumbnail' and 'custom-fields' for icon class
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 6,
            'menu_icon'             => 'dashicons-admin-settings',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'has_archive'           => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'service', $args_service );

        // Service Type Taxonomy
        $labels_taxonomy = array(
            'name'              => _x( 'Service Types', 'taxonomy general name', 'agencypro' ),
            'singular_name'     => _x( 'Service Type', 'taxonomy singular name', 'agencypro' ),
            'search_items'      => __( 'Search Service Types', 'agencypro' ),
            'all_items'         => __( 'All Service Types', 'agencypro' ),
            'parent_item'       => __( 'Parent Service Type', 'agencypro' ),
            'parent_item_colon' => __( 'Parent Service Type:', 'agencypro' ),
            'edit_item'         => __( 'Edit Service Type', 'agencypro' ),
            'update_item'       => __( 'Update Service Type', 'agencypro' ),
            'add_new_item'      => __( 'Add New Service Type', 'agencypro' ),
            'new_item_name'     => __( 'New Service Type Name', 'agencypro' ),
            'menu_name'         => __( 'Service Type', 'agencypro' ),
        );
        $args_taxonomy = array(
            'hierarchical'      => true,
            'labels'            => $labels_taxonomy,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'service-type' ),
            'show_in_rest'      => true,
        );
        register_taxonomy( 'service_type', array( 'project' ), $args_taxonomy );

        // Testimonial CPT
        $labels_testimonial = array(
            'name'                  => _x( 'Testimonials', 'Post Type General Name', 'agencypro' ),
            'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'agencypro' ),
            'menu_name'             => __( 'Testimonials', 'agencypro' ),
            'name_admin_bar'        => __( 'Testimonial', 'agencypro' ),
            'all_items'             => __( 'All Testimonials', 'agencypro' ),
            'add_new_item'          => __( 'Add New Testimonial', 'agencypro' ),
            'add_new'               => __( 'Add New', 'agencypro' ),
            'new_item'              => __( 'New Testimonial', 'agencypro' ),
            'edit_item'             => __( 'Edit Testimonial', 'agencypro' ),
            'update_item'           => __( 'Update Testimonial', 'agencypro' ),
            'view_item'             => __( 'View Testimonial', 'agencypro' ),
            'search_items'          => __( 'Search Testimonial', 'agencypro' ),
            'not_found'             => __( 'Not found', 'agencypro' ),
            'featured_image'        => __( 'Author Image', 'agencypro' ),
            'set_featured_image'    => __( 'Set author image', 'agencypro' ),
            'remove_featured_image' => __( 'Remove author image', 'agencypro' ),
            'use_featured_image'    => __( 'Use as author image', 'agencypro' ),
        );
        $args_testimonial = array(
            'label'                 => __( 'Testimonial', 'agencypro' ),
            'description'           => __( 'Client testimonials', 'agencypro' ),
            'labels'                => $labels_testimonial,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 7,
            'menu_icon'             => 'dashicons-format-quote',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        );
        register_post_type( 'testimonial', $args_testimonial );

    }
    add_action( 'init', 'agencypro_register_post_types', 0 );
}
