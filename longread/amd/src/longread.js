define(['jquery'], function($) {
    return {
        init: function() {
            let currentPage = 0; // Текущая страница.
            const pages = $('.longread-page'); // Все страницы.
            const prevButton = $('#prev-page'); // Кнопка "Назад".
            const nextButton = $('#next-page'); // Кнопка "Вперед".

            // Обновляет состояние навигации и отображение страниц.
            function updateNavigation() {
                pages.addClass('hidden-page'); // Скрыть все страницы.
                $(pages[currentPage]).removeClass('hidden-page'); // Показать текущую страницу.

                // Обновить состояние кнопок.
                prevButton.prop('disabled', currentPage === 0);
                nextButton.prop('disabled', currentPage === pages.length - 1);
            }

            // Обработчик кнопки "Назад".
            prevButton.on('click', function() {
                if (currentPage > 0) {
                    currentPage--; // Переход на предыдущую страницу.
                    updateNavigation();
                }
            });

            // Обработчик кнопки "Вперед".
            nextButton.on('click', function() {
                if (currentPage < pages.length - 1) {
                    currentPage++; // Переход на следующую страницу.
                    updateNavigation();
                }
            });

            updateNavigation(); // Инициализация навигации.
        }
    };
});