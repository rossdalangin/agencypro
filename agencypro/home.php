<?php
get_header(); ?>
<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php single_post_title(); ?></h1>
        </header>
        <?php if ( have_posts() ) : ?>
            <div class="blog-masonry-grid">
                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', 'masonry' );
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
