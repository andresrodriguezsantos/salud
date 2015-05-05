<div id="ip"></div>
<div id="address"></div>
<hr/>Full response:
<pre id="details"></pre>
<?php $this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/global.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]) ?>
