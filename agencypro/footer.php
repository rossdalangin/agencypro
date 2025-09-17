<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AgencyPro
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="footer-widgets container">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php endif; ?>
        </div>

		<div class="site-info">
            <div class="container">
                <?php
                $copyright_text = get_theme_mod( 'agencypro_copyright_text', __( '© 2025 AgencyPro. All Rights Reserved.', 'agencypro' ) );
                echo esc_html( $copyright_text );
                ?>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
