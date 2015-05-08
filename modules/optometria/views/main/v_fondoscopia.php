<?php
/** @var $model \app\models\optometria\OptFondoscopia */
use yii\helpers\Html;

?>
<div class="panel panel-default">
    <div class="panel panel-body">
        <div class="col-md-6">
            <?php if ($model->odurlimg): ?>
                <?= Html::tag('h4', $model->getAttributeLabel('odurlimg')) ?>
                <div class="col-md-offset-2 col-md-8">
                    <?= Html::img('@web/' . $model->odurlimg) ?>
                </div>

            <?php else: ?>
                <?= \yii\bootstrap\Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                        'style' => 'margin-left: 0;'
                    ],
                    'body' => 'Sin Imagen',
                    'closeButton' => false
                ]) ?>
            <?php endif ?>
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'oddirecta', 'odindirecta', 'odobservacion',
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?php if ($model->oiurlimg): ?>
                <?= Html::tag('h4', $model->getAttributeLabel('oiurlimg')) ?>
                <div class="col-md-offset-2 col-md-8">
                    <?= Html::img('@web/' . $model->oiurlimg) ?>
                </div>
            <?php else: ?>
                <?= \yii\bootstrap\Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                        'style' => 'margin-left: 0;'
                    ],
                    'body' => 'Sin Imagen',
                    'closeButton' => false
                ]) ?>
            <?php endif ?>
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'oidirecta', 'oiindirecta', 'oiobservacion',
                ]
            ]) ?>
        </div>
    </div>
</div>