<?php
/** @var $this \yii\web\View */
/** @var $form \yii\bootstrap\ActiveForm */
/** @var $model \app\models\optometria\OptExamenexterno */
/** @var $key String */
?>
<div class="panel panel-default">

    <div class="box-body panel-body">
        <h4 class="text-info">Biomicroscopía</h4>

        <div class="col-md-12 row">
            <?= $form->field($model, 'tipo', ['enableLabel' => false, 'inputOptions' => ['value' => $key]])->hiddenInput() ?>
        </div>
        <div class="col-md-6">
            <h4 class="text-info">Ojo Derecho</h4>
            <?= $form->field($model, '[' . $key . ']odphoto')->widget(\kartik\file\FileInput::className(), [
                'options' => ['accept' => 'image/*'],
            ]) ?>
            <?= $form->field($model, '[' . $key . ']odobservacion')->textarea() ?>
        </div>
        <div class="col-md-6">
            <h4 class="text-info">Ojo Izquierdo</h4>
            <?= $form->field($model, '[' . $key . ']oiphoto')->widget(\kartik\file\FileInput::className(), [
                'options' => ['accept' => 'image/*'],
            ]) ?>
            <?= $form->field($model, '[' . $key . ']oiobservacion')->textarea() ?>
        </div>

    </div>
</div>