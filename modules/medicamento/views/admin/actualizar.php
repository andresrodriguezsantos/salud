<?php
/**
 * @var $this \yii\web\View
 * @var $medicamento \app\models\medicamento\Medicamento
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\BaseUrl;

?>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <div class="box-body" style="overflow: hidden">
                <div class="col-md-5">
                    <h3 style="color: #8EC4EC">Formulario para ingresar Nuevos Medicamentos</h3>
                    <?php $data = \app\models\medicamento\MedSubtipoTerapeutico::find()
                        ->select(['med_subtipo_terapeutico.id as id', 'med_subtipo_terapeutico.nombre as label', 'med_tipo_terapeutico.nombre as nombretipo'])
                        ->leftJoin('med_tipo_terapeutico', 'med_subtipo_terapeutico.idtipoterapeutico = med_tipo_terapeutico.id')
                        ->asArray()
                        ->all(); ?>
                    <!--formulario para ingresar medicamento-->
                    <?php $form = ActiveForm::begin([
                    ]); ?>

                    <?= $form->field($medicamento, 'idsubtipoterapeutico', ['enableLabel' => false])->hiddenInput(['value' => $medicamento->isNewRecord ? '' : $medicamento->idsubtipoterapeutico]) ?>
                    <label>Filtro de Tipos Terapeuticos</label>
                    <?= \yii\jui\AutoComplete::widget([
                        'name' => 'nombresubtipoterapeutico',
                        'value' => $medicamento->subtipoterapeutico->nombre,
                        'clientOptions' => [
                            'source' => $data,
                            'minLength' => '3',
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
                    <?= $form->field($medicamento, 'nombrecomercial') ?>
                    <?= $form->field($medicamento, 'composicion') ?>
                    <?= $form->field($medicamento, 'descripcion')->textarea(['rows' => 8]) ?>
                    <div class="box-footer">
                        <?= \yii\helpers\Html::submitButton('<i class="glyphicon glyphicon-save"></i> Save Information', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-warning']) ?>s
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-md-7">
                    <?= $this->render('tablafichaingreso') ?>
                </div>
            </div>
        </div>
    </div>
<?php
$this->registerJsFile(BaseUrl::home() . 'js/findmedicamento.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
])
?>
<?php /** @var \app\models\medicamento\MedPreMed $medpre */
$pres = '';
foreach ($medicamento->presentaciones as $medpre):?>
    <?php $pres .= $medpre->presentacion->nombre . ', '; ?>
<?php endforeach ?>
<?php $this->registerJs('$.cargarMedicamento("' . $medicamento->subtipoterapeutico->tipoterapeutico->nombre .
    '","' . $medicamento->subtipoterapeutico->nombre . '","' . $medicamento->nombrecomercial . '","' . $pres . '","' . $medicamento->composicion . '","' . $medicamento->descripcion . '")'); ?>