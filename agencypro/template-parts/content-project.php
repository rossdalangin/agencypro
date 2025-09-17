<?php
/**
 * Template part for displaying a single project in a grid.
 * @package AgencyPro
 */
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
                echo esc_html( implode( ', ', wp_list_pluck( $project_terms, 'name' ) ) );
            }
            ?>
        </span>
    </div>
</a>
