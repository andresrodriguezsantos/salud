<?php
/** @var $this \yii\web\View */
use app\models\Codigocie;
use yii\helpers\Html;

/** @var $form \yii\bootstrap\ActiveForm */
/** @var $diagnostico \app\models\optometria\OptDiagnostico[] */
/** @var $button boolean */
/** @var $submit bool */
?>
<?php if ($button): ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div id="diacnosticos">
            <?php endif ?>
            <?php $data = Codigocie::find()
                ->select(['id as value', 'nombre as label', 'codigo as code'])
                ->asArray()
                ->all() ?>
            <?php foreach ($diagnostico as $key => $model): ?>
                <div class="col-md-6">
                    <h4><?= $model->ojo ?></h4>
                    <?= $form->field($model, '[' . $key . ']ojo')->hiddenInput()->label(false) ?>
                    <div class="col-xs-10" id="field<?= $key ?>">
                        <?= $form->field($model, '[' . $key . ']nominacion')->textInput(['value' => $model->codigoCIE ? $model->codigoCIE->nombre : '', 'readonly' => (!empty($model->codigoCIE))]) ?>
                    </div>
                    <div class="col-xs-2" id="boton<?= $key ?>" style="padding-top: 5%">
                        <?= Html::button('<i class="glyphicon glyphicon-remove-circle"></i>',
                            ['class' => 'btn btn xs btn-warning', 'id' => 'remove' . $key]) ?>
                    </div>
                    <div class="col-xs-12">
                        <?= $form->field($model, '[' . $key . ']codigoCIE_id')->hiddenInput() ?>
                        <?= \yii\helpers\Html::textInput('codigocie', $model->codigoCIE ? $model->codigoCIE_id : '',
                            ['class' => 'codcie ui-autocomplete-input form-control', 'id' => "ac$key",
                                'readonly' => (!empty($model->codigoCIE))]) ?>
                    </div>

                </div>
                <?php $this->registerJs("jQuery(document).ready(function (){ \n $.autocompletar(" . \yii\helpers\Json::encode($data) . "," . $key . ");});", \yii\web\View::POS_END) ?>
            <?php endforeach ?>
            <?php $this->registerAssetBundle('yii\jui\JuiAsset', \yii\web\View::POS_END) ?>
        </div>
        <?php if ($button): ?>
            <div class="col-md-12" style="margin-top: 10px">
                <?= \yii\helpers\Html::button('Agregar Diagnóstico', ['class' => 'btn btn-primary', 'id' => 'adddiagnostico', 'data-val' => $key + 1]) ?>
                <?php if ($submit): ?>
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                <?php endif ?>
            </div>
        <?php endif ?>
        <?php if ($button): ?>
    </div>
</div>
<?php endif ?>