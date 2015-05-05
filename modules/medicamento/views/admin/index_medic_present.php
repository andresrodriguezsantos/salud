<?php

?>

<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title" style="color: #8EC4EC">Asignacion de Nuevas Presentaciones a un Medicamento</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?= Yii::$app->controller->renderPartial('form_medic_present', [
                'medpre' => $medpre,
                'medicamento' => $medicamento
            ]) ?>
        </div>
    </div>
</div>
