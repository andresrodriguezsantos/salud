<?php
use app\models\Departamento;
use app\models\medicamento\MedPresentacion;
use app\models\medicamento\MedTipoTerapeutico;
use app\models\Pais;
use yii\base\Controller;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\bootstrap\ActiveForm;
/** @var $presentacion MedPresentacion */
/* @var array $btn */
/* @var array $url*/
?>

<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title" style="color: #8EC4EC">Information of Laboratory</h3>
        </div>
        <div class="box-body" style="overflow: hidden">


            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#sede" data-toggle="tab">Sede laboratory</a></li>
                    <li class="active"><a href="#laboratorio" data-toggle="tab">Update Information laboratory</a></li>
                    <li class="pull-left header" style="color: #8EC4EC"><i class="glyphicon glyphicon-save"></i> </li>
                </ul>
                <div class="tab-content" style="overflow: hidden">

                    <input type="text"  value="<?php echo $idlab ?>" id="idlabora" style="display: none;"/>
                    <!-- -------------------------------------------  TAB PANEL PARA INGRESAR   LABORATORIOS  --------------------------------------------------------- -->
                    <div class="tab-pane" id="laboratorio">
                        <div class="col-md-12                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           ">
                            <h3 style="color: #8EC4EC">Information Laboratory</h3>
                            <?php $form = ActiveForm::begin(
                                ['action'=>['actualizar']]
                            ); ?>
                            <div class="col-md-6">
                                <?= $form->field($laboratorio, 'nombre'); ?>
                                <?= $form->field($laboratorio, 'direccion') ?>
                                <?= $form->field($laboratorio, 'telefono') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($laboratorio, 'contacto') ?>
                                <?= $form->field($laboratorio, 'email') ?>
                                <?= $form->field($laboratorio, 'nota')->textarea(['rows'=>10,'cols'=>10]) ?>
                            </div>
                            <div class="box-footer">
                                <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>


                    </div><!-- /.tab-pane -->
                    <!-- -------------------------------------------  TAB PANEL PARA INGRESAR SEDES DE LABORATORIO --------------------------------------------------------- -->
                    <div class="tab-pane" id="sede">
                        <div class="col-md-12">
                            <h3 style="color: #8EC4EC">Update information Sedes Laboratory</h3>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <h4 style="color: #8EC4EC; text-align: center">Information Actual User</h4>
                                    <table class="table table-striped table-bordered ">
                                        <tbody>
                                        <tr><th>Nombre</th><th><?php echo $info[1].' '. $info[2] ?></th></tr>
                                        <tr><th>Identificacion</th><th><?php echo $info[3]?></th></tr>
                                        <tr><th>Cargo</th><th> <?php echo $labuser->cargo ?></th></tr>
                                        <tr><th>Email</th><th><?php echo $labuser->email ?></th></tr>
                                        <tr><th>Ciudad</th><th> <?php echo $info[0]?></th></tr>
                                        </tbody>
                                    </table>
                                </div>
                               <div id="nuevo usuario" class="col-md-6">
                                   <h4 style="color: #8EC4EC; text-align: center">Information New User</h4>
                                   <table class="table table-striped table-bordered ">

                                       <tbody id="idactualizar"></tbody>
                                   </table>
                               </div>
                            </div>
                                <div class="col-md-12"><h3 style="color: #8EC4EC" align="center">Information new</h3></div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <h5 style="color: #8EC4EC">Please verify that the user is registered</h5>
                                    <div class="col-md-8 ">
                                        <input type="text" class="form-control" id="inputcedula"/>
                                        <?= $form->field($labuser,'idusuario')->hiddenInput(); ?>
                                    </div>
                                    <div class="col-md-4">
                                        <buttton class="btn btn-success btnvalida" >Validate</buttton>
                                        <buttton class="btn btn-info btnedita" style="display: none" >Edit</buttton>
                                    </div>
                                    <div class="ubicacion col-md-12" style="display: none">
                                        <label for="">Cargo</label>
                                        <input type="text" class="form-control" id="inputactualizarcargo"/>
                                        <label for="">Email Corporativo</label>
                                        <input type="text" class="form-control" id="inputactualizaremail"/>
                                    </div>
                                </div>
                                <div class="col-md-6 ubicacion" style="display: none">
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

                                    </div>
                            </div>

                            <div class="box-footer">
                                <br/>
                                <button class="btn btn-primary" id="botonenviaractualizacion">Submit</button>
                                <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-warning']) ?>
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        </div>
    </div>
</div>


<?php
$this->registerJsFile(\yii\helpers\BaseUrl::home() .'js/global.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]);

$this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/eventos.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]);

?>
<?php $this->registerJs("$.comprobar($('select[name=\"LabSede[idciudad]\"]'))") ?>
