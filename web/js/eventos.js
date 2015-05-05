$(document).ready(function () {

    var iduser = "";

    $('.btnvalida').click(function (event) {
        $num = $('#inputcedula').val();
        if ($num != null)
            $.validaCedula($num);
        else
            alert('No data to validate');
    });// final de la funcion

    $.validaCedula = function valida($cedula) {
        $.getJSON('/salud/web/laboratorio/admin/validarcedula', {'ced': $cedula}).success(function (info) {
            console.log(info);
            if (info != 'Existe' && info != null) {
                iduser = info.id;
                $('.datos').show();
                $('.ubicacion').show();
                $('.boton').show();
                $('.btnvalida').hide();
                $('#inputcedula').prop('disabled', true);
                $('.btnedita').show();
                $('.nombreuser').text(info.nombres);
                $('.apellidouser').text(info.apellidos);
                $('.cedulauser').text(info.cedula);
                $('.ciudaduser').text(info.idciudad);
                $('#labusuario-idusuario').val(info.id);
                $('#idactualizar').html('');
                $('#idactualizar').append(
                    '<tr><th>Nombre</th><th>' + info.nombres + ' ' + info.apellidos + '</th></tr>' +
                    '<tr><th>Identificacion</th><th>' + info.cedula + '</th></tr>' +
                    '<tr><th>Email</th><th>' + info.email + '</th></tr>' +
                    '<tr><th>Ciudad</th><th>' + info.nombre + '</th></tr>'
                );

            } else if (info == 'Existe') {
                $('#formularioincompletoregistrosede').modal('show');

                /* var $btn = $('#botonmodalborrar');
                 var url = '/salud/web/medicamento/admin/deletepresentacion';
                 $btn.attr('href', url+'?id='+idfila);
                 $('#borrarpresentacion').modal('show');

                 */
            } else {

                $('#formularioincompletoregistrosede').modal('show');
                $('#labusuario-idusuario').val('');
                $('.datos').hide();
                $('.ubicacion').hide();
                $('.boton').hide();
                $('#idactualizar').html('');
                iduser = "";
            }
        }); //  fin del get jason
    }//final de la funcion

    $('.btnedita').click(function (event) {
        $('.datos').hide();
        $('.ubicacion').hide();
        $('.boton').hide();
        $('.btnedita').hide();
        $('.btnvalida').show();
        $('#inputcedula').prop('disabled', false);
        $('#labusuario-idusuario').val('');
        $('#idactualizar').html('');
        iduser = "";
    });

    $('#botonenviaractualizacion').click(function (event) {
        var cargo = $('#inputactualizarcargo').val();
        var email = $('#inputactualizaremail').val();
        var ciudad = $('#labsede-idciudad').val();
        var informarcion = [];
        if (cargo != null && email != null && ciudad != 'Seleccione' && iduser != null) {
            informarcion = [cargo, email, ciudad, iduser];
            var idl = $('#idlabora').val();
            $.getJSON('/salud/web/laboratorio/admin/actualizar', {
                'id': idl,
                'datos': informarcion
            }).success(function (info) {

            });
        } else {
            alert();
        }
    });

    //$('.btnenviarform').click(function(event){
    //  $('#w1').modal('show');
    //});

    $('#btncreatesede').click(function () {
        var idl = $('#btncreatesede').val();
        $.getJSON('/salud/web/laboratorio/admin/add', {'id': idl}).success(function (info) {

        });

    });


});; // final del documento