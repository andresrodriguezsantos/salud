<?php
/** @var \app\models\Usuario $usuario */
?>

<div class="col-md-12" style="margin-top: 0">
    <div class="box box-info">
        <div class="box-body" style="overflow: hidden">
            <h3 style="color: #8EC4EC">Bienvenido(a) de Nuevo</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-4">
                        <h2 style="margin-bottom: 2px; margin-top: 2px"><?= $usuario->nombres . ' ' . $usuario->apellidos ?></h2>
                        <h6 class="text-info"><?= $usuario->cedula ?></h6>
                        <h5 class="text-danger">Contacto de Emergencia:</h5>
                        <h5><?= ($usuario->paciente->telefonoacudiente) ?
                                $usuario->paciente->telefonoacudiente : 'No ha registrado datos de Contacto' ?>
                        </h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Factor RH: <strong><?= $usuario->paciente->rh ?></strong></h5>
                        <h5>Edad: <strong><?= \app\shelper\Util::edad($usuario->paciente->fechanacimiento) ?></strong></h5>
                        <h5>Contacto Personal: <strong><?= $usuario->paciente->telefonocelular ?></strong></h5>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-danger">Alegias: <strong><?= $usuario->paciente->alergias ?></strong></h5>
                        <h5 class="text-danger">Enfermedad Actual: </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body" style="overflow: hidden">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><?= \yii\helpers\Html::a('Historia', ['/paciente/home/historia/','id'=>$usuario->paciente->id], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= \yii\helpers\Html::a('Anotación', \yii\helpers\Url::base() ."/paciente/home/notas", ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= \yii\helpers\Html::a('Actualizar Datos', \yii\helpers\Url::base() . '/paciente/perfil', ['class' => 'menu-btn']) ?></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="col-md-12 text-center">
                    <h2 class="text-info">Su Historia Clinica Ahora siempre Disponible</h2>

                    <p>
                        Ahora usted siempre estara enterado de su evolucion medica,
                        CLINIKBOX se lo garantiza
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