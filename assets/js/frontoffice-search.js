document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.scroll-div-defiler');
    const buttons = document.querySelectorAll('.defiler-option .btn');
    const sections = document.querySelectorAll('.scroll-item');

    

    // Vérifiez si les éléments existent
    if (!container || buttons.length === 0 || sections.length === 0) {
        console.error('Required elements not found in the DOM.');
        return;
    }

    function updateActiveButton() {
        const scrollLeft = container.scrollLeft;
        const containerWidth = container.clientWidth;
        
        buttons.forEach(btn => btn.classList.remove('btn-active'));
        sections.forEach((section, index) => {
            const sectionLeft = section.offsetLeft;
            const sectionRight = sectionLeft + section.offsetWidth;

            if (scrollLeft >= sectionLeft - (containerWidth / 2) && scrollLeft < sectionRight - (containerWidth / 2)) {
                buttons[index].classList.add('btn-active');
            }
        });
    }

    buttons.forEach((button, index) => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const section = sections[index];
            if (section) {
                const scrollOffset = section.offsetLeft - container.offsetLeft;
                container.scrollTo({ left: scrollOffset, behavior: 'smooth' });
            }
        });
    });

    container.addEventListener('scroll', updateActiveButton);

    // Initialize the active button
    updateActiveButton();
});
