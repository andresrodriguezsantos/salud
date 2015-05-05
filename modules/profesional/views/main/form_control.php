<?php
/**
 * @var $form ActiveForm
 * @var $historia \app\models\Historia
 * @var $data array
 */
use kartik\popover\PopoverX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Ingreso de Control Medico</h3>
            <?= PopoverX::widget([
                'header' => 'Información',
                'size' => PopoverX::SIZE_LARGE,
                'type' => PopoverX::TYPE_INFO,
                'placement' => PopoverX::ALIGN_LEFT_TOP,
                'content' => 'Servicio de ayuda',
                'toggleButton' => ['label' => '<i class="glyphicon glyphicon-question-sign"></i> Ayuda',
                    'class' => 'btn btn-info btn-xs pull-right', 'style' => 'margin: 10px;']
            ]) ?>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?php
            $form = ActiveForm::begin([
                // 'enableAjaxValidation' => true,
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>
            <div class="col-md-6">
                <b>Notas del Control</b>
                <?= $form->field($control, 'notas')->textarea(['rows' => 5, 'cols' => 10])->label(false) ?>
                <div class="form-footer">
                    <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <div class=" col-md-6">
                <?= $form->field($control, 'picture')->fileInput() ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>