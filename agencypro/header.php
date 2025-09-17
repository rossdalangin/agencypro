<?php
/**
 * The header for our theme
 * @package AgencyPro
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'agencypro' ); ?></a>
	<header id="masthead" class="site-header">
        <div class="container">
            <div class="site-branding">
                <?php if ( has_custom_logo() ) { the_custom_logo(); } elseif ( get_bloginfo( 'name' ) ) { ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php } ?>
            </div>
            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </button>
                <?php wp_nav_menu(['theme_location' => 'menu-1', 'menu_id' => 'primary-menu']); ?>
            </nav>
            <div class="header-cta">
                <a href="<?php echo esc_url( get_theme_mod( 'agencypro_hero_button_url', '#' ) ); ?>" class="button button-primary">
                    <?php echo esc_html( get_theme_mod( 'agencypro_hero_button_text', 'Get a Quote' ) ); ?>
                </a>
            </div>
        </div>
	</header>
	<div id="content" class="site-content">
