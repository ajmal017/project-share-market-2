  function callAjax(fid){
    $.ajax({
      url: "/community/" + fid,
      type: 'get',
      success: function() {
        console.log("Valueadded");
      }
    });
  }