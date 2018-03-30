$(document).ready(function () {
    var apiKey = 'PEQIWLTYB0GPLMB8';
    var url = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=CWN&interval=1min&apikey='+apiKey;

    
    // moveToCart(url);

    var myChart = Highcharts.chart('container', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Fruit Consumption'
        },
        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Jane',
            data: [1, 0, 4]
        }, {
            name: 'John',
            data: [5, 7, 3]
        }]
    });

    
});



var moveToCart = function (url) {
    var dates = [];
    var volume = [];
    try {
        $.ajax({
        type: 'GET',
        url: url
        })
        .done(function (data) {
            for (var time_series in data['Time Series (1min)']){
                dates.push(time_series);  
                volume.push(data['Time Series (1min)'][time_series]['5. volume']);  
            }

            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: '# of Votes',
                        data: volume,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        })
        .fail(function () {
            alert('Nothing found');
        });
    } catch (e) {
    alert(e);
    }

    
};