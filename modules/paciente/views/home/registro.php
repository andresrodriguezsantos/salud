<?php
/**
 * @var $this \yii\web\View
 * @var $usuario \app\models\Usuario
 * @var $paciente \app\models\Paciente
 */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <i class="glyphicon glyphicon-user"></i>
            <h3 class="box-title">Registrar nuevo paciente</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?php $form = \yii\bootstrap\ActiveForm::begin([
                'enableAjaxValidation'=>true
            ]) ?>
            <div class="col-md-6">
                <?= $form->field($usuario,'cedula',['inputOptions'=>['value'=>Yii::$app->request->get('ced','')]]) ?>
                <?= $form->field($usuario,'email') ?>
                <div class="form-group">
                    <?= $form->field($usuario,'idpais')->dropDownList(
                        ArrayHelper::merge([''=>'Seleccione'],
                            ArrayHelper::map(\app\models\Pais::find()->orderBy('nombre asc')->all(),'id','nombre')),['id'=>'pais']
                    ) ?>
                </div>
                <div class="form-group">
                    <label for="deparamento">Departamento - Estado</label>
                    <?=
                    Html::dropDownList('departamento', null,
                        ['' => 'Seleccione'], ['class' => 'form-control', 'id' => 'departamento','disabled'=>true]);
                    ?>
                </div>
                <div class="form-group">
                    <?= $form->beginField($usuario,'idciudad') ?>
                    <label for="ciudad">Ciudad</label>
                    <?= Html::activeDropDownList($usuario, 'idciudad',
                        ['' => 'Seleccione'], $options = ['class' => 'form-control', 'disabled' => true])
                    ?>
                    <?= $form->endField() ?>
                </div>

            </div>
            <div class="col-md-6">
                <?= $form->field($usuario,'nombres') ?>
                <?= $form->field($usuario,'apellidos') ?>
                <?= $form->field($paciente,'rh')->dropDownList(
                    [''=>'Seleccione','A+' => 'A+', 'A-' => 'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-']);?>
                <?= $form->field($paciente,'fechanacimiento')->widget(\yii\widgets\MaskedInput::className(),[
                    'clientOptions' => ['alias' =>  'yyyy-mm-dd']
                ]) ?>
                <?= $form->field($usuario,'telefonocelular') ?>
                <?= Html::submitButton('Guardar nuevo Paciente',['class'=>'btn btn-primary']) ?>
            </div>
            <?php $form->end() ?>
        </div>
    </div>
</div>
<?php $this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/global.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]) ?>
<?php $this->registerJs("$.comprobar($('select[name=\"Usuario[idciudad]\"]'))") ?>
