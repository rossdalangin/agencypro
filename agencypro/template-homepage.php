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
    // --- RENDER HOMEPAGE SECTIONS DYNAMICALLY ---

    // 1. Get the desired order from the Customizer.
    $default_order = 'hero,clients,services,portfolio,testimonials,cta';
    $section_order_str = get_theme_mod( 'agencypro_section_order', $default_order );
    $section_order = explode( ',', $section_order_str );

    // 2. Prepare an array to hold the HTML for each section.
    $sections_html = [];

    // --- HERO SECTION ---
    ob_start();
    if ( get_theme_mod( 'agencypro_hero_display', true ) ) {
        $hero_headline = get_theme_mod( 'agencypro_hero_headline', __( 'We Don\'t Just Build Websites. We Build Businesses.', 'agencypro' ) );
        $hero_subheadline = get_theme_mod( 'agencypro_hero_subheadline', __( 'We are a team of creatives who are excited about unique ideas and help digital and fin-tech companies to create amazing identity by crafting top-notch UI/UX.', 'agencypro' ) );
        $hero_button_text = get_theme_mod( 'agencypro_hero_button_text', __( 'Get a Quote', 'agencypro' ) );
        $hero_button_url = get_theme_mod( 'agencypro_hero_button_url', '#' );
        ?>
        <section id="hero" class="homepage-section hero-section">
            <div class="container">
                <h1 class="hero-headline"><?php echo esc_html( $hero_headline ); ?></h1>
                <p class="hero-subheadline"><?php echo esc_html( $hero_subheadline ); ?></p>
                <a href="<?php echo esc_url( $hero_button_url ); ?>" class="button button-primary"><?php echo esc_html( $hero_button_text ); ?></a>
            </div>
        </section>
        <?php
    }
    $sections_html['hero'] = ob_get_clean();


    // --- CLIENTS SECTION ---
    ob_start();
    if ( get_theme_mod( 'agencypro_clients_display', true ) ) {
        $clients_headline = get_theme_mod( 'agencypro_clients_headline', __( 'Trusted By The World\'s Best', 'agencypro' ) );
        $clients_gallery_ids = get_theme_mod( 'agencypro_clients_gallery' );
        if ( ! empty( $clients_gallery_ids ) ) :
        ?>
        <section id="clients" class="homepage-section clients-section">
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
        <?php endif;
    }
    $sections_html['clients'] = ob_get_clean();


    // --- SERVICES SECTION ---
    ob_start();
    if ( get_theme_mod( 'agencypro_services_display', true ) ) {
        $services_headline = get_theme_mod( 'agencypro_services_headline', __( 'Our Services', 'agencypro' ) );
        $services_count = get_theme_mod( 'agencypro_services_count', 3 );
        $services_query = new WP_Query( array(
            'post_type'      => 'service',
            'posts_per_page' => absint( $services_count ),
            'no_found_rows'  => true,
        ) );
        if ( $services_query->have_posts() ) :
        ?>
        <section id="services" class="homepage-section services-section">
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
        <?php endif;
    }
    $sections_html['services'] = ob_get_clean();


    // --- PORTFOLIO SECTION ---
    ob_start();
    if ( get_theme_mod( 'agencypro_portfolio_display', true ) ) {
        $portfolio_headline = get_theme_mod( 'agencypro_portfolio_headline', __( 'Recent Work', 'agencypro' ) );
        $portfolio_count = get_theme_mod( 'agencypro_portfolio_count', 4 );
        $portfolio_query = new WP_Query( array(
            'post_type'      => 'project',
            'posts_per_page' => absint( $portfolio_count ),
            'no_found_rows'  => true,
        ) );
        if ( $portfolio_query->have_posts() ) :
        ?>
        <section id="portfolio" class="homepage-section portfolio-section">
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
        <?php endif;
    }
    $sections_html['portfolio'] = ob_get_clean();


    // --- PROMO SECTION ---
    ob_start();
    if ( get_theme_mod( 'agencypro_promo_display', true ) ) {
        $promo_headline = get_theme_mod( 'agencypro_promo_headline', 'A Special Offer Just For You' );
        $promo_text = get_theme_mod( 'agencypro_promo_text', 'This is a special promotional section where you can highlight a service, a discount, or a unique value proposition to capture your visitor\'s attention.' );
        $promo_button_text = get_theme_mod( 'agencypro_promo_button_text', 'Learn More' );
        $promo_button_url = get_theme_mod( 'agencypro_promo_button_url', '#' );
        ?>
        <section id="promo" class="homepage-section promo-section text-align-left">
            <div class="container">
                <h2 class="section-title"><?php echo esc_html( $promo_headline ); ?></h2>
                <div class="promo-content">
                    <p><?php echo wp_kses_post( $promo_text ); ?></p>
                </div>
                <?php if ( ! empty( $promo_button_text ) && ! empty( $promo_button_url ) ) : ?>
                <a href="<?php echo esc_url( $promo_button_url ); ?>" class="button button-primary"><?php echo esc_html( $promo_button_text ); ?></a>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
    $sections_html['promo'] = ob_get_clean();


    // --- TESTIMONIALS SECTION ---
    ob_start();
    if ( get_theme_mod( 'agencypro_testimonials_display', true ) ) {
        $testimonials_headline = get_theme_mod( 'agencypro_testimonials_headline', __( 'What Our Clients Say', 'agencypro' ) );
        $testimonials_count = get_theme_mod( 'agencypro_testimonials_count', 3 );
        $testimonials_query = new WP_Query( array(
            'post_type'      => 'testimonial',
            'posts_per_page' => absint( $testimonials_count ),
            'no_found_rows'  => true,
        ) );
        if ( $testimonials_query->have_posts() ) :
        ?>
        <section id="testimonials" class="homepage-section testimonials-section">
            <div class="container">
                <h2 class="section-title"><?php echo esc_html( $testimonials_headline ); ?></h2>
                <div class="testimonials-wrapper">
                    <?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>
                    <div class="testimonial-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="testimonial-image">
                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="testimonial-content">
                            <blockquote class="testimonial-text"><?php the_content(); ?></blockquote>
                            <cite class="testimonial-author">&mdash; <?php the_title(); ?></cite>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
        <?php endif;
    }
    $sections_html['testimonials'] = ob_get_clean();


    // --- CTA SECTION ---
    ob_start();
    if ( get_theme_mod( 'agencypro_cta_display', true ) ) {
        $cta_headline = get_theme_mod( 'agencypro_cta_headline', __( 'Have a project in mind?', 'agencypro' ) );
        $cta_subheadline = get_theme_mod( 'agencypro_cta_subheadline', 'Let\'s talk about your project. We are here to help you.' );
        $cta_button_text = get_theme_mod( 'agencypro_cta_button_text', __( 'Get a Quote', 'agencypro' ) );
        $cta_button_url = get_theme_mod( 'agencypro_cta_button_url', '#' );
        ?>
        <section id="cta" class="homepage-section cta-section">
            <div class="container">
                <h2 class="section-title"><?php echo esc_html( $cta_headline ); ?></h2>
                <p class="section-sub-title"><?php echo wp_kses_post( $cta_subheadline ); ?></p>
                <a href="<?php echo esc_url( $cta_button_url ); ?>" class="button button-primary"><?php echo esc_html( $cta_button_text ); ?></a>
            </div>
        </section>
        <?php
    }
    $sections_html['cta'] = ob_get_clean();


    // 3. Loop through the ordered sections and print their HTML.
    foreach ( $section_order as $section_name ) {
        $section_name = trim( $section_name );
        if ( ! empty( $sections_html[ $section_name ] ) ) {
            echo $sections_html[ $section_name ];
        }
    }
    ?>

</main><!-- #main -->

<?php
get_footer();
