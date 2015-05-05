<?php
/**
 * @var $medicamento \app\models\medicamento\Medicamento
 */
?>
<h4 style="color: #8EC4EC">Formulario para ingresar Nuevos Medicamentos</h4>
<?php
use app\models\Areasalud;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$data = \app\models\medicamento\MedSubtipoTerapeutico::find()
    ->select(['med_subtipo_terapeutico.id as id', 'med_subtipo_terapeutico.nombre as label', 'med_tipo_terapeutico.nombre as nombretipo'])
    ->leftJoin('med_tipo_terapeutico', 'med_subtipo_terapeutico.idtipoterapeutico = med_tipo_terapeutico.id')
    ->asArray()
    ->all();


$data2 = \app\models\medicamento\MedPresentacion::find()
    ->select(['id as value', 'nombre as label'])
    ->asArray()
    ->all();


$data3 = Areasalud::find()
    ->select(['id as value', 'nombre as label'])
    ->asArray()
    ->all();

?>

<!--formulario para ingresar medicamento-->
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true
]); ?>


<?php if ($medicamento->isNewRecord): ?>
    <label>Filtro de Area de Salud</label>
    <?= \yii\jui\AutoComplete::widget([
        'name' => 'areasalud',
        'clientOptions' => [
            'source' => $data3,
            'minLength' => '1',
            'autoFill' => true,
            'select' => new \yii\web\JsExpression('
                    function(event,ui){
                        $("#' . \yii\helpers\Html::getInputId($medicamento, 'idarea') . '").val(ui.item.value);
                        $(this).val(ui.item.label);
                        $.setDataOfDocument("area",null,ui.item.label,ui.item.value,ui.item.label,ui.item.value);
                        return false;
                    }
                ')
        ],
        'options' => [
            'class' => 'form-control'
        ]
    ])
    ?>
<?php endif ?>

<?= $form->field($medicamento, 'idsubtipoterapeutico', ['enableLabel' => false])->hiddenInput(['value' => $medicamento->isNewRecord ? '' : $medicamento->idsubtipoterapeutico]) ?>
<label>Filtro de Tipos Terapeuticos</label>
<?= \yii\jui\AutoComplete::widget([
    'name' => 'nombresubtipoterapeutico',
    'clientOptions' => [
        'source' => $data,
        'minLength' => '1',
        'value' => $medicamento->isNewRecord ? '' : $medicamento->subtipoterapeutico->nombre,
        'autoFill' => true,
        'select' => new \yii\web\JsExpression('
                    function(event,ui){
                        $("#' . \yii\helpers\Html::getInputId($medicamento, 'idsubtipoterapeutico') . '").val(ui.item.id);
                        $(this).val(ui.item.label);
                        $.setDataOfDocument("subtipo",ui.item.nombretipo,ui.item.label,ui.item.id);
                        return false;
                    }
                ')
    ],
    'options' => [
        'class' => 'form-control'
    ]
]) ?>
<?php if ($medicamento->isNewRecord): ?>
    <label>Filtro de Presentaciones de Medicamentos</label>
    <?= \yii\jui\AutoComplete::widget([
        'name' => 'presentacionterapeutica',
        'clientOptions' => [
            'source' => $data2,
            'minLength' => '1',
            'autoFill' => true,
            'select' => new \yii\web\JsExpression('
                    function(event,ui){
                        $("#' . \yii\helpers\Html::getInputId($medicamento, 'idsubtipoterapeutico') . '").val(ui.item.value);
                        $(this).val(ui.item.label);
                        $.setDataOfDocument("presentacion",null,ui.item.label,ui.item.value);
                        return false;
                    }
                ')
        ],
        'options' => [
            'class' => 'form-control'
        ]
    ]) ?>
<?php endif ?>
<?= $form->field($medicamento, 'nombrecomercial') ?>
<?= $form->field($medicamento, 'composicion') ?>
<?= $form->field($medicamento, 'descripcion')->textarea(['rows' => 8]) ?>
<?php ActiveForm::end(); ?>

<div class="box-footer">
    <button class="btn btn-primary fa-plus glyphicon glyphicon-save" id="btnsavemedicina"
            style="">Guardar Medicamento
    </button>
    <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-warning']) ?>
</div>