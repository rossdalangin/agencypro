<?php
/**
 * Template part for displaying the Portfolio section on the homepage.
 * @package AgencyPro
 */
$headline = get_theme_mod( 'agencypro_portfolio_headline', 'Recent Work' );
$count = get_theme_mod( 'agencypro_portfolio_count', 4 );
$query = new WP_Query(['post_type' => 'project', 'posts_per_page' => absint( $count ), 'no_found_rows' => true]);
if ( ! $query->have_posts() ) { return; }
?>
<section id="portfolio" class="homepage-section portfolio-section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
        <div class="portfolio-grid">
            <?php while ( $query->have_posts() ) : $query->the_post();
                get_template_part('template-parts/content', 'project');
            endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
