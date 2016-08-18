
var oil = {

    input: $('#oil-amount'),

    table: $('#oil-table-body'),

    addForm: $('#add-oil-form'),

    subtractForm: $('#subtract-oil-form'),

    addButton: '#add-oil-submit',

    subtractButton: '#subtract-oil-submit',

    removeButton: '.delete-oil',

    response:{},

    add: function(){
        var self = this,
            row = '';

        self.response = ajax.post('oil/add', self.addForm.serialize());

        row = self.newRow( self.response );

        self.addRow( row );

        self.clearInput();
    },

    subtract: function(){
        var self = this,
            row = '';

        self.response = ajax.post('oil/subtract', self.subtractForm.serialize());

        row = self.newRow( self.response );

        self.addRow( row );

        self.clearInput();
    },

    remove: function( id ){
        var self = this;

        self.response = $.post('oil/delete', {'id': id});

        $( '.oil-' + id ).closest('tr').remove();
    },

    newRow: function ( data ){
        var self = this;

        if(data.action == '+'){
            data.action = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
        } else {
            data.action = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
        }

        return '<tr>' +
            '<td>' + data.vehicle + '</td>' +
            '<td>' + data.type + '</td>' +
            '<td>' + data.action + '</td>' +
            '<td>' + data.amount + '</td>' +
            '<td>' + data.date + '</td>' +
            '<td>' + data.time + '</td>' +
            '<td>' + data.auth + '</td>' +
            '<td><button type="button" class="btn btn-xs btn-danger delete-diesel diesel-' + data.id + '" id="' + data.id +'">' +
            '<span class="glyphicon glyphicon-remove" aria-hidden="true">' +
            '</span>' +
            '</button>' +
            '</td></tr>';
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

$(document).on('click', oil.addButton, function(){

    oil.add();

    return false;
});

$(document).on('click', oil.subtractButton, function(){

    oil.subtract();

    return false;
});

$(document).on('click', oil.removeButton, function(){

    oil.remove(this.id);

    return false;
});

$(document).ready(function(){
    var i = 0;

    $('#oil-table').DataTable({
        initComplete: function () {
            this.api().columns().every( function () {

                if( i == 1 || i == 6 ){

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
