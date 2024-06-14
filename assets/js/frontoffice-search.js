document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.scroll-div-defiler');
    const buttons = document.querySelectorAll('.defiler-option .btn');
    const sections = document.querySelectorAll('.scroll-item');

    function updateActiveButton() {
        const scrollLeft = container.scrollLeft;
        const containerWidth = container.clientWidth;

        sections.forEach((section, index) => {
            const sectionLeft = section.offsetLeft;
            const sectionRight = sectionLeft + section.offsetWidth;

            if (scrollLeft >= sectionLeft - (containerWidth / 2) && scrollLeft < sectionRight - (containerWidth / 2)) {
                buttons.forEach(btn => btn.classList.remove('btn-active'));
                buttons[index].classList.add('btn-active');
            }
        });
    }

    buttons.forEach((button, index) => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const section = sections[index];
            const scrollOffset = section.offsetLeft - container.offsetLeft;
            container.scrollTo({ left: scrollOffset, behavior: 'smooth' });
        });
    });

    container.addEventListener('scroll', updateActiveButton);

    // Initialize defiler-active button
    updateActiveButton();
});