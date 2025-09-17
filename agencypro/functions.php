<?php
/**
 * AgencyPro functions and definitions
 *
 * @package AgencyPro
 */

// Define theme version
if ( ! defined( 'AGENCYPRO_VERSION' ) ) {
	define( 'AGENCYPRO_VERSION', '2.2.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function agencypro_setup() {
	load_theme_textdomain( 'agencypro', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);
	register_nav_menus( ['menu-1' => esc_html__( 'Primary', 'agencypro' )] );
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'agencypro_setup' );

/**
 * Register widget areas.
 */
function agencypro_widgets_init() {
	register_sidebar([
        'name'          => esc_html__( 'Footer', 'agencypro' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'agencypro' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
	register_sidebar([
        'name'          => esc_html__( 'Blog Sidebar', 'agencypro' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'agencypro' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}
add_action( 'widgets_init', 'agencypro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function agencypro_scripts() {
	wp_enqueue_style( 'agencypro-main-style', get_template_directory_uri() . '/css/main.css', [], AGENCYPRO_VERSION );

    // Dynamic Google Fonts
    $heading_font = get_theme_mod('agencypro_heading_font_family', 'Montserrat');
    $font_families = ['Montserrat:wght@400;700', $heading_font . ':wght@700'];
    $fonts_url = 'https://fonts.googleapis.com/css2?family=' . implode('&family=', array_unique($font_families)) . '&display=swap';
    wp_enqueue_style( 'agencypro-fonts', $fonts_url, [], null );

	wp_enqueue_script( 'agencypro-main-js', get_template_directory_uri() . '/js/main.js', ['jquery'], AGENCYPRO_VERSION, true );
    wp_localize_script( 'agencypro-main-js', 'agencypro_ajax_obj', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'agencypro_filter_nonce' ),
    ]);
}
add_action( 'wp_enqueue_scripts', 'agencypro_scripts' );

/**
 * Determines if a given hex color is light or dark.
 */
function agencypro_is_color_light( $hex ) {
    $hex = str_replace( '#', '', $hex );
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
    $luminance = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;
    return $luminance > 128;
}

/**
 * Add dynamic CSS for Customizer options.
 */
function agencypro_dynamic_css() {
    $css = '';

    // Global & Typography Colors
    $accent_color = get_theme_mod( 'agencypro_accent_color', '#8e44ad' );
    $body_text_color = get_theme_mod( 'agencypro_body_text_color', '#e0e0e0' );
    $heading_text_color = get_theme_mod( 'agencypro_heading_text_color', '#ffffff' );
    $heading_font_family = get_theme_mod('agencypro_heading_font_family', 'Montserrat');
    $css .= ":root { --color-primary: " . esc_attr($accent_color) . "; --color-dark-text: " . esc_attr($body_text_color) . "; }";
    $css .= "h1, h2, h3, h4, h5, h6 { color: " . esc_attr($heading_text_color) . "; font-family: '" . esc_attr($heading_font_family) . "', sans-serif; }";

    // Header & Footer Colors
    $header_bg_color = get_theme_mod('agencypro_header_bg_color', '#1e1e1e');
    $header_link_color = get_theme_mod('agencypro_header_link_color', '#e0e0e0');
    $footer_bg_color = get_theme_mod('agencypro_footer_bg_color', '#1e1e1e');
    $footer_text_color = get_theme_mod('agencypro_footer_text_color', '#a0a0a0');
    $footer_link_color = get_theme_mod('agencypro_footer_link_color', '#ffffff');
    $css .= ".site-header { background-color: " . esc_attr($header_bg_color) . "; }";
    $css .= ".site-header .main-navigation a, .site-header .site-title a { color: " . esc_attr($header_link_color) . "; }";
    $css .= ".site-footer { background-color: " . esc_attr($footer_bg_color) . "; }";
    $css .= ".site-footer, .site-footer .widget-title { color: " . esc_attr($footer_text_color) . "; }";
    $css .= ".site-footer a { color: " . esc_attr($footer_link_color) . "; }";

    // Mobile Menu Colors
    $hamburger_icon_color = agencypro_is_color_light($header_bg_color) ? '#121212' : '#ffffff';
    $mobile_menu_link_color = agencypro_is_color_light($header_bg_color) ? '#121212' : '#ffffff';
    $css .= "@media (max-width: 992px) {";
    $css .= ".menu-toggle .line { background-color: " . esc_attr($hamburger_icon_color) . "; }";
    $css .= ".main-navigation ul { background-color: " . esc_attr($header_bg_color) . "; }";
    $css .= ".main-navigation ul a { color: " . esc_attr($mobile_menu_link_color) . "; }";
    $css .= "}";

    // Section Backgrounds
    $sections = ['hero', 'clients', 'services', 'portfolio', 'promo', 'testimonials', 'cta'];
    foreach ($sections as $section) {
        $bg_type = get_theme_mod("agencypro_{$section}_bg_type", 'none');
        $selector = ".homepage-section#{$section}";
        switch ($bg_type) {
            case 'color':
                $css .= "{$selector} { background: " . esc_attr(get_theme_mod("agencypro_{$section}_bg_color")) . "; }";
                break;
            case 'image':
                $css .= "{$selector} { background-image: url(" . esc_url(get_theme_mod("agencypro_{$section}_bg_image")) . "); background-size: cover; background-position: center; }";
                break;
            case 'gradient':
                $css .= "{$selector} { background-image: linear-gradient(to right, " . esc_attr(get_theme_mod("agencypro_{$section}_bg_gradient_1")) . ", " . esc_attr(get_theme_mod("agencypro_{$section}_bg_gradient_2")) . "); }";
                break;
            case 'none':
            default:
                $css .= "{$selector} { background: none !important; }";
                break;
        }
    }

    if (!empty($css)) {
        wp_add_inline_style('agencypro-main-style', $css);
    }
}
add_action( 'wp_enqueue_scripts', 'agencypro_dynamic_css' );

// Include other PHP files
require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * AJAX handler for portfolio filtering.
 */
function agencypro_filter_portfolio() {
    check_ajax_referer('agencypro_filter_nonce', 'nonce');
    $term_slug = sanitize_text_field( $_POST['term'] );
    $page = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
    $args = ['post_type' => 'project', 'posts_per_page' => 6, 'paged' => $page];
    if ($term_slug !== 'all') {
        $args['tax_query'] = [['taxonomy' => 'service_type', 'field' => 'slug', 'terms' => $term_slug]];
    }
    $query = new WP_Query($args);
    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'project');
        }
    } elseif ($page === 1) {
        echo '<p class="no-results">' . esc_html__( 'No projects found.', 'agencypro' ) . '</p>';
    }
    $html = ob_get_clean();
    wp_reset_postdata();
    wp_send_json_success(['html' => $html, 'max_num_pages' => $query->max_num_pages]);
}
add_action( 'wp_ajax_filter_portfolio', 'agencypro_filter_portfolio' );
add_action( 'wp_ajax_nopriv_filter_portfolio', 'agencypro_filter_portfolio' );
?>
