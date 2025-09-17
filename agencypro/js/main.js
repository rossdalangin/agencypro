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
     * Portfolio AJAX Filter & Load More
     */
    var currentPage = 1;
    var currentTerm = 'all';
    var container = $('#portfolio-grid-container');
    var loadMoreButton = $('#load-more-projects');

    // Filter button click
    $('#portfolio-filter-menu .filter-button').on('click', function(e) {
        e.preventDefault();

        currentPage = 1;
        currentTerm = $(this).data('term');

        // Active button class
        $('#portfolio-filter-menu .filter-button').removeClass('active');
        $(this).addClass('active');

        loadProjects(true); // true to replace content
    });

    // Load more button click
    loadMoreButton.on('click', function(e) {
        e.preventDefault();
        currentPage++;
        loadProjects(false); // false to append content
    });

    function loadProjects(replace) {
         $.ajax({
            url: agencypro_ajax_obj.ajax_url,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'filter_portfolio',
                nonce: agencypro_ajax_obj.nonce,
                term: currentTerm,
                page: currentPage
            },
            beforeSend: function() {
                container.addClass('loading');
                loadMoreButton.text('Loading...');
            },
            success: function(response) {
                if(response.success) {
                    var newContent = response.data.html;
                    if (replace) {
                        container.html(newContent);
                    } else {
                        container.append(newContent);
                    }

                    // Handle "Load More" button visibility
                    if (currentPage >= response.data.max_num_pages) {
                        loadMoreButton.hide();
                    } else {
                        loadMoreButton.show();
                    }
                } else {
                    loadMoreButton.hide();
                }
            },
            complete: function() {
                container.removeClass('loading');
                loadMoreButton.text('Load More');
            }
        });
    }

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
