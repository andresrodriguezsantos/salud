<?php
/** @var $this \yii\web\View */
use yii\helpers\Html;

/** @var $moduloverduc \app\models\optometria\OptModuloVersionesducciones[] */
/** @var $moduloamplitud \app\models\optometria\OptModuloAmplitudFlexibilidad */
/** @var $covertest \app\models\optometria\OptCoverTest */
/** @var $form \yii\bootstrap\ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
            <div class="box-header">
                <h4>Cover Test</h4>
            </div>
            <table class="table table-condensed table-bordered">
                <tr>
                    <th><?= Html::tag('label', $covertest->getAttributeLabel('m6')) ?></th>
                    <th><?= Html::tag('label', $covertest->getAttributeLabel('m3')) ?></th>
                    <th><?= Html::tag('label', $covertest->getAttributeLabel('m1')) ?></th>
                    <th><?= Html::tag('label', $covertest->getAttributeLabel('cm50')) ?></th>
                    <th><?= Html::tag('label', $covertest->getAttributeLabel('cm30')) ?></th>
                    <th><?= Html::tag('label', $covertest->getAttributeLabel('cm20')) ?></th>
                    <th><?= Html::tag('label', $covertest->getAttributeLabel('cm10')) ?></th>
                </tr>
                <tr>
                    <td><?= $form->field($covertest, 'm6', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                    <td><?= $form->field($covertest, 'm3', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                    <td><?= $form->field($covertest, 'm1', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                    <td><?= $form->field($covertest, 'cm50', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                    <td><?= $form->field($covertest, 'cm30', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                    <td><?= $form->field($covertest, 'cm20', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                    <td><?= $form->field($covertest, 'cm10', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                </tr>
                <tr>
                    <td colspan="7">
                        Registre la condición motora y su magnitud. Ejemplo x5 (exoforia 5 prismas); XTA(exotropia
                        alternante 12 prismas)
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12">
            <?php
            $optionsv = [];
            $optionsd = [];
            if (!$moduloverduc['versiones']->isNewRecord) {
                $optionsv = [
                    'initialPreview' => [
                        Html::img(\yii\helpers\Url::base() . '/' . $moduloverduc['versiones']->urlimg,
                            ['class' => 'file-preview-image']),
                    ],
                    'initialCaption' => $moduloverduc['versiones']->urlimg,
                    'showRemove' => false,
                    'overwriteInitial' => false,
                ];
            }
            if (!$moduloverduc['ducciones']->isNewRecord) {
                $optionsd = [
                    'initialPreview' => [
                        Html::img(\yii\helpers\Url::base() . '/' . $moduloverduc['ducciones']->urlimg,
                            ['class' => 'file-preview-image']),
                    ],
                    'initialCaption' => $moduloverduc['versiones']->urlimg,
                    'showRemove' => false,
                    'overwriteInitial' => false,
                ];
            }
            ?>
            <div class="col-md-6">
                <h4>Versiones</h4>

                <div class="col-md-10 col-md-offset-1">
                    <?= $form->field($moduloverduc['versiones'], '[versiones]photo')->widget(\kartik\file\FileInput::className(), [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => $optionsv,
                        'disabled' => (!$moduloverduc['versiones']->isNewRecord)
                    ]) ?>
                </div>
                <?= $form->field($moduloverduc['versiones'], '[versiones]observacion', ['options' => ['readonly' => (!$moduloverduc['versiones']->isNewRecord), 'placeholder' => 'Redacte los hallazgos o su interpretación']]) ?>
            </div>
            <div class="col-md-6">
                <h4>Ducciones</h4>

                <div class="col-md-10 col-md-offset-1">
                    <?= $form->field($moduloverduc['ducciones'], '[ducciones]photo')->widget(\kartik\file\FileInput::className(), [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => $optionsd,
                        'disabled' => (!$moduloverduc['ducciones']->isNewRecord)
                    ]) ?>
                </div>
                <?= $form->field($moduloverduc['ducciones'], '[ducciones]observacion', ['inputOptions' => ['readonly' => (!$moduloverduc['ducciones']->isNewRecord), 'placeholder' => 'Redacte los hallazgos o su interpretación']]) ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <h4>Ojo Derecho</h4>

                <div class="col-xs-6">
                    <?= $form->field($moduloamplitud, 'derechoamplitud', ['inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]])
                    ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($moduloamplitud, 'derechoflexibilidad', ['inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]])

                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Ojo Izquierdo</h4>

                <div class="col-xs-6">
                    <?= $form->field($moduloamplitud, 'izquierdoamplitud', ['inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]])
                    ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($moduloamplitud, 'izquierdoflexibilidad', ['inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]])
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6 ">
                <table class="table table-bordered table-condensed">
                    <tr>
                        <th colspan="3" class="">Punto Próximo de comvergencia
                            <small>(cms)</small>
                        </th>
                    </tr>
                    <tr>
                        <th>OR</th>
                        <th>FR</th>
                        <th>Disociado</th>
                    </tr>
                    <tr>
                        <td><?= $form->field($moduloamplitud, 'ppc_or', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                        <td><?= $form->field($moduloamplitud, 'ppc_fr', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                        <td><?= $form->field($moduloamplitud, 'ppc_disociado', ['enableLabel' => false, 'inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]]) ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 ">
                <table class="table table-bordered table-condeced col-md-12">
                    <tr>
                        <th colspan="4">Reservas Fusionales
                            <small>(Dioptrías Prismáticas)</small>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">Positivas</th>
                        <th colspan="2" class="text-center">Negativas</th>
                    </tr>
                    <tr>
                        <td><?= $form->field($moduloamplitud, 'rfp_vl', ['inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]])
                            ?></td>
                        <td><?= $form->field($moduloamplitud, 'rfp_vp', ['inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]])
                            ?></td>
                        <td><?= $form->field($moduloamplitud, 'rfn_vl', ['inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]])
                            ?></td>
                        <td><?= $form->field($moduloamplitud, 'rfn_vp', ['inputOptions' => ['readonly' => (!$moduloamplitud->isNewRecord)]])
                            ?></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
