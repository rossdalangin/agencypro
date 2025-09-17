(function($) {
    'use strict';
    $(function() {
        // Mobile Menu Toggle
        var $menuToggle = $('.menu-toggle');
        var $mainNav = $('.main-navigation');
        $menuToggle.on('click', function() {
            $mainNav.toggleClass('toggled');
        });

        // Scroll-triggered Animations
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
                if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
                    $element.addClass('is-visible');
                }
            });
        }
        $window.on('scroll resize', check_if_in_view);
        $window.trigger('scroll');

        // Portfolio AJAX Filter & Load More
        var currentPage = 1;
        var currentTerm = 'all';
        var container = $('#portfolio-grid-container');
        var loadMoreButton = $('#load-more-projects');

        $('#portfolio-filter-menu .filter-button').on('click', function(e) {
            e.preventDefault();
            currentPage = 1;
            currentTerm = $(this).data('term');
            $('#portfolio-filter-menu .filter-button').removeClass('active');
            $(this).addClass('active');
            loadProjects(true);
        });

        loadMoreButton.on('click', function(e) {
            e.preventDefault();
            currentPage++;
            loadProjects(false);
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
                        if (currentPage >= response.data.max_num_pages || newContent.trim() === '') {
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
    });
})(jQuery);
