<?php use app\models\Departamento;
use app\models\Pais;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$form = ActiveForm::begin(); ?>
<div class="col-md-6">
    <h4 style="color: #8EC4EC">Por favor verifique que el usuario que desea asignar se encuentre registrado</h4>
    <div class="col-md-8 ">
        <input type="text" class="form-control" id="inputcedula"/>
        <?= $form->field($labuser,'idusuario')->hiddenInput()->label(false) ?>
    </div>
    <div class="col-md-4">

        <buttton class="btn btn-success btnvalida" >Validar</buttton>
        <buttton class="btn btn-info btnedita" style="display: none" >Editar</buttton>
        <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-warning']) ?>
    </div>
    <table class="table table-striped table-bordered ">

        <tbody id="idactualizar"></tbody>
    </table>
</div>
<div class="col-md-6 ubicacion" style="display: none">
    <?= $form->field($labuser, 'cargo') ?>
    <?= $form->field($labuser, 'email') ?>
    <label for="pais">Seleccione un Pais</label>
    <div class="form-group field-idpais-required">
        <?=
        Html::dropDownList('pais', null,
            ArrayHelper::merge(['' => 'Seleccione'],
                ArrayHelper::map(Pais::find()->orderBy('nombre')->all(),'id','nombre')),
            ['class'=>'form-control'])
        ?>
    </div>
    <label for="departamento">Departamento - Estado</label>
    <?=
    Html::dropDownList('departamento', null,
        ArrayHelper::merge(['' => 'Seleccione'],
            ArrayHelper::map(
                Departamento::find()
                    ->where('idpais = :idpais', [':idpais' => Yii::$app->request->get('idp')])
                    ->all(), 'id', 'nombre'
            )), ['class' => 'form-control', 'id' => 'departamento']);
    ?>

    <?= $form->beginField($sede,'idciudad') ?>
    <label for="ciudad">Ciudad</label>
    <?= Html::activeDropDownList($sede,'idciudad',
        ['' => 'Seleccione'], $options = ['class' => 'form-control', 'disabled' => 'disabled'])
    ?>
    <?= $form->endField() ?>
    <div class="box-footer boton" style="display: none">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>