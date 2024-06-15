document.addEventListener('DOMContentLoaded', function() {
    const starInputs = document.querySelectorAll('.stars-div input[name="stars"]');
    
    starInputs.forEach(starInput => {
        starInput.addEventListener('change', () => {
            const selectedValue = starInput.value;
            
            starInputs.forEach(input => {
                const label = input.parentElement;
                if (input.value <= selectedValue) {
                    label.classList.add('selected');
                } else {
                    label.classList.remove('selected');
                }
            });
        });
    });
});
