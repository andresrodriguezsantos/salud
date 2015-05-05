<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">FORMULARIO PARA LA REDACCION DE NOTICIAS</h3>
        </div>
        <div class="box-body">
            <?php use yii\bootstrap\ActiveForm;
            use yii\helpers\Html;

            $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>

            <?= $form->field($noticia, 'titulo') ?>
            <?= $form->field($noticia, 'mensaje') ?>
            <?= $form->field($noticia, 'anexos') ?>
            <?= $form->field($noticia, 'picture')->fileInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>