var    addVehicleForm = $('#add-vehicle-form'),
       deleteVehicleForm = $('#delete-vehicle-form');

$(document).on('click', '#add-vehicle-submit', function(){

    $.post( 'vehicle/add', addVehicleForm.serialize())
        .done(function( data ) {
            data = parse(data);
            var newRow = '<tr><td>' + data.registration + '</td>' +
                '<td><button type="button" class="btn btn-xs btn-danger delete-vehicle vehicle-' + data.id + '" id="' + data.id +'">' +
                '<span class="glyphicon glyphicon-remove" aria-hidden="true">' +
                '</span>' +
                '</button>' +
                '</td></tr>';

            var newSelect = '<option value="' + data.id +'" class="vehicle-' + data.id + '">' + data.registration + '</option>'

            $('#vehicle-table-body').append(newRow);
            $('.vehicle-table-body').append(newRow);
            $('.vehicle-select').append(newSelect);
            $('#registration-text').val('');
        });

    return false;
});

$(document).on('click', '#delete-vehicle-submit', function(){
    $.post( 'vehicle/delete', deleteVehicleForm.serialize())
        .done(function( data ) {
        });

    return false;
});

$(document).on('click', '.delete-vehicle', function(){

    var id = this.id;

    $.post( 'vehicle/delete', {'id': id})
        .done(function( data ) {
            $( '.vehicle-' + id ).closest('tr').remove();
            $( '.vehicle-' + id ).closest('option').remove();
        });

    return false;
});

$(document).ready(function(){
    $('#vehicle-table').DataTable();
});