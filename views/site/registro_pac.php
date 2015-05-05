<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Paciente */
/* @var $form ActiveForm */

$this->title = Yii::t('site', 'Register Patiente');
$this->params['breadcrumbs'][] = ['url' => ['registro'], 'label' => 'Register'];
$this->params['breadcrumbs'][] = $this->title;

?>


    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Registrar Cuenta</h3>
            </div>
            <div class="box-body" style="overflow: hidden">
                <?php $form = ActiveForm::begin(); ?>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Datos Personales</h3>
                        </div>
                        <div class="box-body">
                            <?= $form->field($model, 'fechanacimiento')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => ['alias' => 'yyyy-mm-dd']
                            ]) ?>

                            <div class="form-group">

                                <label for="deparamento">Departamento - Estado</label>
                                <?= Html::dropDownList('departamento', null,
                                    ArrayHelper::merge(['' => 'Seleccione'],
                                        ArrayHelper::map(
                                            \app\models\Departamento::find()
                                                ->where('idpais = :idpais', [':idpais' => Yii::$app->request->get('idp')])
                                                ->all(), 'id', 'nombre'
                                        )), ['class' => 'form-control', 'id' => 'departamento']);
                                ?>
                                <label for="ciudad">Ciudad</label>
                                <?= Html::activeDropDownList($model2, 'idciudad',
                                    ['' => 'Seleccione'], $options = ['class' => 'form-control', 'disabled' => 'disabled'])
                                ?>
                            </div>

                            <div class="help-block"></div>

                            <?= $form->field($model2, 'telefonocelular') ?>
                            <?= $form->field($model2, 'email') ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">En caso de Emergencia Contactarse con:</h3>
                        </div>
                        <div class="box-body">
                            <?= $form->field($model, 'nombreacudiente') ?>
                            <?= $form->field($model, 'ocupacion') ?>
                            <label for="">Telefono Celular de acudiente o Contacto de Emergencia</label>
                            <?= $form->field($model, 'telefonocelular')->label(false) ?>
                            <?= $form->field($model, 'telefonoacudiente') ?>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary']) ?>
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