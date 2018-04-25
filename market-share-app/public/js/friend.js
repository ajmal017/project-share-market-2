  function addAjax(fid){
    $.ajax({
      url: "/community/add/" + fid,
      type: 'get',
      success: function() {
        console.log("Value Added");
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