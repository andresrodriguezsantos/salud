<?php
/** @var $this yii\web\View */
use kartik\file\FileInput;

/** @var $fondoscopia \app\models\optometria\OptFondoscopia */
/** @var $form \yii\bootstrap\ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
            <h4>Ojo Derecho</h4>
            <?= $form->field($fondoscopia, 'oddirecta') ?>
            <?= $form->field($fondoscopia, 'odindirecta') ?>
            <?= $form->field($fondoscopia, 'odobservacion') ?>
            <?= $form->field($fondoscopia, 'odphoto')->widget(FileInput::className()
                , [
                    'options' => ['accept' => 'image/*']
                ]) ?>
        </div>
        <div class="col-md-6">
            <h4>Ojo Izquierdo</h4>
            <?= $form->field($fondoscopia, 'oidirecta') ?>
            <?= $form->field($fondoscopia, 'oiindirecta') ?>
            <?= $form->field($fondoscopia, 'oiobservacion') ?>
            <?= $form->field($fondoscopia, 'oiphoto')->widget(FileInput::className()
                , [
                    'options' => ['accept' => 'image/*']
                ]) ?>
        </div>
    </div>
</div>