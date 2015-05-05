<?php

use app\models\EpsCosultorio;
use app\models\AfiliadoEps;
use app\models\Paciente;
use Faker\Provider\Image;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\usuario */
/* @var $model3 app\models\AfiliadoEps */
/* @var $model app\models\Paciente  */
/* @var $form ActiveForm */
/* @var $data app\models\AfiliadoEps[] */
?>


<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title" style="color: #8EC4EC">Informacion Personal de Paciente</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li><a href="#pass" data-toggle="tab">Seguridad</a></li>
                        <li><a href="#contacto" data-toggle="tab">Datos de Contacto</a></li>
                        <li><a href="#emergencia" data-toggle="tab">En caso de Emergencia Contactar a:</a></li>
                        <li <?= (Yii::$app->request->get('id'))? 'class="active"':''; ?>><a href="#salud" data-toggle="tab">Aseguradora Medica</a></li>
                        <li><a href="#ficha" data-toggle="tab">Ficha Medica</a></li>
                        <li <?= (Yii::$app->request->get('id'))? '':'class="active"'; ?>><a href="#personal" data-toggle="tab">Datos Personales</a></li>
                        <li class="pull-left header" style="color: #8EC4EC"><i class="glyphicon glyphicon-th-large"></i> </li>
                    </ul>
                    <div class="tab-content" style="overflow: hidden">
                        <div class="tab-pane <?= (Yii::$app->request->get('id'))? '':'active'; ?>" id="personal">
                            <?=Yii::$app->controller->renderPartial('reg_datos_personales',[
                                'model'=>$model,
                                'model2'=>$model2
                            ])?>

                        </div><!-- /.tab-pane -->
                        <div class="tab-pane col-md-12" id="contacto">
                                <?=  Yii::$app->controller->renderPartial('reg_contacto',[
                                    'model'=>$model
                                ])?>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane <?= (Yii::$app->request->get('id'))? 'active':''; ?>" id="salud">
                            <?=Yii::$app->controller->renderPartial('reg_aseguradora',[
                                'model3'=>$model3,
                                'data'=>$data
                            ])?>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane col-md-12" id="emergencia">
                           <?= Yii::$app->controller->renderPartial('reg_emergencia',[
                                'model2'=>$model2
                           ])?>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane col-md-12" id="ficha">
                            <?= Yii::$app->controller->renderPartial('ficha_medica',[
                                'model2'=>$model2
                            ])?>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane col-md-12" id="pass">
                            <?= Yii::$app->controller->renderPartial('reg_seguridad',[
                                'model'=>$model,
                            ])?>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
        </div>
    </div>
</div>

<?php $this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/global.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]) ?>