<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */
/* @var $form ActiveForm */
?>
<div class="panel panel-default panel-info col-md-12">
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'action' => ['editar', 'id' => $noticia->id]
        ]); ?>
        <div class="col-md-6">
            <?= $form->field($noticia, 'titulo') ?>
            <?= $form->field($noticia, 'mensaje')->textarea(['cols' => '6', 'rows' => '6']) ?>
            <?= $form->field($noticia, 'anexos') ?>
            <?= $form->field($noticia, 'picture')->fileInput() ?>
            <?= $form->field($noticia, 'estado')->dropDownList(['1' => 'Activo', '0' => 'Inactivo']) ?>
        </div>
        <div class="col-md-6">
            <?= /** @var \app\models\Noticias $noticia */
            \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $noticia->urlimg, ['style' => 'max-height:270px']) ?>
            <br/><br/>
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div><!-- noticias-form_noticias -->
