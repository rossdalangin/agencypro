<?php
/**
 * Template part for displaying the Services section on the homepage.
 * @package AgencyPro
 */
$headline = get_theme_mod( 'agencypro_services_headline', 'Our Services' );
$count = get_theme_mod( 'agencypro_services_count', 3 );
$query = new WP_Query(['post_type' => 'service', 'posts_per_page' => absint( $count ), 'no_found_rows'  => true]);
if ( ! $query->have_posts() ) { return; }
?>
<section id="services" class="homepage-section services-section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
        <div class="services-grid">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="service-item">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="service-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="service-item-content">
                        <?php
                        $icon_class = get_post_meta( get_the_ID(), 'icon_class', true );
                        if ( $icon_class ) : ?>
                            <div class="service-icon"><i class="<?php echo esc_attr( $icon_class ); ?>"></i></div>
                        <?php endif; ?>
                        <h3 class="service-title"><?php the_title(); ?></h3>
                        <div class="service-content"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="button button-secondary"><?php esc_html_e( 'Learn More', 'agencypro' ); ?></a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
