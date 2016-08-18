
var vehicle = {

    input: $('#registration-text'),

    table: $('#vehicle-table-body'),

    addForm: $('#add-vehicle-form'),

    addButton: '#add-vehicle-submit',

    removeButton: '.delete-oil',

    response:{},

    add: function(){
        var self = this,
            row = '';

        self.response = ajax.post('vehicle/add', self.addForm.serialize());

        if(self.response !== false) {
            row = self.newRow(self.response);

            self.addRow(row);

            self.clearInput();
        }
    },

    remove: function( id ){
        var self = this;

        self.response = $.post('vehicle/delete', {'id': id});

        $( '.oil-' + id ).closest('tr').remove();
    },

    newRow: function ( data ){
        var self = this;

        return '<tr><td>' + data.registration + '</td></tr>';
    },

    addRow: function( row ) {
        var self = this;

        self.table.prepend(row);
    },

    clearInput: function() {
        var self = this;

        self.input.val('');
    }
};

$(document).on('click', vehicle.addButton, function(){

    vehicle.add();

    return false;
});

$(document).on('click', vehicle.removeButton, function(){

    vehicle.remove(this.id);

    return false;
});

$(document).ready(function(){
    $('#vehicle-table').DataTable();
});
