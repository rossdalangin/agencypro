<?php
/**
 * Template part for displaying the Promo section on the homepage.
 * @package AgencyPro
 */
$headline = get_theme_mod( 'agencypro_promo_headline', 'A Special Offer' );
$text = get_theme_mod( 'agencypro_promo_text', 'Promotional text here.' );
$button_text = get_theme_mod( 'agencypro_promo_button_text', 'Learn More' );
$button_url = get_theme_mod( 'agencypro_promo_button_url', '#' );
?>
<section id="promo" class="homepage-section promo-section text-align-left">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
        <div class="promo-content">
            <p><?php echo wp_kses_post( $text ); ?></p>
        </div>
        <?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) : ?>
        <a href="<?php echo esc_url( $button_url ); ?>" class="button button-primary"><?php echo esc_html( $button_text ); ?></a>
        <?php endif; ?>
    </div>
</section>
