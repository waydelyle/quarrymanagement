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

    post: function( url , data ){
        var self = this;

        $.post(url, data).done(function( data ) {
                self.response = self.parse( data );
            });

        return self.response;
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