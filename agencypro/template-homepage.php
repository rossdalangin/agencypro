<?php
/**
 * Template Name: Homepage
 *
 * The template for displaying the homepage.
 *
 * @package AgencyPro
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    // --- HERO SECTION ---
    $hero_headline = get_theme_mod( 'agencypro_hero_headline', __( 'We Don\'t Just Build Websites. We Build Businesses.', 'agencypro' ) );
    $hero_subheadline = get_theme_mod( 'agencypro_hero_subheadline', __( 'We are a team of creatives who are excited about unique ideas and help digital and fin-tech companies to create amazing identity by crafting top-notch UI/UX.', 'agencypro' ) );
    $hero_button_text = get_theme_mod( 'agencypro_hero_button_text', __( 'Get a Quote', 'agencypro' ) );
    $hero_button_url = get_theme_mod( 'agencypro_hero_button_url', '#' );
    ?>
    <section class="homepage-section hero-section">
        <div class="container">
            <h1 class="hero-headline"><?php echo esc_html( $hero_headline ); ?></h1>
            <p class="hero-subheadline"><?php echo esc_html( $hero_subheadline ); ?></p>
            <a href="<?php echo esc_url( $hero_button_url ); ?>" class="button button-primary"><?php echo esc_html( $hero_button_text ); ?></a>
        </div>
    </section>

    <?php
    // --- CLIENTS SECTION ---
    $clients_headline = get_theme_mod( 'agencypro_clients_headline', __( 'Trusted By The World\'s Best', 'agencypro' ) );
    $clients_gallery_ids = get_theme_mod( 'agencypro_clients_gallery' );
    if ( ! empty( $clients_gallery_ids ) ) :
    ?>
    <section class="homepage-section clients-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $clients_headline ); ?></h2>
            <div class="client-logos">
                <?php
                $gallery_ids = explode( ',', $clients_gallery_ids );
                foreach ( $gallery_ids as $id ) {
                    $image_url = wp_get_attachment_image_url( $id, 'medium' );
                    if ( $image_url ) {
                        echo '<div class="client-logo"><img src="' . esc_url( $image_url ) . '" alt="' . esc_attr__( 'Client Logo', 'agencypro' ) . '"></div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // --- SERVICES SECTION ---
    $services_headline = get_theme_mod( 'agencypro_services_headline', __( 'Our Services', 'agencypro' ) );
    $services_count = get_theme_mod( 'agencypro_services_count', 3 );
    $services_query = new WP_Query( array(
        'post_type'      => 'service',
        'posts_per_page' => absint( $services_count ),
        'no_found_rows'  => true,
    ) );
    if ( $services_query->have_posts() ) :
    ?>
    <section class="homepage-section services-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $services_headline ); ?></h2>
            <div class="services-grid">
                <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                    <div class="service-item">
                        <?php
                        $icon_class = get_post_meta( get_the_ID(), 'icon_class', true );
                        if ( $icon_class ) :
                        ?>
                            <div class="service-icon"><i class="<?php echo esc_attr( $icon_class ); ?>"></i></div>
                        <?php endif; ?>
                        <h3 class="service-title"><?php the_title(); ?></h3>
                        <div class="service-content"><?php the_content(); ?></div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // --- PORTFOLIO SECTION ---
    $portfolio_headline = get_theme_mod( 'agencypro_portfolio_headline', __( 'Recent Work', 'agencypro' ) );
    $portfolio_count = get_theme_mod( 'agencypro_portfolio_count', 4 );
    $portfolio_query = new WP_Query( array(
        'post_type'      => 'project',
        'posts_per_page' => absint( $portfolio_count ),
        'no_found_rows'  => true,
    ) );
    if ( $portfolio_query->have_posts() ) :
    ?>
    <section class="homepage-section portfolio-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $portfolio_headline ); ?></h2>
            <div class="portfolio-grid">
                <?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="portfolio-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="portfolio-image"><?php the_post_thumbnail('large'); ?></div>
                        <?php endif; ?>
                        <div class="portfolio-overlay">
                            <h3 class="portfolio-title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // --- TESTIMONIALS SECTION ---
    $testimonials_headline = get_theme_mod( 'agencypro_testimonials_headline', __( 'What Our Clients Say', 'agencypro' ) );
    ?>
    <section class="homepage-section testimonials-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $testimonials_headline ); ?></h2>
            <div class="testimonials-wrapper">
                <?php for ( $i = 1; $i <= 3; $i++ ) :
                    $text = get_theme_mod( "agencypro_testimonial_text_$i" );
                    $author = get_theme_mod( "agencypro_testimonial_author_$i" );
                    if ( ! empty( $text ) && ! empty( $author ) ) :
                ?>
                <div class="testimonial-item">
                    <blockquote class="testimonial-text">"<?php echo esc_html( $text ); ?>"</blockquote>
                    <cite class="testimonial-author">- <?php echo esc_html( $author ); ?></cite>
                </div>
                <?php endif; endfor; ?>
            </div>
        </div>
    </section>

    <?php
    // --- CTA SECTION ---
    $cta_headline = get_theme_mod( 'agencypro_cta_headline', __( 'Have a project in mind?', 'agencypro' ) );
    $cta_button_text = get_theme_mod( 'agencypro_cta_button_text', __( 'Get a Quote', 'agencypro' ) );
    $cta_button_url = get_theme_mod( 'agencypro_cta_button_url', '#' );
    ?>
    <section class="homepage-section cta-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $cta_headline ); ?></h2>
            <a href="<?php echo esc_url( $cta_button_url ); ?>" class="button button-primary"><?php echo esc_html( $cta_button_text ); ?></a>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();
