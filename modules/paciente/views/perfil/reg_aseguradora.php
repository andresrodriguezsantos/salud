<div class="col-md-6">
    <?php use app\models\EpsCosultorio;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;

    $form = ActiveForm::begin(
        ['action' => ['update', 'id' => $model3->id]]
    ); ?>
    <label class="control-label">Tipo de Aseguradora Medica</label>
    <?=
    Html::activeDropDownList($model3, 'tipo', ['' => 'Seleccione', 'Publica' => 'Publica', 'Privada' => 'Privada'], ['class' => 'form-control'])
    ?>
    <label class="control-label">Clasificacion Aseguradora Medica</label>
    <?=
    Html::activeDropDownList($model3, 'clasificacion',
        ['' => 'Seleccione', 'Arp' => 'Arp', 'Eps' => 'Eps'], ['class' => 'form-control'])
    ?>

    <label class="control-label">Tipo de Afiliacion Medica</label>
    <?=
    Html::activeDropDownList($model3, 'afiliacion',
        ['' => 'Seleccione', 'Cotizante' => 'Cotizante', 'Beneficiario' => 'Beneficiario'], ['class' => 'form-control', 'value' => $model3->afiliacion])
    ?>
    <label for="">Aseguradora Medica</label>
    <?= Html::activeDropDownList($model3, 'eps_cosultorio_id',
        ArrayHelper::merge(['' => 'Seleccione'], ArrayHelper::map(EpsCosultorio::find()
            ->where(['tipo' => 1])
            ->all(), 'id', 'nombre')), $options = ['class' => 'form-control'])

    ?>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class=" col-md-6">
    <table class="table table-striped table-bordered">
        <thead>
        <th>Tipo</th>
        <th>Clasificación</th>
        <th>Eps</th>
        <th>Opciones</th>
        </thead>
        <?php foreach ($data as $dd): ?>
            <tr>
                <td>
                    <?= $dd->tipo ?>
                </td>
                <td>
                    <?= $dd->clasificacion ?>
                </td>
                <td>
                    <?= $dd->getEpsCosultorio()->one()->nombre; ?>
                </td>
                <td>
                    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['index', 'id' => $dd->id]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>