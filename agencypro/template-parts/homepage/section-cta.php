<?php
/**
 * Template part for displaying the CTA section on the homepage.
 *
 * @package AgencyPro
 */

$headline = get_theme_mod( 'agencypro_cta_headline', __( 'Have a project in mind?', 'agencypro' ) );
$subheadline = get_theme_mod( 'agencypro_cta_subheadline', 'Let\'s talk about your project. We are here to help you.' );
$button_text = get_theme_mod( 'agencypro_cta_button_text', __( 'Get a Quote', 'agencypro' ) );
$button_url = get_theme_mod( 'agencypro_cta_button_url', '#' );
?>
<section id="cta" class="homepage-section cta-section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
        <p class="section-sub-title"><?php echo wp_kses_post( $subheadline ); ?></p>
        <a href="<?php echo esc_url( $button_url ); ?>" class="button button-primary"><?php echo esc_html( $button_text ); ?></a>
    </div>
</section>
