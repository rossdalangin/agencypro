<?php
/**
 * Template Name: Portfolio
 *
 * The template for displaying the portfolio grid with AJAX filters.
 *
 * @package AgencyPro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>

        <?php
        $terms = get_terms( array(
            'taxonomy'   => 'service_type',
            'hide_empty' => true,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
        ?>
            <div id="portfolio-filter-menu">
                <button class="filter-button active" data-term="all"><?php esc_html_e( 'All', 'agencypro' ); ?></button>
                <?php foreach ( $terms as $term ) : ?>
                    <button class="filter-button" data-term="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div id="portfolio-grid-container">
            <?php
            $portfolio_query = new WP_Query( array(
                'post_type'      => 'project',
                'posts_per_page' => -1, // Show all projects initially
            ) );

            if ( $portfolio_query->have_posts() ) :
                while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
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
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>' . esc_html__( 'No projects found.', 'agencypro' ) . '</p>';
            endif;
            ?>
        </div><!-- #portfolio-grid-container -->
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
?>
