<?php
/**
 * Template part for displaying the Portfolio section on the homepage.
 *
 * @package AgencyPro
 */

$headline = get_theme_mod( 'agencypro_portfolio_headline', __( 'Recent Work', 'agencypro' ) );
$count = get_theme_mod( 'agencypro_portfolio_count', 4 );
$query = new WP_Query( array(
    'post_type'      => 'project',
    'posts_per_page' => absint( $count ),
    'no_found_rows'  => true,
) );

if ( ! $query->have_posts() ) {
    return;
}
?>
<section id="portfolio" class="homepage-section portfolio-section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
        <div class="portfolio-grid">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="portfolio-item">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="portfolio-image"><?php the_post_thumbnail('large'); ?></div>
                    <?php endif; ?>
                    <div class="portfolio-overlay">
                        <h3 class="portfolio-title"><?php the_title(); ?></h3>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
