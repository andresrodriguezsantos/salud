<?php

?>
<div class="col-md-12" style="overflow: hidden">
    <div class="box box-success">
        <div class="box-header">
            <i class="glyphicon glyphicon-edit"></i>

            <h3 class="box-title">Formulario para Editar Codigo Cie</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?= Yii::$app->controller->renderPartial('form_codigocie', ['model' => $codigo]); ?>
        </div>
    </div>
</div>

