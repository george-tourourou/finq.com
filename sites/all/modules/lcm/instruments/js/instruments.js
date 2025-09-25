(function ($, Drupal) {

    function tooltip_init(context) {
        var $tooltip = $("<div id='tooltip-popup'></div>").appendTo("body");
        $("a.tp[title]", context).each(function (index, item) {
            var tooltipText = $(item).attr("title");
            if (!tooltipText) {
                return true;
            }
            $(item)
                .removeAttr("title")
                .mouseout(function () {
                    $tooltip.css({display: "none"});
                })
                .mousemove(function (kmouse) {
                    $tooltip.css({left: kmouse.pageX + 15, top: kmouse.pageY + 15});
                })
                .mouseover(function () {
                    $tooltip.html(tooltipText);
                    $tooltip.css({display: "block"});
                });
        });
    }

    Drupal.Instruments = (function () {
        var REALTIME_DATA_REQUEST_INTERVAL = 5000;
        var CHART_DATA_REQUEST_INTERVAL = 1000;


        var availableIntervals = ['5m', '15m', '30m', '1h', '2h', '4h', '1d', '1w'];
        var availableTypesOfChart = {'l': 'line', 'c': 'candlestick'};
        var highchartsParams = {
            chart: {
                renderTo: 'container',
                backgroundColor: '#121216',
                marginRight: 40,
                marginTop: 70,
                marginLeft: 10,
                marginBottom: 23
            },
            navigator: {
                adaptToUpdatedData: true,
                height: 16,
                maskInside: false,
                maskFill: 'rgba(34, 38, 43, 0.75)',
                outlineColor: '#373739',
                outlineWidth: 1,
                margin: 10
            },
            rangeSelector: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                candlestick: {
                    upColor: "#029702",
                    upLineColor: "#029702",
                    color: "#DD3131",
                    lineColor: "#DD3131",
                    dataGrouping: {
                        enabled: false
                    }
                },
                line: {
                    color: "#5B5B5D", // #FFFFFF
                    gapSize: 1000,
                    dataGrouping: {
                        enabled: false
                    },
		            lineWidth: 1
                }
            },
            tooltip: {
                positioner: function (labelWidth, labelHeight, point) {
                    var tooltipX, tooltipY;
                    if (point.plotX + chart.plotLeft < labelWidth && point.plotY + labelHeight > chart.plotHeight) {
                        tooltipX = chart.plotLeft;
                        tooltipY = chart.plotTop + chart.plotHeight - 2 * labelHeight - 10;
                    } else {
                        tooltipX = chart.plotLeft;
                        tooltipY = chart.plotTop + chart.plotHeight - labelHeight;
                    }
                    return {
                        x: tooltipX,
                        y: tooltipY
                    };
                },
                formatter: function() {
                    var s=' ';
                    $.each(this.points, function(i, series) {
                        //console.log(series);
                        n=new Date(series.point.x);
                        var dateOtions = {
                            //era: 'long',
                            //year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            weekday: 'long',
                            timezone: 'UTC',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                            //second: 'numeric'
                        };
                        if(i==0) {
                            s += n.toLocaleString("en-US", dateOtions) + " | <span style='text-transform: uppercase;'>" + this.series.name + "</span> | ";
                            //s += ("0" + n.getDate()).slice(-2) + "/" + ("0" + (n.getMonth() + 1)).slice(-2) + "/" + n.getFullYear() + " | <span style='text-transform: uppercase;'>" + this.series.name + "</span> | ";
                        }
                        if(series.point.open  != undefined) {
                            s += 'Open: ' + series.point.open + ' High: ' + series.point.high + ' Low: ' + series.point.low + ' Close: ' + series.point.close;
                            //s += 'Open: <span style="font-weight:bold">' + series.point.open + '</span> Close: <span style="font-weight:bold">' + series.point.close + '</span> High: <span style="font-weight:bold">' + series.point.high + '</span> Low: <span style="font-weight:bold">' + series.point.low + '</span>';
                        }
                        else {
                            s += this.y;
                        }
                    });
                    return s;
                },
                shadow: false,
                shared: true,
                borderWidth: 0,
                //backgroundColor: 'rgba(255,255,255,0.8)',
                backgroundColor: 'transparent',
                borderColor: "#607B8B",
                yDecimals: 2,
                useHTML: true,
                style: {
                    color: "#c6c6c6",
                    fontSize: "10px"
                }
            },
            xAxis: {
                ordinal: true,
		        gridLineWidth: 1,
		        gridLineColor: '#212123',
                tickWidth: 0,
                lineColor: '#212123',
                offset: 20,
                labels: {
                    y: -4,
                    style: {
                        color: '#C7C7C8'
                    }
                }
            },
	        yAxis: {
		        gridLineWidth: 1,
		        gridLineColor: '#212123',
                showFirstLabel: false,
                offset: 20,
                labels: {
                    align: (location.href.search("/ar/") === -1 ? "left" : "right"),
                    x: -15,
                    y: 4,
                    style: {
                        color: '#C7C7C8'
                    }
                }
	        },
            scrollbar: {
                enabled: false
            },
            series: []
        };

        var failCounter = 0;
        var chart = null;
        var $chartControlsContainer = null;
        var $widgetChartControlContainer = null;
        var $chartTypesContainer = null;
        var $chartInstrumentsContainer = null;
        var $chartControlsContainerItem = null;
        var $instrumentInformationContainer = null;
        var instrumentRealtimeDataContainer = {
            'buy': null,
            'sell': null,
            'change': null,
            'high': null,
            'low': null
        };
        var $chartTradeLink = null;
        var $chartPoweredByLink = null;

        var initiated = false;

        var instrumentSymbol = null;
        var instrumentSymbolData = null;

        var realtimeData = null;
        var seriesType = 'c';
        var currentResolutionLevel = availableIntervals[0];

        /**
         * Read configurations, prepare caches & etc.
         */
        var init = function () {
            if (initiated) return;
            initiated = true;

            instrumentSymbol = Drupal.settings.instrumentSymbol;
            instrumentSymbolData = Drupal.settings.instrumentSymbolSensitive;
            seriesType = (Drupal.settings.chart_type != undefined) ? Drupal.settings.chart_type : 'c';
            currentResolutionLevel = (Drupal.settings.chart_interval != undefined) ? Drupal.settings.chart_interval : availableIntervals[0];
            $instrumentInformationContainer = $('.instrument-info');


            $.each(instrumentRealtimeDataContainer, function (index, element) {
                var tmp = $('[data-value="' + index + '"]');
                if (tmp.length) {
                    instrumentRealtimeDataContainer[index] = tmp;
                }
            });

            initGettingRealtimeData();
            initChart();
            updateSeries(true);
            sendSymbol(instrumentSymbolData);
            sendSymbolInstrumentWidget(instrumentSymbolData);
        };

        var initGettingRealtimeData = function () {
            getRealtimeData();
        };

        var getRealtimeData = function () {
            ///@TODO should use &.jsonp
            $.ajax({
                url: Drupal.settings.instruments.instrumentsRealTimeData,
                cache: false,
                jsonpCallback: 'callbackQuotes',
                dataType: 'jsonp',
                data: {
                    q: instrumentSymbol, //instrument
                    key: 1
                }
            })
                .done(function (data) {
                    onGetRealtimeData(data);
                    failCounter = 0;
                    setTimeout(getRealtimeData, REALTIME_DATA_REQUEST_INTERVAL);
                })
                .fail(function () {
                    failCounter++;
                    setTimeout(getRealtimeData, REALTIME_DATA_REQUEST_INTERVAL * failCounter);
                });
        };

        var onGetRealtimeData = function (data) {
            //by default we show progress indicator for user, so we should hide it when got some data
            if (realtimeData === null) {
                removeProgressIndicator();
            }
            realtimeData = data[instrumentSymbol];
            updateRealtimeData();
        };

        var removeProgressIndicator = function () {
            $instrumentInformationContainer.find('.progress').remove();
        };

        var initChart = function () {
            Highcharts.setOptions({
                global: {
                    useUTC: false // @todo: need to verify compliance with this setting and the date in the chart`s tooltip for different timezones/locales
                }
            });
            $chartControlsContainer = $(".chart_control");
            $chartTypesContainer = $(".chart_type");
            $chartInstrumentsContainer = $(".chart_instrument");
            $widgetChartControlContainer = $("#content-widget .chart_control");
            $chartTradeLink = $(".trade-link a");
            $chartPoweredByLink = $("#content-widget a.more-quotes");

            if($chartInstrumentsContainer.length == 1){

                Drupal.Infra.cachedAjaxRequest(Drupal.settings.basePath +
                    Drupal.settings.instruments.instrumentSearchDataPath, function (data) {
                    $.each(data, function (index, instrument) {
                        var option = $('<option>')
                            .attr('value', instrument.value)
                            .html(instrument.label);
                        if(instrumentSymbol == instrument.value){
                            option.attr('selected', true);
                        }
                        option.appendTo($chartInstrumentsContainer);
                    });
                    $chartInstrumentsContainer.on('change', function () {
                        instrumentSymbol = $(this).val();
                        updateSeries(true);
                        if ($chartPoweredByLink !==null && typeof $chartPoweredByLink !== 'undefined') {
                            $chartPoweredByLink.attr('href','/instruments/' + instrumentSymbol);
                        }
                        updateSymbolInstrumentWidget(instrumentSymbol);
                    });
                });




            }

            chart = new Highcharts.StockChart(highchartsParams);

            $.each(availableIntervals, function (index, value) {
                var option = $('<a>')
                    .attr('data-id', index)
                    .attr('data-value', value)
                    .html(value);
                if (currentResolutionLevel == value ) {
                    option.addClass('active');
                }
                option.appendTo($chartControlsContainer);
            });

            $chartControlsContainerItem = $(".chart_control a");
            $chartControlsContainerItem.on('click', function () {
                $(".chart_control a").removeClass('active');
                $(this).addClass('active');
                currentResolutionLevel = availableIntervals[$(this).data('id')];
                updateSeries(true);
            });

            $widgetChartControlContainer.on('click',function(){
                if ($(this).hasClass('opened')) {
                    $(this).removeClass('opened');
                    $(this).find("a").not(".active").hide();
                } else {
                    $(this).addClass('opened');
                    $(this).find("a").css("display","block");
                }
            });



            var chartTypeObj = [];
            $.each(availableTypesOfChart, function (index, value) {
                chartTypeObj.push(index);
            });

            var $chartTypeId = 1;
            var $chartTypeCount = chartTypeObj.length;
            $chartTypesContainer.on('click', function () {
                $(this).removeClass(chartTypeObj[$chartTypeId]);
                $chartTypeId++;
                if($chartTypeId >= $chartTypeCount){
                    $chartTypeId = 0;
                }

                seriesType = chartTypeObj[$chartTypeId];

                updateSeries(true);
                $(this).addClass(chartTypeObj[$chartTypeId]);
            });

        };

        var updateSeries = function (retry) {
            if (typeof retry === 'undefined') {
                retry = false;
            }

            chart.showLoading();

            var seriesLength = chart.series.length;
            var navigator;
            for(var i = seriesLength - 1; i > -1; i--) {
                if(chart.series[i].name.toLowerCase() == 'navigator') {
                    navigator = chart.series[i];
                } else {
                    chart.series[i].remove(false);
                }
            }

            chart.redraw();


            $.jsonp({
                url: Drupal.settings.instruments.instrumentsChartsData + "&callback=?",
                callback: 'getChartsCallback', //defined because data service does not support "_" in callback names
                data: {
                    q: instrumentSymbol,//instrument
                    resolution: currentResolutionLevel,
                    type: seriesType
                },
                success: function (data, textStatus, xOptions) {
                    if (data != null && data != "" && typeof data === 'object' && data.length) {
                        chart.addSeries(
                            {
                                type: availableTypesOfChart[seriesType],
                                name: instrumentSymbol,
                                data: data
                            }
                        );
                    }
                    chart.hideLoading();
                },
                error: function (xOptions, textStatus) {
                    if (retry) {
                        setTimeout(updateSeries, CHART_DATA_REQUEST_INTERVAL);
                    }
                }

            });
        };

        var updateRealtimeData = function () {
            $.each(instrumentRealtimeDataContainer, function (index, element) {
                if (element !== null && typeof realtimeData[index] !== 'undefined') {
                    element.html(realtimeData[index]);
                }
            });
            if (realtimeData['change'][0] !== '-') {
                if(instrumentRealtimeDataContainer['change'] !== null && typeof instrumentRealtimeDataContainer['change'] !== 'undefined') {
                    instrumentRealtimeDataContainer['change'].removeClass('down').addClass('up');
                }
            }
            else {
                if(instrumentRealtimeDataContainer['change'] !== null && typeof instrumentRealtimeDataContainer['change'] !== 'undefined') {
                    instrumentRealtimeDataContainer['change'].removeClass('up').addClass('down');
                }
            }
        };

        var sendSymbol = function(symbol) {
            var class_of_links = ['buy', 'sell'];
            var params = 'path=details&symbol=' + symbol;

            $.each(class_of_links, function (index, element) {
                var path = $instrumentInformationContainer.find('.buttons .' + element + ' a').attr('href');
                if (path && path.indexOf('?') > -1) {
                    $('.' + element + ' a').attr('href', path + '&' + params);
                }
                else {
                    $('.' + element + ' a').attr('href', path + '?' + params);
                }
            });
        };

        var sendSymbolInstrumentWidget = function(symbol) {
            var params = 'path=details&symbol=' + symbol;
            if (typeof $chartTradeLink.attr('href') !== typeof undefined && $chartTradeLink.attr('href') !== false) {
               if ($chartTradeLink.attr('href').indexOf('?') > -1) {
                   $chartTradeLink.attr('href', $chartTradeLink.attr('href') + '&' + params);
               }
               else {
                   $chartTradeLink.attr('href', $chartTradeLink.attr('href') + '?' + params);
               }
            }
        };

        var updateUrlParameter = function(url, param, value){
            var regex = new RegExp('('+param+'=)[^\&]+');
            return url.replace( regex , '$1' + value);
        }

        var updateSymbolInstrumentWidget = function(symbol) {
            $chartTradeLink.attr('href', updateUrlParameter($chartTradeLink.attr('href'),'symbol',symbol));
        };

        return {
            init: init
        }
    }());

    Drupal.behaviors.instrumentsBehavior = {
        attach: function (context, settings) {
            Drupal.Instruments.init();
            tooltip_init(context);
        },
        weight: 10
    }
})(jQuery, Drupal);

