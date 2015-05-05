<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @since 1.0.0 */
/* @var $this yii\web\View */
/* @var $model app\models\search\SearchPaciente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class='optometria-search col-md-12 row'>

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
    ]); ?>
    <div class='form-group col-sm-4'>
        <?= $form->field($model, 'typo', ['inputOptions' => ['id' => 'tipobusqueda']])->dropDownList([
            '1' => 'Nombres o apellidos',
            '2' => 'numero de documento'
        ]) ?>
    </div>
    <div class='form-group col-sm-4'>
        <?= $form->field($model, 'valor')
            ->textInput(['placeholder' => 'nombre(s) o apellido(s)', 'id' => 'valor']) ?>
    </div>
    <div class='form-group col-sm-4' style="margin-top: 2.2%;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJs("
$('#tipobusqueda').change(function(e){
    e.preventDefault();
    var val = $(this).val();
    console.log(val);
    var valor = $('#valor');
    if(val == '1'){
        valor.attr('placeholder','nombre(s) o apellido(s)');
    }else if(val == '2'){
        valor.attr('placeholder','numero de documento del paciente');
    }
})
") ?>
