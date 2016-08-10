var addDieselForm = $('#add-diesel-form'),
    subtractDieselForm = $('#subtract-diesel-form');

$(document).on('click', '#add-diesel-submit', function(){
    $.post( 'diesel/add', addDieselForm.serialize())
        .done(function( data ) {
            data = parse(data);

            if(data.action == '+'){
                data.action = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
            } else {
                data.action = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
            }

            var newRow = '<tr>' +
                '<td>' + data.vehicle + '</td>' +
                '<td>' + data.amount + '</td>' +
                '<td>' + data.action + '</td>' +
                '<td>' + data.meter + '</td>' +
                '<td>' + data.date + '</td>' +
                '<td>' + data.time + '</td>' +
                '<td>' + data.auth + '</td>' +
                '<td><button type="button" class="btn btn-xs btn-danger delete-diesel diesel-' + data.id + '" id="' + data.id +'">' +
                '<span class="glyphicon glyphicon-remove" aria-hidden="true">' +
                '</span>' +
                '</button>' +
                '</td></tr>';

            $('#diesel-table-body').append(newRow);
            $('#diesel-amount').val('');
        });

    return false;
});

$(document).on('click', '#subtract-diesel-submit', function(){
    $.post( 'diesel/subtract', subtractDieselForm.serialize())
        .done(function( data ) {
            data = parse(data);

            if(data.action == '+'){
                data.action = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
            } else {
                data.action = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
            }

            var newRow = '<tr>' +
                '<td>' + data.vehicle + '</td>' +
                '<td>' + data.amount + '</td>' +
                '<td>' + data.action + '</td>' +
                '<td>' + data.meter + '</td>' +
                '<td>' + data.date + '</td>' +
                '<td>' + data.time + '</td>' +
                '<td>' + data.auth + '</td>' +
                '<td><button type="button" class="btn btn-xs btn-danger delete-diesel diesel-' + data.id + '" id="' + data.id +'">' +
                '<span class="glyphicon glyphicon-remove" aria-hidden="true">' +
                '</span>' +
                '</button>' +
                '</td></tr>';

            $('#diesel-table-body').append(newRow);
            $('#diesel-amount').val('');
        });

    return false;
});

$(document).on('click', '.delete-diesel', function(){

    var id = this.id;

    $.post( 'diesel/delete', {'id': id})
        .done(function( data ) {
            $( '.diesel-' + id ).closest('tr').remove();
        });

    return false;
});

$(document).ready(function(){
    var i = 0;

    $('#diesel-table').DataTable({
        initComplete: function () {
            this.api().columns().every( function () {

                if( i == 3 || i == 0 || i == 6 ){

                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                }

                i++;
            } );
        }
    });
});
