<?php
/**
 * @var $this \yii\web\View
 * @var $optometria \app\models\optometria\Optometria
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-4">
            <?= $form->field($optometria, 'motivoconsulta')->textarea() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($optometria, 'antecedentefamiliar')->textarea() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($optometria, 'antecedentepersonal')->textarea() ?>
        </div>
    </div>
</div>
