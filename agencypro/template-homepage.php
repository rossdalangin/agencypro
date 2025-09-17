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
    // --- RENDER HOMEPAGE SECTIONS DYNAMICALLY BASED ON ORDER FIELD ---

    // 1. Define all possible sections and their default data.
    $section_ids = ['hero', 'clients', 'services', 'portfolio', 'promo', 'testimonials', 'cta'];
    $sections_data = [];

    // 2. Populate the array with data from the Customizer.
    foreach ($section_ids as $id) {
        $sections_data[] = [
            'id'      => $id,
            'display' => get_theme_mod("agencypro_{$id}_display", true),
            'order'   => get_theme_mod("agencypro_{$id}_order", 10),
        ];
    }

    // 3. Sort the sections based on the 'order' value.
    usort($sections_data, function($a, $b) {
        return $a['order'] <=> $b['order'];
    });

    // 4. Loop through the sorted sections and render them.
    foreach ($sections_data as $section) {
        if ($section['display']) {
            // Use get_template_part to keep this file clean.
            // We will create a new file for each section's markup.
            get_template_part('template-parts/homepage/section', $section['id']);
        }
    }
    ?>

</main><!-- #main -->

<?php
get_footer();
