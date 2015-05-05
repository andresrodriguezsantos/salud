<?php use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(
    ['action' => ['update']]
); ?>
    <div class="col-md-6">
        <?= $form->field($model2, 'nombreacudiente') ?>
        <?= $form->field($model2, 'ocupacion') ?>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col-md-6">
        <?= $form->field($model2, 'telefonocelular') ?>
        <?= $form->field($model2, 'telefonoacudiente') ?>
    </div>

<?php ActiveForm::end(); ?>