<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Paciente */
/* @var $form ActiveForm */
/** @var $model2 \app\models\Usuario */
?>


<div class="col-md-12">
    <div class="box-body" style="overflow: hidden">

        <div class="col-md-4">
            <? /*= Html::img(\yii\helpers\Url::base() . '/img/logo.jpg',[],false) */ ?>

            <div class="box-header">
                <h3 class="box-title"><b>Crear una Cuenta</b></h3>
            </div>
            <?php $form = ActiveForm::begin([
                'enableAjaxValidation' => true
            ]); ?>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model2, 'nombres') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model2, 'apellidos') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model2, 'cedula') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label">Tipo de Usuario</label>
                    <?= Html::dropDownList('typo', null, [
                        'pac' => 'Paciente',
                        'pro' => 'Profesional',
                        'lab' => 'Laboratorio'
                    ], ['class' => 'form-control']) ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <br/>
                    <label for="">Seleccione un Pais</label>

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
                <?= Html::submitButton('Registrarme', ['class' => 'btn btn-success btn-lg btn-block']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <?= Html::a('¿No puedes acceder a tu cuenta?', '') ?><br/>
            <?= Html::a('Inicia sesion con un codigo de un solo uso', '') ?>
        </div>

        <div class="col-md-8">

            <?= Html::img(\yii\helpers\Url::base() . '/img/opt2.jpg', ['style' => 'margin:10%', 'class' => 'img-responsive']) ?>

        </div>
    </div>
</div>


