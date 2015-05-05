<?php
/** @var $queratometria \app\models\optometria\OptCorneaQueratometria */

/** @var $this \yii\web\View */
/** @var $form \yii\bootstrap\ActiveForm */

$script = <<< SCRIPT
function (chrs, buffer, pos, strict, opts) {
   var valExp2 = new RegExp("180|1|[09][0-9]|");
   return valExp2.test(buffer[pos - 1] + chrs);
}
SCRIPT;

?>
<div class="col-md-6">
    <h4>Ojo Derecho</h4>

    <div class="col-sm-4">
        <?= $form->field($queratometria, 'odesfera',
            ['inputOptions' => ['readonly' => !$queratometria->isNewRecord]])
        ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($queratometria, 'odcilindro',
            ['inputOptions' => ['readonly' => !$queratometria->isNewRecord]])
        ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($queratometria, 'odeje',
            ['inputOptions' => ['readonly' => !$queratometria->isNewRecord, 'max' => "180", 'type' => 'numbre']])
        ?>
    </div>
</div>
<div class="col-md-6">
    <h4>Ojo Izquierdo</h4>

    <div class="col-sm-4">
        <?= $form->field($queratometria, 'oioesfera',
            ['inputOptions' => ['readonly' => !$queratometria->isNewRecord]])
        ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($queratometria, 'oicilindro',
            ['inputOptions' => ['readonly' => !$queratometria->isNewRecord]])
        ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($queratometria, 'oieje',
            ['inputOptions' => ['readonly' => !$queratometria->isNewRecord, 'max' => "180", 'type' => 'numbre'],])
        ?>
    </div>
</div>