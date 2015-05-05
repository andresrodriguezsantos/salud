<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Areasalud */
/* @var $form ActiveForm */
?>

<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <i class="glyphicon glyphicon-"></i>

            <h3 class="box-title">Registro de Areas de la salud para asignar a medicamentos</h3>
        </div>
        <div class="box-body" style="overflow:hidden;">
            <div class="col-md-6">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'nombre') ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-6">
                <label for="">Listado de Areas de Salud</label>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lista as $l) { ?>
                        <tr>
                            <td><?= $l->nombre ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
