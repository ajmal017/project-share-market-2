$(document).ready(function () {
    var asx_results;

    $("#search_companies").click(function (e) {
        e.preventDefault();
        if ($('#asx_code').val() == '') {
            $("#company_details").html("<div class = 'sysoListingResult'>Enter an ASX code before searching</div>");
        } else {
            $.ajax({
                url: "/listing/companycode/" + $('#asx_code').val(),
                success: function (results) {
                    asx_results = results;
                    if (results != '') {
                        //$("#company_details").html("<b>" + results[0]['company_name'] + "</b><br>" + results[0]['gics_industry']);
                        $("#company_details").html("<div class = 'sysoListingResult'><a href='/listing/" + results[0].company_code + "'>" + results[0]['company_name'] + " " + results[0]['gics_industry'] + "</div>");
                        //$("#get_daily_data").html('<input type="button" value="Get Daily Data" id="query_daily_data">');
                    } else{
                        $("#company_details").html("<div class = 'sysoListingResult'>No companies found matching that ASX code</div>");
                    }
                }
            });
        }
    });

    $("#company_name").on('input propertychange', function (e) {
        e.preventDefault();
        if ($('#company_name').val() == '') {
            //$("#company_name_dropdown").html("<option disabled value=''>Start typing a company name</option>");
            $("#company_details").html("<div class = 'sysoListingResult'>Start typing a company name</div>");
        } else {
            $.ajax({
                url: "/listing/companyname/" + $('#company_name').val(),
                success: function (results) {
                    $("#company_details").html("");
                    //$("#company_name_dropdown").html("<option value=''></option>");
                    if (results != '') {
                        
                        for (const key in results) {
                            //$("#company_name_dropdown").append("<option value='" + results[key].company_code + "'>" + results[key].company_name + "</option>");
                            
                            $("#company_details").append("<div class = 'sysoListingResult'><a href='/listing/" + results[key].company_code + "'>" + results[key].company_name + "</a></div>");
                            //$("#company_details").append("<div class = 'sysoListingResult'>" + results[key].company_name + "</div>");
                        }                       
                    } else {
                        //$("#company_name_dropdown").html("<option disabled value=''>No companies found, try again</option>");
                        $("#company_details").html("<div class = 'sysoListingResult'>No companies found - Please try again</div>");
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
                    $("#company_details").html("<div class = 'sysoListingResult'>No companies found matching that ASX code</div>");
                }
            }
        });
    });


    /**
     * Load new data depending on the selected min and max
     */
    function afterSetExtremes(e) {

        var chart = Highcharts.charts[0];

        chart.showLoading('Loading data from server...');
        $.getJSON('https://www.highcharts.com/samples/data/from-sql.php?start=' + Math.round(e.min) +
            '&end=' + Math.round(e.max) + '&callback=?', function (data) {
                chart.series[0].setData(data);
                chart.hideLoading();
            });
    }

    // See source code from the JSONP handler at https://github.com/highcharts/highcharts/blob/master/samples/data/from-sql.php
    $.getJSON('https://www.highcharts.com/samples/data/from-sql.php?callback=?', function (data) {

        // Add a null value for the end date
        data = [].concat(data, [[Date.now(), null, null, null, null]]);

        // create the chart
        Highcharts.stockChart('container', {
            chart: {
                type: 'candlestick',
                zoomType: 'x'
            },

            navigator: {
                adaptToUpdatedData: false,
                series: {
                    data: data
                }
            },

            scrollbar: {
                liveRedraw: false
            },

            title: {
                text: 'Monthly Stock Market Data'
            },

            subtitle: {
                text: 'Displaying 1.7 million data points in Highcharts Stock by async server loading'
            },

            rangeSelector: {
                buttons: [{
                    type: 'month',
                    count: 1,
                    text: '1m'
                }, {
                    type: 'year',
                    count: 1,
                    text: '1y'
                }, {
                    type: 'all',
                    text: 'All'
                }],
                inputEnabled: false, // it supports only days
                selected: 2 // all
            },

            xAxis: {
                events: {
                    afterSetExtremes: afterSetExtremes
                },
                minRange: 3600 * 1000 // one hour
            },

            yAxis: {
                floor: 0
            },

            series: [{
                data: data,
                dataGrouping: {
                    enabled: false
                }
            }]
        });
    });
});
