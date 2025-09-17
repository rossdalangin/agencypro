<?php
/**
 * AgencyPro Theme Customizer
 *
 * @package AgencyPro
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function agencypro_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'agencypro_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'agencypro_customize_partial_blogdescription',
			)
		);
	}

    // Sanitization Callbacks
    function agencypro_sanitize_text( $input ) {
        return sanitize_text_field( $input );
    }

    function agencypro_sanitize_url( $input ) {
        return esc_url_raw( $input );
    }

    function agencypro_sanitize_integer( $input ) {
        return intval( $input );
    }

    // Homepage Sections Panel
    $wp_customize->add_panel( 'agencypro_homepage_panel', array(
        'title'       => __( 'Homepage Sections', 'agencypro' ),
        'priority'    => 130,
        'description' => __( 'Manage the content of homepage sections.', 'agencypro' ),
    ) );

    // Hero Section
    $wp_customize->add_section( 'agencypro_hero_section', array(
        'title'    => __( 'Hero Section', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 10,
    ) );

    // Hero Headline
    $wp_customize->add_setting( 'agencypro_hero_headline', array(
        'default'           => __( 'We Don\'t Just Build Websites. We Build Businesses.', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_hero_headline', array(
        'label'   => __( 'Headline', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'type'    => 'textarea',
    ) );
    $wp_customize->selective_refresh->add_partial('agencypro_hero_headline', array(
        'selector' => '.hero-section .hero-headline',
        'render_callback' => function() { return get_theme_mod('agencypro_hero_headline'); }
    ));

    // Hero Sub-headline
    $wp_customize->add_setting( 'agencypro_hero_subheadline', array(
        'default'           => __( 'We are a team of creatives who are excited about unique ideas and help digital and fin-tech companies to create amazing identity by crafting top-notch UI/UX.', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_hero_subheadline', array(
        'label'   => __( 'Sub-headline', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'type'    => 'textarea',
    ) );
     $wp_customize->selective_refresh->add_partial('agencypro_hero_subheadline', array(
        'selector' => '.hero-section .hero-subheadline',
        'render_callback' => function() { return get_theme_mod('agencypro_hero_subheadline'); }
    ));

    // Hero Button Text
    $wp_customize->add_setting( 'agencypro_hero_button_text', array(
        'default'           => __( 'Get a Quote', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_hero_button_text', array(
        'label'   => __( 'Button Text', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'type'    => 'text',
    ) );
    $wp_customize->selective_refresh->add_partial('agencypro_hero_button_text', array(
        'selector' => '.hero-section .button-primary',
        'render_callback' => function() { return get_theme_mod('agencypro_hero_button_text'); }
    ));

    // Hero Button URL
    $wp_customize->add_setting( 'agencypro_hero_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'agencypro_sanitize_url',
    ) );
    $wp_customize->add_control( 'agencypro_hero_button_url', array(
        'label'   => __( 'Button URL', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'type'    => 'url',
    ) );

    // Client Logos Section
    $wp_customize->add_section( 'agencypro_clients_section', array(
        'title'    => __( 'Client Logos Section', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 20,
    ) );

    // Clients Headline
    $wp_customize->add_setting( 'agencypro_clients_headline', array(
        'default'           => __( 'Trusted By The World\'s Best', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage'
    ) );
    $wp_customize->add_control( 'agencypro_clients_headline', array(
        'label'   => __( 'Headline', 'agencypro' ),
        'section' => 'agencypro_clients_section',
        'type'    => 'text',
    ) );
    $wp_customize->selective_refresh->add_partial('agencypro_clients_headline', array(
        'selector' => '.clients-section .section-title',
        'render_callback' => function() { return get_theme_mod('agencypro_clients_headline'); }
    ));

    // Clients Gallery
    $wp_customize->add_setting( 'agencypro_clients_gallery', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'agencypro_clients_gallery', array(
        'label'       => __( 'Client Logos', 'agencypro' ),
        'section'     => 'agencypro_clients_section',
        'mime_type'   => 'image',
        'description' => __( 'Upload multiple client logos. They will be displayed in a horizontal scroller.', 'agencypro' ),
    ) ) );

    // Services Preview Section
    $wp_customize->add_section( 'agencypro_services_section', array(
        'title'    => __( 'Services Preview', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 30,
    ) );
    $wp_customize->add_setting( 'agencypro_services_headline', array(
        'default'           => __( 'Our Services', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_services_headline', array(
        'label'   => __( 'Headline', 'agencypro' ),
        'section' => 'agencypro_services_section',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'agencypro_services_count', array(
        'default'           => 3,
        'sanitize_callback' => 'agencypro_sanitize_integer',
    ) );
    $wp_customize->add_control( 'agencypro_services_count', array(
        'label'   => __( 'Number of services to show', 'agencypro' ),
        'section' => 'agencypro_services_section',
        'type'    => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 6, 'step' => 1 ),
    ) );

    // Portfolio Preview Section
    $wp_customize->add_section( 'agencypro_portfolio_section', array(
        'title'    => __( 'Portfolio Preview', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 40,
    ) );
    $wp_customize->add_setting( 'agencypro_portfolio_headline', array(
        'default'           => __( 'Recent Work', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_portfolio_headline', array(
        'label'   => __( 'Headline', 'agencypro' ),
        'section' => 'agencypro_portfolio_section',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'agencypro_portfolio_count', array(
        'default'           => 4,
        'sanitize_callback' => 'agencypro_sanitize_integer',
    ) );
    $wp_customize->add_control( 'agencypro_portfolio_count', array(
        'label'   => __( 'Number of projects to show', 'agencypro' ),
        'section' => 'agencypro_portfolio_section',
        'type'    => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 8, 'step' => 1 ),
    ) );

    // Testimonials Section
    $wp_customize->add_section( 'agencypro_testimonials_section', array(
        'title'    => __( 'Testimonials', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 50,
    ) );
    $wp_customize->add_setting( 'agencypro_testimonials_headline', array(
        'default'           => __( 'What Our Clients Say', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_testimonials_headline', array(
        'label'   => __( 'Headline', 'agencypro' ),
        'section' => 'agencypro_testimonials_section',
        'type'    => 'text',
    ) );
    // Repeater-like functionality with 3 testimonials
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting( "agencypro_testimonial_text_$i", array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ) );
        $wp_customize->add_control( "agencypro_testimonial_text_$i", array(
            'label'   => sprintf(__( 'Testimonial #%s Text', 'agencypro' ), $i),
            'section' => 'agencypro_testimonials_section',
            'type'    => 'textarea',
        ) );
        $wp_customize->add_setting( "agencypro_testimonial_author_$i", array(
            'default'           => '',
            'sanitize_callback' => 'agencypro_sanitize_text',
        ) );
        $wp_customize->add_control( "agencypro_testimonial_author_$i", array(
            'label'   => sprintf(__( 'Testimonial #%s Author', 'agencypro' ), $i),
            'section' => 'agencypro_testimonials_section',
            'type'    => 'text',
        ) );
    }

    // CTA Section
    $wp_customize->add_section( 'agencypro_cta_section', array(
        'title'    => __( 'Call to Action', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 60,
    ) );
     $wp_customize->add_setting( 'agencypro_cta_headline', array(
        'default'           => __( 'Have a project in mind?', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_cta_headline', array(
        'label'   => __( 'Headline', 'agencypro' ),
        'section' => 'agencypro_cta_section',
        'type'    => 'text',
    ) );
     $wp_customize->add_setting( 'agencypro_cta_button_text', array(
        'default'           => __( 'Get a Quote', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_cta_button_text', array(
        'label'   => __( 'Button Text', 'agencypro' ),
        'section' => 'agencypro_cta_section',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'agencypro_cta_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'agencypro_sanitize_url',
    ) );
    $wp_customize->add_control( 'agencypro_cta_button_url', array(
        'label'   => __( 'Button URL', 'agencypro' ),
        'section' => 'agencypro_cta_section',
        'type'    => 'url',
    ) );

    // Theme Options Panel
    $wp_customize->add_panel( 'agencypro_theme_options_panel', array(
        'title'       => __( 'Theme Options', 'agencypro' ),
        'priority'    => 140,
    ) );

    // Colors Section
    $wp_customize->add_section( 'agencypro_colors_section', array(
        'title'    => __( 'Colors', 'agencypro' ),
        'panel'    => 'agencypro_theme_options_panel',
    ) );
    $wp_customize->add_setting( 'agencypro_accent_color', array(
        'default'           => '#8e44ad',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_accent_color', array(
        'label'   => __( 'Primary Accent Color', 'agencypro' ),
        'section' => 'agencypro_colors_section',
    ) ) );

    // Footer Section
    $wp_customize->add_section( 'agencypro_footer_section', array(
        'title'    => __( 'Footer', 'agencypro' ),
        'panel'    => 'agencypro_theme_options_panel',
    ) );
    $wp_customize->add_setting( 'agencypro_copyright_text', array(
        'default'           => __( '© 2025 AgencyPro. All Rights Reserved.', 'agencypro' ),
        'sanitize_callback' => 'agencypro_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'agencypro_copyright_text', array(
        'label'   => __( 'Copyright Text', 'agencypro' ),
        'section' => 'agencypro_footer_section',
        'type'    => 'text',
    ) );
     $wp_customize->selective_refresh->add_partial('agencypro_copyright_text', array(
        'selector' => '.site-info',
        'render_callback' => function() { return get_theme_mod('agencypro_copyright_text'); }
    ));
}
add_action( 'customize_register', 'agencypro_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 */
function agencypro_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function agencypro_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function agencypro_customize_preview_js() {
	wp_enqueue_script( 'agencypro-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), AGENCYPRO_VERSION, true );
}
add_action( 'customize_preview_init', 'agencypro_customize_preview_js' );
