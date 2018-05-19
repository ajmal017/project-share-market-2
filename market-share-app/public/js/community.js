$(document).ready(function () {
  //The initial data grab
  setTimeout(function () {
    top_ten_users();
    top_15_friends();
  }, 1000); 

  //The ongoing auto-refreshing data grab
  setInterval(function () {
    top_ten_users();
    top_15_friends();
  }, 30000); 

  var top_ten_users = function(){
    $('.leaderboardListTable').html('Loading leaderboard list.....');
    var table_data =  '<tr id = "tableHeader">'+
                        '<th>Name</th>'+
                        '<th>Profit</th>'+
                        '<th>Equity</th>'+
                        '<th>Purchases</th>'+
                        '<th>Updated</th>'+
                        '<th></th>'+
                      '</tr>';

    $.ajax({
      url: "/getLeaderboard",
      success: function (results) {
        if (results != '') {
          $('.leaderboardListTable').html(table_data + results);
        } else {
          $('.leaderboardListTable').html("Leaderboard is currently empty");
        }
      }
    });
  };

  var top_15_friends = function(){
    $('.friendListTable').html('Loading top 15 friends list.....');
    var table_data =  '<tr id = "tableHeader">'+
                        '<th>Name</th>'+
                        '<th>Profit</th>'+
                        '<th>Equity</th>'+
                        '<th>Purchases</th>'+
                        '<th>Updated</th>'+
                        '<th></th>'+
                      '</tr>';
    $.ajax({
      url: "/getTopFriends",
      success: function (results2) {
        if (results2 != '') {
          $('.friendListTable').html(table_data + results2);
        } else {
          $('.friendListTable').html("Top 15 friends currently empty");
        }
      }
    });
  };
});
