<?php
/** @var $model \app\models\optometria\OptExamenexterno */
?>
<div class="col-md-6">
    <h4>Ojo Derecho</h4>
    <?php if(!empty($model->odurlimg)): ?>
    <?= \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $model->odurlimg) ?>
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
    <h4><?= $model->getAttributeLabel('observacion') ?></h4>
    <?= \yii\helpers\Html::tag('p', $model->odobservacion) ?>
</div>
<div class="col-md-6">
    <h4>Ojo Izquierdo</h4>
    <?php if(!empty($model->oiurlimg)): ?>
    <?= \yii\helpers\Html::img('@web/' . $model->oiurlimg) ?>
    <?php else: ?>
        <?= \yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-info',
                'style' => 'margin-left: 0;'
            ],
            'body' => 'Sin Imagen',
            'closeButton' => false
        ]) ?>
    <?php endif; ?>
    <h4><?= $model->getAttributeLabel('observacion') ?></h4>
    <?= \yii\helpers\Html::tag('p', $model->oiobservacion) ?>
</div>