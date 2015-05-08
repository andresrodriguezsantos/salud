$(document).ready(function(){
    $('a.optometria').click(function(){
        console.log('click en link');
        var perm = $(this).attr('data-perm');
        var optid = $(this).attr('data-optid');
        if(perm == 2 || perm == 3){
            return showSolicitudpin(optid);
        }else if(perm == 4){
            return showSolicitudpermiso(optid);
        }
        return true;
    });

    function showSolicitudpin(id){
        $('#get-pin').modal('show');
        $('#send-pin').click(function(){
            $.get('/salud/web/paciente/getpin',{id:id}).success(function(data){
                return data;
            });
        });
        return false;
    }

    function showSolicitudpermiso(id){

    }



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