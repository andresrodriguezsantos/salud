<?php
/** @var $this \yii\web\View */
/** @var $paciente \app\models\Paciente */
/** @var $historias \yii\data\ActiveDataProvider */

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
            <p>
                <?php if(Yii::$app->user->can('Profesional')): ?>
                    <?= \yii\helpers\Html::a('Agregar nota al Paciente',['/paciente/historia/addnota','id'=>$paciente->id],['class'=>'btn btn-primary']) ?>
                <?php endif ?>
                <?php if (Yii::$app->user->can('Paciente')): ?>
                    <?= \yii\helpers\Html::a('Agregar nota',['/paciente/home/notas','id'=>$paciente->id],['class'=>'btn btn-primary']) ?>
                <?php endif ?>
            </p>

            <br/>
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
