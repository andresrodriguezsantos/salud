<?php
/** @var $this \yii\web\View */

/** @var $vista string */
/** @var $optometria \app\models\optometria\Optometria */
/** @var $array array */
/** @var $model string */
?>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="glyphicon glyphicon-ban-circle"></i>

                <h3 class="box-title">Agregar Valor</h3>
            </div>
            <div class="box-body" style="overflow: hidden">
                <?php $form = \yii\bootstrap\ActiveForm::begin([
                    'action' => ['add' . $model, 'id' => $optometria->id],
                    'enableAjaxValidation' => true,
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]) ?>
                <div class="panel">
                    <div class="panel-default">
                        <?= $this->render($vista, \yii\helpers\ArrayHelper::merge(['form' => $form], $array)) ?>
                        <div class="col-md-12">
                            <?php \yii\bootstrap\Modal::begin([
                                'header' => '<h5>Compleatar Acción ?</h5>',
                                'toggleButton' => ['label' => 'Guardar historia clinica', 'class' => 'btn btn-primary'],
                                'footer' => \yii\helpers\Html::submitButton('Guardar historia', ['class' => 'btn btn-primary']) .
                                    \yii\helpers\Html::button('cancelar', ['class' => 'btn btn-warning', 'data-dismiss' => 'modal']),
                                'size' => \yii\bootstrap\Modal::SIZE_SMALL
                            ]) ?>
                            <div class="alert alert-warning">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                Esta seguro de guardar esta historia clinica una vez guardada es irreversible ?
                            </div>
                            <?php \yii\bootstrap\Modal::end() ?>
                        </div>
                    </div>
                </div>



                <?php $form->end() ?>
            </div>
        </div>
    </div>
<?php $this->registerJsFile('@web/js/opt.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END,
]) ?>