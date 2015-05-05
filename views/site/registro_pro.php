<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model3 \app\models\ProfesionalEps */
/* @var $this yii\web\View */
/* @var $model app\models\Profesional */
/* @var $form ActiveForm */
$this->title = Yii::t('site', 'register profesional');
$this->params['breadcrumbs'][] = ['url' => ['registro'], 'label' => 'Registro'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Registrar Cuenta</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?php $form = ActiveForm::begin(
                [
                    'options' => ['enctype' => 'multipart/form-data'],
                    'validateOnType' => true
                ]
            ); ?>
            <div class="col-md-6 ">
                <?= $form->field($model2, 'registroprofesional') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model2, 'picture')->fileInput() ?>
                <?= $form->field($model2, 'picture2', ['inputOptions' => ['class' => 'form-control']])->fileInput() ?>
                <label class="control-label">Profesion</label>
                <?=
                Html::activeDropDownList($model3, 'idprofesion',
                    ArrayHelper::map(\app\models\Profesion::find()->all(), 'id', 'descripcion'), $options = ['class' => 'form-control'])
                ?>
            </div>
            <div class="col-md-6">
                <div id="idlabora">
                    <?= $form->field($model3, 'id_eps')->dropDownList(
                        ArrayHelper::merge(['' => 'Seleccione'],
                            ArrayHelper::map(\app\models\EpsCosultorio::find()->all(), 'id', 'nombre'))
                    ) ?>
                </div>
                <div id="datacarga"></div>
                <br/>
                <?php
                Modal::begin([
                    'id' => 'regclinica',
                    'header' => '<h2>Registro de Clinicas o Consultorios</h2>',
                    'toggleButton' => ['label' => '¿Eres profesional independiente?', 'tag' => 'a', 'id' => 'independiente'],
                    'options' => ['style' => 'overflow:hidden'],
                    'footer' => Html::button('Cargar', ['class' => 'btn btn-success', 'id' => 'cargaclinica'])
                        . Html::button(Yii::t('app', 'Cancelar'), ['class' => 'btn btn-warning', 'id' => 'cancelind'])
                ]);
                $form = ActiveForm::begin([
                    'enableAjaxValidation' => true,
                ]); ?>

                <?= $form->field($eps_con, 'nombre') ?>
                <?= $form->field($eps_con, 'direccion') ?>
                <?= $form->field($eps_con, 'contacto') ?>
                <?php ActiveForm::end();
                Modal::end();
                ?>
                <br/><br/>
                <label for="deparamento">Departamento - Estado</label>
                <?=
                Html::dropDownList('departamento', null,
                    ArrayHelper::merge(['' => 'Seleccione'],
                        ArrayHelper::map(
                            \app\models\Departamento::find()
                                ->where('idpais = :idpais', [':idpais' => Yii::$app->request->get('idp')])
                                ->all(), 'id', 'nombre'
                        )), ['class' => 'form-control', 'id' => 'departamento']);
                ?>
                <?= $form->beginField($model, 'idciudad') ?>
                <label for="ciudad">Ciudad</label>
                <?= Html::activeDropDownList($model, 'idciudad',
                    ['' => 'Seleccione'], $options = ['class' => 'form-control', 'disabled' => 'disabled'])
                ?>
                <?= $form->endField() ?>
                <?= $form->field($model, 'telefonocelular') ?>
                <div class="box-footer">
                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<?php $this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/global.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]) ?>

<?php $this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/registrousuario.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]) ?>
<?php $this->registerJs("$.comprobar($('select[name=\"Usuario[idciudad]\"]'))") ?>




