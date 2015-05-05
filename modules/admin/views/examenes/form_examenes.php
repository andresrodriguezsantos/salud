<?php

use app\models\Areasalud;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\examenes */
/* @var $form ActiveForm */
?>


<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <i class="glyphicon glyphicon-"></i>

            <h3 class="box-title">Formulario para ingresar examenes medicos</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <div class="col-md-6">
                <?php $form = ActiveForm::begin(); ?>
                <?php
                $data = Areasalud::find()
                    ->select(['id as value', 'nombre as label'])
                    ->asArray()
                    ->all();
                ?>
                <?= /** @var \app\models\Examenes $examen */
                $form->field($examen, 'idareasalud')->hiddenInput()->label(false) ?>
                <label>Filtro de Areas de Salud</label>
                <?= AutoComplete::widget([
                    'name' => 'nombre',
                    'value' => ($examen->isNewRecord) ? '' : $examen->nombre,
                    'clientOptions' => [
                        'source' => $data,
                        'select' => new JsExpression('
                    function(event,ui){
                        $("#examenes-idareasalud").val(ui.item.value);
                        $(this).val(ui.item.label);
                        return false;
                    }
                ')
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ]
                ])
                ?>
                <?= $form->field($examen, 'nombre') ?>
                <?= $form->field($examen, 'tipo') ?>
                <div class="form-footer">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-6">
                <label for="">Lista de Examenes</label>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Examen</th>
                        <th>Tipo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var \app\models\Examenes $l */
                    foreach ($lista as $l): ?>
                        <tr>
                            <td><?= $l->nombre ?></td>
                            <td><?= $l->tipo ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
