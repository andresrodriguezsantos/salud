<?php
/** @var $topografia \app\models\optometria\OptCorneaTopografia */
/** @var $this \yii\web\View */
/** @var $form \yii\bootstrap\ActiveForm */
use kartik\file\FileInput;
use yii\helpers\Html;

?>
<?php
$optionsv = [];
$optionsd = [];
if (!$topografia->isNewRecord) {
    $optionsv = [
        'initialPreview' => [
            Html::img(\yii\helpers\Url::base() . '/' . $topografia->odurlimg,
                ['class' => 'file-preview-image']),
        ],
        'initialCaption' => $topografia->odurlimg,
        'showRemove' => false,
        'overwriteInitial' => false,
    ];
}
if (!$topografia->isNewRecord) {
    $optionsd = [
        'initialPreview' => [
            Html::img(\yii\helpers\Url::base() . '/' . $topografia->oiurlimg,
                ['class' => 'file-preview-image']),
        ],
        'initialCaption' => $topografia->oiurlimg,
        'showRemove' => false,
        'overwriteInitial' => false,
    ];
}
?>
<div class="col-md-6">
    <div class="box-header">
        <h4>Ojo Derecho</h4>
    </div>
    <div class="box-body">
        <?= $form->field($topografia, 'odphoto')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => $optionsv,
            'disabled' => (!$topografia->isNewRecord)
        ]); ?>
        <?= $form->field($topografia, 'odobservacion')->textarea(['readonly' => !$topografia->isNewRecord]) ?>
    </div>
</div>
<div class="col-md-6">
    <div class="box-header">
        <h4>Ojo Izquierdo</h4>
    </div>
    <div class="box-body">
        <?= $form->field($topografia, 'oiphoto')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => $optionsd,
            'disabled' => (!$topografia->isNewRecord)
        ]); ?>
        <?= $form->field($topografia, 'oiobservacion')->textarea(['readonly' => !$topografia->isNewRecord]) ?>
    </div>
</div>
