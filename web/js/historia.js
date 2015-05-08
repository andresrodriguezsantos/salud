$(document).ready(function () {
    $('a.optometria').click(function () {
        var href = this.href;
        console.log('click en link ' + href);
        var perm = $(this).attr('data-perm');
        console.log(perm);
        var optid = $(this).attr('data-optid');

        var result_pin = $('#result-pin');
        var result_sol = $('#result-sol');
        var container_pin = $('#pin-body');
        var container_sol = $('#sol-body');


        if (perm == 2 || perm == 3) {
            $('#get-pin').modal('show');
            $('#send-pin').click(function () {
                container_pin.append('<div class="overlay"></div>' +
                '<div class="loading-img"></div>');
                var pin = $('input[name="pin"]').val();
                $.get('/salud/web/paciente/historia/getpin', {id: optid, pin: pin}).success(function (data) {
                    setTimeout(function () {
                        container_pin.children('.overlay').remove();
                        container_pin.children('.loading-img').remove();
                        if (data == 'autorised') {
                            result_pin.addClass('text-success').removeClass('text-red');
                            result_pin.html('Autorizado redireccionando');
                            window.location = (href + '&pin=' + pin);
                        } else if (data == 'pinerror') {
                            result_pin.addClass('text-red').removeClass('text-success');
                            result_pin.html('El pin que ha ingresado es erroneo');
                        }
                    }, 1500);
                });
            });
            return false;
        }
        if (perm == 4) {
            $('#get-solicitud').modal('show');
            $('#send-solicitud').click(function(){
                var nota = $('textarea[name="nota"]').val();
                container_sol.append('<div class="overlay"></div>' +
                '<div class="loading-img"></div>');
                $.get('/salud/web/paciente/historia/getpermision', {id: optid, nota: nota}).success(function (data) {
                    setTimeout(function () {
                        container_sol.children('.overlay').remove();
                        container_sol.children('.loading-img').remove();
                        console.log(data);
                        if (data == 'send') {
                            result_sol.addClass('text-success').removeClass('text-red');
                            result_sol.html('Solicitud de permiso enviada.');
                        } else if (data == 'resenderror') {
                            result_sol.addClass('text-red').removeClass('text-success');
                            result_sol.html('Ud ya ha solicitado permiso para ver esta historia pero el profesional no ha autorizado su ingreso');
                        }
                    }, 1500);
                });

            });
            return false;
        }
        return true;
    });

    $('.collapse-toggle').click(function () {
        var container = $($(this).attr('data-parent')).children();
        var panel = $(container).find('.panel-body');
        var load = $(container).attr('data-load');
        var id = $(container).attr('data-optid');
        if (load == 0) {
            $.get('/salud/web/paciente/home/control', {id: id}).success(function (data) {
                setTimeout(function () {
                    panel.html(data);
                    $(container).attr('data-load', 1);
                    fanci();
                }, 1500);

            });
        }
    });

    function fanci() {
        $(".fancybox").fancybox({
            openEffect: 'none',
            closeEffect: 'none'
        });
    }

    console.log('init');
});