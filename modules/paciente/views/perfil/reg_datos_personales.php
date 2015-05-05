<?php use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;

$form = ActiveForm::begin(
    ['action' => ['update']]
); ?>
    <div class="col-md-6">

        <?= $form->field($model, 'nombres') ?>
        <?= $form->field($model, 'apellidos') ?>

        <div class="form-group">
            <label for="pais">Pais</label>
            <?=
            Html::dropDownList('pais', null,
                ArrayHelper::merge(['' => "Seleccione"], ArrayHelper::map(\app\models\Pais::find()
                    ->addOrderBy('nombre')->all(), 'id', 'nombre')), ['class' => 'form-control']);
            ?>
        </div>
        <div class="form-group">
            <label class="control-label">Departamento - Estado</label>
            <?=
            Html::dropDownList('departamento', null,
                ['' => 'Seleccione'], ['class' => 'form-control', 'disabled' => 'disabled'])
            ?>
        </div>
        <?= $form->beginField($model, 'idciudad') ?>
        <div class="form-group field-usuario-idciudad required">
            <label class="control-label">Ciudad</label>
            <?=
            Html::activeDropDownList($model, 'idciudad',
                ['' => 'Seleccione'], ['class' => 'form-control', 'disabled' => 'disabled'])
            ?>
            <div class="help-block"></div>
        </div>
        <?= $form->endField() ?>
    </div>
    <div class="col-md-6">
        <label class="control-label">Tipo Documento Identificacion</label>
        <?= Html::activeDropDownList($model, 'idtipodocumento',
            \yii\helpers\ArrayHelper::map(\app\models\Tipodocumento::find()->all(), 'id', 'descripcion'), $options = ['class' => 'form-control']) ?>
        <?= $form->field($model, 'cedula') ?>
        <div class="form-group field-paciente-fechanacimiento required">
            <?= $form->beginField($model2, 'fechanacimiento') ?>
            <label class="control-label" for="paciente-fechanacimiento">Fecha de Nacimiento</label>
            <?= DatePicker::widget([
                'model' => $model2,
                'attribute' => 'fechanacimiento',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => ['class' => 'form-control']
            ]); ?>
            <?= $form->endField() ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>