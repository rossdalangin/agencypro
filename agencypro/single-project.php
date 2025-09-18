<?php
/**
 * The template for displaying all single projects (portfolio items)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AgencyPro
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('project-case-study'); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
                <header class="entry-header project-hero" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                    <div class="container">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="project-meta">
                            <span class="project-category">
                                <?php
                                $project_terms = get_the_terms( get_the_ID(), 'service_type' );
                                if ( $project_terms && ! is_wp_error( $project_terms ) ) {
                                    $term_names = wp_list_pluck( $project_terms, 'name' );
                                    echo esc_html( implode( ', ', $term_names ) );
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </header><!-- .entry-header -->
            <?php else : ?>
                 <header class="entry-header">
                    <div class="container">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                </header>
            <?php endif; ?>


            <div class="entry-content">
                <div class="container">
                    <div class="project-details">
                        <div class="project-goals">
                            <h3><?php esc_html_e( 'Project Goals', 'agencypro' ); ?></h3>
                            <?php
                            $project_goals = get_post_meta( get_the_ID(), '_agencypro_project_goals', true );
                            if ( ! empty( $project_goals ) ) {
                                echo '<p>' . esc_html( $project_goals ) . '</p>';
                            }
                            ?>
                        </div>
                        <div class="project-results">
                            <h3><?php esc_html_e( 'Results', 'agencypro' ); ?></h3>
                             <?php
                            $project_results = get_post_meta( get_the_ID(), '_agencypro_project_results', true );
                            if ( ! empty( $project_results ) ) {
                                echo '<p>' . esc_html( $project_results ) . '</p>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="project-description">
                         <h3><?php esc_html_e( 'The Process', 'agencypro' ); ?></h3>
                        <?php
                        the_content();
                        ?>
                    </div>
                </div>
            </div><!-- .entry-content -->

        </article><!-- #post-<?php the_ID(); ?> -->

    <?php
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
?>
