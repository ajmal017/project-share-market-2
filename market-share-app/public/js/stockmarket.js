$(document).ready(function () {
    'use strict';

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
                        $("#company_details").html("<div class = 'sysoListingResult'><a href='/listing/" + results[0].company_code + "'>" + results[0].company_name + " " + results[0].gics_industry + "</div>");
                        //$("#get_daily_data").html('<input type="button" value="Get Daily Data" id="query_daily_data">');
                    } else {
                        $("#company_details").html("<div class = 'sysoListingResult'>No companies found matching that ASX code</div>");
                    }
                }
            });
        }
    });

    $("#company_name").on('input propertychange', function (e) {
        e.preventDefault();
        if ($('#company_name').val() == '') {
            $("#company_details").html("<div class = 'sysoListingResult'>Start typing a company name</div>");
        } else {
            $.ajax({
                url: "/listing/companyname/" + $('#company_name').val(),
                success: function (results) {
                    $("#company_details").html("");
                    if (results != '') {
                        for(const key in results) {
                            $("#company_details").append("<div class = 'sysoListingResult'><a href='/listing/" + results[key].company_code + "'>" + results[key].company_name + "</a></div>");
                        }
                    } else {
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

    $('.radio_container').change(function () {
        $('#container').html('');
        $('.loading_title').removeAttr('hidden');
        if ($(this).text().trim() == 'Basic') {
            basic_chart();
        } else if ($(this).text().trim() == 'Advanced') {
            advanced_chart();
        }
    });

    $.getJSON('/listing/getrealtime/' + $('#container').attr('class'), function (data) {
        $('.loading_title').attr('hidden', true);
        var title_text = '';
        if (data.length != 0) {
            title_text = $('#container').attr('class') + ' Stock Data';
        } else {
            title_text = 'No stock data available for ' + $('#container').attr('class');
        }
        // split the data set into ohlc and volume
        var ohlc = [],
            dataLength = data.length,
            // set the allowed units for data grouping
            groupingUnits = [[
                'minute',
                [1]
            ]],
            i = 0;

        for (i; i < dataLength; i += 1) {
            ohlc.push([
                data[i][0], // the date
                data[i][4]  // close
            ]);
        }

        // create the chart
        Highcharts.stockChart('container', {
            title: {
                text: 'Stock Price'
            },

            rangeSelector: {
                allButtonsEnabled: true,
                buttons: [{
                    count: 15,
                    type: 'minute',
                    text: '15m'
                }, {
                    count: 30,
                    type: 'minute',
                    text: '30m'
                }, {
                    count: 60,
                    type: 'minute',
                    text: '1h'
                }, {
                    count: 1,
                    type: 'day',
                    text: '1d'
                }, {
                    count: 1,
                    type: 'week',
                    text: '1w'
                }, {
                    type: 'all',
                    text: 'All'
                }],
                selected: 5 // all
            },

            series: [{
                name: $('#container').attr('class'),
                data: ohlc,
                tooltip: {
                    valueDecimals: 2
                }
            }]
        });
    });

    var basic_chart = function () {
        $.getJSON('/listing/getrealtime/' + $('#container').attr('class'), function (data) {
            $('.loading_title').attr('hidden', true);
            var title_text = '';
            if (data.length != 0) {
                title_text = $('#container').attr('class') + ' Stock Data';
            } else {
                title_text = 'No stock data available for ' + $('#container').attr('class');
            }
            // split the data set into ohlc and volume
            var ohlc = [],
                dataLength = data.length,
                // set the allowed units for data grouping
                groupingUnits = [[
                    'minute',
                    [1]
                ]],
                i = 0;

            for (i; i < dataLength; i += 1) {
                ohlc.push([
                    data[i][0], // the date
                    data[i][4]  // close
                ]);
            }

            // create the chart
            Highcharts.stockChart('container', {
                title: {
                    text: 'Stock Price'
                },

                rangeSelector: {
                    allButtonsEnabled: true,
                    buttons: [{
                        count: 15,
                        type: 'minute',
                        text: '15m'
                    }, {
                        count: 30,
                        type: 'minute',
                        text: '30m'
                    }, {
                        count: 60,
                        type: 'minute',
                        text: '1h'
                    }, {
                        count: 1,
                        type: 'day',
                        text: '1d'
                    }, {
                        count: 1,
                        type: 'week',
                        text: '1w'
                    }, {
                        type: 'all',
                        text: 'All'
                    }],
                    selected: 5 // all
                },

                series: [{
                    name: $('#container').attr('class'),
                    data: ohlc,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });
        });
    }
    var advanced_chart = function () {
        $.getJSON('/listing/getrealtime/' + $('#container').attr('class'), function (data) {
            $('.loading_title').attr('hidden', true);
            var title_text = '';
            if (data.length != 0) {
                title_text = $('#container').attr('class') + ' Stock Data';
            } else {
                title_text = 'No stock data available for ' + $('#container').attr('class');
            }
            // split the data set into ohlc and volume
            var ohlc = [],
                dataLength = data.length,
                // set the allowed units for data grouping
                groupingUnits = [[
                    'minute',
                    [1]
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
            }

            // create the chart
            Highcharts.stockChart('container', {

                rangeSelector: {
                    allButtonsEnabled: true,
                    buttons: [{
                        count: 15,
                        type: 'minute',
                        text: '15m'
                    }, {
                        count: 30,
                        type: 'minute',
                        text: '30m'
                    }, {
                        count: 60,
                        type: 'minute',
                        text: '1h'
                    }, {
                        count: 1,
                        type: 'day',
                        text: '1d'
                    }, {
                        count: 1,
                        type: 'week',
                        text: '1w'
                    }, {
                        type: 'all',
                        text: 'All'
                    }],
                    selected: 5 // all
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
                }],

                series: [{
                    type: 'candlestick',
                    name: $('#container').attr('class'),
                    data: ohlc,
                    dataGrouping: {
                        units: groupingUnits
                    }
                }]
            });
        });
    }
});
