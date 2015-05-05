<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Paciente */
/* @var $form ActiveForm */
/** @var $model2 \app\models\Usuario */
?>



    <div class="col-md-12">
        <!--    <div class="box">-->
        <div class="box-body" style="overflow: hidden">
            <div class="col-md-6">
                <div>
                    <?= Html::img(\yii\helpers\Url::base() . '/img/logo.jpg', [], false) ?>
                </div>
                <div class="box-header">
                    <h3 class="box-title"><b>Crear cuenta</b></h3>
                </div>
                <div class="row col-md-12 form-group">
                    <div class="row col-md-7">
                        <label class="control-label">ingresar como</label>
                        <?= Html::dropDownList('typo', null, [
                            'pac' => 'Paciente',
                            'pro' => 'Profesional',
                            'lab' => 'Laboratorio'
                        ], ['class' => 'form-control', 'id' => 'tipocuenta']) ?>
                    </div>
                </div>
                <div id="registrodual" class="form-group">
                    <?php $form = ActiveForm::begin([
                        //'enableAjaxValidation' => true,
                        'action' => ['registro']
                    ]); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model2, 'nombres') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model2, 'apellidos') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model2, 'cedula') ?>
                        </div>
                        <div class="col-md-6">
                            <label for="">país</label>

                            <div class="form-group field-idpais-required">
                                <?= $form->beginField($model2, 'idpais'); ?>
                                <?= Html::activeDropDownList($model2, 'idpais',
                                    \yii\helpers\ArrayHelper::map(\app\models\Pais::find()->orderBy('nombre asc')->all(), 'id', 'nombre'),
                                    ['class' => 'form-control']
                                ) ?>
                                <?= $form->endField() ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?= Html::submitButton('Registrarme', ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Iniciar Sesion', '../site/login', ['class' => 'btn btn-button btn-info']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <br/>
                    <?= Html::a('¿No puedes acceder a tu cuenta?', '') ?><br/>
                    <?= Html::a('Inicia sesion con un codigo de un solo uso', '') ?>
                </div>
                <div id="registrolab" class="form-group">
                    <?php $form = ActiveForm::begin([
                        'action' => ['registrolaboratorio'],
                    ]); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($laboratorio, 'nombre') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($laboratorio, 'nit') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($laboratorio, 'direccion') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($laboratorio, 'telefono') ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?= Html::submitButton('Registrarme', ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Iniciar Sesion', '../site/login', ['class' => 'btn btn-button btn-info']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <br/>
                    <?= Html::a('¿No puedes acceder a tu cuenta?', '') ?><br/>
                    <?= Html::a('Inicia sesion con un codigo de un solo uso', '') ?>

                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <?= Html::img(\yii\helpers\Url::base() . '/img/opt2.jpg', ['style' => 'margin:20%']) ?>
                </div>
            </div>
        </div>
        <!--    </div>-->
    </div>

<?php $this->registerJsFile('@web/js/registrousuario.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END,
]) ?>