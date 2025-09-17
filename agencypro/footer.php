<?php
/**
 * The template for displaying the footer
 * @package AgencyPro
 */
?>
	</div><!-- #content -->
	<footer id="colophon" class="site-footer">
        <div class="footer-widgets container">
            <?php if ( is_active_sidebar( 'footer-1' ) ) { dynamic_sidebar( 'footer-1' ); } ?>
        </div>
		<div class="site-info">
            <div class="container">
                <?php echo esc_html( get_theme_mod( 'agencypro_copyright_text', '© 2025 AgencyPro' ) ); ?>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
