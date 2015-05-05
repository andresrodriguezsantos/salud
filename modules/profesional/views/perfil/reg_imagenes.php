<?php use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<?php
$form = ActiveForm::begin([
    'action' => ['update'],
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
    <div class="col-md-6">
        <label for="">Foto de Perfil</label><br/>
        <?= Html::img('@web/' . $profesional->urlfoto, ['style' => 'max-height:270px']) ?>
        <br/><br/>
        <label for="">Seleccione una Imagen Para Actualizar la Imagen de Perfil</label>
        <?= $form->field($profesional, 'picture')->fileInput()->label(false) ?>
    </div>
    <div class="col-md-6">
        <label for="">Foto de Registro Profesional</label>
        <?= Html::img('@web/' . $profesional->urlregistro, ['style' => 'max-height:270px']) ?>
        <br/><br/>
        <label for="">Seleccione una Imagen Para Actualizar la Imagen de Registro Profesional</label>
        <?= $form->field($profesional, 'picture2')->fileInput()->label(false) ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>