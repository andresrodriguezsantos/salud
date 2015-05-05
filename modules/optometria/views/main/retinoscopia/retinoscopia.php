<?php
/** @var $this \yii\web\View */

/** @var $form \yii\bootstrap\ActiveForm */
/** @var $model \app\models\optometria\OptRetinoscopia[] */
/** @var $key String */
$script = <<< SCRIPT
function (chrs, buffer, pos, strict, opts) {
   var valExp2 = new RegExp("180|0[0-9][0-9]|[0|1][0-7][0-9]");
   return valExp2.test(buffer[pos - 1] + chrs);
}
SCRIPT;

?>
<?php if ($model[$key]->tipo): ?>
    <?= $form->field($model[$key], "[$key]tipo", ['enableLabel' => false])->hiddenInput() ?>
<?php endif ?>
<div class="col-md-6">
    <h4>Ojo Derecho</h4>

    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model[$key], "[$key]odesfera")
            ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model[$key], "[$key]odcilindro")
            ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model[$key], "[$key]odeje")
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model[$key], "[$key]odsnellenvl")->dropDownList(
                \app\shelper\OptometriaHel::getSnellen()
            ) ?>
            <?php \app\shelper\OptometriaHel::SetSnellen($this, $model[$key], "[$key]odsnellenvl", "[$key]odlogmarvl") ?>

            <?= $form->field($model[$key], "[$key]odsnellenvp")->dropDownList(
                \app\shelper\OptometriaHel::getSnellen()
            ) ?>
            <?php \app\shelper\OptometriaHel::SetSnellen($this, $model[$key], "[$key]odsnellenvp", "[$key]odlogmarvp") ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model[$key], "[$key]odlogmarvl", ['inputOptions' => ['readonly' => true, 'value' => '0.00']]) ?>
            <?= $form->field($model[$key], "[$key]odlogmarvp", ['inputOptions' => ['readonly' => true, 'value' => '0.00']]) ?>
        </div>
    </div>
</div>
<div class="col-md-6">
    <h4>Ojo Izquierdo</h4>

    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model[$key], "[$key]oiesfera")
            ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model[$key], "[$key]oicilindro")
            ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model[$key], "[$key]oieje")
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model[$key], "[$key]oisnellenvl")->dropDownList(
                \app\shelper\OptometriaHel::getSnellen()
            ) ?>
            <?php \app\shelper\OptometriaHel::SetSnellen($this, $model[$key], "[$key]oisnellenvl", "[$key]oilogmarvl") ?>

            <?= $form->field($model[$key], "[$key]oisnellenvp")->dropDownList(
                \app\shelper\OptometriaHel::getSnellen()
            ) ?>
            <?php \app\shelper\OptometriaHel::SetSnellen($this, $model[$key], "[$key]oisnellenvp", "[$key]oilogmarvp") ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model[$key], "[$key]oilogmarvl", ['inputOptions' => ['readonly' => true, 'value' => '0.00']]) ?>
            <?= $form->field($model[$key], "[$key]oilogmarvp", ['inputOptions' => ['readonly' => true, 'value' => '0.00']]) ?>
        </div>
    </div>
</div>
<div class="col-md-8 row col-md-offset-2">
    <h4 class="text-info">Ambos Ojos</h4>

    <div class="col-md-6">
        <?= $form->field($model[$key], "[$key]ambossnellenvl")->dropDownList(
            \app\shelper\OptometriaHel::getSnellen()
        ) ?>
        <?php \app\shelper\OptometriaHel::SetSnellen($this, $model[$key], "[$key]ambossnellenvl", "[$key]amboslogmarvl") ?>
        <?= $form->field($model[$key], "[$key]ambossnellenvp")->dropDownList(
            \app\shelper\OptometriaHel::getSnellen()
        ) ?>
        <?php \app\shelper\OptometriaHel::SetSnellen($this, $model[$key], "[$key]ambossnellenvp", "[$key]amboslogmarvp") ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model[$key], "[$key]amboslogmarvl", ['inputOptions' => ['readonly' => true, 'value' => '0.00']]) ?>
        <?= $form->field($model[$key], "[$key]amboslogmarvp", ['inputOptions' => ['readonly' => true, 'value' => '0.00']]) ?>
    </div>
</div>