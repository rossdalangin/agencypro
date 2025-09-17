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

    // Google Fonts - Montserrat
    wp_enqueue_style( 'agencypro-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap', array(), null );

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

    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => -1,
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

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            ?>
            <a href="<?php the_permalink(); ?>" class="portfolio-item">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="portfolio-image"><?php the_post_thumbnail('large'); ?></div>
                <?php endif; ?>
                <div class="portfolio-overlay">
                    <h3 class="portfolio-title"><?php the_title(); ?></h3>
                    <span class="portfolio-category">
                        <?php
                        $project_terms = get_the_terms( get_the_ID(), 'service_type' );
                        if ( $project_terms && ! is_wp_error( $project_terms ) ) {
                            $term_names = wp_list_pluck( $project_terms, 'name' );
                            echo esc_html( implode( ', ', $term_names ) );
                        }
                        ?>
                    </span>
                </div>
            </a>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<p class="no-results">' . esc_html__( 'No projects found in this category.', 'agencypro' ) . '</p>';
    }

    wp_die();
}
add_action( 'wp_ajax_filter_portfolio', 'agencypro_filter_portfolio' );
add_action( 'wp_ajax_nopriv_filter_portfolio', 'agencypro_filter_portfolio' );

/**
 * Add dynamic CSS for Customizer options.
 */
function agencypro_dynamic_css() {
    $accent_color = get_theme_mod( 'agencypro_accent_color', '#8e44ad' );

    $css = '
        :root {
            --color-primary: ' . esc_attr( $accent_color ) . ';
        }
    ';

    wp_add_inline_style( 'agencypro-main-style', $css );
}
add_action( 'wp_enqueue_scripts', 'agencypro_dynamic_css' );
