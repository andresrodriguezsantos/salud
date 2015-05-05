<?php
/**
 * @var $usuario app\models\usuario
 * @var \app\models\ProfesionalTitulos $estudios
 * @var $profesional app\models\profesional
 */

?>

<div class="col-md-12">
    <div class="box box-success">
        <div class="box-body" style="overflow: hidden">
            <div class="col-md-4">
                <h2 style="color: #8EC4EC"><?= 'Dr(a). ' . $usuario->nombres . ' ' . $usuario->apellidos ?></h2>
                <label for=""><?= ($estudios) ? $estudios[0]->nombre : '' ?></label><br/>
                <label for=""><?= 'Reg. CTNPO: ' . $usuario->profesional->registroprofesional ?></label>
                <label for="">Datos de Ubicacion : <?= $usuario->direccion ?></label><br/>
                <label for="">Ciudad : <?= $usuario->ciudad->nombre ?></label>
            </div>
            <div class="col-md-4">
                <br/><br/><br/>
                <?php if ($alleps) ?>
                <label for=""><?= $alleps[0]->eps->nombre ?></label><br/>
                <label for=""><?= $alleps[0]->profesion->descripcion ?></label><br/>
                <label for=""><?= $alleps[0]->eps->direccion ?></label>
            </div>
            <div class="col-md-4">
                <?= \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $usuario->profesional->urlfoto, ['style' => 'max-height:270px']) ?>
            </div>

            <div class="col-md-12">
                <div class="box-body" style="overflow: hidden">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <li class="list-group-item"><?= \yii\helpers\Html::a('Paciente', \yii\helpers\Url::base() . "/optometria/main/list", ['class' => 'menu-btn']) ?></li>
                            <li class="list-group-item"><?= \yii\helpers\Html::a('Perfil Profesional', \yii\helpers\Url::base() . "/profesional/perfil", ['class' => 'menu-btn']) ?></li>
                            <li class="list-group-item"><?= \yii\helpers\Html::a('Estadisticas', '#', ['class' => 'menu-btn']) ?></li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12 text-center">
                            <h2 class="text-info">Optometria</h2>

                            <p style="text-align: justify">
                                Sus registros de pacientes, historias clínicas, certificados, exámenes,
                                tratamientos e información vital, ahora en su computador, tableta y celular.
                                La administración de sus historias clínicas ahora será diferente;
                                en cualquier lugar, a cualquier hora dispondrá de la información clínica de
                                sus pacientes, como llevar su archivo en la web.
                            </p><br/>

                            <p style="text-align: justify">
                                Sus reportes, remisiones, órdenes de exámenes, certificados y prescripciones,
                                todo en un solo lugar, es una experiencia ágil que privilegiará a sus pacientes.
                                Pruébelo ahora. ¡Es gratuito!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>