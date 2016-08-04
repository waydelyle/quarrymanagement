var addOilForm = $('#add-oil-form'),
    subtractOilForm = $('#subtract-oil-form');

$(document).on('click', '#add-oil-submit', function(){
    $.post( 'oil/add', addOilForm.serialize())
        .done(function( data ) {
            data = parse(data);

            if(data.action == '+'){
                data.action = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
            } else {
                data.action = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
            }

            var newRow = '<tr><td>' + data.amount + '</td><td>' + data.created_at + '</td>' +
                '<td><button type="button" class="btn btn-xs btn-danger delete-oil oil-' + data.id + '" id="' + data.id +'">' +
                '<span class="glyphicon glyphicon-remove" aria-hidden="true">' +
                '</span>' +
                '</button>' +
                '</td></tr>';

            $('#oil-table-body').append(newRow);
            $('#oil-amount').val('');
        });

    return false;
});

$(document).on('click', '#subtract-oil-submit', function(){
    $.post( 'oil/subtract', subtractOilForm.serialize())
        .done(function( data ) {
            data = parse(data);

            if(data.action == '+'){
                data.action = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
            } else {
                data.action = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
            }

            var newRow = '<tr><td>' + data.amount + '</td><td>' + data.created_at + '</td>' +
                '<td><button type="button" class="btn btn-xs btn-danger delete-diesel diesel-' + data.id + '" id="' + data.id +'">' +
                '<span class="glyphicon glyphicon-remove" aria-hidden="true">' +
                '</span>' +
                '</button>' +
                '</td></tr>';

            $('#oil-table-body').append(newRow);
            $('#oil-amount').val('');
        });

    return false;
});

$(document).on('click', '.delete-oil', function(){

    var id = this.id;

    $.post( 'oil/delete', {'id': id})
        .done(function( data ) {
            $( '.oil-' + id ).closest('tr').remove();
        });

    return false;
});

$(document).ready(function(){
    $('#oil-table').DataTable();
});