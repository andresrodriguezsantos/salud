<?php use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(
    ['action' => ['update']]
); ?>
    <div class="col-md-6">
        <?= $form->field($model, 'direccion') ?>
        <?= $form->field($model, 'email') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'telefonocelular') ?>
        <?= $form->field($model, 'telefonofijo') ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>