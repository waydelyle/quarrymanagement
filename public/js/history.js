
var History = {
    dieselHistoryTableBody: '#diesel-history-table-body',
    oilHistoryTableBody: '#oil-history-table-body',

    init: function(){
    },

    post: function( chartToGet, data ){
        var self = this;

        if(data == undefined){
            data = {
                fromDate: null,
                toDate: null,
            }
        }

        $.post( 'history/' + chartToGet, data)
        .done(function( data ) {
            self.buildTable( parse(data) );
        });
    },

    buildTable: function ( data ){
        var self = this;

        $(self.dieselHistoryTableBody).empty();

        for(var row in data){

            var action = undefined;
            var vehicle = '';

            if(data[row].vehicle != 'no-vehicle'){
                vehicle = data[row].vehicle;
            }

            if(data[row].action == '+'){
                action = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
            } else {
                action = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
            }

            $(self.dieselHistoryTableBody).append(
                '<tr>' +
                '<td>' + vehicle + '</td>' +
                '<td>' + data[row].amount + ' ' + data[row].type + '</td>' +
                '<td>' + action + '</td>' +
                '<td>' + data[row].date + '</td>' +
                '<td>' + data[row].time + '</td>' +
                '<td>' + data[row].auth + '</td>' +
                '</tr>');
        }
    },

};

$(document).ready(function($){

    History.init();
    History.post('diesel');

    $(document).on('click', '#view-diesel-history', function(){
        History.post('diesel', { fromDate: $('#fromDate').val(), toDate: $('#toDate').val()});

        $('#view-oil-history').parent().removeClass('active');
        $('#view-diesel-history').parent().addClass('active');

        return false;
    });

    $(document).on('click', '#view-oil-history', function(){
        History.post('oil', { fromDate: $('#fromDate').val(), toDate: $('#toDate').val()});

        $('#view-oil-history').parent().addClass('active');
        $('#view-diesel-history').parent().removeClass('active');

        return false;
    });

});
