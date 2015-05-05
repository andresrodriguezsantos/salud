<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EpsCosultorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eps-cosultorio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => 250]) ?>
    <?= Html::activeDropDownList($model, 'idciudad',
        \yii\helpers\ArrayHelper::map(\app\models\Ciudad::find()->all(), 'id', 'nombre'), $options = ['class' => 'form-control']) ?>
    <?= $form->field($model, 'contacto')->textInput(['maxlength' => 500]) ?>
    <br/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
