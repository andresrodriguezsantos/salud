$(document).ready(function(){
    $('.collapse-toggle').click(function(){
        var container =$($(this).attr('data-parent')).children();
        var panel = $(container).find('.panel-body');
        var load = $(container).attr('data-load');
        var id = $(container).attr('data-optid');
        if(load == 0){
            $.get('/salud/web/paciente/home/control',{id:id}).success(function(data){
                setTimeout(function(){
                    panel.html(data);
                    $(container).attr('data-load',1);
                    console.log('Cargado por primera vez');
                    fanci();
                },1500);

            });  
        }
    });

    function fanci(){
        $(".fancybox").fancybox({
            openEffect	: 'none',
            closeEffect	: 'none'
        });
    }
    console.log('init');
});