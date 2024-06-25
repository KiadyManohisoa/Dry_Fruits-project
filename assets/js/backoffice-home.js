var global_chart;
var sales_chart;

var app = angular.module('statApp', []);

function convertToDoubleArray(obj) {
    return Object.values(obj).map(value => parseFloat(value.replace(/ /g, '')));
}
function getCurrentMonthYear() {
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1; // Ajouter 1 car getMonth() retourne de 0 à 11
    var currentYear = currentDate.getFullYear();

    // Formater le mois pour qu'il ait toujours deux chiffres (par exemple, janvier => '01')
    var formattedMonth = ('0' + currentMonth).slice(-2);

    // Retourner la date au format YYYY-MM
    return currentYear + '-' + formattedMonth;
}

app.controller('GraphController', function($scope, $http) {
    window.onload = function(){
        var currentDate = new Date();
        
        // Formater la date pour correspondre à ce que votre API PHP attend (par exemple, ISO8601)
        var formattedDate = getCurrentMonthYear(); 

        $scope.getGraphByDate(formattedDate);
    }

    $scope.getGraphByDate = function(date){
        $http.get(site_url+'/backoffice/Sales_Controller/get_sales_stats/'+date)
        .then(function(response) {
            // Succès de la requête
                var data = response.data;
                submitForm(data.sales,data.charges,data.results,data.sales_figures);
            // Vous pouvez effectuer d'autres actions ici avec les données reçues
        }, function(error) {
            document.getElementById("exception").innerHTML=JSON.stringify(error);
            $('#ExceptionModal').modal('show');
            // Erreur lors de la requête
        });
};
    $scope.getGraph = function() {
        var date = document.getElementById("stat-date").value;
        if (date=="") {
            document.getElementById("exception").innerHTML="You should input the month and year to see the General Report";
            $('#ExceptionModal').modal('show');
        }
        else{
            $http.get(site_url+'/backoffice/Sales_Controller/get_sales_stats/'+date)
                .then(function(response) {
                    // Succès de la requête
                    var data = response.data;
                    submitForm(data.sales,data.charges,data.results,data.sales_figures);
                    // Vous pouvez effectuer d'autres actions ici avec les données reçues
                },function(error) {
                    document.getElementById("exception").innerHTML=JSON.stringify(error);
                    $('#ExceptionModal').modal('show');
                    // Erreur lors de la requête
                });
        }
    };
});

function submitForm(salesTab,chargesTab,resultsTab,sales_figuresTab) {
    const sales = convertToDoubleArray(salesTab);
    const charges = convertToDoubleArray(chargesTab);
    const results = convertToDoubleArray(resultsTab);
    const sales_figures = convertToDoubleArray(sales_figuresTab);
    const labels = Array.from({ length: sales.length }, (_, i) => (i + 1).toString());
    

    const totalSales = sales.reduce((acc, val) => acc + val, 0);
    const totalCharges = charges.reduce((acc, val) => acc + val, 0);
    const totalResults = results.reduce((acc, val) => acc + val, 0);
    const totalSales_figures = sales_figures[sales_figures.length-1];

    const data = {
        sales: totalSales,
        charges: totalCharges,
        results: totalResults,
        sales_figures : totalSales_figures,
        chartData: {
            labels: labels,
            sales: sales,
            charges: charges,
            results: results,
            sales_figures: sales_figures
        }
    };

    // Mettre à jour les valeurs sur la page
    document.getElementById('sales').innerText = data.sales + ' Ar';
    document.getElementById('charges').innerText = data.charges + ' Ar';
    document.getElementById('results').innerText = data.results + ' Ar';
    document.getElementById('sales_figures').innerText = data.sales_figures + ' Ar';

    // Mettre à jour le graphique
    update_global_chart(data.chartData);
    update_sales_chart(data.chartData);
}


function update_global_chart(chartData) {
    var ctx = document.getElementById('global-chart').getContext('2d');
    if (global_chart) {
        global_chart.destroy();
    }
    global_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Results',
                    data: chartData.results,
                    borderColor: '#d2475c',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Charges',
                    data: chartData.charges,
                    borderColor: '#79b09d',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Sales',
                    data: chartData.sales,
                    borderColor: '#aad7c3',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            scales: {
                y: {
                    min : 0,
                }
            }
        }
    });
}

function update_sales_chart(chartData) {
    var ctx = document.getElementById('sales-chart').getContext('2d');
    if (sales_chart) {
        sales_chart.destroy();
    }
    sales_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Sales figures',
                    data: chartData.sales_figures,
                    borderColor: '#d2475c',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            scales: {
                y: {
                    min : 0
                }
            }
        }
    });
}