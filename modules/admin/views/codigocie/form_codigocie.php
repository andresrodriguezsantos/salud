<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'enableAjaxValidation' => true,
]); ?>
    <div class="col-md-6">
        <?= $form->field($model, 'codigo') ?>
        <?= $form->field($model, 'nombre') ?>
        <?= $form->field($model, 'definicionprofesional')->textarea(['cols' => '6', 'rows' => '8']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'definicionpaciente')->textarea(['cols' => '6', 'rows' => '8']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>