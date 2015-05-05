$(document).ready(function () {
    $('select[name="Usuario[idpais]"]').change(function (event) {
        console.log('entra pais');
        $.post('/salud/web/site/loadglobal', {'tipo': 'pais', 'id': $(this).val()}, function (data, textStatus, xhr) {
            data = jQuery.parseJSON(data);
            var $departamentos = $('select[name="departamento"]');
            $departamentos.prop('disabled', false);
            $departamentos.empty();
            $departamentos.append($('<option></option>')
                .attr('value', '').text("Seleccione"));
            $.each(data, function (index, val) {
                $departamentos.append($("<option></option>")
                    .attr("value", index).text(val));
            });
        });
    });
    $.comprobar = function (ciudad) {
        $('select[name="departamento"]').change(function (event) {
            console.log('entra departamentos');
            $.post('/salud/web/site/loadglobal', {
                'tipo': 'departamento',
                'id': $(this).val()
            }, function (data, textStatus, xhr) {
                data = jQuery.parseJSON(data);
                var $ciudad = $('select[name="Usuario[idciudad]"]');
                ciudad.prop('disabled', false);
                ciudad.empty();
                ciudad.append($('<option></option>')
                    .attr('value', '').text('Seleccione'));
                $.each(data, function (index, val) {
                    ciudad.append($('<option></option>')
                        .attr('value', index).text(val));
                });
            });
        });
    };
    var newClinik = false;
    var nombreClinica = $('.field-epscosultorio-nombre');
    var direccionClinica = $('.field-epscosultorio-direccion');
    var contactoClinica = $('.field-epscosultorio-contacto');

    function onChangueText(part) {
        var group = $('.field-epscosultorio-' + part);
        var name = group.find('#epscosultorio-' + part).val();
        console.log(name);
        if (name == "" || name == 'undefinied') {
            group.addClass('has-error')
                .find('.help-block').html('Escriba el nombre de la clinica');
            newClinik = false;
        } else {
            group.addClass('has-success').removeClass('has-error')
                .find('.help-block').html('');
            newClinik = true;
        }
    }

    nombreClinica.change(function () {
        onChangueText('nombre')
    });
    direccionClinica.change(function () {
        onChangueText('direccion')
    });
    contactoClinica.change(function () {
        onChangueText('contacto')
    });


    $('#independiente').click(function (e) {
        $('#idlabora').hide();
    });
    $('#cancelind').click(function (e) {
        close(false);
    });

    $('#cargaclinica').click(function (e) {
        validaNewClinick();
    });

    $('#regclinica').on('hidden.bs.modal', function () {
        //close(true);
    });

    function close(validate) {
        if (validate) {
            validaNewClinick();
            if (!newClinik) {
                $('#idlabora').show();
                $('#profesionaleps-id_eps').find(':selected').attr('value', '');
                $('#regclinica').modal('hide');
                $('#datacarga').html('');
            }
        } else {
            $('#idlabora').show();
            $('#profesionaleps-id_eps').find(':selected').attr('value', '');
            $('#regclinica').modal('hide');
            $('#datacarga').html('');
        }
    }

    function validaNewClinick() {
        var name = $(nombreClinica).find('#epscosultorio-nombre').val();
        var dire = $(direccionClinica).find('#epscosultorio-direccion').val();
        var cont = $(contactoClinica).find('#epscosultorio-contacto').val();
        console.log(name);
        if (name == "" || name == 'undefinied') {
            nombreClinica.addClass('has-error')
                .find('.help-block').html('Escriba el nombre de la clinica');
            newClinik = false;
        } else {
            nombreClinica.addClass('has-success').removeClass('has-error')
                .find('.help-block').html('');
            newClinik = true;
        }
        if (dire == "" || dire == 'undefinied') {
            direccionClinica.addClass('has-error').removeClass('has-success')
                .find('.help-block').html('Escriba la dirección de su clinica');
            newClinik = false;
        } else {
            direccionClinica.addClass('has-success').removeClass('has-error')
                .find('.help-block').html('');
            newClinik = true;
        }
        if (cont == "" || cont == 'undefinied') {
            contactoClinica.addClass('has-error').removeClass('has-success')
                .find('.help-block').html('Escriba el nombre de la clinica');
            newClinik = false;
        } else {
            contactoClinica.addClass('has-success').removeClass('has-error')
                .find('.help-block').html('');
            newClinik = true;
        }
        if (newClinik) {
            $('#regclinica').modal('hide');
        }
        $('#profesionaleps-id_eps').find(':selected').attr('value', 0);
        $('#datacarga').html('<h3>' + $('input[name="EpsCosultorio[nombre]"]').val() + '</h3>');
    }

});