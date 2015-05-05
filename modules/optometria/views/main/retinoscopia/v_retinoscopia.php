<?php
/** @var $model \app\models\optometria\OptRetinoscopia */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
            <?= \yii\helpers\Html::tag('h4', 'Ojo Derecho') ?>
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'odesfera', 'odcilindro', 'odeje', 'odsnellenvl', 'odlogmarvl', 'odsnellenvp', 'odlogmarvp'
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= \yii\helpers\Html::tag('h4', 'Ojo Izquierdo') ?>
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'oiesfera', 'oicilindro', 'oieje', 'oisnellenvl', 'oilogmarvl', 'oisnellenvp', 'oilogmarvp'
                ]
            ]) ?>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <?= \yii\helpers\Html::tag('h4', 'Ambos Ojos', ['class' => 'text-info']) ?>
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ambossnellenvl', 'amboslogmarvl', 'ambossnellenvp', 'amboslogmarvp'
                ]
            ]) ?>
        </div>
    </div>
</div>
