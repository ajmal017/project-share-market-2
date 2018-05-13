$(document).ready(function () {
  //The initial data grab
  setTimeout(function () {
    get_friends_list();
  }, 1000); 

  //The ongoing auto-refreshing data grab
  setInterval(function () {
    get_friends_list();
  }, 30000); 

  var get_friends_list = function(){
    $('.friendsTable').html('Loading friends list.....');
    var table_data = '<tr id="tableHeader">' +
      '<th>Name</th>' +
      '<th>Equity</th>' +
      '<th>Balance</th>' +
      '<th>Purchases</th>' +
      '<th>Updated</th>' +
      '</tr>';

    $.ajax({
      url: "/get_friends_list/" + $('.friendsTable').attr('id').replace('userid_', ''),
      success: function (results) {
        if (results != '') {
          $('.friendsTable').html(table_data + results);
        }
      }
    });
  };
});
