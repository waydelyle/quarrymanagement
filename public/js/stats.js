var Chart = {
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

                var chartHeight = chartAreaHeight + 150; var chart = new google.visualization.BarChart(document.querySelector('#displayChart'));

                var options = {
                    height: chartHeight,
                    bars: 'verticle'
                };
                var material = new google.charts.Bar(document.getElementById('displayChart'));
                material.draw(data, options);
            }
        });
    }
};

$(document).ready(function($){

    Chart.init();

    Chart.get('diesel');

    $(document).on('click', '#loadDieselChart', function(){
        Chart.get('diesel');
    });

    $(document).on('click', '#loadOilChart', function(){
        Chart.get('oil');
    });
});
