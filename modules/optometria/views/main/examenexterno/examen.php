<?php
/** @var $this \yii\web\View */
/** @var $form \yii\bootstrap\ActiveForm */
/** @var $model \app\models\optometria\OptExamenexterno */
/** @var $key String */
/** @var $layout String */
?>
<div class="<?= $layout ?>">
    <div class="box-header">
        <h4><?= ucwords($key) ?></h4>
    </div>
    <div class="box-body row">
        <h4 class="text-info">Ojo Derecho</h4>
        <?= $form->field($model, 'tipo', ['enableLabel' => false, 'inputOptions' => ['value' => $key]])->hiddenInput() ?>
        <?= $form->field($model, '[' . $key . ']odphoto')->widget(\kartik\file\FileInput::className(), [
            'options' => ['accept' => 'image/*'],
        ]) ?>
        <?= $form->field($model, '[' . $key . ']odobservacion')->textarea() ?>
        <h4 class="text-info">Ojo Izquierdo</h4>
        <?= $form->field($model, '[' . $key . ']oiphoto')->widget(\kartik\file\FileInput::className(), [
            'options' => ['accept' => 'image/*'],
        ]) ?>
        <?= $form->field($model, '[' . $key . ']oiobservacion')->textarea() ?>
    </div>
</div>