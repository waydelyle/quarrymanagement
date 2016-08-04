var addDieselForm = $('#add-diesel-form'),
    subtractDieselForm = $('#subtract-diesel-form'),
    addOilForm = $('#add-oil-form'),
    subtractOilForm = $('#subtract-oil-form'),
    addVehicleForm = $('#add-vehicle-form'),
    deleteVehicleForm = $('#delete-vehicle-form');

$(".nav a").on("click", function(){
    $(".nav").find(".active").removeClass("active");
    $(this).parent().addClass("active");
});

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

$(document).on('click', '#add-diesel-submit', function(){
    $.post( 'diesel/add', addDieselForm.serialize())
        .done(function( data ) {
            data = parse(data);
            var newRow = '<tr><td>' + data.amount + '</td><td>' + data.created_at + '</td>' +
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
            var newRow = '<tr><td>' + data.amount + '</td><td>' + data.created_at + '</td>' +
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

$(document).on('click', '#add-oil-submit', function(){
    $.post( 'oil/add', addOilForm.serialize())
        .done(function( data ) {
            data = parse(data);
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

$(document).on('click', '.delete-vehicle', function(){

    var id = this.id;

    $.post( 'vehicle/delete', {'id': id})
        .done(function( data ) {
            $( '.vehicle-' + id ).closest('tr').remove();
            $( '.vehicle-' + id ).closest('option').remove();
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

$(document).on('click', '.delete-diesel', function(){

    var id = this.id;

    $.post( 'diesel/delete', {'id': id})
        .done(function( data ) {
            $( '.diesel-' + id ).closest('tr').remove();
        });

    return false;
});

var parse  = function( data ){
    return JSON.parse(data);
};

$(document).ready(function(){
    $('#diesel-table').DataTable();
});

$(document).ready(function(){
    $('#oil-table').DataTable();
});

$(document).ready(function(){
    $('#vehicle-table').DataTable();
});