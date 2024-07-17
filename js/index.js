$( document ).ready(function() {
    $.post( "/api/check.php", function( data ) {
        
        if(data != 'none'){
            $('#logout').removeClass("hide");
        }else{
            $('#login').removeClass("hide");
            $('#register').removeClass("hide");
        }

      });

    $('#logout').on( "click", function() {
        $.post( "/api/logout.php", function( data ) {
            window.location.reload();
        })
    });
});