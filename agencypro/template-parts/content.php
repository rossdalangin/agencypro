<?php
/**
 * Template part for displaying posts
 * @package AgencyPro
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_singular() ) :
        the_post_thumbnail( 'full', array( 'class' => 'alignwide' ) );
    endif; ?>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>
	</header>
	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses( 'Continue reading<span class="screen-reader-text"> "%s"</span>', array( 'span' => array( 'class' => array() ) ) ),
			get_the_title()
		) );
		wp_link_pages(['before' => '<div class="page-links">' . esc_html__( 'Pages:', 'agencypro' ), 'after'  => '</div>']);
		?>
	</div>
</article>
