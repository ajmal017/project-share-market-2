  function addAjax(fid){
    $.ajax({
      url: "/community/add/" + fid,
      type: 'get',
      success: function(data) {
        if (!data) {
          console.log("Value Added");
        } 
        else {
          alert("Friend already exists");
        }
      }
    });
  }

  function deleteAjax(fid) {
    $.ajax({
      url: "/community/delete/" + fid,
      type: 'get',
      success: function () {
        console.log("Value Removed");
      }
    });
  }