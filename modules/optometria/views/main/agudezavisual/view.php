<?php
/** @var $model \app\models\optometria\OptAgudezavisualConcorreccion|
 * \app\models\optometria\OptAgudezavisualSincorreccion|
 * \app\models\optometria\OptAgudezavisualConph */
/** @var $optometria \app\models\optometria\Optometria */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-4">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'vl_derecho_snellen',
                    'vl_derecho_logmar',
                    'vp_derecho'
                ]
            ])
            ?>
        </div>
        <div class="col-md-4">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'vl_izquierdo_snellen',
                    'vl_izquierdo_logmar',
                    'vp_izquierdo'
                ]
            ])
            ?>
        </div>
        <div class="col-md-4">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'vl_ambos_snellen',
                    'vl_ambos_logmar',
                    'vp_ambos'
                ]
            ])
            ?>
        </div>
        <?php if ($model->isNewRecord): ?>
            <div class="col-md-12 ">
                <br/>

                <div class="col-md-6 col-md-offset-3 text-center">
                    <?= \yii\helpers\Html::a('Agregar Valores', ['add', 'id' => $optometria->id, 'model' => 'agudezavisual'], ['class' => 'btn btn-lg btn-default btn-block']) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

