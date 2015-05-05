jQuery(document).ready(function () {
    $.setFilt = function (id) {
        $.getJSON('/salud/web/certificados/filtro', {id: id}).success(function (data) {
            console.log(data);
            $.autocompletar(data);
        })
    };

    var index = 1;
    $.autocompletar = function (sourse) {
        jQuery('#certifi').autocomplete({
            'select': function (event, ui) {
                $('#examenes').append('<li>' +
                '<input type="hidden" id="certificado-campos-examen-' + index + '" name="Certificado[campos][examen-' + index + ']" value="' + ui.item.label + '">' +
                '<h4>' + ui.item.label + '</h4>' +
                '</li>');
                index = index + 1;
                return false;
            },
            source: sourse
        });
    };
});