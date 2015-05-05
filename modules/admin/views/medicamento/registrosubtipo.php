<?php
/** @var $subtipo \app\models\medicamento\MedSubtipoTerapeutico */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>


<div class="tab-pane" id="subtipoterapeutico">
    <div class="col-md-7">
        <h3 style="color: #8EC4EC">Enter New Therapeutic Subtype Form</h3>
        <?php
        $data = \app\models\medicamento\MedTipoTerapeutico::find()
            ->select(['id as value', 'nombre as label'])
            ->asArray()
            ->all(); ?>
        <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => true
        ]); ?>
        <?= $form->field($subtipo, 'idtipoterapeutico')->hiddenInput() ?>
        <label>Filtro de Tipos Terapeuticos</label>
        <?= \yii\jui\AutoComplete::widget([
            'name' => 'nombre',
            'value' => ($subtipo->isNewRecord) ? '' : $subtipo->tipoterapeutico->nombre,
            'clientOptions' => [
                'source' => $data,
                'select' => new \yii\web\JsExpression('
                    function(event,ui){
                        $("#medsubtipoterapeutico-idtipoterapeutico").val(ui.item.value);
                        $(this).val(ui.item.label);
                        return false;
                    }
                ')
            ],
            'options' => [
                'class' => 'form-control'
            ]
        ])
        ?>
        <?= $form->field($subtipo, 'nombre') ?>
        <?php echo $form->field($subtipo, 'estado')->dropDownList(['1' => 'Activo', '0' => 'Inactivo']) ?>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'id' => 'btnformulariosubtipo']) ?>
        </div>
        <?php $form->end(); ?>
        <?php ?>
    </div>
</div>