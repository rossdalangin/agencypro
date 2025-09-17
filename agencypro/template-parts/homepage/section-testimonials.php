<?php
/**
 * Template part for displaying the Testimonials section on the homepage.
 * @package AgencyPro
 */
$headline = get_theme_mod( 'agencypro_testimonials_headline', 'What Clients Say' );
$count = get_theme_mod( 'agencypro_testimonials_count', 3 );
$query = new WP_Query(['post_type' => 'testimonial', 'posts_per_page' => absint( $count ), 'no_found_rows' => true]);
if ( ! $query->have_posts() ) { return; }
?>
<section id="testimonials" class="homepage-section testimonials-section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
        <div class="testimonials-wrapper">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="testimonial-item">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="testimonial-image"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
                <?php endif; ?>
                <div class="testimonial-content">
                    <blockquote class="testimonial-text"><?php the_content(); ?></blockquote>
                    <cite class="testimonial-author">&mdash; <?php the_title(); ?></cite>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
