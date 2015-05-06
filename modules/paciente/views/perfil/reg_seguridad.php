<div class="col-md-6">
    <?php use kartik\popover\PopoverX;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    $form = ActiveForm::begin([
        'action' => ['update'],
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <label for="">Nueva Contraseña</label>
    <?= $form->field($model, 'password')->passwordInput()->label(false)?>

    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-md-6">
    <label for="">Informacion de Pin de Seguridad</label>
    <br/><br/>
    <div class="col-md-6">
        <label for="">Pin Numero : <h2 style="color: #008d4c" ><?=$model->pin?></h2></label>
    </div>
    <?=$model->pin=""?>

    <div class="col-md-6">
        <?php $form = ActiveForm::begin([
            'action' => ['update'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <label for="">Cambiar Codigo Pin</label>
        <?= PopoverX::widget([
            'header'=>'Ayuda',
            'size'=>PopoverX::SIZE_LARGE,
            'type'=>PopoverX::TYPE_INFO,
            'placement'=>PopoverX::ALIGN_LEFT_TOP,
            'content'=>'Este Pin de seguridad le permite....',
            'toggleButton'=>['label'=>'<i class="glyphicon glyphicon-question-sign"></i> Ayuda',
                'tag'=>'a','style'=>'margin: 10px;']
        ]) ?>
        <?= $form->field($model, 'pin')->label(false)?>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>