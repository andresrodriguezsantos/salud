<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EpsCosultorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <i class="glyphicon glyphicon-"></i>

            <h3 class="box-title">Registro de Consultorios</h3>
        </div>
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6">
                <?= $form->field($eps, 'nombre')->textInput(['maxlength' => 250]) ?>
                <?= $form->field($eps, 'direccion')->textInput(['maxlength' => 250]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($eps, 'contacto')->textInput(['maxlength' => 500]) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton($eps->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $eps->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>