const cost = 5000;
var frontoffice_app = angular.module('frontofficeApp', []);
function formatNumber(number, decimals = 2, dec_point = '.', thousands_sep = ' ') {
    // Convertir le nombre en chaîne et séparer la partie entière de la partie décimale
    let [integerPart, decimalPart] = parseFloat(number).toFixed(decimals).split('.');

    // Gérer le cas où integerPart devient "1000" à cause de parseFloat
    if (integerPart.includes('e')) {
        integerPart = parseInt(number).toFixed(decimals).split('.')[0];
        decimalPart = parseInt(number).toFixed(decimals).split('.')[1];
    }
    // Ajouter le séparateur de milliers à la partie entière
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);

    // Retourner la chaîne formatée avec le point décimal et la gestion des décimales
    if (decimalPart === undefined) {
        return integerPart;
    } else {
        return integerPart + dec_point + decimalPart;
    }
}

frontoffice_app.controller('heartController', function($http) {
    function toggleSrc(text, change) {
        if (change === "disable") {
            return text.replace(/\benable\b/g, 'disable');
        }
        return text.replace(/\bdisable\b/g, 'enable');
    }
    window.onload = function() {
        // Gestion des cases à cocher avec la classe "heart"
        const hearts = document.querySelectorAll('input[type="checkbox"].heart');

        if (client_favoris.length > 0) {
            for (let i = 0; i < client_favoris.length; i++) {
                let heartsWithSameId = document.querySelectorAll(`input[type="checkbox"].heart[id="heart-${client_favoris[i]}"]`);

                heartsWithSameId.forEach(heartWithSameId => {
                    heartWithSameId.checked = true;
                    const label = heartWithSameId.parentNode;
                    const img = label.querySelector('img');

                    if (img) {
                        img.src = img.src.replace('disable', 'enable');
                    }
                });
            }
        }

        hearts.forEach(heart => {
            heart.addEventListener('change', function() {
                
                const id = this.id;
                let heartsWithSameId = document.querySelectorAll(`input[type="checkbox"].heart[id="${id}"]`);

                heartsWithSameId.forEach(heartWithSameId => {
                    const label = heartWithSameId.parentNode;
                    const img = label.querySelector('img');

                    if (img) {
                        if (this.checked) {
                            img.src = toggleSrc(img.src, 'enable');
                        } else {
                            img.src = toggleSrc(img.src, 'disable');
                        }
                    }
                });

                let id_product = id.split('-')[1];
                let url;

                if (this.checked) {
                    // Ajouter le produit aux favoris
                    url = site_url + 'frontoffice/Products_Controller/add_products_favoris/' + id_product;
                } else {
                    // Supprimer le produit des favoris
                    url = site_url + 'frontoffice/Products_Controller/delete_products_favoris/' + id_product;
                }

                $http.get(url)
                    .then(function(response) {
                        // Succès de la requête
                        var data = response.data;

                        if (data['error']) {
                            let heartsWithSameId = document.querySelectorAll(`input[type="checkbox"].heart[id="${id}"]`);

                            heartsWithSameId.forEach(heartWithSameId => {
                                const label = heartWithSameId.parentNode;
                                const img = label.querySelector('img');

                                if (img) {
                                        img.src = toggleSrc(img.src, 'disable');
                                        this.checked=false;
                                }
                            });
                        }

                    }, function(error) {
                        document.getElementById("exception").innerHTML = JSON.stringify(error);
                        $('#ExceptionModal').modal('show');
                        
                        let heartsWithSameId = document.querySelectorAll(`input[type="checkbox"].heart[id="${id}"]`);

                        heartsWithSameId.forEach(heartWithSameId => {
                            const label = heartWithSameId.parentNode;
                            const img = label.querySelector('img');

                            if (img) {
                                    img.src = toggleSrc(img.src, 'disable');
                                    this.checked=false;
                            }
                        });
                        // Erreur lors de la requête
                    });
            });
        });

        const starInputs = document.querySelectorAll('.stars-div input[name="stars"]');
    
        starInputs.forEach(starInput => {
            starInput.addEventListener('change', () => {
                const selectedValue = starInput.value;
                
                starInputs.forEach(input => {
                    const label = input.parentNode;
                    const img = label.querySelector('img');
                    if (img) {
                        if (input.value <= selectedValue) {
                            img.src = toggleSrc(img.src, 'enable');
                        } else {
                            img.src = toggleSrc(img.src, 'disable');
                        }
                    }
                });
            });
        });

        // Gestion des cases à cocher dans les icônes de sac (bag)
        const bags = document.querySelectorAll('.bag-icon input[type="checkbox"]');

        bags.forEach(bag => {
            bag.addEventListener('change', function() {
                const optionDiv = this.nextElementSibling.nextElementSibling; // Récupérer le sibling suivant le label, qui est .option

                if (optionDiv != null && optionDiv.classList.contains('option')) {
                    if (this.checked) {
                        optionDiv.style.display = "block";
                    } else {
                        optionDiv.style.display = "none";
                    }
                }
            });
        });

        // Gestion des clics sur les boutons dans les icônes de sac (button)
        const buttons = document.querySelectorAll('.bag-icon .type');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const optionDiv = this.closest('.option'); // Récupérer le div .option qui contient ce bouton

                if (optionDiv != null && optionDiv.classList.contains('option')) {
                    optionDiv.style.display = "none"; // Masquer le div .option
                }

                // Récupérer l'ID du produit à partir de l'ID du bouton
                const id = this.id;
                const id_product = id.split('-')[0];
                const type = id.split('-')[1];

                // Désactiver toutes les cases à cocher associées à ce produit
                const checkboxes = [
                    document.getElementById("check-" + id_product),
                    document.getElementById("new-check-" + id_product),
                    document.getElementById("most-saled-check-" + id_product)
                ];
                checkboxes.forEach(checkbox => {
                    if (checkbox != null) {
                        checkbox.checked = false;
                    }
                });

                // Faire une requête HTTP pour ajouter le produit au panier avec le type spécifié
                $http.get(site_url + '/frontoffice/Products_Controller/add_products_to_basket/' + id_product + '/' + type)
                    .then(function(response) {
                        // Succès de la requête
                        var data = response.data;
                        if (data['error']) {
                            document.getElementById("exception").innerHTML = data['error'];
                            $('#ExceptionModal').modal('show');
                        }

                    }, function(error) {
                        // Erreur lors de la requête
                        document.getElementById("exception").innerHTML = JSON.stringify(error);
                        $('#ExceptionModal').modal('show');
                    });
            });
        });

        const changeBasketButtons = document.querySelectorAll('.change-basket');

        changeBasketButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.id;
                const id_product = id.split('-')[1];
                const type = id.split('-')[2];
                let quantity_product = 0;

                if (id.startsWith('plus')) {
                    quantity_product = 1;
                } else if (id.startsWith('minus')) {
                    quantity_product = -1;
                } else if (id.startsWith('delete')) {
                    quantity_product = 0;
                }

                $http.get(site_url + '/frontoffice/Products_Controller/add_products_to_basket/' + id_product + '/' + type + '/' + quantity_product)
                .then(function(response) {
                    var data = response.data;
                    if (data['error']) {
                        document.getElementById("exception").innerHTML = data['error'];
                        $('#ExceptionModal').modal('show');
                        return;
                    }
                    const quantityElement = document.getElementById(`quantity-${id_product}-${type}`);
                    const totalElement = document.getElementById(`total-${id_product}-${type}`);
                    let priceText = document.getElementById(`product-price-${id_product}-${type}`).textContent;
                    const cleanedPriceText = priceText.replace(/\D/g, '').replace(" Ar", "").trim();
                    const price = parseInt(cleanedPriceText);

                    let currentQuantity = parseInt(quantityElement.value);

                    const itemDiv = button.closest('.item');
                    if (quantity_product === 0 || (currentQuantity + quantity_product) <= 0) {
                        if (itemDiv) {
                            itemDiv.remove();

                            // Vérifier si le panier est vide après la suppression
                            const basketItems = document.querySelectorAll('.item');
                            const basketItemsContainer = document.querySelector('.item-list');
                            const totalsContainer = document.querySelector('.totals');

                            if (basketItems.length === 0) {
                                basketItemsContainer.innerHTML = '<div class="content"><p>Your basket is empty.</p></div>';
                                totalsContainer.innerHTML = '<div class="content"><p>Your basket is empty.</p></div>';
                            }
                        }
                    } 
                    if(document.querySelectorAll('.total-item').length>0) {
                        currentQuantity += quantity_product;
                        quantityElement.value = currentQuantity;
                        quantityElement.name = currentQuantity;
                        let total = (currentQuantity * price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                        totalElement.textContent = "Total: "+ total + " Ar";
                        const product_prices = document.querySelectorAll('.total-item');

                        let total_prices = 0;

                        product_prices.forEach(product_price => {
                            let price = parseInt(product_price.textContent.replace('Total: ', '').replace(" Ar", "").replace(' ',''));
                            total_prices += price;
                        });

                        document.getElementById("subtotal").textContent = (total_prices).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + " Ar";

                        let reduction_percentage = parseInt(document.getElementById("reduction").textContent.replace('-', '').replace(" Ar", "").trim());

                        let total_after_reduction = (total_prices - (total_prices * (reduction_percentage / 100))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

                        document.getElementById("total").textContent = total_after_reduction + " Ar";
                        const total_payement = parseFloat(total_prices - (total_prices * (reduction_percentage / 100)))+ cost;
                        //alert(total_payement);
                        document.getElementById("total-payment").innerText = total_payement.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + " Ar";

                    }

                }).catch(function(error) {
                    console.error(error);
                    document.getElementById("exception").innerHTML = JSON.stringify(error);
                    $('#ExceptionModal').modal('show');
                });
            });
        });

        const inputQuantities = document.querySelectorAll('input[type="text"].quantity');

        inputQuantities.forEach(inputQuantity => {
            inputQuantity.addEventListener('change', function() {
                const id = this.id;
                const id_product = id.split('-')[1];
                const type = id.split('-')[2];
                let quantity_product = 0;
                if (isNaN(parseInt(this.value))) {
                    document.getElementById("exception").innerHTML = "You should put  number";
                    $('#ExceptionModal').modal('show');
                    this.value=this.name;
                } 
                quantity_product =  parseInt(this.value) - parseInt(this.name);


                
                $http.get(site_url + '/frontoffice/Products_Controller/add_products_to_basket/' + id_product + '/' + type + '/' + quantity_product)
                .then(function(response) {
                    var data = response.data;
                    if (data['error']) {
                        document.getElementById("exception").innerHTML = data['error'];
                        $('#ExceptionModal').modal('show');
                        inputQuantity.value=inputQuantity.name;
                        return;
                    }
                    inputQuantity.name=inputQuantity.value;
                    inputQuantity.value=inputQuantity.name;
                    const totalElement = document.getElementById(`total-${id_product}-${type}`);
                    let priceText = document.getElementById(`product-price-${id_product}-${type}`).textContent;
                    const cleanedPriceText = priceText.replace(/\D/g, '').replace(" Ar", "").trim();
                    const price = parseInt(cleanedPriceText);

                    let currentQuantity = parseInt(inputQuantity.value);
                    const itemDiv = inputQuantity.closest('.item');
                    if (quantity_product === 0 || (currentQuantity + quantity_product) <= 0) {
                        if (itemDiv) {
                            itemDiv.remove();

                            // Vérifier si le panier est vide après la suppression
                            const basketItems = document.querySelectorAll('.item');
                            const basketItemsContainer = document.querySelector('.item-list');
                            const totalsContainer = document.querySelector('.totals');

                            if (basketItems.length === 0) {
                                basketItemsContainer.innerHTML = '<div class="content"><p>Your basket is empty.</p></div>';
                                totalsContainer.innerHTML = '<div class="content"><p>Your basket is empty.</p></div>';
                            }
                        }
                    } 
                    if(document.querySelectorAll('.total-item').length>0) {
                        currentQuantity += quantity_product;
                        let total = (currentQuantity * price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                        totalElement.textContent = "Total: "+ total + " Ar";
                        const product_prices = document.querySelectorAll('.total-item');

                        let total_prices = 0;

                        product_prices.forEach(product_price => {
                            let price = parseInt(product_price.textContent.replace('Total: ', '').replace(" Ar", "").replace(' ',''));
                            total_prices += price;
                        });

                        document.getElementById("subtotal").textContent = (total_prices).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + " Ar";

                        let reduction_percentage = parseInt(document.getElementById("reduction").textContent.replace('-', '').replace(" Ar", "").trim());

                        let total_after_reduction = (total_prices - (total_prices * (reduction_percentage / 100))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

                        document.getElementById("total").textContent = total_after_reduction + " Ar";
                        const total_payement = parseFloat(total_prices - (total_prices * (reduction_percentage / 100)))+ cost;
                        document.getElementById("total-payment").innerText = total_payement.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + " Ar";

                    }

                }).catch(function(error) {
                    console.error(error);
                    document.getElementById("exception").innerHTML = JSON.stringify(error);
                    $('#ExceptionModal').modal('show');
                });
            });
        });
    };
});