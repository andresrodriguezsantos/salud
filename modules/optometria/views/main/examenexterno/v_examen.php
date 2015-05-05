<?php
/** @var $model \app\models\optometria\OptExamenexterno */
?>
<div class="col-md-6">
    <h4><?= $model->tipo ?></h4>
    <?= \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $model->odurlimg) ?>
    <h4><?= $model->getAttributeLabel('observacion') ?></h4>
    <?= \yii\helpers\Html::tag('p', $model->odobservacion) ?>
</div>
<div class="col-md-6">
    <h4><?= $model->tipo ?></h4>
    <?= \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $model->oiurlimg) ?>
    <h4><?= $model->getAttributeLabel('observacion') ?></h4>
    <?= \yii\helpers\Html::tag('p', $model->oiobservacion) ?>
</div>