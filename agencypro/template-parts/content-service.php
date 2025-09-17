<?php
/**
 * Template part for displaying service posts in a masonry grid
 * @package AgencyPro
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-item'); ?>>
    <div class="masonry-item-inner">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large'); ?></a>
            </div>
        <?php endif; ?>
        <header class="entry-header">
            <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
        </header>
        <div class="entry-summary"><?php the_excerpt(); ?></div>
        <footer class="entry-footer">
            <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e('View Details', 'agencypro'); ?> &rarr;</a>
        </footer>
    </div>
</article>
