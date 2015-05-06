<?php
/** @var $model \app\models\Historia */
use yii\helpers\Html;

/** @var $lastModel \app\models\Historia */
?>
<?php if ($lastModel != null && (date('Y-m-d', strtotime($lastModel->fecha)) != date('Y-m-d', strtotime($model->fecha)))):
    ?>
    <li class="time-label">
        <span class="bg-red"><?= date('d M Y', strtotime($model->fecha)) ?></span>
    </li>
<?php elseif ($lastModel == null):
    ?>
    <li class="time-label">
        <span class="bg-red"><?= date('d M Y', strtotime($model->fecha)) ?></span>
    </li>
<?php endif ?>
<li>
    <?php $object = $model->getObject();
    if ($object instanceof \app\models\optometria\Optometria):
        /** @var $object \app\models\optometria\Optometria */
        ?>
        <i class="glyphicon glyphicon-eye-open" title="Historia clinica de optometria"></i>
        <div class="timeline-item">
            <span class="time"
                ><i
                    class="glyphicon glyphicon-time"></i> <?= date('h:i a', strtotime($model->fecha)) ?></span>
            <h3 class="timeline-header"><?= Html::a('Historia Clinica de Optometria', ['/optometria/main/view', 'id' => $object->id]) ?></h3>
            <div class="timeline-body">
                <?php if (Yii::$app->user->can('Optometra', ['optometria' => $object])): ?>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Opciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><?= Html::a('<i class="glyphicon glyphicon-edit"></i> Agregar control',
                                    ['/optometria/main/addcontrol', 'id' => $object->id]) ?></li>
                            <li class="divider"></li>
                            <li><?= Html::a('Remitir',['certificados/remitir', 'id' => $object->historia_id]) ?></li>
                            <li><?= Html::a('Examenes',['certificados/examen', 'id' => $object->historia_id]) ?></li>
                            <li><?= Html::a('Prescribir Medicamento',['/medicamento/admin/prescripcionmedica/', 'id' => $object->historia_id]) ?></li>
                            <li><?= Html::a('Expedir Certificado',['certificados/index/', 'id' => $object->historia_id]) ?></li>
                            <li><?= Html::a('Prescribir anteojos',['certificados/prescribiranteojos/', 'id' => $object->historia_id]) ?></li>
                        </ul>
                    </div>
                <?php elseif(Yii::$app->user->can('Paciente')): ?>
                    <?= Html::a('<i class="glyphicon glyphicon-edit"></i> Agregar control',
                        ['/optometria/main/addcontrol', 'id' => $object->id],['class'=>'btn btn-info btn-xs pull-right']) ?>
                <?php endif; ?>

                <p>
                    <strong>Profesional:</strong><?= $object->historia->profesional->usuario->nombres . ' ' . $object->historia->profesional->usuario->apellidos ?>
                </p>
                <strong>Diagnóstico(s) :</strong>
                <br/>
                <?php foreach($object->optDiagnostico as $diagnostico): ?>
                    <strong><?= $diagnostico->ojo == 'Ojo Derecho'? 'OD:' : 'OI:' ?></strong>
                    <strong>Codigo-CIE</strong><?= $diagnostico->codigoCIE->codigo ?> / <strong>Nominación</strong> <?= $diagnostico->nominacion ?>
                    <br/>
                <?php endforeach ?>
                <p>
                    <?php $controles = $object->controles;
                    if (!empty($controles)):?>
                    <?= \yii\bootstrap\Collapse::widget([
                            'items'=>[
                                [
                                'label'=> 'Controles',
                                'content'=>'<div class="box box-default">
                                <div class="box-body">
                                    <br/><br/><br/><br/><br/>
                                </div>
                                <div class="overlay"></div>
                                <div class="loading-img"></div>
                            </div>',
                                   'options'=>[
                                       'data'=>['optid'=>$object->id,'load'=>0]
                                   ]
                                ]
                            ]
                        ]) ?>
                <?php endif ?>
            </div>

            <div class='timeline-footer'>

            </div>
        </div>
    <?php endif ?>
</li>