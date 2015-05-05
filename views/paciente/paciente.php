<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Paciente */
/* @var $form ActiveForm */
?>
<div class="paciente">

    <?php $form = ActiveForm::begin(); ?>

    <?= \yii\jui\DatePicker::widget([
        'model' => $model,
        'attribute' => 'fechanacimiento'
    ]) ?>
    <?= $form->field($model, 'ocupacion') ?>
    <?= $form->field($model, 'fechaingreso') ?>
    <?= $form->field($model, 'telefonocelular') ?>
    <?= $form->field($model, 'nombreacudiente') ?>
    <?= $form->field($model, 'telefonoacudiente') ?>
    <?= $form->field($model, 'idusuario') ?>
    <?= $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- paciente -->
