<?php
/** @var $optometria app\models\optometria\Optometria */
/** @var $historia \app\models\Historia */
/** @var $this \yii\web\View */
/** @var \yii\bootstrap\ActiveForm $form */
use yii\helpers\Html;

?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-6">
                <div class="box-header">
                    <h5><?= Yii::t('site', 'Búsqueda de pacientes') ?></h5>
                </div>
                <div class="col-xs-10">
                    <div class="form-group paciente-id">
                        <?= Html::input('text', 'cedula', Yii::$app->request->get('d', ''), ['class' => 'form-control cedula', 'placeholder' => 'introduzca el número de documento del paciente']) ?>
                        <?= $form->field($historia, 'paciente_id', ['enableLabel' => false, 'validateOnChange' => true])->hiddenInput(); ?>
                    </div>
                </div>
                <div class="col-xs-2">
                    <?= Html::button('Search', ['class' => 'btn btn-primary btn-sm search']) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-heading">
                            <strong>Detalles del Paciente</strong>
                        </li>
                        <li class="list-group-item">
                            <strong>Nombres :</strong><span class="nombres pull-right"></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Documento :</strong><span class="documento pull-right"></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Dirección :</strong><span class="direccion pull-right"></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Email :</strong><span class="email pull-right"></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Entidad :</strong><span class="entidad pull-right"></span>
                        </li>
                        <li class="list-group-item">
                            <strong>edad :</strong><span class="nacimiento pull-right"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php \yii\bootstrap\Modal::begin([
    'headerOptions' => ['class' => 'box-header'],
    'header' => '<h5 class="text-danger"> Paciente no Registrado </h5>',
    'id' => 'errornopaciente',
    'footer' => Html::button('<i class="glyphicon glyphicon-remove"></i> Close', ['data-dismiss' => 'modal', 'class' => 'btn btn-sm btn-warning'])
        . Html::a('<i class="glyphicon glyphicon-user"></i> Registrar Paciente', ['/paciente/home/registrar?ced='], ['class' => 'btn btn-primary', 'target' => '_blank', 'id' => 'newpaciente']),
]) ?>
<?= \yii\bootstrap\Alert::widget(
    [
        'options' => [
            'class' => 'alert-warning'
        ],
        'body' => ' <i class="glyphicon glyphicon-remove" aria-hidden="true"></i> no existe paciente con este numero de Documento !',
        'closeButton' => false
    ]
) ?>
<?php \yii\bootstrap\Modal::end() ?>
<?php if (Yii::$app->request->get('d')) {
    $this->registerJs('$.findCedula()');
} ?>