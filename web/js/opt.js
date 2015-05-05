$(document).ready(function () {
    var url = $('#newpaciente').attr('href');
    var sourses;
    $('.search').click(function (e) {
        e.preventDefault();
        $.findCedula();
    });
    $('#adddiagnostico').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('data-val');
        $.post('/salud/web/optometria/main/newdiagnostico', {id: id}).success(function (data, textStatus, xhr) {
            $('#diacnosticos').append(data);
            $.autocompletar(sourses, id);
            id = (parseInt(id) + 1);
            $.autocompletar(sourses, id);
            id += 1;
            $('#adddiagnostico').attr('data-val', id);
        });
    });

    $.findCedula = function () {
        $.getJSON('/salud/web/optometria/main/finpac',
            {ced: $('.cedula').val()}).success(function (json) {
                json = jQuery.parseJSON(json);
                var $pacid = $('.paciente-id');
                var $inpu = $('input[name="Historia[paciente_id]"]');
                var $nombre = $('.nombres');
                var $documento = $('.documento');
                var $direccion = $('.direccion');
                var $email = $('.email');
                var $entidad = $('.entidad');
                var $fecha = $('.nacimiento');
                if (json[0] != null) {
                    $pacid.addClass('has-success');
                    $pacid.removeClass('has-error');
                    $inpu.val(json[0].id);
                    $nombre.html(json[1].nombres + ' ' + json[1].apellidos);
                    $documento.html(json[1].cedula);
                    $direccion.html(json[1].direccion);
                    $email.html(json[1].email);
                    $entidad.html(json[2].nombre);
                    $fecha.html(json[0].fechanacimiento);
                } else {
                    $pacid.removeClass('has-success');
                    $pacid.addClass('has-error');
                    $inpu.val('');
                    $('#errornopaciente').modal('show');
                    $nombre.html('');
                    $documento.html('');
                    $direccion.html('');
                    $email.html('');
                    $entidad.html('');
                    $fecha.html('');
                    $('#newpaciente').attr('href', url + $('.cedula').val());
                    console.log(url);
                }
            });
    };

    $.autocompletar = function (sourse, id) {
        if (sourse != null) {
            sourses = sourse;
        }
        console.log(id);
        jQuery('#optdiagnostico-' + id + '-nominacion').autocomplete({

            'select': function (event, ui) {
                $('#optdiagnostico-' + id + '-codigocie_id').val(ui.item.value);
                $(this).val(ui.item.label);
                var code = $('#ac' + id);
                code.val(ui.item.code);
                //readonly
                $(this).attr('readonly', '');
                code.attr('readonly', '');
                //ajustamiento
                var field = $('#field' + id);
                var boton = $('#boton' + id);
                field.removeClass('col-xs-12').addClass('col-xs-10');
                boton.removeClass('col-xs-0').addClass('col-xs-2');
                $('#remove' + id).show();
                return false;
            },
            source: sourses,
            autoFill: true,
            max: 5,
            minLength: 3
        }).autocomplete('instance')._renderItem = function (ul, item) {
            return $('<li>')
                .append('<a>' + item.label + '<br><small>' + item.code + '</small></a>')
                .appendTo(ul);
        };
        funcButon(id);
    };

    var tblSnellen = [
        '0.00', '-0.60', '-0.40', '-0.30', '-019',
        '-0.10', '0.00', '0.10', '0.20', '0.30',
        '0.40', '0.50', '0.60', '0.70', '0.80',
        '0.90', '1.00', '1.10', '1.20', '1.30',
        '1.40', '1.50', '1.60', '1.70', '1.80',
        '1.90', '2.00', 'bultos', 'ppl', 'no ppl'
    ];
    $.fn.snellen = function (logmar) {
        this.on('change', function (e) {
            var sel = $(this).find(':selected').index();
            $(logmar).val(tblSnellen[sel]);
        })
    };
    function funcButon(id) {
        $('#remove' + id).click(function (e) {
            //remove valores y remove readonly
            $('#optdiagnostico-' + id + '-nominacion').val('')
                .removeAttr('readonly');
            $('#ac' + id).val('')
                .removeAttr('readonly');
            //ajuta vista
            var field = $('#field' + id);
            var boton = $('#boton' + id);
            field.removeClass('col-xs-10').addClass('col-xs-12');
            boton.removeClass('col-xs-2').addClass('col-xs-0');
            $(this).hide();
        })
    }
});