var ajax = {

    response: {},

    init: function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            async: false
        });
    },

    post: function( url, data ){
        var self = this;

        $.post(url, data)
            .done(function( data ) {
                self.response = self.parse( data );

                if( self.response.code == undefined && self.response.message != undefined ){
                    self.success( self.response.message );
                }

            }).fail(function() {
                self.response.message = 'Failed to connect.';
                self.response.code = 500;
        });

        if(self.response.code != undefined){
            self.error(self.response.code, self.response.message);

            return false;
        }

        return self.response;
    },

    error: function( code, message ){
        $('#error').modal('show');
        $('#error-code').text(code + ' error.');
        $('#error-message').text(message);
    },

    success: function( message ){
        $('#success').modal('show');
        $('#success-message').text(message);
    },

    parse: function( data ){
        return JSON.parse(data);
    }
};

$(document).ready(function(){

    $(".nav a").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });

    $(".nav a").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });

    ajax.init();
});

var parse = function( data ){
    return JSON.parse(data);
};