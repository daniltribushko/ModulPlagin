define(['jquery'], function($) {
    return {
        init: function() {
            let currentPage = 0;
            const pages = $('.longread-page');
            const prevButton = $('#prev-page');
            const nextButton = $('#next-page');

            function updateNavigation() {
                pages.addClass('hidden-page');
                $(pages[currentPage]).removeClass('hidden-page');
                prevButton.prop('disabled', currentPage === 0);
                nextButton.prop('disabled', currentPage === pages.length - 1);
            }

            prevButton.on('click', function() {
                if (currentPage > 0) {
                    currentPage--;
                    updateNavigation();
                }
            });

            nextButton.on('click', function() {
                if (currentPage < pages.length - 1) {
                    currentPage++;
                    updateNavigation();
                }
            });

            updateNavigation();
        }
    };
});
