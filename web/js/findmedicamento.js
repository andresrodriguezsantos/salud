$(document).ready(function () {

    var tarjeta = new getTarjeta();

    function getTarjeta() {
        this.tipo = {id: "", nombre: ""};
        this.subtipo = {id: "", nombre: ""};
        this.nombre = "";
        this.presentacion = {id: "", nombre: ""};
        this.composicion = "";
        this.laboratorio = "";
        this.descripcion = "";
        this.area = {id: "", nombre: ""};
    }

    var producto = new getProducto();

    function getProducto() {
        this.idprod = "";
        this.nombreprod = "";
        this.estado = "";
    }

    var tipo = new getTipo();

    function getTipo() {
        this.informacion = {idt: "", nombre: ""};
    }

    var prescripcion = new getprescripcion();

    function getprescripcion() {
        this.medicamento = {id: "", nombre: "", descripcion: ""};
        this.presentacion = {id: "", nombre: "", composicion: ""};
        this.dosis = "";
        this.unidad = "";
        this.duracion = "";
        this.administracion = "";
    }

    var allmedicamentos = [];

    /* ----------------------------------------  EVENTOS PARA LAS BUSQUEDAS DE LOS MEDICAMENTOS LOS EVENTOS LIKES DE LAS TABLAS----------------*/

    //este boton es el del search en la tabla lista de presentaciones de la vista listapresentacion
    $('#btnselecttipo').click(function (event) {
        $dato = $('#inputtextosubtipo').val();
        $.getJSON('/salud/web/medicamento/admin/likesubtipo', {'dato': $dato}).success(function (info) {
            if (info != null) {
                $('#bodysubtipo').html('');
                $('#bodysubtipo').append(info);
                recargar_botones_selecciona();
            }
        }); //  fin del get jason
    });

// EVENTO BOTON BUSCAR DE LA TABLA LISTA PRESENTACIONES
    $('#btn-buscar-pre').click(function (event) {
        $dato = $('#text-filtro-pre').val();
        $.getJSON('/salud/web/medicamento/admin/likepresentacion', {'dato': $dato}).success(function (info) {
            if (info != null) {
                $('#bodytablalistapresentacion').html('');
                $('#bodytablalistapresentacion').append(info);
                recargar_botones_selecciona();
            }
        }); //  fin del get jason
    });


    /* EVENTOS PARA EL BOTON ADD ITEM DE LAS TABLAS DONDE SE FILTRA INFORMACION
     (AGREGAR LAS PROPIEDADES DEL MEDICAMENTO SELECCIONADO A LA TABLA Y PODER CREAR EL MEDICAMENTO) */

    function recargar_todos_los_botones() {
        recargar_botones_selecciona();
        recargar_botones_edita();
        recargar_botones_delete();
    }


    function recargar_botones_selecciona() {
        // este boton es el de la tabla subtipo el boton add item
        $('.btn-addsubtipo').click(function (event) {
            var id = $(this).attr('value');
            var nombre = $(this).parents('tr').children('td').eq(0).html();
            var idtipo = $(this).parents('tr').eq(0).attr('id');
            var nombretipo = $(this).parents('tr').children('td').eq(1).html();
            tarjeta.subtipo = {
                id: id,
                nombre: nombre
            };
            tarjeta.tipo = {
                id: idtipo,
                nombre: nombretipo
            };
            agregatabla();
        });
    } // final del recargar botones selecciona

    function recargar_botones_add_likes() {
        // este es el boton add de la tabla lista presentaciones en la vista listapresentacion
        $('.btn-add-pres').click(function (event) {
            var id = $(this).attr('value');
            var nombre = $(this).parents('tr').children('td').eq(1).html();
            console.log(nombre);
            tarjeta.presentacion = {
                id: id,
                nombre: nombre
            };
            agregatabla();
        });
    }// FINAL DEL RECARGAR BOTONES ADD LIKES

    $('#medicamento-nombrecomercial').keyup(function (argument) {
        tarjeta.nombre = $(this).val();
        agregatabla();
    });

    $('#medicamento-composicion').keyup(function (argument) {
        tarjeta.composicion = $(this).val();
        agregatabla();
    });

    $('#medicamento-descripcion').keyup(function (argument) {
        tarjeta.descripcion = $(this).val();
        agregatabla();
    });

    $.setDataOfDocument = function (object, nombretipo, nombre, id, area, idarea) {
        if (object == 'subtipo') {
            tarjeta.tipo.nombre = nombretipo;
            tarjeta.subtipo.nombre = nombre;
            tarjeta.subtipo.id = id;
        } else if (object == 'presentacion') {
            tarjeta.presentacion.id = id;
            tarjeta.presentacion.nombre = nombre;
        } else if (object == 'area') {
            tarjeta.area.nombre = area;
            tarjeta.area.id = idarea;
        }
        agregatabla();
    };

    function agregatabla() {
        var $tabla = $('.tablafichaingreso');
        $.each($tabla, function (index, val) {
            $(val).html(
                '<tr><th>Area</th><td>' + tarjeta.area.nombre + '</td></tr>' +
                '<tr><th>Tradename</th><td>' + tarjeta.nombre + '</td></tr>' +
                '<tr><th>Composition</th><td>' + tarjeta.composicion + '</td></tr>' +
                '<tr><th>Therapeutic Type</th><td>' + tarjeta.tipo.nombre + '</td></tr>' +
                '<tr><th>Therapeutic Subtype</th><td>' + tarjeta.subtipo.nombre + '</td></tr>' +
                '<tr><th>Presentation</th><td>' + tarjeta.presentacion.nombre + '</td></tr>' +
                '<tr><th>Description</th><td>' + tarjeta.descripcion + '</td></tr>'
            );
        });
    }

    agregatabla();
    recargar_botones_selecciona();

//   -------------------------------------- EN ESTA FUNCION SE CAPTURA TODA LA INFORMACION Y SE ENVIA AL MODELO PARA GUARDAR.-------------------------------

    $('#btnsavemedicina').click(function (event) {
        if (tarjeta.nombre != "" && tarjeta.presentacion.nombre != "" && tarjeta.tipo.nombre != ""
            && tarjeta.subtipo.nombre != "" && tarjeta.composicion && tarjeta.descripcion != "" && tarjeta.area) {
            $.post('/salud/web/medicamento/admin/registrarmedicamento',
                {'dato': JSON.stringify(tarjeta)}).success(function (info) {

                });
        } else {
            $('#formularioincompleto').modal('show');
        }
    });

// EVENTOS PARA EL BOTON EDIT DE LAS TABLAS DONDE SE BUSCA INFORMACION (CARGA LOS DATOS EN EL FORMULARIO PARA REALIZAR LA ACTUALIZACION---------------------

    function recargar_botones_edita() {

        $('.btnpresentacionedit').click(function (event) {
            producto.idprod = $(this).attr('value');
            producto.nombreprod = $(this).parents('tr').children('td').eq(0).html();
            var estado = $(this).parents('tr').children('td').eq(1).html();
            if (estado === 'Activo')
                producto.estado = 1;
            else
                producto.estado = 0;
            $('#medpresentacion-nombre').val(producto.nombreprod);
            $('#medpresentacion-estado').val(producto.estado);
            $('input[name="MedPresentacion[id]"]').val(producto.idprod);
        });
    } // final de la funcion recargar botones edita


// ----------------------------------------------------------- EVENTO EN EL PANEL SUBTIPO (SELECCIONA EL TIPO )----------------------------------------
    function recargar_filtro_sutipo() {
        $('.btn_filtro_select').click(function (event) {
            var nomb = $(this).parents('tr').children('td').eq(0).html();
            var idtip = $(this).parents('tr').eq(0).attr('id');
            tipo.informacion = {
                idt: idtip,
                nombre: nomb
            };
            $('#input_nombre_subtipo').val(tipo.informacion.nombre);
            $('#medsubtipoterapeutico-idtipoterapeutico').val(tipo.informacion.idt);
            $('#btnformulariosubtipo').show();

        });
    }

// ---------------------------------------------------------EVENTOS PARA LOS BOTONES DELETE EN TODAS LAS TABLAS -------------------------------------------
    function recargar_botones_delete() {
        $('.btnpresentacionremove').click(function (event) {
            idfila = $(this).parents('tr').eq(0).attr('id');
            var $btn = $('#botonmodalborrar');
            var url = '/salud/web/medicamento/admin/deletepresentacion';
            $btn.attr('href', url + '?id=' + idfila);
            $('#borrarpresentacion').modal('show');
        });

    }//final de la funcion recargar botones  delete

// ----------------------------------------------	EVENTOS PARA PRESCRIBIR MEDICAMENTOS A PACIENTES  --------------------------------------------------


    function obetenerget(key) {
        key = key.replace(/[\[]/, '\\[');
        key = key.replace(/[\]]/, '\\]');
        var pattern = "[\\?&]" + key + "=([^&#]*)";
        var regex = new RegExp(pattern);
        var url = unescape(window.location.href);
        var results = regex.exec(url);
        if (results === null) {
            return null;
        } else {
            return results[1];
        }
    }


    $.getPresentaciones = function (id) {
        $.getJSON('/salud/web/medicamento/admin/getpresentaciones', {'id': id}).success(function (info) {
            info = jQuery.parseJSON(info);
            $('#tablapresmed').html('');
            $('#thtablapresmed').html('');
            $('#h4nombremed').append(
                'Nombre <br> Comercial :   ' + info[0].medicamento.nombrecomercial
            );
            $('#h4presentacionmed').append(
                'Presentacion: '
            );
            prescripcion.medicamento = {
                id: info[0].medicamento.id,
                nombre: info[0].medicamento.nombrecomercial,
                descripcion: info[0].medicamento.descripcion
            };
            $.each(info, function (index, val) {
                $(val).html(
                    tablaprescripcionmedicamento(val)
                );
            });//final del each
            recargar_botones_prescripcion();
        });//final del json
    };

    function tablaprescripcionmedicamento(dato) {
        $('#tablapresmed').append(
            '<tr id="' + dato.medicamento.id + '">' +
            '<td>' + dato.presentacion.nombre + '</td>' +
            '<td>' + dato.medicamento.composicion + '</td>' +
            '<td><button class="btn btn-success btn-xs btn_pres_add" value="' + dato.presentacion.id + '">Seleccionar</button>  ' +
            '<button class="btn btn-info btn-xs btn_pres_view" value="' + dato.presentacion.id + '">Ver</button></td>' +
            '</tr>'
        );
    }

    $('#btn_pres_addform').click(function (event) {
        prescripcion.unidad = $('#optprescripcionmed-unidades').val();
        prescripcion.dosis = $('#optprescripcionmed-dosis').val();
        prescripcion.duracion = $('#optprescripcionmed-duracion').val();
        prescripcion.administracion = $('#optprescripcionmed-viaadministracion').val();
        if (prescripcion.presentacion.id != "" && prescripcion.presentacion.nombre != "" && prescripcion.presentacion.composicion != ""
            && prescripcion.medicamento.id != "" && prescripcion.medicamento.nombre != ""
            && prescripcion.dosis != "" && prescripcion.unidad != "" && prescripcion.duracion != "" && prescripcion.administracion != "") {
            $('#tablaprescripcion').append(
                '<tr id="">' +
                '<td>' + prescripcion.medicamento.nombre + '</td>' +
                '<td>' + prescripcion.presentacion.nombre + '</td>' +
                '<td>' + prescripcion.unidad + '</td>' +
                '<td>' + prescripcion.dosis + '</td>' +
                '<td>' + prescripcion.duracion + '</td>' +
                '<td>' + prescripcion.administracion + '</td>' +
                '<td><button class=" btn btn-danger btn-xs btn_pres_view removepres" id="' + prescripcion.medicamento.id + '">Remove</button></td>' +
                '</tr>'
            );
            allmedicamentos.push(prescripcion);
            borrartesfield();
            console.log(allmedicamentos);
            prescripcion = new getprescripcion();
            //removefilas();
            $('#btn_pres_submitform').show();
        } else {
            $('#formprescripcionincomplete').modal('show');
        }
    });
    function borrartesfield() {
        $('#optprescripcionmed-unidades').val("");
        $('#optprescripcionmed-dosis').val("");
        $('#optprescripcionmed-duracion').val("");
        $('#optprescripcionmed-viaadministracion').val("");
        $('#h4nombremed').html('');
        $('#h4presentacionmed').html('');
        $('#tablapresmed').html('');
    }

    function recargar_botones_prescripcion() {
        $('.btn_pres_add').click(function (event) {
            var nombrepresentation = $(this).parents('tr').children('td').eq(0).html();
            var idpresentacion = $(this).attr('value');
            var composicionpresen = $(this).parents('tr').children('td').eq(1).html();
            prescripcion.presentacion = {
                id: idpresentacion,
                nombre: nombrepresentation,
                composicion: composicionpresen
            };
            $('#h4presentacionmed').html('');
            $('#h4presentacionmed').append(
                'Presentacion :  ' + prescripcion.presentacion.nombre
            );
        });

        $('.btn_pres_view').click(function (event) {
            var id = $(this).parents('tr').attr('id');
            $.getJSON('/salud/web/medicamento/admin/buscarmedicamento', {'dato': id}).success(function (info) {
                if (info != null) {
                    $('#infomedicamento').modal('show');
                    $('#bodyprescripcion').html(
                        '<table class="table table-bordered table-striped">' +
                        '<thead>' +
                        '<tr><th>Propiedades</th><th>Informacion</th></tr>' +
                        '</thead>' +
                        '<tbody>' +
                        '<tr><td>Nombre</td><td>' + info.nombrecomercial + '</td></tr>' +
                        '<tr><td>composicion</td><td>' + info.composicion + '</td></tr>' +
                        '<tr><td>Descripcion</td><td>' + info.descripcion + '</td></tr>' +
                        '</tbody>' +
                        '<table>'
                    );
                }//final del if
            }); //  fin del get jason
        });
    } // final de la funcion recargar_botones_prescripcion

    $('#btn_pres_submitform').click(function (event) {
        var idh = obetenerget("id");
        $.get('/salud/web/medicamento/admin/prescripcionmedica', {
            'dato': JSON.stringify(allmedicamentos),
            'idh': idh
        }).success(function (info) {
            borrartesfield();
            $('#tablaprescripcion').html('');
            $('#btn_pres_submitform').hide();
        });// final del getjson
    });//final del click

    function removefilas() {
        $('.removepres').click(function (event) {
            var file = $(this).parents('tr').remove();
            var id = $(this).attr('id');
            $.each(allmedicamentos, function (index, val) {
                if (id == val.medicamento.id) {
                    allmedicamentos.pop(index);
                    return false;
                }
            });
        });
    }

    $.completar = function (sourses) {
        jQuery('#fmedicamento').autocomplete({
            'select': function (event, ui) {
                $("#optprescripcionmed-idmedicamento").val(ui.item.id);
                $(this).val(ui.item.label);
                $.getPresentaciones(ui.item.id);
                return false;
            },
            'source': sourses,
            'autofill': true
        }).autocomplete('instance')._renderItem = function (ul, item) {
            return $('<li>')
                .append('<a><small>' + item.label + '</small></a>')
                .appendTo(ul);
        };
    };

    $('#selectipo').on('change', function (ev) {
        var index = $(this).find(':selected').index();
        if (index) {
            $('#laboratorios').show();
            $.get('/salud/web/medicamento/admin/fillopts', {'tipo': 'comercial', 'lab': null}).success(function (data) {
                $.completar(data);
            })
        } else {
            $('#laboratorios').hide();
            $.get('/salud/web/medicamento/admin/fillopts', {
                'tipo': 'composicion',
                'lab': null
            }).success(function (data) {
                $.completar(data);
            })
        }

    });
    $('#laboratorios').change(function (ev) {
        var sel = $('#laboratorios :selected').val();
        $.get('/salud/web/medicamento/admin/fillopts', {'tipo': 'comercial', 'lab': sel}).success(function (data) {
            $.completar(data);
        })
    });

    $.cargarMedicamento = function (tipo, subtipo, nombre, presentacion, composicion, descripcion, area, idarea) {
        tarjeta.tipo = {id: "", nombre: tipo};
        tarjeta.subtipo = {id: "", nombre: subtipo};
        tarjeta.nombre = nombre;
        tarjeta.presentacion = {id: "", nombre: presentacion};
        tarjeta.composicion = composicion;
        tarjeta.descripcion = descripcion;
        tarjeta.area = {id: idarea, nombre: area};
        agregatabla();
    };

// --------------------------   EVENTOS PARA EL FORMULARIO DE PRESENTACIONES -----------------------------------------------------------------
//____________________________________________________________________________________________________________________________________________

    $('.btn-editar-pre').click(function (event) {
        var valor = $(this).val();
        $('#medpresentacion-id').val(valor); // se le pasa el id al formulario para que actualize
        var nombre = $(this).parents('tr').children('td').eq(1).html();
        $('#medpresentacion-nombre').val(nombre);
        $.get('/salud/web/medicamento/admin/registrarpresentacion', {'id': valor}).success(function (info) {
        });
    });

    $('#btn-buscar-presentacion').click(function (event) {
        var text = $('#text-filtro-presentacion').val();
        $.get('/salud/web/medicamento/admin/likepresentacion', {'dato': text}).success(function (info) {
            if (info != null) {
                $('#bodytablalistapresentacion').html('');
                $('#bodytablalistapresentacion').append(info);
                recargar_botones_add_likes();
            }
        });
    });


});// FINAL DEL DOCUMENTO

