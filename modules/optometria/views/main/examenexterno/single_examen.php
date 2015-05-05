<?php
/** @var $this \yii\web\View */
/** @var $form \yii\bootstrap\ActiveForm */
/** @var $model \app\models\optometria\OptExamenexterno */
/** @var $layout String */
?>
<div class="<?= $layout ?>">
    <div class="box-header">
        <h4><?= ucwords($model->tipo) ?></h4>
    </div>
    <div class="box-body row">
        <div class="col-md-6">
            <h4 class="text-info">Ojo Derecho</h4>
            <?= $form->field($model, 'odphoto')->widget(\kartik\file\FileInput::className(), [
                'options' => ['accept' => 'image/*'],
            ]) ?>
            <?= $form->field($model, 'odobservacion') ?>
        </div>
        <div class="col-md-6">
            <h4 class="text-info">Ojo Izquierdo</h4>
            <?= $form->field($model, 'oiphoto')->widget(\kartik\file\FileInput::className(), [
                'options' => ['accept' => 'image/*'],
            ]) ?>
            <?= $form->field($model, 'oiobservacion') ?>
        </div>
        <?= $form->field($model, 'tipo', ['enableLabel' => false, 'inputOptions' => ['value' => $model->tipo]])->hiddenInput() ?>
    </div>
</div>