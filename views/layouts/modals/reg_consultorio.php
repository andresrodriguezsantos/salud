<?php
/* @var array $btn */
/* @var array $url */
/** @var \app\models\medicamento\Medicamento $model */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

Modal::begin([
    'header' => '<h3 style="color: #8EC4EC">Registro de Clinicas o Consultorios Independientes</h3>',
    'toggleButton' => $btn,
    'footer' => Html::button('cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-default'])
]);
$form = ActiveForm::begin([
]); ?>
<?php ActiveForm::end(); ?>

<?php
Modal::end();
?>
