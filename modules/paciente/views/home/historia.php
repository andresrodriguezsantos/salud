<?php
/** @var $this \yii\web\View */
use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var $paciente \app\models\Paciente */
/** @var $historias \yii\data\ActiveDataProvider */
$this->title = 'Historia clinica : '.$paciente->usuario->nombres.' '.$paciente->usuario->apellidos;
if(Yii::$app->user->can('Paciente'))
$this->params['breadcrumbs'][] = ['url'=>['index'],'label'=>''];
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->can('Optometra'))
?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <i class="glyphicon glyphicon-user"></i>

            <h3 class="box-title">Historia Clinica Paciente
                : <?= $paciente->usuario->nombres . ' ' . $paciente->usuario->apellidos ?>
            </h3>
            <span class="pull-right" style="margin: 10px">
                <strong>documento: </strong><?= $paciente->usuario->cedula ?>
                <strong>Edad: </strong><?= \app\shelper\Util::edad($paciente->fechanacimiento) ?>
                <strong>cel: </strong><?= $paciente->usuario->telefonocelular ?>
            </span>
        </div>
        <div class="box-body">
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $historias,
                    'itemOptions' => ['tag' => false],
                    'itemView' =>'_historia',
                    'layout' => "{summary}\n
                    <ul class=\"timeline\">
                    {items}
                    <li>
                        <i class=\"glyphicon glyphicon-time\"></i>
                    </li>
                    </ul>
                    {pager}\n"
                ]) ?>

        </div>
    </div>
</div>
<?php
    $pin = Modal::begin([
        'id'=>'get-pin',
        'header'=>'<h4>Solicitud de pin</h4>',
        'footer'=>Html::button('Validar',['class'=>'btn btn-success','id'=>'send-pin']).
        Html::button('Cancelar', ['data-dismiss' => 'modal', 'class' => 'btn btn-default'])
    ]);
?>

    <div class="box box-solid" id="pin-body">
        <div class="box-body">
            <?= Html::label('Escriba el pin del Usuario','pin') ?>
            <?= Html::textInput('pin',null,['class'=>'form-control','id'=>'pin']) ?>
            <?= Html::tag('div','',['id'=>'result-pin','class'=>'text-success']) ?>
        </div>
    </div>
<?php $pin->end() ?>

<?php
$pin = Modal::begin([
    'id'=>'get-solicitud',
    'header'=>'<h4>Solicitud de permiso</h4>',
    'footer'=>Html::button('Validar',['class'=>'btn btn-success','id'=>'send-solicitud']).
        Html::button('Cancelar', ['data-dismiss' => 'modal', 'class' => 'btn btn-default'])
]);
?>
    <div class="box box-solid" id="sol-body">
        <div class="box-body">
            <?= Html::label('Escriba una Nota para el profesional.','solicitud') ?>
            <?= Html::textarea('nota',null,['class'=>'form-control','id'=>'solicitud']) ?>
            <?= Html::tag('div','',['id'=>'result-sol','class'=>'text-success']) ?>
        </div>
    </div>
<?php $pin->end() ?>

<?php $this->registerJsFile('@web/fanci/jquery.fancybox.js',[
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END,
]) ?>
<?php $this->registerCssFile('@web/fanci/jquery.fancybox.css') ?>
<?php $this->registerJsFile('@web/js/historia.js',[
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END,
]) ?>