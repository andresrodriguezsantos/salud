<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profesional */
/* @var $form ActiveForm */
?>
<div class="profesional">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'registroprofesional') ?>
    <?= $form->field($model, 'urlfoto') ?>
    <?= $form->field($model, 'urlregistro') ?>
    <?= $form->field($model, 'idusuario') ?>
    <?= $form->field($model, 'idprofesion') ?>
    <?= $form->field($model, 'idepsconsultorio') ?>
    <?= $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- profesional -->
