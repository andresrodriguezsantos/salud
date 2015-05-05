$(document).ready(function () {


    $("#registrolab").hide();
    $("#tipocuenta").change(function () {
        var tipo = $(this).val();
        if (tipo == "lab") {
            $('#registrodual').hide();
            $('#registrolab').show();
        } else {
            $("#registrolab").hide();
            $('#registrodual').show();
        }
    });

}); // final del documento$( "select" )
  

 