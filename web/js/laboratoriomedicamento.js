$(document).ready(function () {

    $('.btntipoedit').click(function (event) {
        producto.idprod = $(this).attr('value');
        producto.nombreprod = $(this).parents('tr').children('td').eq(0).html();
        var estado = $(this).parents('tr').children('td').eq(1).html();
        if (estado === 'Activo')
            producto.estado = 1;
        else
            producto.estado = 0;
        $('#medtipoterapeutico-nombre').val(producto.nombreprod);
        $('#medtipoterapeutico-estado').val(producto.estado);
        $('input[name="MedTipoTerapeutico[id]"]').val(producto.idprod);
    });

    $('.btn-editsubtipo').click(function (event) {
        producto.idprod = $(this).attr('value');
        producto.nombreprod = $(this).parents('tr').children('td').eq(0).html();
        var tipo = $(this).parents('tr').attr('id');
        var estado = $(this).parents('tr').children('td').eq(2).html();
        var categoria = $(this).parents('tr').children('td').eq(1).html();
        if (estado === 'Activo')
            producto.estado = 1;
        else
            producto.estado = 0;
        $('#medsubtipoterapeutico-nombre').val(producto.nombreprod);
        $('#input_nombre_subtipo').val(categoria);
        $('#medsubtipoterapeutico-estado').val(producto.estado);
        $('#medsubtipoterapeutico-id').val(producto.idprod);
        $('#medsubtipoterapeutico-idtipoterapeutico').val(tipo);
    });


    $('.btntiporemove').click(function (event) {
        idfila = $(this).parents('tr').eq(0).attr('id');
        var $btn = $('#botonmodalborrartipo');
        var url = '/salud/web/medicamento/admin/deletetipo';
        $btn.attr('href', url + '?id=' + idfila);
        $('#borrartipo').modal('show');
    });
    $('.btn-removesubtipo').click(function (event) {
        idfila = $(this).attr('value');
        alert(idfila);
        var $btn = $('#botonmodalborrarsubtipo');
        var url = '/salud/web/medicamento/admin/deletesubtipo';
        $btn.attr('href', url + '?id=' + idfila);
        $('#borrarsubtipo').modal('show');
    });


//_______________________-- EDITAR LAS SEDES DE LOS LABORATORIOS ______________________________________


});// FINAL DEL DOCUMENTO