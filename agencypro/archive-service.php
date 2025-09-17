<?php
/**
 * The template for displaying the archive for the "Service" Custom Post Type.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AgencyPro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php echo esc_html( get_theme_mod( 'agencypro_service_archive_title', __( 'Our Services', 'agencypro' ) ) ); ?>
            </h1>
            <div class="archive-description">
                <?php echo wp_kses_post( get_theme_mod( 'agencypro_service_archive_description', __( 'A list of services we offer to our clients.', 'agencypro' ) ) ); ?>
            </div>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>
            <div class="services-masonry-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content', 'service' );
                endwhile;
                ?>
            </div><!-- .services-masonry-grid -->
            <?php
            the_posts_navigation();
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
?>
