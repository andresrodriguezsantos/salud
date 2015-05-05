<?php
/** @var $form \yii\bootstrap\ActiveForm */
/** @var $rx \app\models\optometria\OptRxenuso */
$script = "function (chrs, buffer, pos, strict, opts) {
   var valExp2 = new RegExp(\"180|[0[0-9][0-9]|[0|1][0-7][0-9]|[0[0[9-9]\");
   return valExp2.test(buffer[pos - 1] + chrs);
}";
//[0|1]|[\h]
$script2 = "function (chrs, buffer, pos, strict, opts) {
   var valExp2 = new RegExp(\"[0|1]|[\\h]\");
   return valExp2.test(buffer[pos - 1] + chrs);
}";
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
            <table class="table table-condensed table-bordered">
                <tr>
                    <th class="text-center">Rx en Uso Derecho</th>
                </tr>
                <tr>
                    <td>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'odcilindro', ['inputOptions' => ['value' => '00.00']]) ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'odesfera', ['inputOptions' => ['value' => '00.00']]) ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'odeje', ['inputOptions' => ['value' => '0°']]) ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oddip') ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'odadd') ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oddm') ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-condensed table-bordered">
                <tr>
                    <th class="text-center">Rx en Uso Izquierdo</th>
                </tr>
                <tr>
                    <td>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oicilindro', ['inputOptions' => ['value' => '00.00']]) ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oiesfera', ['inputOptions' => ['value' => '00.00']]) ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oieje', ['inputOptions' => ['value' => '0°']]) ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oidip') ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oiadd') ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oidm') ?>
                        </div>
                    </td>

            </table>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-condensed">
                <tr>
                    <td>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'odobservacion')->textarea() ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'oiobservacion')->textarea() ?>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->field($rx, 'tipodelente')->dropDownList(
                                \app\shelper\OptometriaHel::getTipoLente()
                            ) ?>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</div>