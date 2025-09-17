<?php
get_header(); ?>
<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('project-case-study'); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
                <header class="entry-header project-hero" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                    <div class="container">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                </header>
            <?php endif; ?>
            <div class="entry-content">
                <div class="container">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
