<?php use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$form = ActiveForm::begin(
    ['action' => ['update']]
); ?>
<div class="col-md-12 form-group">

    <label for="">Datos Actuales de Ubicacion Personal</label>
    <table class="table table-bordered">
        <tr>
            <th>Pais</th>
            <th>Departamento - Estado</th>
            <th>Ciudad</th>
        </tr>
        <tr>
            <td><?= $usuario->ciudad->departamento->pais->nombre ?> </td>
            <td><?= $usuario->ciudad->departamento->nombre ?> </td>
            <td><?= $usuario->ciudad->nombre ?> </td>
        </tr>
    </table>

</div>

<div class="col-md-12 form-group">
    <div class="col-md-4">
        <?= $form->field($usuario, 'nombres') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($usuario, 'apellidos') ?>
    </div>

</div>
<div class="col-md-12">
    <div class="col-md-4">
        <label class="control-label">Tipo Documento Identificacion</label>
        <?= Html::activeDropDownList($usuario, 'idtipodocumento',
            \yii\helpers\ArrayHelper::map(\app\models\Tipodocumento::find()
                ->all(), 'id', 'descripcion'),
            $options = ['class' => 'form-control']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($usuario, 'cedula') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($profesional, 'registroprofesional') ?>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-4">
        <div class="form-group">
            <label for="pais">Pais</label>
            <?=
            Html::dropDownList('pais', null,
                ArrayHelper::merge(['' => "Seleccione"], ArrayHelper::map(\app\models\Pais::find()
                    ->addOrderBy('nombre')->all(), 'id', 'nombre')), ['class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Departamento - Estado</label>
            <?=
            Html::dropDownList('departamento', null,
                ['' => 'Seleccione'], ['class' => 'form-control', 'disabled' => 'disabled'])
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <?= $form->beginField($usuario, 'idciudad') ?>
        <div class="form-group field-usuario-idciudad required">
            <label class="control-label">Ciudad</label>
            <?=
            Html::activeDropDownList($usuario, 'idciudad',
                ['' => 'Seleccione'], ['class' => 'form-control', 'disabled' => 'disabled'])
            ?>
            <div class="help-block"></div>
        </div>
        <?= $form->endField() ?>
    </div>
</div>
<div class="col-md-12">
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/global.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]) ?>
<?php $this->registerJs("$.comprobar($('select[name=\"Usuario[idciudad]\"]'))") ?>





