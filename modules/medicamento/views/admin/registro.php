<?php
use app\models\medicamento\MedPresentacion;
use app\models\medicamento\MedSubtipoTerapeutico;
use app\models\medicamento\MedTipoTerapeutico;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\BaseUrl;
use yii\helpers\Html;

/** @var $presentacion MedPresentacion */
/** @var $medicamentos \yii\data\ActiveDataProvider */
/* @var array $btn */
/* @var array $url */
?>

<div class="col-md-12">
    <div class="box box-success">
        <div class="box-body" style="overflow: hidden">
            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#listadomedicamento" data-toggle="tab">Medicaments List</a></li>
                    <!--                    <li><a href="#listadoterapeutico" data-toggle="tab">Therapeutic List</a></li>-->
                    <!--                    <li><a href="#listapresentacion" data-toggle="tab">Presentation List</a></li>-->
                    <li <?= (Yii::$app->request->get('id')) ? '' : 'class="active"'; ?>><a href="#medicina"
                                                                                           data-toggle="tab">Medicine</a>
                    </li>
                </ul>
                <div class="tab-content" style="overflow: hidden">
                    <!-- -------------------------------------------  TAB PANEL PARA INGRESAR PRESENTACIONES  --------------------------------------------------------- -->
                    <div class="tab-pane" id="listapresentacion">
                        <div class="col-md-6">
                            <?php echo Yii::$app->controller->renderPartial('listadopresentacion', [
                                'listapre' => $listapre
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo Yii::$app->controller->renderPartial('tablafichaingreso') ?>
                        </div>

                    </div>
                    <!-- /.tab-pane -->
                    <!-- -------------------------------------------  TAB PANEL PARA INGRESAR MEDICAMENTOS  --------------------------------------------------------- -->
                    <div class="tab-pane <?= (Yii::$app->request->get('id')) ? '' : 'active'; ?>" id="medicina">
                        <div class="col-md-5">
                            <?php echo Yii::$app->controller->renderPartial('form_medicamento', [
                                'medicamento' => $medicamento,
                            ]) ?>
                        </div>
                        <div class="col-md-7 ">
                            <?php echo Yii::$app->controller->renderPartial('tablafichaingreso'); ?>
                        </div>
                        <br/>
                    </div>
                    <!-- /.tab-pane -->
                    <!--                     ----------------------------------------------------------------- PANEL DE LISTADOS ---------------------------------------------------------------->
                    <div class="tab-pane" id="listadoterapeutico">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <h3 style="color: #8EC4EC">Therapeutic Type</h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tablatipo">
                                    <?php
                                    /** @var MedTipoTerapeutico $tipo */
                                    foreach ($listatipo as $tipo) { ?>
                                        <tr>
                                            <td><?= $tipo->nombre ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h3 style="color: #8EC4EC">Therapeutic SubType</h3>

                                <div class="col-md-8 row">
                                    <div class="form-group">
                                        <input class="form-control" id="inputtextosubtipo">
                                    </div>
                                </div>
                                <div class="col-md-4 row">
                                    <div class="form-group">
                                        <button id="btnselecttipo" class="btn btn-success pull-right">Search</button>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Type Therapeutic</th>
                                        <th>SubType Therapeutic</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody id="bodysubtipo">
                                    <?php
                                    /** @var MedSubtipoTerapeutico $subtipo */
                                    foreach ($listasubtipo as $subtipo) { ?>
                                        <tr>
                                            <td><?= $subtipo->tipoterapeutico->nombre ?></td>
                                            <td><?= $subtipo->nombre ?></td>
                                            <td>
                                                <button class="btn btn-xs btn-success btn-addsubtipo"
                                                        value="<?= $subtipo->id ?>"><i
                                                        class="fa-plus glyphicon glyphicon-check"></i>Add item
                                                </button>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="listadomedicamento">
                        <?= Yii::$app->controller->renderPartial('listadomedicamentos', [
                            'medicamento' => $medicamento,
                            'medicamentos' => $medicamentos
                        ]) ?>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
    </div>
</div>

<?php

Modal::begin([
    'header' => '<h3 class="text-danger">There are empty fields</h3>',
    'id' => 'modalvacio',
    'footer' => Html::button('Close', ['data-dismiss' => 'modal', 'class' => 'btn btn-success'])
]);
echo Alert::widget([
    // 'options'=>['class'=>'alert-warning'],
    'body' => '<h4 style="color: #8EC4EC; text-align: center">Please enter the missing information</h4>',
    'closeButton' => false
]);
Modal::end();
Modal::begin([
    'header' => '<h3 class="text-danger">Card Admision Incomplet Form</h3>',
    'id' => 'formularioincompleto',
    'footer' => Html::button('Close', ['data-dismiss' => 'modal', 'class' => 'btn btn-success'])
]);
echo Alert::widget([
    'body' => '<h4 style="color: #8EC4EC; text-align: center">Please check that the card information entry is complete</h4>',
    'closeButton' => false
]);
Modal::end();

Modal::begin([
    'header' => '<h3 class="text-danger">Sure you want to delete ?</h3>',
    'id' => 'borrarpresentacion',
//    'toggleButton' => $btn,
    'footer' => Html::a('borrar', ['deletepresentacion'], ['class' => 'btn btn-warning', 'id' => 'botonmodalborrar']) .
        Html::button('cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-default'])
]); ?>
<h3 style="text-align: center">The information will be permanently deleted <br>
    Note : The medical informtion relations well be inhabilite for use
</h3>
<?php
Modal::end();

Modal::begin([
    'header' => '<h3 class="text-danger">Sure you want to delete ?</h3>',
    'id' => 'borrartipo',
//    'toggleButton' => $btn,
    'footer' => Html::a('borrar', ['deletetipo'], ['class' => 'btn btn-warning', 'id' => 'botonmodalborrartipo']) .
        Html::button('cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-default'])
]); ?>
<h3 style="text-align: center">The information will be permanently deleted <br>
    Note : The medical informtion relations well be inhabilite for use
</h3>
<?php
Modal::end();

Modal::begin([
    'header' => '<h3 class="text-danger">Sure you want to delete ?</h3>',
    'id' => 'borrarsubtipo',
//    'toggleButton' => $btn,
    'footer' => Html::a('borrar', ['deletesubtipo'], ['class' => 'btn btn-warning', 'id' => 'botonmodalborrarsubtipo']) .
        Html::button('cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-default'])
]); ?>
<h3 style="text-align: center">The information will be permanently deleted <br>
    Note : The medical informtion relations well be inhabilite for use
</h3>
<?php
Modal::end();

$this->registerJsFile(BaseUrl::home() . 'js/findmedicamento.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
])




?>
