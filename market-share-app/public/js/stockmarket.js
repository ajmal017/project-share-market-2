$(document).ready(function () {
  var url = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=MSFT&interval=1min&apikey=demo';
  var apiKey = 'PEQIWLTYB0GPLMB8';

  
  moveToCart(url);
});

var moveToCart = function (url) {
  try {
    $.ajax({
      type: 'GET',
      url: url
    })
      .done(function (data) {
        console.log(data);
      })
      .fail(function () {
        alert('Nothing found');
      });
  } catch (e) {
    alert(e);
  }
};