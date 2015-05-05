<?php
/** @var $tipo */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<div class="tab-pane" id="tipoterapeutico">
    <div class="col-md-7">
        <h3 style="color: #8EC4EC">Enter New Therapeutic Type Form</h3>
        <?php
        $form = ActiveForm::begin(); ?>
        <?= $form->field($tipo, 'nombre') ?>
        <?= $form->field($tipo, 'estado')->dropDownList(['1' => 'Activo', '0' => 'Inactivo']) ?>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>