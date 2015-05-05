<?php
/**
 * @var $model \app\models\optometria\OptControl
 * @var $this \yii\web\View
 */
use kartik\file\FileInput;

?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <i class="glyphicon glyphicon-edit"></i>

            <h3 class="box-title">Agregar nuevo control a historia clinica</h3>
        </div>
        <div class="box-body">
            <?php $form = \yii\bootstrap\ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
            ]) ?>
            <?= $form->field($model, 'nota') ?>
            <?= $form->field($model, 'pic[]')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'multiple' => 'multiple'],
                'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png']
                ]]) ?>
            <?php $form->end(); ?>
        </div>
    </div>
</div>