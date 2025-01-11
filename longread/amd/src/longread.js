define([], function() {
    return {
        init: function() {
            const pages = document.querySelectorAll('.longread-page');
            let currentPage = 0;

            const showPage = (index) => {
                pages.forEach((page, i) => {
                    page.style.display = i === index ? 'block' : 'none';
                });
            };

            document.getElementById('next').addEventListener('click', () => {
                if (currentPage < pages.length - 1) {
                    currentPage++;
                    showPage(currentPage);
                }
            });

            document.getElementById('prev').addEventListener('click', () => {
                if (currentPage > 0) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            showPage(currentPage);
        }
    };
});
