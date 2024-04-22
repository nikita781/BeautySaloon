document.addEventListener('DOMContentLoaded', function() {
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
        const button = item.querySelector('.accordion-button');

        button.addEventListener('click', function() {
            const content = item.querySelector('.accordion-content');
            const isActive = item.classList.contains('active');

            accordionItems.forEach(item => {
                item.classList.remove('active');
                item.querySelector('.accordion-content').style.display = 'none';
            });

            if (!isActive) {
                item.classList.add('active');
                content.style.display = 'flex';
            }
        });
    });
});
