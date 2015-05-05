<?php use yii\helpers\Html; ?>
<div class="col-md-12">
    <div class="box-header">
        <i class="glyphicon glyphicon-"></i>

        <h3 class="box-title">¿Quienes somos?</h3>
    </div>
    <div class="box-body">
        <div class="col-md-6">
            <p style="text-align: justify">
                Clinikbox es una organización privada que promueve la implementación de sistemas de información clínica
                a profesionales, pacientes, laboratorios e instituciones públicas y privadas vinculadas con el sector
                de la salud en Latinoamérica y el mundo, para establecer protocolos de información portable que
                faciliten la universalidad y portabilidad de información clínica de los pacientes, así como la
                administración ágil de esta información por parte de los profesionales para brindar mejor atención y
                calidad de vida a sus pacientes.
                Administramos esta información de manera responsable y confidencial para el uso profesional, así como
                para establecer perfiles epidemiológicos que contribuyan al estudio de prevalencia de las enfermedades,
            </p>
        </div>
        <div class="col-md-6">
            <?=
            Html::img(\yii\helpers\Url::base() . '/img/opt2.jpg', ['class' => 'img-responsive']) ?>
        </div>

        <div class="col-md-6">
            <?=
            Html::img(\yii\helpers\Url::base() . '/img/opt2.jpg', ['class' => 'img-responsive']) ?>
        </div>
        <div class="col-md-6">
            <p style="text-align: justify">
                <br/>
                en aras de promover políticas y acciones tendientes a mejorar los perfiles epidemiológicos en el mundo.
                La organización tiene por objeto integrar la información clínica de los pacientes en un solo sitio
                virtual
                para proveer el acceso remoto fácil y gratuito cada vez que realice un evento clínico como nuevo
                diagnóstico,
                consulta, control o seguimiento, especialmente en pacientes cuya condición de salud les obliga a asistir
                periódicamente a los servicios médicos especializados.
            </p>
        </div>
    </div>

</div>
