<?php
/** @var $concorreccion \app\models\optometria\OptAgudezavisualConcorreccion */
use app\shelper\OptometriaHel;
use yii\helpers\Html;

/** @var \yii\bootstrap\ActiveForm $form */
?>
<div class="panel panel-default">
    <div class="panel-body row">

        <div class="col-md-4">
            <table class="table table-bordered table-condensed">
                <tr>
                    <th colspan="2" class="text-center">Ojo Derecho</th>
                </tr>
                <tr>
                    <th>Snellen</th>
                    <th>LogMAR</th>
                </tr>
                <tr>
                    <td>
                        <?= $form->beginField($concorreccion, 'vl_derecho_snellen') ?>
                        <?= Html::activeDropDownList($concorreccion, 'vl_derecho_snellen',
                            OptometriaHel::getSnellen(), ['class' => 'form-control snellen']) ?>
                        <?= $form->endField() ?>
                        <?php OptometriaHel::SetSnellen($this, $concorreccion, 'vl_derecho_snellen', 'vl_derecho_logmar') ?>
                    </td>
                    <td>
                        <?= $form->field($concorreccion, 'vl_derecho_logmar',
                            ['enableLabel' => false, 'inputOptions' => ['readonly' => 'readonly']]) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?= $form->beginField($concorreccion, 'vp_derecho') ?>
                        <?= Html::tag('label', 'Vision Proxima') ?>
                        <?= Html::activeDropDownList($concorreccion, 'vp_derecho',
                            OptometriaHel::getVisionCuadro(), ['class' => 'form-control']) ?>
                        <?= $form->endField() ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered table-condensed">
                <tr>
                    <th colspan="2" class="text-center">Ojo Izquierdo</th>
                </tr>
                <tr>
                    <th>Snellen</th>
                    <th>LogMAR</th>
                </tr>
                <tr>
                    <td>
                        <?= $form->beginField($concorreccion, 'vl_izquierdo_snellen') ?>
                        <?= Html::activeDropDownList($concorreccion, 'vl_izquierdo_snellen',
                            OptometriaHel::getSnellen(), ['class' => 'form-control snellen']) ?>
                        <?= $form->endField() ?>
                        <?php OptometriaHel::SetSnellen($this, $concorreccion, 'vl_izquierdo_snellen', 'vl_izquierdo_logmar') ?>
                    </td>
                    <td>
                        <?= $form->field($concorreccion, 'vl_izquierdo_logmar',
                            ['enableLabel' => false, 'inputOptions' => ['readonly' => 'readonly']]) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?= $form->beginField($concorreccion, 'vp_izquierdo') ?>
                        <?= Html::tag('label', 'Vision Proxima') ?>
                        <?= Html::activeDropDownList($concorreccion, 'vp_izquierdo',
                            OptometriaHel::getVisionCuadro(), ['class' => 'form-control']) ?>
                        <?= $form->endField() ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered table-condensed">
                <tr>
                    <th colspan="2" class="text-center">Ambos Ojos</th>
                </tr>
                <tr>
                    <th>Snellen</th>
                    <th>LogMAR</th>
                </tr>
                <tr>
                    <td>
                        <?= $form->beginField($concorreccion, 'vl_ambos_snellen') ?>
                        <?= Html::activeDropDownList($concorreccion, 'vl_ambos_snellen',
                            OptometriaHel::getSnellen(), ['class' => 'form-control snellen']) ?>
                        <?= $form->endField() ?>
                        <?php OptometriaHel::SetSnellen($this, $concorreccion, 'vl_ambos_snellen', 'vl_ambos_logmar') ?>
                    </td>
                    <td>
                        <?= $form->field($concorreccion, 'vl_ambos_logmar',
                            ['enableLabel' => false, 'inputOptions' => ['readonly' => 'readonly']]) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?= $form->beginField($concorreccion, 'vp_ambos') ?>
                        <?= Html::tag('label', 'Vision Proxima') ?>
                        <?= Html::activeDropDownList($concorreccion, 'vp_ambos',
                            OptometriaHel::getVisionCuadro(), ['class' => 'form-control']) ?>
                        <?= $form->endField() ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>