<?php
/** @var \app\models\laboratorio\LabSede $lab_sede
 * @var \app\models\laboratorio\LabUsuario $usuario
 */

?>


<div class="col-md-12">
    <div class="box box-info">
        <div class="box-body"  style="overflow: hidden">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="text-info"><?=$lab_sede->laboratorio->nombre?></h3>
                    <h4> NIT : <?= $lab_sede->laboratorio->nit ?></h4>
                    <h4><?= $lab_sede->laboratorio->direccion ?></h4>
                </div>
            </div>
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><?= \yii\helpers\Html::a('Editar Perfil', \yii\helpers\Url::base() . '/laboratorio/admin/actualizarlaboratorio', ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= \yii\helpers\Html::a('Medicamentos', \yii\helpers\Url::base() . '/medicamento/admin' , ['class' => 'menu-btn']) ?>
                        <!--<ul class="list-group" style="display: none">
                            <li class="list-group-item">
                                </*= \yii\helpers\Html::a('Registrar Medicamento', \yii\helpers\Url::base() . '/medicamento/admin', ['class' => 'menu-btn']) */?>
                            </li>
                            <li class="list-group-item">
                                </*= \yii\helpers\Html::a('Registrar Presentaciones', \yii\helpers\Url::base() . '/medicamento/admin/registrarpresentacion', ['class' => 'menu-btn']) */?>
                            </li>
                        </ul>-->
                    </li>
                    <li class="list-group-item"><?= \yii\helpers\Html::a('Portafolio de Servicios','', ['class' => 'menu-btn']) ?></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="col-md-12 text-center">
                    <h2 class="text-info"><?= $lab_sede->laboratorio->nombre ?></h2>
                    <p>Ahora su portafolio de productos y servicios está al alcance de sus clientes.
                        Profesionales de la salud dispondrán en línea de sus productos para informarse y
                        efectuar una fácil y ágil prescripción de medicamentos, dispositivos médicos y
                        servicios de asistencia médica.
                    </p>
                    <p>
                        Su portafolio disponible 24 horas, en cualquier lugar, en cualquier computador,
                        tableta y celular de los profesionales de salud. Visibilice sus productos y amplíe su
                        participación en ventas con el profesional de la salud. Pruébelo ahora. ¡Es gratuito!
                    </p>
                </div>
                <div class="col-md-8">

                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
</div>