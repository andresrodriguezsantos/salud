<?php
/**
 * @var $form ActiveForm
 * @var $historia \app\models\Historia
 * @var $control \app\models\PacienteControl
 * @var $data array
 */
use kartik\popover\PopoverX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Ingreso de Notas Medicas</h3>
            <?= PopoverX::widget([
                'header'=>'Información',
                'size'=>PopoverX::SIZE_LARGE,
                'type'=>PopoverX::TYPE_INFO,
                'placement'=>PopoverX::ALIGN_LEFT_TOP,
                'content'=>'En este formulario puede ingresar Informacion que estime conveniente <br>
                            compartir con el profesional encargado <br>
                            Campos resqueridos: <br>
                            * El campo nota es de caracter obligatorio. <br>
                            * La imagen es opcional ( puede cargar fotos de examenes) <br>
                            * El campo Profesional es de caracter obligatorio y le permite seleccionar al profesional',

                'toggleButton'=>['label'=>'<i class="glyphicon glyphicon-question-sign"></i> Ayuda',
                    'class'=>'btn btn-info btn-xs pull-right','style'=>'margin: 10px;']
            ]) ?>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?php
            $form = ActiveForm::begin([
               // 'enableAjaxValidation' => true,
                'options'=>[
                    'enctype'=>'multipart/form-data'
                ]
            ]); ?>
            <div class="col-md-6">
                <?= $form->field($control, 'notas')->textarea(['rows'=>5,'cols'=>10]) ?>
                <?= $form->field($control, 'urlimg')->fileInput() ?>
                <div class="form-footer">
                    <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <div class="col-md-6">
                <b>Nombre del Profesional</b>
                <?= $form->field($historia,'profesional_id')->dropDownList($data)->label(false) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>