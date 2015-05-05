<?php
/** @var $this \yii\web\View */
/** @var $cornea \app\models\optometria\OptCornea */
/** @var $corneaqueratometria \app\models\optometria\OptCorneaQueratometria */
/** @var $corneatopografia \app\models\optometria\OptCorneaTopografia */
/** @var $form \yii\bootstrap\ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?= \yii\bootstrap\Tabs::widget([
            'items' => [
                [
                    'label' => 'Queratometría',
                    'content' => $this->render('cornea/queratometria', [
                        'queratometria' => $corneaqueratometria,
                        'form' => $form
                    ])
                ],
                [
                    'label' => 'Topografía',
                    'content' => $this->render('cornea/topografia', [
                        'topografia' => $corneatopografia,
                        'form' => $form
                    ])
                ]
            ]
        ]) ?>
    </div>
</div>