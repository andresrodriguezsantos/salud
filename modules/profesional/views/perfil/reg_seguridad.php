<div class="col-md-6">
    <?php use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    $form = ActiveForm::begin([
        'action' => ['update'],
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <label for="">Nueva Contraseña</label>
    <?= $form->field($usuario, 'password')->passwordInput()->label(false) ?>

    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-md-6">
    <label for="">Informacion de Pin de Seguridad</label>
    <br/><br/>

    <div class="col-md-6">
        <label for="">Pin Numero : <h2 style="color: #008d4c"><?= $usuario->pin ?></h2></label>
    </div>
    <div class="col-md-6">
        <?php $form = ActiveForm::begin([
            'action' => ['update'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <?= $usuario->pin = "" ?>
        <label for="">Cambiar Codigo Pin</label>
        <?= $form->field($usuario, 'pin')->label(false) ?>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>