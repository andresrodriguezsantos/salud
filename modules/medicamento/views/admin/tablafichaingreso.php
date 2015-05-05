<h4 style="color: #8EC4EC">Informacion General del Medicamento</h4>
<!--<div class=" footer">
    <button class="btn btn-primary fa-plus glyphicon glyphicon-save" id="btnsavemedicina" style="display: none"></i>Save Information</button>
</div>-->
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>ADMISION CARD</th>
        <th>INFORMATION</th>
    </tr>
    </thead>
    <tbody class="tablafichaingreso">

    </tbody>
</table>
<?php
use yii\helpers\BaseUrl;

$this->registerJsFile(BaseUrl::home() . 'js/findmedicamento.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
])

?>