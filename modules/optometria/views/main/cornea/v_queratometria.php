<?php
/** @var $model \app\models\optometria\OptCorneaQueratometria */
/** @var $optometria \app\models\optometria\Optometria */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-sm-6">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'odesfera', 'odcilindro', 'odeje'
                ]
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'oioesfera', 'oicilindro', 'oieje'
                ]
            ]) ?>
        </div>
    </div>
</div>
