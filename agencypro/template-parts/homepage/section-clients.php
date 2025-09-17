<?php
/**
 * Template part for displaying the Client Logos section on the homepage.
 * @package AgencyPro
 */
$headline = get_theme_mod( 'agencypro_clients_headline', 'Trusted By The Best' );
?>
<section id="clients" class="homepage-section clients-section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
        <div class="client-logos">
            <?php
            for ( $i = 1; $i <= 8; $i++ ) {
                $logo_url = get_theme_mod( "agencypro_client_logo_$i" );
                if ( ! empty( $logo_url ) ) {
                    echo '<div class="client-logo"><img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr__( 'Client Logo', 'agencypro' ) . ' ' . $i . '"></div>';
                }
            }
            ?>
        </div>
    </div>
</section>
