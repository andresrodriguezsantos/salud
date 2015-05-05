<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Codigocie */
/* @var $form ActiveForm */
?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?= \yii\bootstrap\Tabs::widget([
                'items' => [
                    [
                        'label' => 'Registrar Presentacion',
                        'content' => $this->render('form_presentacion', [
                            'presentacion' => $presentacion,
                            'listapre' => $listapre
                        ])
                    ],
                    [
                        'label' => 'Administracion de Presentaciones a Medicamentos',
                        'content' => $this->render('listadomedicamentos', ['medicamentos' => $medicamentos, 'medicamento' => $medicamento])
                    ]
                    ,
                ]
            ]) ?>
        </div>
    </div>
</div>
