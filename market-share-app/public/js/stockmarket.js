$(document).ready(function () {
    var asx_results;

    $("#search_companies").click(function (e) {
        e.preventDefault();
        if ($('#asx_code').val() == '') {
            $("#company_details").html("<b>Enter an ASX code before searching.</b>");
        } else {
            $.ajax({
                url: "/listing/" + $('#asx_code').val(),
                success: function (results) {
                    asx_results = results;
                    if (results != '') {
                        $("#company_details").html("<b>" + results[0]['company_name'] + "</b><br>" + results[0]['gics_industry']);
                        $("#get_daily_data").html('<input type="button" value="Get Daily Data" id="query_daily_data">');
                    } else{
                        $("#company_details").html("<b>No companies found matching that ASX code</b>");
                    }
                }
            }); 
        }
    });
});
