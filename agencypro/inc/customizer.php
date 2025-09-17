<?php
/**
 * AgencyPro Theme Customizer
 *
 * @package AgencyPro
 */

function agencypro_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Sanitization Callbacks
    function agencypro_sanitize_text( $input ) { return sanitize_text_field( $input ); }
    function agencypro_sanitize_url( $input ) { return esc_url_raw( $input ); }
    function agencypro_sanitize_integer( $input ) { return intval( $input ); }

    // Homepage Sections Panel
    $wp_customize->add_panel( 'agencypro_homepage_panel', array(
        'title'       => __( 'Homepage Sections', 'agencypro' ),
        'priority'    => 130,
        'description' => __( 'Manage the content and order of homepage sections.', 'agencypro' ),
    ) );

    // Helper function to add background controls
    function agencypro_add_bg_controls($section_id, $section_label, $priority_offset, $wp_customize) {
        $wp_customize->add_setting( "agencypro_{$section_id}_bg_type", ['default' => 'none', 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control( "agencypro_{$section_id}_bg_type", ['label' => "$section_label Background Type", 'section' => "agencypro_{$section_id}_section", 'type' => 'select', 'choices' => ['none' => 'None', 'color' => 'Color', 'image' => 'Image', 'gradient' => 'Gradient'], 'priority' => $priority_offset + 2]);
        $wp_customize->add_setting( "agencypro_{$section_id}_bg_color", ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "agencypro_{$section_id}_bg_color", ['label' => 'Background Color', 'section' => "agencypro_{$section_id}_section", 'active_callback' => function() use ($wp_customize, $section_id) { return 'color' === $wp_customize->get_setting("agencypro_{$section_id}_bg_type")->value(); }, 'priority' => $priority_offset + 3]));
        $wp_customize->add_setting( "agencypro_{$section_id}_bg_image", ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "agencypro_{$section_id}_bg_image", ['label' => 'Background Image', 'section' => "agencypro_{$section_id}_section", 'active_callback' => function() use ($wp_customize, $section_id) { return 'image' === $wp_customize->get_setting("agencypro_{$section_id}_bg_type")->value(); }, 'priority' => $priority_offset + 3]));
        $wp_customize->add_setting( "agencypro_{$section_id}_bg_gradient_1", ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "agencypro_{$section_id}_bg_gradient_1", ['label' => 'Gradient Color 1', 'section' => "agencypro_{$section_id}_section", 'active_callback' => function() use ($wp_customize, $section_id) { return 'gradient' === $wp_customize->get_setting("agencypro_{$section_id}_bg_type")->value(); }, 'priority' => $priority_offset + 3]));
        $wp_customize->add_setting( "agencypro_{$section_id}_bg_gradient_2", ['default' => '#121212', 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "agencypro_{$section_id}_bg_gradient_2", ['label' => 'Gradient Color 2', 'section' => "agencypro_{$section_id}_section", 'active_callback' => function() use ($wp_customize, $section_id) { return 'gradient' === $wp_customize->get_setting("agencypro_{$section_id}_bg_type")->value(); }, 'priority' => $priority_offset + 4]));
    }

    // Sections Data
    $sections = [
        'hero' => ['label' => 'Hero Section', 'priority' => 10, 'order' => 10],
        'clients' => ['label' => 'Client Logos Section', 'priority' => 20, 'order' => 20],
        'services' => ['label' => 'Services Preview', 'priority' => 30, 'order' => 30],
        'portfolio' => ['label' => 'Portfolio Preview', 'priority' => 40, 'order' => 40],
        'promo' => ['label' => 'Promo Section', 'priority' => 45, 'order' => 45],
        'testimonials' => ['label' => 'Testimonials', 'priority' => 50, 'order' => 50],
        'cta' => ['label' => 'Call to Action', 'priority' => 60, 'order' => 60],
    ];

    foreach ($sections as $id => $details) {
        $wp_customize->add_section("agencypro_{$id}_section", ['title' => $details['label'], 'panel' => 'agencypro_homepage_panel', 'priority' => $details['priority']]);
        $wp_customize->add_setting("agencypro_{$id}_display", ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
        $wp_customize->add_control("agencypro_{$id}_display", ['label' => 'Display Section', 'section' => "agencypro_{$id}_section", 'type' => 'checkbox', 'priority' => 1]);
        $wp_customize->add_setting("agencypro_{$id}_order", ['default' => $details['order'], 'sanitize_callback' => 'absint']);
        $wp_customize->add_control("agencypro_{$id}_order", ['label' => 'Order', 'section' => "agencypro_{$id}_section", 'type' => 'number', 'priority' => 2]);
        agencypro_add_bg_controls($id, $details['label'], 10, $wp_customize);
    }

    // --- Content Controls ---

    // Hero
    $wp_customize->add_setting('agencypro_hero_headline', ['default' => 'We Don\'t Just Build Websites. We Build Businesses.', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_hero_headline', ['label' => 'Headline', 'section' => 'agencypro_hero_section', 'type' => 'textarea']);
    $wp_customize->add_setting('agencypro_hero_subheadline', ['default' => 'We are a team of creatives...', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_hero_subheadline', ['label' => 'Sub-headline', 'section' => 'agencypro_hero_section', 'type' => 'textarea']);
    $wp_customize->add_setting('agencypro_hero_button_text', ['default' => 'Get a Quote', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_hero_button_text', ['label' => 'Button Text', 'section' => 'agencypro_hero_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_hero_button_url', ['default' => '#', 'sanitize_callback' => 'agencypro_sanitize_url']);
    $wp_customize->add_control('agencypro_hero_button_url', ['label' => 'Button URL', 'section' => 'agencypro_hero_section', 'type' => 'url']);
    $wp_customize->add_setting('agencypro_hero_button_text_2', ['default' => 'Learn More', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('agencypro_hero_button_text_2', ['label' => 'Secondary Button Text', 'section' => 'agencypro_hero_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_hero_button_url_2', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('agencypro_hero_button_url_2', ['label' => 'Secondary Button URL', 'section' => 'agencypro_hero_section', 'type' => 'url']);

    // Clients
    $wp_customize->add_setting('agencypro_clients_headline', ['default' => 'Trusted By The World\'s Best', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_clients_headline', ['label' => 'Headline', 'section' => 'agencypro_clients_section', 'type' => 'text']);

    // Repeater-style controls for Client Logos
    for ($i = 1; $i <= 8; $i++) {
        $wp_customize->add_setting( "agencypro_client_logo_$i", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "agencypro_client_logo_$i", array(
            'label'   => sprintf(__( 'Client Logo #%s', 'agencypro' ), $i),
            'section' => 'agencypro_clients_section',
        ) ) );
    }

    // Services
    $wp_customize->add_setting('agencypro_services_headline', ['default' => 'Our Services', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_services_headline', ['label' => 'Headline', 'section' => 'agencypro_services_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_services_count', ['default' => 3, 'sanitize_callback' => 'agencypro_sanitize_integer']);
    $wp_customize->add_control('agencypro_services_count', ['label' => 'Number of services to show', 'section' => 'agencypro_services_section', 'type' => 'number']);

    // Portfolio
    $wp_customize->add_setting('agencypro_portfolio_headline', ['default' => 'Recent Work', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_portfolio_headline', ['label' => 'Headline', 'section' => 'agencypro_portfolio_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_portfolio_count', ['default' => 4, 'sanitize_callback' => 'agencypro_sanitize_integer']);
    $wp_customize->add_control('agencypro_portfolio_count', ['label' => 'Number of projects to show', 'section' => 'agencypro_portfolio_section', 'type' => 'number']);

    // Promo
    $wp_customize->add_setting('agencypro_promo_headline', ['default' => 'A Special Offer Just For You', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('agencypro_promo_headline', ['label' => 'Headline', 'section' => 'agencypro_promo_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_promo_text', ['default' => 'A promotional section to highlight a service.', 'sanitize_callback' => 'wp_kses_post']);
    $wp_customize->add_control('agencypro_promo_text', ['label' => 'Content', 'section' => 'agencypro_promo_section', 'type' => 'textarea']);
    $wp_customize->add_setting('agencypro_promo_button_text', ['default' => 'Learn More', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('agencypro_promo_button_text', ['label' => 'Button Text', 'section' => 'agencypro_promo_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_promo_button_url', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('agencypro_promo_button_url', ['label' => 'Button URL', 'section' => 'agencypro_promo_section', 'type' => 'url']);

    // Testimonials
    $wp_customize->add_setting('agencypro_testimonials_headline', ['default' => 'What Our Clients Say', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_testimonials_headline', ['label' => 'Headline', 'section' => 'agencypro_testimonials_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_testimonials_count', ['default' => 3, 'sanitize_callback' => 'agencypro_sanitize_integer']);
    $wp_customize->add_control('agencypro_testimonials_count', ['label' => 'Number of testimonials to show', 'section' => 'agencypro_testimonials_section', 'type' => 'number']);

    // CTA
    $wp_customize->add_setting('agencypro_cta_headline', ['default' => 'Have a project in mind?', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_cta_headline', ['label' => 'Headline', 'section' => 'agencypro_cta_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_cta_subheadline', ['default' => 'Let\'s talk about your project.', 'sanitize_callback' => 'wp_kses_post']);
    $wp_customize->add_control('agencypro_cta_subheadline', ['label' => 'Sub-headline', 'section' => 'agencypro_cta_section', 'type' => 'textarea']);
    $wp_customize->add_setting('agencypro_cta_button_text', ['default' => 'Get a Quote', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control('agencypro_cta_button_text', ['label' => 'Button Text', 'section' => 'agencypro_cta_section', 'type' => 'text']);
    $wp_customize->add_setting('agencypro_cta_button_url', ['default' => '#', 'sanitize_callback' => 'agencypro_sanitize_url']);
    $wp_customize->add_control('agencypro_cta_button_url', ['label' => 'Button URL', 'section' => 'agencypro_cta_section', 'type' => 'url']);

    // --- Header & Footer Panel ---
    $wp_customize->add_panel( 'agencypro_header_footer_panel', array('title' => 'Header & Footer', 'priority' => 135));

    // Header Section
    $wp_customize->add_section( 'agencypro_header_section', array('title' => 'Header', 'panel' => 'agencypro_header_footer_panel'));
    $wp_customize->add_setting( 'agencypro_header_bg_color', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_header_bg_color', ['label' => 'Header Background Color', 'section' => 'agencypro_header_section']));
    $wp_customize->add_setting( 'agencypro_header_link_color', ['default' => '#e0e0e0', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_header_link_color', ['label' => 'Header Link Color', 'section' => 'agencypro_header_section']));
    $wp_customize->add_setting( 'agencypro_mobile_menu_bg_color', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_mobile_menu_bg_color', ['label' => 'Mobile Menu Background Color', 'section' => 'agencypro_header_section']));

    // Footer Section
    $wp_customize->add_section( 'agencypro_footer_section', array('title' => 'Footer', 'panel' => 'agencypro_header_footer_panel'));
    $wp_customize->add_setting( 'agencypro_footer_bg_color', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_footer_bg_color', ['label' => 'Footer Background Color', 'section' => 'agencypro_footer_section']));
    $wp_customize->add_setting( 'agencypro_footer_text_color', ['default' => '#a0a0a0', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_footer_text_color', ['label' => 'Footer Text Color', 'section' => 'agencypro_footer_section']));
    $wp_customize->add_setting( 'agencypro_footer_link_color', ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_footer_link_color', ['label' => 'Footer Link Color', 'section' => 'agencypro_footer_section']));
    $wp_customize->add_setting( 'agencypro_copyright_text', ['default' => '© 2025 AgencyPro. All Rights Reserved.', 'sanitize_callback' => 'agencypro_sanitize_text']);
    $wp_customize->add_control( 'agencypro_copyright_text', ['label' => 'Copyright Text', 'section' => 'agencypro_footer_section', 'type' => 'text']);


    // --- Theme Options & Typography ---
    $wp_customize->add_panel( 'agencypro_theme_options_panel', array('title' => 'Theme Options', 'priority' => 140));
    $wp_customize->add_section( 'agencypro_colors_section', array('title' => 'Global Colors', 'panel' => 'agencypro_theme_options_panel'));
    $wp_customize->add_setting( 'agencypro_accent_color', ['default' => '#8e44ad', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_accent_color', ['label' => 'Primary Accent Color', 'section' => 'agencypro_colors_section']));

    $wp_customize->add_panel( 'agencypro_typography_panel', array('title' => 'Typography & Colors', 'priority' => 141));
    $wp_customize->add_section( 'agencypro_typography_colors_section', array('title' => 'Font Colors', 'panel' => 'agencypro_typography_panel'));
    $wp_customize->add_setting( 'agencypro_body_text_color', ['default' => '#e0e0e0', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_body_text_color', ['label' => 'Body Text Color', 'section' => 'agencypro_typography_colors_section']));
    $wp_customize->add_setting( 'agencypro_heading_text_color', ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_heading_text_color', ['label' => 'Headings Color (H1-H6)', 'section' => 'agencypro_typography_colors_section']));

    // Heading Font Family
    $wp_customize->add_setting( 'agencypro_heading_font_family', array(
        'default'           => 'Montserrat',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'agencypro_heading_font_family', array(
        'label'   => __( 'Heading Font Family', 'agencypro' ),
        'section' => 'agencypro_typography_colors_section',
        'type'    => 'select',
        'choices' => [
            'Montserrat' => 'Montserrat',
            'Roboto' => 'Roboto',
            'Poppins' => 'Poppins',
            'Lato' => 'Lato',
            'Oswald' => 'Oswald',
        ],
    ) );
}
add_action( 'customize_register', 'agencypro_customize_register' );

function agencypro_customize_preview_js() {
	wp_enqueue_script( 'agencypro-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'agencypro_customize_preview_js' );
