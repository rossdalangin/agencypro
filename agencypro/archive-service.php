<?php
get_header(); ?>
<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php echo esc_html( get_theme_mod( 'agencypro_service_archive_title', 'Our Services' ) ); ?>
            </h1>
            <div class="archive-description">
                <?php echo wp_kses_post( get_theme_mod( 'agencypro_service_archive_description', 'A list of services we offer.' ) ); ?>
            </div>
        </header>
        <?php if ( have_posts() ) : ?>
            <div class="services-masonry-grid">
                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', 'service' );
                endwhile;
                ?>
            </div>
            <?php the_posts_navigation();
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
    </div>
</main>
<?php get_footer(); ?>
