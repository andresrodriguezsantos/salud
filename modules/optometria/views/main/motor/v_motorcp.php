<?php
/** @var $model \app\models\optometria\OptModuloAmplitudFlexibilidad */
/** @var $optometria \app\models\optometria\Optometria */
use yii\helpers\Html;

$cover = new \app\models\optometria\OptCoverTest();
$cover->parseJson($model->covertest);
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-5">
            <h4>Cover test</h4>
            <?= \yii\widgets\DetailView::widget([
                'model' => $cover,
                'attributes' => [
                    'm6', 'm3', 'm1', 'cm50', 'cm30', 'cm20', 'cm10'
                ],
            ]) ?>
        </div>
        <div class="col-md-7">
            <div class="col-md-6">
                <h4>Ojo Derecho</h4>
                <?= \yii\widgets\DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'derechoamplitud', 'derechoflexibilidad'
                    ]
                ]) ?>
            </div>
            <div class="col-md-6">
                <h4>Ojo Izquierdo</h4>
                <?= \yii\widgets\DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'izquierdoamplitud', 'izquierdoflexibilidad'
                    ]
                ]) ?>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <td colspan="4" class="">PPC</td>
                    </tr>
                    <tr>
                        <td>OR</td>
                        <td>FR</td>
                        <td>Disociado</td>
                    </tr>
                    <tr>
                        <td><?= $model->ppc_or ?></td>
                        <td><?= $model->ppc_fr ?></td>
                        <td><?= $model->ppc_disociado ?></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">RFP</th>
                        <th colspan="2" class="text-center">RFN</th>
                    </tr>
                    <tr>
                        <td>
                            <?= Html::tag('span', $model->getAttributeLabel('rfp_vl'), ['class' => 'text-info']) ?>
                            <?= Html::tag('p', $model->rfp_vl) ?>
                        </td>
                        <td>
                            <?= Html::tag('span', $model->getAttributeLabel('rfp_vp'), ['class' => 'text-info']) ?>
                            <?= Html::tag('p', $model->rfp_vp) ?>
                        </td>
                        <td>
                            <?= Html::tag('span', $model->getAttributeLabel('rfn_vl'), ['class' => 'text-info']) ?>
                            <?= Html::tag('p', $model->rfn_vl) ?>
                        </td>
                        <td>
                            <?= Html::tag('span', $model->getAttributeLabel('rfn_vp'), ['class' => 'text-info']) ?>
                            <?= Html::tag('p', $model->rfn_vp) ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if ($model->isNewRecord): ?>
            <div class="col-md-4 col-md-offset-4">
                <br/>
                <?= Html::a('Agregar Valores', ['add', 'id' => $optometria->id, 'model' => 'motor'], ['class' => 'btn btn-default btn-block btn-lg']) ?>
            </div>
        <?php endif ?>
    </div>
</div>
