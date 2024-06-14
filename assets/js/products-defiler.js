class ScrollDefiler {
    constructor(container) {
        this.container = container.querySelector('.product-container');
        this.nextBtn = container.querySelector('.next-btn');
        this.prevBtn = container.querySelector('.prev-btn');
        this.containerWidth = this.container.offsetWidth;

        this.setupListeners();
        this.updateButtonState();
    }

    setupListeners() {
        this.nextBtn.addEventListener('click', () => {
            this.container.scrollBy({ left: this.containerWidth, behavior: 'smooth' });
            this.updateButtonState();
        });

        this.prevBtn.addEventListener('click', () => {
            this.container.scrollBy({ left: -this.containerWidth, behavior: 'smooth' });
            this.updateButtonState();
        });

        this.container.addEventListener('scroll', () => {
            this.updateButtonState();
        });
    }

    updateButtonState() {
        const scrollLeft = this.container.scrollLeft;
        const scrollWidth = this.container.scrollWidth;
        const clientWidth = this.container.clientWidth;

        if (scrollLeft <= 0) {
            this.prevBtn.disabled = true;
        } else {
            this.prevBtn.disabled = false;
        }

        if (scrollLeft + clientWidth >= scrollWidth) {
            this.nextBtn.disabled = true;
        } else {
            this.nextBtn.disabled = false;
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const defilerContainers = document.querySelectorAll('.products-defiler');
    defilerContainers.forEach(container => new ScrollDefiler(container));
});
