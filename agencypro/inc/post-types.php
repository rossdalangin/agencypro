<?php
if ( ! function_exists('agencypro_register_post_types') ) {
    function agencypro_register_post_types() {
        register_post_type( 'project', [
            'labels' => ['name' => 'Projects', 'singular_name' => 'Project', 'menu_name' => 'Portfolio'],
            'public' => true, 'has_archive' => true, 'menu_icon' => 'dashicons-portfolio',
            'supports' => ['title', 'editor', 'thumbnail'], 'show_in_rest' => true,
        ]);
        register_post_type( 'service', [
            'labels' => ['name' => 'Services', 'singular_name' => 'Service'],
            'public' => true, 'has_archive' => true, 'menu_icon' => 'dashicons-admin-settings',
            'supports' => ['title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'], 'show_in_rest' => true,
        ]);
        register_post_type( 'testimonial', [
            'labels' => ['name' => 'Testimonials', 'singular_name' => 'Testimonial'],
            'public' => false, 'show_ui' => true, 'menu_icon' => 'dashicons-format-quote',
            'supports' => ['title', 'editor', 'thumbnail'],
        ]);
        register_taxonomy( 'service_type', ['project'], [
            'labels' => ['name' => 'Service Types', 'singular_name' => 'Service Type'],
            'hierarchical' => true, 'show_admin_column' => true, 'show_in_rest' => true,
        ]);
    }
    add_action( 'init', 'agencypro_register_post_types', 0 );
}
?>
