<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Codigocie */
/* @var $form ActiveForm */
?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Ingreso de Codigo Cie</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?= \yii\bootstrap\Tabs::widget([
                'items' => [
                    [
                        'label' => 'Registrar Codigo CIE',
                        'content' => $this->render('form_codigocie', ['model' => $codigo])
                    ],
                    [
                        'label' => 'Listado de Codigo CIE',
                        'content' => $this->render('lista_cie', ['model' => $lista, 'listasearch' => $listasearch])
                    ]
                ]
            ]) ?>
        </div>
    </div>
</div>
