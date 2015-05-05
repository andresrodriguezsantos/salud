<?php
/** @var $models \app\models\optometria\OptModuloVersionesducciones[] */
/** @var $optometria \app\models\optometria\Optometria */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <div class="col-md-6">
                    <h4><?= $model->tipo ?></h4>
                    <?= \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $model->urlimg) ?>
                    <h4><?= $model->getAttributeLabel('observacion') ?></h4>
                    <?= \yii\helpers\Html::tag('p', $model->observacion) ?>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div class="col-md-6 col-md-offset-3">
                <?= \yii\helpers\Html::a('Agregar Valores', ['add', 'id' => $optometria->id, 'model' => 'motor'], ['class' => 'btn btn-default btn-block btn-lg']) ?>
            </div>
        <?php endif ?>
    </div>
</div>