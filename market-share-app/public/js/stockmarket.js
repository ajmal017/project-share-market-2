$(document).ready(function () {
    var asx_results;

    $("#search_companies").click(function (e) {
        e.preventDefault();
        if ($('#asx_code').val() == '') {
            $("#company_details").html("<b>Enter an ASX code before searching.</b>");
        } else {
            $.ajax({
                url: "/listing/companycode/" + $('#asx_code').val(),
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

    $("#company_name").on('input propertychange', function (e) {
        e.preventDefault();
        if ($('#company_name').val() == '') {
            $("#company_name_dropdown").html("<option disabled value=''>Start typing a company name</option>");
        } else {
            $.ajax({
                url: "/listing/companyname/" + $('#company_name').val(),
                success: function (results) {
                    $("#company_name_dropdown").html("<option value=''></option>");
                    if (results != '') {
                        for (const key in results) {
                            $("#company_name_dropdown").append("<option value='" + results[key].company_code + "'>" + results[key].company_name + "</option>");
                        }                       
                    } else {
                        $("#company_name_dropdown").html("<option disabled value=''>No companies found, try again</option>");
                    }
                }
            });
        }
    });

    $('select[name="company_name_dropdown"]').change(function () {
        $.ajax({
            url: "/listing/companycode/" + $(this).val(),
            success: function (results) {
                if (results != '') {
                    $('#asx_code').val(results[0]['company_code']);
                    $("#company_details").html("<b>" + results[0]['company_name'] + "</b><br>" + results[0]['gics_industry']);
                    $("#get_daily_data").html('<input type="button" value="Get Daily Data" id="query_daily_data">');
                } else {
                    $("#company_details").html("<b>No companies found matching that ASX code</b>");
                }
            }
        });
    });
});
