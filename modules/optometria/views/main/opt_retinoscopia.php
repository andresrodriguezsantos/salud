<?php
/** @var $this yii\web\View */
/** @var $retinoscopia \app\models\optometria\OptRetinoscopia */
/** @var $form \yii\bootstrap\ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel panel-body">
        <?= \yii\bootstrap\Tabs::widget([
            'items' => [
                [
                    'label' => 'Estática',
                    'content' => $this->render('retinoscopia/retinoscopia', [
                        'model' => $retinoscopia,
                        'key' => 'estatica',
                        'form' => $form
                    ])
                ],
                [
                    'label' => 'Dinámica',
                    'content' => $this->render('retinoscopia/retinoscopia', [
                        'model' => $retinoscopia,
                        'key' => 'dinamica',
                        'form' => $form
                    ])
                ],
                [
                    'label' => 'Ciclopegía',
                    'content' => $this->render('retinoscopia/retinoscopia', [
                        'model' => $retinoscopia,
                        'key' => 'ciclopegia',
                        'form' => $form
                    ])
                ],
                [
                    'label' => 'Otra',
                    'content' => $this->render('retinoscopia/retinoscopia', [
                        'model' => $retinoscopia,
                        'key' => 'otra',
                        'form' => $form
                    ])
                ],
            ]
        ]) ?>
    </div>
</div>