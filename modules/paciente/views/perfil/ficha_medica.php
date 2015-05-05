<?php
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin(
    ['action' => ['update']]
); ?>

    <div class="col-md-6">
        <?= $form->field($model2, 'rh')->dropDownList(
            ['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-']); ?>
        <?= $form->field($model2, 'alergias')->textarea(['rows' => '3']) ?>
    </div>
    <div class="col-md-6">
        <label for="">Enfermedad Actual</label>
        <textarea name="" id="" cols="72" rows="5"></textarea>
    </div>
<?php ActiveForm::end(); ?>