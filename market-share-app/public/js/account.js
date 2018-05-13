$(document).ready(function () {
  //The initial data grab
  setTimeout(function () {
    get_transactions_list();
    get_friends_list();
  }, 1000); 

  //The ongoing auto-refreshing data grab
  setInterval(function () {
    get_friends_list();
    get_transactions_list();
  }, 30000); 

  var get_friends_list = function(){
    $('.friendsTable').html('Loading friends list.....');
    var table_data =  '<tr id="tableHeader">' +
                        '<th>Name</th>' +
                        '<th>Equity</th>' +
                        '<th>Balance</th>' +
                        '<th>Purchases</th>' +
                        '<th>Updated</th>' +
                      '</tr>';

    $.ajax({
      url: "/getFriendsList/" + $('.friends').attr('id').replace('userid_', ''),
      success: function (results) {
        if (results != '') {
          $('.friendsTable').html(table_data + results);
        } else {
          $('.friendsTable').html("Friends list is currently empty");
        }
      }
    });
  };

  var get_transactions_list = function(){
    $('.transactionTable').html('Loading transaction list.....');
    var table_data =  '<tr id="tableHeader">'+
                          '<th>Code</th>'+
                          '<th>Quantity</th>'+
                          '<th>Sold</th>'+
                          '<th>Fees</th>'+
                          '<th>Date</th>'+
                      '</tr>';
    $.ajax({
      url: "/getRecentTransactions/" + $('.friends').attr('id').replace('userid_', ''),
      success: function (results2) {
        if (results2 != '') {
          $('.transactionTable').html(table_data + results2);
        } else {
          $('.transactionTable').html("No recent closed transactions");
        }
      }
    });
  };
});
