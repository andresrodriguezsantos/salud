<?php
/** @var $this \yii\web\View */
/** @var $form \yii\bootstrap\ActiveForm */
/** @var $optometria \app\models\optometria\Optometria */
?>
<div class="panel panel-default">
    <div class="panel panel-body">
        <div class="col-md-8">
            <?= $form->field($optometria, 'disposicion')->textarea() ?>
        </div>
        <!-- <div class="col-md-4">
             /*= $form->field($optometria, 'proxcontrol',[
                 'inputOptions'=>[
                     'placeholder'=>'Ej: 1 año'
                 ]
             ]) */
         </div>-->
        <div class="col-md-4">
            <?= $form->field($optometria, 'proxcontrol')->dropDownList(
                \app\shelper\OptometriaHel::getProximocontrol()
            ) ?>
        </div>
    </div>
</div>