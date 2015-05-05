<?php
/**
 * @var $this \yii\web\View
 * @var $paciente \app\models\Paciente
 * @var $control \app\models\PacienteControl
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <i class="glyphicon glyphicon-pencil"></i>

            <h3 class="box-title">Agregar Nota: <span
                    class="text-danger"><?= $paciente->usuario->nombres . ' ' . $paciente->usuario->apellidos ?></span>
            </h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?php $form = ActiveForm::begin([
                // 'enableAjaxValidation' => true,
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>
            <div class="col-md-6">
                <?= $form->field($control, 'notas')->textarea(['rows' => 5, 'cols' => 10]) ?>
                <div class="form-footer">
                    <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= $form->field($control, 'urlimg')->widget(\kartik\file\FileInput::className(), [
                    'options' => ['accept' => 'image/*'],
                ]) ?>
            </div>
        </div>
    </div>
</div>