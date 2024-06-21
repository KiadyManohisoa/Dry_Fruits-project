var deliveryckeck_app = angular.module('deliveryckeckApp', []);

deliveryckeck_app.controller('checkedController', function($scope, $http) {
    window.onload = function(){
        const deliveries = document.querySelectorAll('input[type="checkbox"].delivery-check');

        deliveries.forEach(delivery => {
            delivery.addEventListener('change', function() {
                if (!this.checked) {
                    $http.get(site_url+'/backoffice/Delivery_Controller/unvalidate_delivery/'+delivery.id)
                    .then(function(response) {
                    }, function(error) {
                        document.getElementById("exception").innerHTML=JSON.stringify(error);
                        $('#ExceptionModal').modal('show');
                        // Erreur lors de la requête
                    });
                }
                else{
                    $http.get(site_url+'/backoffice/Delivery_Controller/validate_delivery/'+delivery.id)
                    .then(function(response) {
                    }, function(error) {
                        document.getElementById("exception").innerHTML=JSON.stringify(error);
                        $('#ExceptionModal').modal('show');
                        // Erreur lors de la requête
                    });
                }
            });
        });
    };

});