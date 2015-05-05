
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\laboratorio\laboratorio */
/* @var $form ActiveForm */
/** @var $user \app\models\Usuario */

$this->title = Yii::t('site', 'Laboratory Registration');
$this->params['breadcrumbs'][] = ['url' => ['registro'], 'label' => 'Laboratory Registration'];
$this->params['breadcrumbs'][] = $this->title;

?>



<div class="col-md-12">
    <div class="box box-success ">
        <div class="box-header">
            <i class="fa fa- glyphicon glyphicon-registration-mark "></i>
            <h3 class="box-title">Actualizar Informacion de su Laboratorio</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?php $form = ActiveForm::begin([
                    'action'=>'actualizarlaboratorio'
                ]
            ); ?>
            <div class="col-md-6">
                <?= $form->field($model, 'nombre') ?>
                <?= $form->field($model, 'nit') ?>
                <?= $form->field($model, 'direccion') ?>
                <?= $form->field($model, 'telefono') ?>
                <div class="box-footer">
                    <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary btnenviarform']) ?>
                    <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-warning']) ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'nota')->textarea(['rows'=>10,'cols'=>10]) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
