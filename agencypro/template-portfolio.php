<?php
/**
 * Template Name: Portfolio
 */
get_header(); ?>
<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>
        <?php
        $terms = get_terms( ['taxonomy' => 'service_type', 'hide_empty' => true] );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
            <div id="portfolio-filter-menu">
                <button class="filter-button active" data-term="all"><?php esc_html_e( 'All', 'agencypro' ); ?></button>
                <?php foreach ( $terms as $term ) : ?>
                    <button class="filter-button" data-term="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div id="portfolio-grid-container">
            <?php
            $portfolio_query = new WP_Query( ['post_type' => 'project', 'posts_per_page' => 6, 'paged' => 1] );
            if ( $portfolio_query->have_posts() ) :
                while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
                    get_template_part('template-parts/content', 'project');
                endwhile;
            else :
                echo '<p>' . esc_html__( 'No projects found.', 'agencypro' ) . '</p>';
            endif;
            ?>
        </div>
        <?php if ( $portfolio_query->max_num_pages > 1 ) : ?>
            <div class="load-more-container">
                <button id="load-more-projects" class="button button-primary"><?php esc_html_e( 'Load More', 'agencypro' ); ?></button>
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</main>
<?php get_footer(); ?>
