<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseUrl;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\medicamento\OptPrescripcionMed */
/* @var $form ActiveForm */
$data = \app\models\medicamento\Medicamento::find()
    ->select(['medicamento.id as id', 'medicamento.composicion as label', 'idlaboratorio'])
    ->leftJoin('laboratorio', 'medicamento.idlaboratorio = laboratorio.id')
    ->asArray()
    ->all();
?>
    <div class="col-md-12">
        <div class="box box-success ">
            <div class="box-header">
                <i class="fa fa- glyphicon glyphicon-registration-mark"></i>

                <h3 class="box-title">Medical Prescripcion</h3>
            </div>
            <div class="box-body" style="overflow: hidden">
                <div class="col-md-6">
                    <?php $form = ActiveForm::begin(); ?>
                    <label for="">Seleccione tipo de Filtro</label>

                    <div class="form-group">
                        <?= Html::dropDownList('slectTip', null, [
                            'Generico' => 'Generico',
                            'Comercial' => 'Comercial'
                        ], ['class' => 'form-control', 'id' => 'selectipo']) ?>
                    </div>
                    <div class="form-group" id="laboratorios" style="display:none;">
                        <?= Html::dropDownList('slectTip', null,
                            ArrayHelper::merge(
                                ['' => 'Seleccione'],
                                ArrayHelper::map(
                                    app\models\laboratorio\Laboratorio::find()
                                        ->asArray()->all(), 'id', 'nombre')
                            )
                            , ['class' => 'form-control']) ?>
                    </div>
                    <label for="">Filtro de medicamento</label>
                    <?= $form->field($prescripcion, 'idmedicamento')->hiddenInput()->label(false) ?>
                    <?php $this->registerAssetBundle('yii\jui\JuiAsset', \yii\web\View::POS_END) ?>
                    <?php $this->registerJs(" $.completar(" . \yii\helpers\Json::encode($data) . ");") ?>
                    <?= Html::input('text', 'fmedicamento', null, ['class' => 'form-control', 'id' => 'fmedicamento']) ?>
                    <?= $form->field($prescripcion, 'dosis') ?>
                    <?= $form->field($prescripcion, 'unidades') ?>
                    <?= $form->field($prescripcion, 'duracion') ?>
                    <?= $form->field($prescripcion, 'viaadministracion')->textarea(['rows' => 3, 'cols' => 6]) ?>
                    <?php ActiveForm::end(); ?>
                    <button class=" btn btn-info" id="btn_pres_addform">Agregar Informacion</button>
                    <button class=" btn btn-success" id="btn_pres_submitform" style="display: none">Guardar
                        Prescripcion
                    </button>
                    <?= Html::a('Generar prescripcion', ['/optometria/certificados/generarprescripcion', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-warning']) ?>
                </div>
                <div class="col-md-6">
                    <h3 class="box-title" style="color: #8EC4EC" align="center">Informacion General del Medicamento</h3>
                    <?php echo Yii::$app->controller->renderPartial('tablaprescripciondetalle') ?>
                </div>
                <div class="col-md-12">
                    <h3 class="box-title" style="color: #8EC4EC" align="center">Tabla Con informacion de Medicamentos
                        Prescritos</h3>
                    <?php echo Yii::$app->controller->renderPartial('tablaprescripcionmed') ?>
                </div>
            </div>
        </div>
    </div>
<?php

Modal::begin([
    'header' => '<h3 class="text-danger">Formulario Incompleto</h3>',
    'id' => 'formprescripcionincomplete',
    'footer' => Html::button('Close', ['data-dismiss' => 'modal', 'class' => 'btn btn-success'])
]);
echo Alert::widget([
    'body' => '<h4 style="color: #8EC4EC; text-align: center">Por favor revise que el formulario este completamente diligenciado
                    <br/>o verifique si ha seleccionado una presentacion del medicamento</h4>',
    'closeButton' => false
]);
Modal::end();

Modal::begin([
    'header' => '<h3 class="text-danger">Tarjeta de Informacion del Medicamento</h3>',
    'id' => 'infomedicamento',
    'footer' => Html::button('Close', ['data-dismiss' => 'modal', 'class' => 'btn btn-success'])
]);
echo Alert::widget([
    'body' => '<h4 class="text-center" style="color: #8EC4EC;" id="bodyprescripcion">

</h4>',
    'closeButton' => false
]);
Modal::end();

$this->registerJsFile(BaseUrl::home() . 'js/findmedicamento.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
])




?>