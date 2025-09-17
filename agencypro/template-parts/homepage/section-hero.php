<?php
/**
 * Template part for displaying the Hero section on the homepage.
 * @package AgencyPro
 */
$headline = get_theme_mod( 'agencypro_hero_headline', 'We Build Businesses.' );
$subheadline = get_theme_mod( 'agencypro_hero_subheadline', 'We are a team of creatives.' );
$button_text = get_theme_mod( 'agencypro_hero_button_text', 'Get a Quote' );
$button_url = get_theme_mod( 'agencypro_hero_button_url', '#' );
$button_text_2 = get_theme_mod( 'agencypro_hero_button_text_2', 'Learn More' );
$button_url_2 = get_theme_mod( 'agencypro_hero_button_url_2', '' );
?>
<section id="hero" class="homepage-section hero-section">
    <div class="container">
        <h1 class="hero-headline"><?php echo esc_html( $headline ); ?></h1>
        <p class="hero-subheadline"><?php echo esc_html( $subheadline ); ?></p>
        <div class="hero-buttons">
            <a href="<?php echo esc_url( $button_url ); ?>" class="button button-primary"><?php echo esc_html( $button_text ); ?></a>
            <?php if ( ! empty( $button_url_2 ) && ! empty( $button_text_2 ) ) : ?>
                <a href="<?php echo esc_url( $button_url_2 ); ?>" class="button button-secondary"><?php echo esc_html( $button_text_2 ); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
