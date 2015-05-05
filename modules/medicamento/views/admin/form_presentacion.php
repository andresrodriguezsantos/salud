<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\BaseUrl;
use yii\helpers\Html;

?>
    <h3 class="box-title" style="color: #8EC4EC">Formulario para Ingresar Nuevas Presentaciones a sus
        Medicamentos</h3>
    <div class="box-body" style="overflow: hidden">
        <div class="col-md-6">
            <?php
            $form = ActiveForm::begin(
                ['action' => ['registrarpresentacion']]
            ); ?>
            <?= $form->field($presentacion, 'id', ['enableLabel' => false])->hiddenInput(); ?>
            <?=
            $form->field($presentacion, 'nombre') ?>
            <?= $form->beginField($presentacion, 'estado'); ?>
            <?php echo $form->field($presentacion, 'estado')->dropDownList(['1' => 'Activo', '0' => 'Inactivo']) ?>
            <?= $form->endField(); ?>
            <div class="box-footer">
                <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6">
            <h3 style="color: #8EC4EC">Listado de Presentaciones</h3>

            <div class="col-md-8 row">
                <div class="form-group">
                    <input class="form-control" id="text-filtro-presentacion">
                </div>
            </div>
            <div class="col-md-4 row">
                <div class="form-group">
                    <button id="btn-buscar-presentacion" class="btn btn-success pull-right">Search</button>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Num</th>
                    <th>Nombre Presentacion</th>
                    <th>Opcioness</th>
                </tr>
                </thead>
                <tbody id="bodytablalistapresentacion">
                <?php /** @var \app\models\medicamento\MedPresentacion $pre */
                $c = 0;
                foreach ($listapre as $pre) { ?>
                    <?php $c++?>
                    <tr>
                        <td><?= $c ?></td>
                        <td><?= $pre->nombre ?></td>
                        <td>
                            <button class="btn btn-xs btn-success btn-editar-pre"
                                    value="<?= $pre->id ?>"><i
                                    class="fa-plus glyphicon glyphicon-edit"></i>Editar
                            </button>
                            <?= $this->render('@app/views/layouts/modals/delete', [
                                'btn' => [
                                    'label' => '<i class="glyphicon glyphicon-remove "></i> Eliminar',
                                    'tag' => 'a',
                                    'class' => 'btn btn-danger btn-xs'
                                ],
                                'url' => [
                                    'deletepresentacion', 'id' => $pre->id
                                ]
                            ]); ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
$this->registerJsFile(BaseUrl::home() . 'js/findmedicamento.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
])
?>