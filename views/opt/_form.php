<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\optometria\Optometria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="optometria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'motivoconsulta')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'antecedentefamiliar')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'antecedentepersonal')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'disposicion')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'historia_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
