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

    $.getJSON('/listing/getmonthly/' + $('#container').attr('class'), function (data) {
        var title_text = '';
        if (data.length != 0) {
            title_text = $('#container').attr('class') + ' Stock Data';
        } else {
            title_text = 'No stock data available for ' + $('#container').attr('class');
        }
        // split the data set into ohlc and volume
        var ohlc = [],
            volume = [],
            dataLength = data.length,
            // set the allowed units for data grouping
            groupingUnits = [[
                'month',
                [1, 2, 3, 4, 6]
            ]],

            i = 0;

        for (i; i < dataLength; i += 1) {
            ohlc.push([
                data[i][0], // the date
                data[i][1], // open
                data[i][2], // high
                data[i][3], // low
                data[i][4]  // close
            ]);

            volume.push([
                data[i][0], // the date
                data[i][5] // the volume
            ]);
        }

        // // create the chart
        Highcharts.stockChart('container', {

            rangeSelector: {
                selected: 4 // all
            },

            title: {
                text: title_text
            },

            yAxis: [{
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Stock Prices'
                },
                height: '60%',
                lineWidth: 2,
                resize: {
                    enabled: true
                }
            }, {
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Volume'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            }],

            tooltip: {
                split: true
            },

            series: [{
                type: 'candlestick',
                name: $('#container').attr('class'),
                data: ohlc,
                dataGrouping: {
                    units: groupingUnits
                }
            }, {
                type: 'column',
                name: 'Volume',
                data: volume,
                yAxis: 1,
                dataGrouping: {
                    units: groupingUnits
                }
            }]
        });
    });
});
