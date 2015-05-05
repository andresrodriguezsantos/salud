<?php
/** @var $this \yii\web\View */
/** @var $form \yii\bootstrap\ActiveForm */
/** @var $examenexterno \app\models\optometria\OptExamenexterno[] */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php foreach ($examenexterno as $key => $examen) {
            echo $this->render('examenexterno/examen', [
                'model' => $examen,
                'key' => $key,
                'layout' => 'col-md-6',
                'form' => $form
            ]);
        }
        ?>
    </div>
</div>