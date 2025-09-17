/**
 * Main JavaScript file for AgencyPro Theme
 */

(function($) {
    'use strict';

    // Document ready
    $(function() {

        // All custom jQuery will go here.

    /**
     * Mobile Menu Toggle
     */
    var $menuToggle = $('.menu-toggle');
    var $mainNav = $('.main-navigation');
    $menuToggle.on('click', function() {
        $mainNav.toggleClass('toggled');
    });

    /**
     * Scroll-triggered Animations
     */
    var $animationElements = $('.animate-on-scroll');
    var $window = $(window);

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $.each($animationElements, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('is-visible');
            } else {
                // Optional: remove class if you want animations to repeat
                // $element.removeClass('is-visible');
            }
        });
    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');


    /**
     * Portfolio AJAX Filter
     */
    $('#portfolio-filter-menu .filter-button').on('click', function(e) {
        e.preventDefault();

        // Active button class
        $('#portfolio-filter-menu .filter-button').removeClass('active');
        $(this).addClass('active');

        var term = $(this).data('term');
        var container = $('#portfolio-grid-container');

        $.ajax({
            url: agencypro_ajax_obj.ajax_url,
            type: 'post',
            data: {
                action: 'filter_portfolio',
                nonce: agencypro_ajax_obj.nonce,
                term: term,
            },
            beforeSend: function() {
                container.addClass('loading');
            },
            success: function(response) {
                container.html(response);
            },
            complete: function() {
                container.removeClass('loading');
            }
        });
    });

        // Example: Smooth scroll for anchor links
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });

    }); // End document ready

})(jQuery);
