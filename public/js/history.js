
var History = {
    init: function(){
        google.charts.load('current', {packages: ['corechart', 'bar']});
    },

    get: function( chartToGet ){
        $.get( 'stats/' + chartToGet , function( data ) {
            chartData = parse(data);
            google.charts.setOnLoadCallback(drawDualX);

            function drawDualX() {
                var data = google.visualization.arrayToDataTable(chartData);

                var chartAreaHeight = data.getNumberOfRows() * 30;

                var chartHeight = chartAreaHeight + 500;
                var chart = new google.visualization.BarChart(document.querySelector('#' + chartToGet + 'Chart'));

                var options = {
                    height: chartHeight,
                    bars: 'verticle'
                };
                var material = new google.charts.Bar(document.getElementById(chartToGet + 'Chart'));
                material.draw(data, options);
            }
        });
    }
};

$(document).ready(function($){

    Chart.init();

    Chart.get('diesel');

    $(document).on('click', '#loadOilChart', function(){
        Chart.get('oil');
    });

});
