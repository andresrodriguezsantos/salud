<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $usuario app\models\usuario */
/* @var $profesional app\models\Profesional */
/* @var $profesion app\models\Profesion */
/* @var $prof_eps app\models\ProfesionalEps */
/* @var $eps app\models\EpsCosultorio */
/* @var $form ActiveForm */
?>


    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title" style="color: #8EC4EC">Informacion Personal del Profesional</h3>
            </div>
            <div class="box-body" style="overflow: hidden">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li><a href="#pass" data-toggle="tab">Seguridad</a></li>
                        <li  <?= (Yii::$app->request->get('id')) ? 'class="active"' : ''; ?>><a href="#salud"
                                                                                                data-toggle="tab">Eps
                                Asignado</a></li>
                        <li><a href="#imagenes" data-toggle="tab">Imagenes</a></li>
                        <li><a href="#contacto" data-toggle="tab">Datos de Contacto</a></li>
                        <li><a href="#estudio" data-toggle="tab">Estudios</a></li>
                        <li <?= (Yii::$app->request->get('id')) ? '' : 'class="active"'; ?>><a href="#personal"
                                                                                               data-toggle="tab">Datos
                                Personales</a></li>
                        <li class="pull-left header" style="color: #8EC4EC"><i class="glyphicon glyphicon-th-large"></i>
                        </li>
                    </ul>
                    <div class="tab-content" style="overflow: hidden">

                        <div class="tab-pane <?= (Yii::$app->request->get('id')) ? '' : 'active'; ?>" id="personal">
                            <?= Yii::$app->controller->renderPartial('reg_datospersonales', [
                                'usuario' => $usuario,
                                'profesional' => $profesional
                            ]) ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane col-md-12" id="estudio">
                            <?= Yii::$app->controller->renderPartial('reg_estudios', [
                                'allestudios' => $allestudios,
                                'estudios' => $estudios
                            ]) ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane col-md-12" id="contacto">
                            <?= Yii::$app->controller->renderPartial('reg_contacto', [
                                'usuario' => $usuario
                            ]) ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane <?= (Yii::$app->request->get('id')) ? 'active' : ''; ?>" id="salud">
                            <?= Yii::$app->controller->renderPartial('reg_salud', [
                                'eps' => $eps,
                                'prof_eps' => $prof_eps,
                                'ciudad' => $usuario->idciudad
                            ]) ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane col-md-12" id="imagenes">
                            <?= Yii::$app->controller->renderPartial('reg_imagenes', [
                                'profesional' => $profesional
                            ]) ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane col-md-12" id="pass">
                            <?= Yii::$app->controller->renderPartial('reg_seguridad', [
                                'usuario' => $usuario
                            ]) ?>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </div>

<?php $this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/global.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]) ?>
<?php $this->registerJs("$.comprobar($('select[name=\"Usuario[idciudad]\"]'))") ?>