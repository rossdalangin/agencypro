/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

    // Hero Headline
    wp.customize( 'agencypro_hero_headline', function( value ) {
        value.bind( function( to ) {
            $( '.hero-section .hero-headline' ).text( to );
        } );
    } );

    // Hero Sub-headline
    wp.customize( 'agencypro_hero_subheadline', function( value ) {
        value.bind( function( to ) {
            $( '.hero-section .hero-subheadline' ).text( to );
        } );
    } );

    // Hero Button Text
    wp.customize( 'agencypro_hero_button_text', function( value ) {
        value.bind( function( to ) {
            $( '.hero-section .button-primary' ).text( to );
        } );
    } );

    // Clients Headline
    wp.customize( 'agencypro_clients_headline', function( value ) {
        value.bind( function( to ) {
            $( '.clients-section .section-title' ).text( to );
        } );
    } );

} )( jQuery );
