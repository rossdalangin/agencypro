<?php
/**
 * AgencyPro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AgencyPro
 */

if ( ! defined( 'AGENCYPRO_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'AGENCYPRO_VERSION', '1.0.0' );
}

if ( ! function_exists( 'agencypro_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function agencypro_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on AgencyPro, use a find and replace
		 * to change 'agencypro' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'agencypro', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'agencypro' ),
			)
		);

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

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'agencypro_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'agencypro_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function agencypro_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'agencypro' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'agencypro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'agencypro' ),
			'id'            => 'blog-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'agencypro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'agencypro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function agencypro_scripts() {
	// Main theme stylesheet
	wp_enqueue_style( 'agencypro-main-style', get_template_directory_uri() . '/css/main.css', array(), AGENCYPRO_VERSION );

    // Google Fonts - Dynamic
    $heading_font = get_theme_mod('agencypro_heading_font_family', 'Montserrat');
    // For simplicity, we assume the body font is always Montserrat for now.
    $font_families = array(
        'Montserrat:wght@400;700',
        $heading_font . ':wght@700',
    );
    $fonts_url = 'https://fonts.googleapis.com/css2?family=' . implode('&family=', array_unique($font_families)) . '&display=swap';
    wp_enqueue_style( 'agencypro-fonts', $fonts_url, array(), null );

    // Main JS file
	wp_enqueue_script( 'agencypro-main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), AGENCYPRO_VERSION, true );

    // Pass data to JS
    wp_localize_script( 'agencypro-main-js', 'agencypro_ajax_obj', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'agencypro_filter_nonce' ),
    ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'agencypro_scripts' );

/**
 * Implement the Custom Post Types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Implement the Customizer.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * AJAX handler for portfolio filtering.
 */
function agencypro_filter_portfolio() {
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'agencypro_filter_nonce' ) ) {
        wp_die( 'Permission denied.' );
    }

    $term_slug = sanitize_text_field( $_POST['term'] );
    $page = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;

    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => 6,
        'paged'          => $page,
    );

    if ( $term_slug !== 'all' ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'service_type',
                'field'    => 'slug',
                'terms'    => $term_slug,
            ),
        );
    }

    $query = new WP_Query( $args );

    ob_start();
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part('template-parts/content', 'project');
        }
    } else {
        if ( $page === 1 ) {
            echo '<p class="no-results">' . esc_html__( 'No projects found in this category.', 'agencypro' ) . '</p>';
        }
    }
    $html = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success( array(
        'html' => $html,
        'max_num_pages' => $query->max_num_pages
    ) );
}
add_action( 'wp_ajax_filter_portfolio', 'agencypro_filter_portfolio' );
add_action( 'wp_ajax_nopriv_filter_portfolio', 'agencypro_filter_portfolio' );

/**
 * Add dynamic CSS for Customizer options.
 */
function agencypro_dynamic_css() {
    $css = '';

    // --- Get Accent Color ---
    $accent_color = get_theme_mod( 'agencypro_accent_color', '#8e44ad' );
    $css .= '
        :root {
            --color-primary: ' . esc_attr( $accent_color ) . ';
        }
    ';

    // --- Get Typography Colors ---
    $body_text_color = get_theme_mod( 'agencypro_body_text_color', '#e0e0e0' );
    $heading_text_color = get_theme_mod( 'agencypro_heading_text_color', '#ffffff' );

    $heading_font_family = get_theme_mod('agencypro_heading_font_family', 'Montserrat');

    $css .= "
        body, :root {
            --color-dark-text: " . esc_attr($body_text_color) . ";
        }
        h1, h2, h3, h4, h5, h6 {
            color: " . esc_attr($heading_text_color) . ";
            font-family: '" . esc_attr($heading_font_family) . "', sans-serif;
        }
    ";

    // --- Header & Footer Colors ---
    $header_bg_color = get_theme_mod('agencypro_header_bg_color', '#1e1e1e');
    $header_link_color = get_theme_mod('agencypro_header_link_color', '#e0e0e0');
    $footer_bg_color = get_theme_mod('agencypro_footer_bg_color', '#1e1e1e');
    $footer_text_color = get_theme_mod('agencypro_footer_text_color', '#a0a0a0');
    $footer_link_color = get_theme_mod('agencypro_footer_link_color', '#ffffff');

    $css .= "
        .site-header { background-color: " . esc_attr($header_bg_color) . "; }
        .site-header .main-navigation a, .site-header .site-title a { color: " . esc_attr($header_link_color) . "; }
        .site-footer { background-color: " . esc_attr($footer_bg_color) . "; }
        .site-footer, .site-footer .widget-title { color: " . esc_attr($footer_text_color) . "; }
        .site-footer a { color: " . esc_attr($footer_link_color) . "; }
    ";

    // --- Hamburger Icon Color ---
    $hamburger_icon_color = agencypro_is_color_light($header_bg_color) ? '#121212' : '#ffffff';
    $css .= "
        .menu-toggle .line { background-color: " . esc_attr($hamburger_icon_color) . "; }
    ";

    // --- Generate Section Background CSS ---
    $sections = array('hero', 'clients', 'services', 'portfolio', 'promo', 'testimonials', 'cta');

    foreach ($sections as $section) {
        $bg_type = get_theme_mod( "agencypro_{$section}_bg_type", 'none' );
        $selector = ".homepage-section#{$section}";

        switch ($bg_type) {
            case 'color':
                $bg_color = get_theme_mod( "agencypro_{$section}_bg_color", '#1e1e1e' );
                $css .= "{$selector} { background: " . esc_attr($bg_color) . "; } \n";
                break;

            case 'image':
                $bg_image = get_theme_mod( "agencypro_{$section}_bg_image", '' );
                if ( ! empty($bg_image) ) {
                    $css .= "{$selector} { background-image: url(" . esc_url($bg_image) . "); background-size: cover; background-position: center; } \n";
                }
                break;

            case 'gradient':
                $grad_1 = get_theme_mod( "agencypro_{$section}_bg_gradient_1", '#1e1e1e' );
                $grad_2 = get_theme_mod( "agencypro_{$section}_bg_gradient_2", '#121212' );
                $css .= "{$selector} { background-image: linear-gradient(to right, " . esc_attr($grad_1) . ", " . esc_attr($grad_2) . "); } \n";
                break;

            case 'none':
            default:
                $css .= "{$selector} { background: none !important; } \n";
                break;
        }
    }

    if ( ! empty( $css ) ) {
        wp_add_inline_style( 'agencypro-main-style', $css );
    }
}
add_action( 'wp_enqueue_scripts', 'agencypro_dynamic_css' );

/**
 * Determines if a given hex color is light or dark.
 *
 * @param string $hex The hex color code.
 * @return bool True if light, false if dark.
 */
function agencypro_is_color_light( $hex ) {
    $hex = str_replace( '#', '', $hex );
    if ( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
    }
    // Formula to determine perceived brightness
    $luminance = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;
    return $luminance > 128;
}
