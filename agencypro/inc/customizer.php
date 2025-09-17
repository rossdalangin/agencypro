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
        'description' => __( 'Manage the content and order of homepage sections.', 'agencypro' ),
    ) );

    // Section Order
    $wp_customize->add_section( 'agencypro_section_order_section', array(
        'title'    => __( 'Section Order', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 5,
    ) );
    $wp_customize->add_setting( 'agencypro_section_order', array(
        'default'           => 'hero,clients,services,portfolio,promo,testimonials,cta',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'agencypro_section_order', array(
        'label'       => __( 'Homepage Section Order', 'agencypro' ),
        'section'     => 'agencypro_section_order_section',
        'type'        => 'text',
        'description' => __( 'Enter the sections in the order you want them to appear, separated by commas. Available sections: hero, clients, services, portfolio, testimonials, cta', 'agencypro' ),
    ) );

    // Hero Section
    $wp_customize->add_section( 'agencypro_hero_section', array(
        'title'    => __( 'Hero Section', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 10,
    ) );

    // Display Hero Section
    $wp_customize->add_setting( 'agencypro_hero_display', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'agencypro_hero_display', array(
        'label'   => __( 'Display Section', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'type'    => 'checkbox',
        'priority' => 1,
    ) );

    // --- Background Controls for Hero Section ---
    $wp_customize->add_setting( 'agencypro_hero_bg_type', array(
        'default'           => 'none',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'agencypro_hero_bg_type', array(
        'label'   => __( 'Background Type', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'type'    => 'select',
        'choices' => array(
            'none'     => __( 'None', 'agencypro' ),
            'color'    => __( 'Color', 'agencypro' ),
            'image'    => __( 'Image', 'agencypro' ),
            'gradient' => __( 'Gradient', 'agencypro' ),
        ),
        'priority' => 2,
    ) );

    // BG Color
    $wp_customize->add_setting( 'agencypro_hero_bg_color', array(
        'default'           => '#1e1e1e',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_hero_bg_color', array(
        'label'   => __( 'Background Color', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'active_callback' => function() use ($wp_customize) {
            return 'color' === $wp_customize->get_setting('agencypro_hero_bg_type')->value();
        },
        'priority' => 3,
    ) ) );

    // BG Image
    $wp_customize->add_setting( 'agencypro_hero_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agencypro_hero_bg_image', array(
        'label'   => __( 'Background Image', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'active_callback' => function() use ($wp_customize) {
            return 'image' === $wp_customize->get_setting('agencypro_hero_bg_type')->value();
        },
        'priority' => 3,
    ) ) );

    // BG Gradient Color 1
    $wp_customize->add_setting( 'agencypro_hero_bg_gradient_1', array(
        'default'           => '#1e1e1e',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_hero_bg_gradient_1', array(
        'label'   => __( 'Gradient Color 1', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'active_callback' => function() use ($wp_customize) {
            return 'gradient' === $wp_customize->get_setting('agencypro_hero_bg_type')->value();
        },
        'priority' => 3,
    ) ) );

    // BG Gradient Color 2
    $wp_customize->add_setting( 'agencypro_hero_bg_gradient_2', array(
        'default'           => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_hero_bg_gradient_2', array(
        'label'   => __( 'Gradient Color 2', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'active_callback' => function() use ($wp_customize) {
            return 'gradient' === $wp_customize->get_setting('agencypro_hero_bg_type')->value();
        },
        'priority' => 4,
    ) ) );


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

    // --- Secondary Button ---
    $wp_customize->add_setting( 'agencypro_hero_button_text_2', array(
        'default'           => __( 'Learn More', 'agencypro' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'agencypro_hero_button_text_2', array(
        'label'   => __( 'Secondary Button Text', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'agencypro_hero_button_url_2', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'agencypro_hero_button_url_2', array(
        'label'   => __( 'Secondary Button URL', 'agencypro' ),
        'section' => 'agencypro_hero_section',
        'type'    => 'url',
    ) );

    // Client Logos Section
    $wp_customize->add_section( 'agencypro_clients_section', array(
        'title'    => __( 'Client Logos Section', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 20,
    ) );

    // Display Clients Section
    $wp_customize->add_setting( 'agencypro_clients_display', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'agencypro_clients_display', array(
        'label'   => __( 'Display Section', 'agencypro' ),
        'section' => 'agencypro_clients_section',
        'type'    => 'checkbox',
        'priority' => 1,
    ) );

    // --- BG CONTROLS ---
    $wp_customize->add_setting( 'agencypro_clients_bg_type', ['default' => 'color', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'agencypro_clients_bg_type', ['label' => __( 'Background Type', 'agencypro' ), 'section' => 'agencypro_clients_section', 'type' => 'select', 'choices' => ['none' => 'None', 'color' => 'Color', 'image' => 'Image', 'gradient' => 'Gradient'], 'priority' => 2]);
    $wp_customize->add_setting( 'agencypro_clients_bg_color', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_clients_bg_color', ['label' => __( 'Background Color', 'agencypro' ), 'section' => 'agencypro_clients_section', 'active_callback' => function() use ($wp_customize) { return 'color' === $wp_customize->get_setting('agencypro_clients_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_clients_bg_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agencypro_clients_bg_image', ['label' => __( 'Background Image', 'agencypro' ), 'section' => 'agencypro_clients_section', 'active_callback' => function() use ($wp_customize) { return 'image' === $wp_customize->get_setting('agencypro_clients_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_clients_bg_gradient_1', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_clients_bg_gradient_1', ['label' => __( 'Gradient Color 1', 'agencypro' ), 'section' => 'agencypro_clients_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_clients_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_clients_bg_gradient_2', ['default' => '#121212', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_clients_bg_gradient_2', ['label' => __( 'Gradient Color 2', 'agencypro' ), 'section' => 'agencypro_clients_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_clients_bg_type')->value(); }, 'priority' => 4]));


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
        'label'       => __( 'Client Logos Gallery', 'agencypro' ),
        'section'     => 'agencypro_clients_section',
        'mime_type'   => 'image',
        'description' => __( 'Click "Add new media" and select multiple images from the Media Library by holding down the Ctrl (PC) or Cmd (Mac) key. The selected images will form your client logo gallery.', 'agencypro' ),
    ) ) );

    // Services Preview Section
    $wp_customize->add_section( 'agencypro_services_section', array(
        'title'    => __( 'Services Preview', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 30,
    ) );

    // Display Services Section
    $wp_customize->add_setting( 'agencypro_services_display', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'agencypro_services_display', array(
        'label'   => __( 'Display Section', 'agencypro' ),
        'section' => 'agencypro_services_section',
        'type'    => 'checkbox',
        'priority' => 1,
    ) );

    // --- BG CONTROLS ---
    $wp_customize->add_setting( 'agencypro_services_bg_type', ['default' => 'none', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'agencypro_services_bg_type', ['label' => __( 'Background Type', 'agencypro' ), 'section' => 'agencypro_services_section', 'type' => 'select', 'choices' => ['none' => 'None', 'color' => 'Color', 'image' => 'Image', 'gradient' => 'Gradient'], 'priority' => 2]);
    $wp_customize->add_setting( 'agencypro_services_bg_color', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_services_bg_color', ['label' => __( 'Background Color', 'agencypro' ), 'section' => 'agencypro_services_section', 'active_callback' => function() use ($wp_customize) { return 'color' === $wp_customize->get_setting('agencypro_services_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_services_bg_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agencypro_services_bg_image', ['label' => __( 'Background Image', 'agencypro' ), 'section' => 'agencypro_services_section', 'active_callback' => function() use ($wp_customize) { return 'image' === $wp_customize->get_setting('agencypro_services_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_services_bg_gradient_1', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_services_bg_gradient_1', ['label' => __( 'Gradient Color 1', 'agencypro' ), 'section' => 'agencypro_services_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_services_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_services_bg_gradient_2', ['default' => '#121212', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_services_bg_gradient_2', ['label' => __( 'Gradient Color 2', 'agencypro' ), 'section' => 'agencypro_services_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_services_bg_type')->value(); }, 'priority' => 4]));


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

    // Display Portfolio Section
    $wp_customize->add_setting( 'agencypro_portfolio_display', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'agencypro_portfolio_display', array(
        'label'   => __( 'Display Section', 'agencypro' ),
        'section' => 'agencypro_portfolio_section',
        'type'    => 'checkbox',
        'priority' => 1,
    ) );

    // --- BG CONTROLS ---
    $wp_customize->add_setting( 'agencypro_portfolio_bg_type', ['default' => 'color', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'agencypro_portfolio_bg_type', ['label' => __( 'Background Type', 'agencypro' ), 'section' => 'agencypro_portfolio_section', 'type' => 'select', 'choices' => ['none' => 'None', 'color' => 'Color', 'image' => 'Image', 'gradient' => 'Gradient'], 'priority' => 2]);
    $wp_customize->add_setting( 'agencypro_portfolio_bg_color', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_portfolio_bg_color', ['label' => __( 'Background Color', 'agencypro' ), 'section' => 'agencypro_portfolio_section', 'active_callback' => function() use ($wp_customize) { return 'color' === $wp_customize->get_setting('agencypro_portfolio_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_portfolio_bg_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agencypro_portfolio_bg_image', ['label' => __( 'Background Image', 'agencypro' ), 'section' => 'agencypro_portfolio_section', 'active_callback' => function() use ($wp_customize) { return 'image' === $wp_customize->get_setting('agencypro_portfolio_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_portfolio_bg_gradient_1', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_portfolio_bg_gradient_1', ['label' => __( 'Gradient Color 1', 'agencypro' ), 'section' => 'agencypro_portfolio_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_portfolio_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_portfolio_bg_gradient_2', ['default' => '#121212', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_portfolio_bg_gradient_2', ['label' => __( 'Gradient Color 2', 'agencypro' ), 'section' => 'agencypro_portfolio_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_portfolio_bg_type')->value(); }, 'priority' => 4]));


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

    // Promo Section
    $wp_customize->add_section( 'agencypro_promo_section', array(
        'title'    => __( 'Promo Section', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 45,
    ) );
    $wp_customize->add_setting( 'agencypro_promo_display', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control( 'agencypro_promo_display', ['label' => __( 'Display Section', 'agencypro' ), 'section' => 'agencypro_promo_section', 'type' => 'checkbox', 'priority' => 1]);
    $wp_customize->add_setting( 'agencypro_promo_bg_type', ['default' => 'none', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'agencypro_promo_bg_type', ['label' => __( 'Background Type', 'agencypro' ), 'section' => 'agencypro_promo_section', 'type' => 'select', 'choices' => ['none' => 'None', 'color' => 'Color', 'image' => 'Image', 'gradient' => 'Gradient'], 'priority' => 2]);
    $wp_customize->add_setting( 'agencypro_promo_bg_color', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_promo_bg_color', ['label' => __( 'Background Color', 'agencypro' ), 'section' => 'agencypro_promo_section', 'active_callback' => function() use ($wp_customize) { return 'color' === $wp_customize->get_setting('agencypro_promo_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_promo_bg_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agencypro_promo_bg_image', ['label' => __( 'Background Image', 'agencypro' ), 'section' => 'agencypro_promo_section', 'active_callback' => function() use ($wp_customize) { return 'image' === $wp_customize->get_setting('agencypro_promo_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_promo_bg_gradient_1', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_promo_bg_gradient_1', ['label' => __( 'Gradient Color 1', 'agencypro' ), 'section' => 'agencypro_promo_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_promo_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_promo_bg_gradient_2', ['default' => '#121212', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_promo_bg_gradient_2', ['label' => __( 'Gradient Color 2', 'agencypro' ), 'section' => 'agencypro_promo_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_promo_bg_type')->value(); }, 'priority' => 4]));
    $wp_customize->add_setting( 'agencypro_promo_headline', ['default' => 'A Special Offer Just For You', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'agencypro_promo_headline', ['label' => __( 'Headline', 'agencypro' ), 'section' => 'agencypro_promo_section', 'type' => 'text']);
    $wp_customize->add_setting( 'agencypro_promo_text', ['default' => 'This is a special promotional section where you can highlight a service, a discount, or a unique value proposition to capture your visitor\'s attention.', 'sanitize_callback' => 'wp_kses_post']);
    $wp_customize->add_control( 'agencypro_promo_text', ['label' => __( 'Content', 'agencypro' ), 'section' => 'agencypro_promo_section', 'type' => 'textarea']);
    $wp_customize->add_setting( 'agencypro_promo_button_text', ['default' => 'Learn More', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'agencypro_promo_button_text', ['label' => __( 'Button Text', 'agencypro' ), 'section' => 'agencypro_promo_section', 'type' => 'text']);
    $wp_customize->add_setting( 'agencypro_promo_button_url', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control( 'agencypro_promo_button_url', ['label' => __( 'Button URL', 'agencypro' ), 'section' => 'agencypro_promo_section', 'type' => 'url']);


    // Testimonials Section
    $wp_customize->add_section( 'agencypro_testimonials_section', array(
        'title'    => __( 'Testimonials', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 50,
    ) );

    // Display Testimonials Section
    $wp_customize->add_setting( 'agencypro_testimonials_display', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'agencypro_testimonials_display', array(
        'label'   => __( 'Display Section', 'agencypro' ),
        'section' => 'agencypro_testimonials_section',
        'type'    => 'checkbox',
        'priority' => 1,
    ) );

    // --- BG CONTROLS ---
    $wp_customize->add_setting( 'agencypro_testimonials_bg_type', ['default' => 'none', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'agencypro_testimonials_bg_type', ['label' => __( 'Background Type', 'agencypro' ), 'section' => 'agencypro_testimonials_section', 'type' => 'select', 'choices' => ['none' => 'None', 'color' => 'Color', 'image' => 'Image', 'gradient' => 'Gradient'], 'priority' => 2]);
    $wp_customize->add_setting( 'agencypro_testimonials_bg_color', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_testimonials_bg_color', ['label' => __( 'Background Color', 'agencypro' ), 'section' => 'agencypro_testimonials_section', 'active_callback' => function() use ($wp_customize) { return 'color' === $wp_customize->get_setting('agencypro_testimonials_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_testimonials_bg_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agencypro_testimonials_bg_image', ['label' => __( 'Background Image', 'agencypro' ), 'section' => 'agencypro_testimonials_section', 'active_callback' => function() use ($wp_customize) { return 'image' === $wp_customize->get_setting('agencypro_testimonials_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_testimonials_bg_gradient_1', ['default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_testimonials_bg_gradient_1', ['label' => __( 'Gradient Color 1', 'agencypro' ), 'section' => 'agencypro_testimonials_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_testimonials_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_testimonials_bg_gradient_2', ['default' => '#121212', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_testimonials_bg_gradient_2', ['label' => __( 'Gradient Color 2', 'agencypro' ), 'section' => 'agencypro_testimonials_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_testimonials_bg_type')->value(); }, 'priority' => 4]));


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

    // Setting for number of testimonials to show
    $wp_customize->add_setting( 'agencypro_testimonials_count', array(
        'default'           => 3,
        'sanitize_callback' => 'agencypro_sanitize_integer',
    ) );
    $wp_customize->add_control( 'agencypro_testimonials_count', array(
        'label'   => __( 'Number of testimonials to show', 'agencypro' ),
        'section' => 'agencypro_testimonials_section',
        'type'    => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 9, 'step' => 1 ),
    ) );

    // CTA Section
    $wp_customize->add_section( 'agencypro_cta_section', array(
        'title'    => __( 'Call to Action', 'agencypro' ),
        'panel'    => 'agencypro_homepage_panel',
        'priority' => 60,
    ) );

    // Display CTA Section
    $wp_customize->add_setting( 'agencypro_cta_display', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'agencypro_cta_display', array(
        'label'   => __( 'Display Section', 'agencypro' ),
        'section' => 'agencypro_cta_section',
        'type'    => 'checkbox',
        'priority' => 1,
    ) );

    // --- BG CONTROLS ---
    $wp_customize->add_setting( 'agencypro_cta_bg_type', ['default' => 'color', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control( 'agencypro_cta_bg_type', ['label' => __( 'Background Type', 'agencypro' ), 'section' => 'agencypro_cta_section', 'type' => 'select', 'choices' => ['none' => 'None', 'color' => 'Color', 'image' => 'Image', 'gradient' => 'Gradient'], 'priority' => 2]);
    $wp_customize->add_setting( 'agencypro_cta_bg_color', ['default' => '#8e44ad', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_cta_bg_color', ['label' => __( 'Background Color', 'agencypro' ), 'section' => 'agencypro_cta_section', 'active_callback' => function() use ($wp_customize) { return 'color' === $wp_customize->get_setting('agencypro_cta_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_cta_bg_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agencypro_cta_bg_image', ['label' => __( 'Background Image', 'agencypro' ), 'section' => 'agencypro_cta_section', 'active_callback' => function() use ($wp_customize) { return 'image' === $wp_customize->get_setting('agencypro_cta_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_cta_bg_gradient_1', ['default' => '#8e44ad', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_cta_bg_gradient_1', ['label' => __( 'Gradient Color 1', 'agencypro' ), 'section' => 'agencypro_cta_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_cta_bg_type')->value(); }, 'priority' => 3]));
    $wp_customize->add_setting( 'agencypro_cta_bg_gradient_2', ['default' => '#5e3370', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_cta_bg_gradient_2', ['label' => __( 'Gradient Color 2', 'agencypro' ), 'section' => 'agencypro_cta_section', 'active_callback' => function() use ($wp_customize) { return 'gradient' === $wp_customize->get_setting('agencypro_cta_bg_type')->value(); }, 'priority' => 4]));


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

    $wp_customize->add_setting( 'agencypro_cta_subheadline', array(
        'default'           => 'Let\'s talk about your project. We are here to help you.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'agencypro_cta_subheadline', array(
        'label'   => __( 'Sub-headline', 'agencypro' ),
        'section' => 'agencypro_cta_section',
        'type'    => 'textarea',
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

    // Typography Panel
    $wp_customize->add_panel( 'agencypro_typography_panel', array(
        'title'       => __( 'Typography & Colors', 'agencypro' ),
        'priority'    => 141,
    ) );

    $wp_customize->add_section( 'agencypro_typography_colors_section', array(
        'title'    => __( 'Font Colors', 'agencypro' ),
        'panel'    => 'agencypro_typography_panel',
    ) );

    // Body Text Color
    $wp_customize->add_setting( 'agencypro_body_text_color', array(
        'default'           => '#e0e0e0',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_body_text_color', array(
        'label'   => __( 'Body Text Color', 'agencypro' ),
        'section' => 'agencypro_typography_colors_section',
    ) ) );

    // Heading Text Color
    $wp_customize->add_setting( 'agencypro_heading_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agencypro_heading_text_color', array(
        'label'   => __( 'Headings Color (H1-H6)', 'agencypro' ),
        'section' => 'agencypro_typography_colors_section',
    ) ) );
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
