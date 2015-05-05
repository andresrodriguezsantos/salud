<?php
/** @var $model \app\models\optometria\OptRxenuso */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-sm-4">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Formula',
                        'value' => $model->odesfera . ' ' . $model->odcilindro . ' x ' . $model->odeje
                    ],
                    'oddip',
                    'odadd',
                    'oddm'
                ]
            ]) ?>
        </div>
        <div class="col-sm-4">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Formula',
                        'value' => $model->oiesfera . ' ' . $model->oicilindro . ' x ' . $model->oieje
                    ],
                    'oidip',
                    'oiadd',
                    'oidm'
                ]
            ]) ?>
        </div>
        <div class="col-sm-4">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'odobservacion',
                    'oiobservacion',
                    'tipodelente'
                ]
            ]) ?>
        </div>
    </div>
</div>
