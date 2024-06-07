var global_chart;
var sales_chart;

window.onload = function(){
    submitForm();
}
function submitForm() {
    function getRandomIntMultipleOf100(min, max) {
        const minMultiple = Math.ceil(min / 100);
        const maxMultiple = Math.floor(max / 100);
        return Math.floor(Math.random() * (maxMultiple - minMultiple + 1) + minMultiple) * 100;
    }

    const labels = Array.from({ length: 31 }, (_, i) => (i + 1).toString());
    const sales = Array.from({ length: 31 }, () => getRandomIntMultipleOf100(1000, 5000));
    const charges = Array.from({ length: 31 }, () => getRandomIntMultipleOf100(1000, 5000));
    const results = Array.from({ length: 31 }, () => getRandomIntMultipleOf100(1000, 5000));
    const sales_figures = Array.from({ length: 31 }, () => getRandomIntMultipleOf100(1000, 5000));

    const totalSales = sales.reduce((acc, val) => acc + val, 0);
    const totalCharges = charges.reduce((acc, val) => acc + val, 0);
    const totalResults = results.reduce((acc, val) => acc + val, 0);

    const data = {
        sales: totalSales,
        charges: totalCharges,
        results: totalResults,
        chartData: {
            labels: labels,
            sales: sales,
            charges: charges,
            results: results,
            sales_figures: sales_figures
        }
    };

    console.log(data);

    // Mettre à jour les valeurs sur la page
    document.getElementById('sales').innerText = data.sales + ' Ar';
    document.getElementById('charges').innerText = data.charges + ' Ar';
    document.getElementById('results').innerText = data.results + ' Ar';

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
                    min : 500,
                    max : 6000
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
                    min : 500,
                    max : 6000
                }
            }
        }
    });
}