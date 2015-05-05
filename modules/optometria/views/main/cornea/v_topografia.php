<?php
/** @var $model \app\models\optometria\OptCorneaTopografia */
/** @var $optometria \app\models\optometria\Optometria */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if (!$model->isNewRecord): ?>
            <div class="col-sm-6">
                <h4><?= $model->getAttributeLabel('oiurlimg') ?></h4>

                <div class="text-center">
                    <?= \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $model->oiurlimg) ?>
                </div>
                <h4><?= $model->getAttributeLabel('oiobservacion') ?></h4>
                <?= \yii\helpers\Html::encode($model->oiobservacion) ?>
            </div>
            <div class="col-sm-6">
                <h4><?= $model->getAttributeLabel('odurlimg') ?></h4>

                <div class="text-center">
                    <?= \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $model->odurlimg) ?>
                </div>
                <h4><?= $model->getAttributeLabel('odobservacion') ?></h4>
                <?= \yii\helpers\Html::encode($model->odobservacion) ?>
            </div>
        <?php else: ?>
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-info">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                    Sin valores agregados !
                </div>
                <?php //\yii\helpers\Html::a('Agregar Valores',['add','id'=>$optometria->id,'model'=>'cornea'],['class'=>'btn btn-default btn-block btn-lg']) ?>
            </div>
        <?php endif; ?>
    </div>
</div>