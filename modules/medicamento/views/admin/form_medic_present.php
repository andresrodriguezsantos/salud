<?php use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

$data = \app\models\medicamento\MedPresentacion::find()
    ->select(['id as value', 'nombre as label'])
    ->asArray()
    ->all();
?>
<?php $form = ActiveForm::begin([
]); ?>
<div class="col-md-6">
    <div class="form-group">
        <?= $form->field($medpre, 'idpresentacion')->hiddenInput()->label(false) ?>
        <label>Filtro de Presentación</label>
        <?= \yii\jui\AutoComplete::widget([
            'name' => 'presentaciones',
            'clientOptions' => [
                'source' => $data,
                'autoFill' => true,
                'select' => new JsExpression('
                        function(event,ui){
                            $("#' . \yii\helpers\Html::getInputId($medpre, 'idpresentacion') . '").val(ui.item.value);
                            $(this).val(ui.item.label);
                            return false;
                        }')
            ],
            'options' => ['class' => 'form-control']
        ]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-warning']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-md-6">
    <h3 style="color: #8EC4EC">General information medicine</h3>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ADMISION CARD</th>
            <th>INFORMATION</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>Tradename</th>
            <td><?= $medicamento->nombrecomercial ?></td>
        </tr>
        <tr>
            <th>Composition</th>
            <td><?= $medicamento->composicion ?></td>
        </tr>
        <tr>
            <th>Therapeutic Type</th>
            <td><?= $medicamento->subtipoterapeutico->tipoterapeutico->nombre ?></td>
        </tr>
        <tr>
            <th>Therapeutic Subtype</th>
            <td><?= $medicamento->subtipoterapeutico->nombre ?></td>
        </tr>
        <tr>
            <th>Presentation</th>
            <td>
                <?php /** @var \app\models\medicamento\MedPreMed $medpre */
                foreach ($medicamento->presentaciones as $medpre):?>
                    <?= $medpre->presentacion->nombre ?>,
                <?php endforeach ?>
            </td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?= $medicamento->descripcion ?></td>
        </tr>
        </tbody>
    </table>
</div>