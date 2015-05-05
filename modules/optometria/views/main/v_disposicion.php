<?php
/** @var $this \yii\web\View */
/** @var $optometria \app\models\optometria\Optometria */
?>
<div class="panel panel-default">
    <div class="panel panel-body">
        <h4>Agregar Disposición</h4>

        <div class="col-md-10 col-md-offset-1">
            <?php $form2 = \yii\bootstrap\ActiveForm::begin([
                'action' => ['adddisposicion', 'id' => $optometria->id],
                'enableAjaxValidation' => true,
            ]) ?>
            <div class="col-md-8">
                <?= $form2->field($optometria, 'disposicion')->textarea() ?>
            </div>
            <div class="col-md-4">
                <?= $form2->field($optometria, 'proxcontrol') ?>
            </div>
            <div class="col-md-12">
                <?= \yii\helpers\Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php $form2->end() ?>
        </div>
    </div>
</div>
