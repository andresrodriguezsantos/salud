<?php
/** @var $model \app\models\Historia */
use app\shelper\OptometriaHel;
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
            <?php $satatus = '1';
            /** @var \app\models\Usuario $user */
            $user = Yii::$app->user->identity;
            if ((Yii::$app->user->can('Optometra', ['optometria' => $object]))){
                $satatus = '1';
                //es el dueño hace lo que le de la gana
            } elseif ( Yii::$app->user->can('Profesional')
            and $object->estado){
                $satatus = '2';
                //no es dueño de la historia pide el pin del paciente
            }elseif(Yii::$app->user->can('Profesional') and
                OptometriaHel::ChecPremision($object,$user->profesional->id)){
                $satatus = '3';
                //no es dueño pero tiene permiso de ver la historia
                //igual se le pide el pin del paciente
            }else{
                $satatus = '4';
                //no es dueño y no tiene permiso se le mostrara un dialogo para pedirlo

            }
            ?>
            <h3 class="timeline-header"><?= Html::a('Historia Clinica de Optometria',
                    ['/optometria/main/view', 'id' => $object->id,],['class' => 'optometria', 'data' => [
                        'optid' => $object->id,
                        'perm' => $satatus
                    ]]) ?></h3>

            <div class="timeline-body">
                <?php if (Yii::$app->user->can('Optometra', ['optometria' => $object])): ?>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Opciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><?= Html::a('<i class="glyphicon glyphicon-edit"></i> Agregar control',
                                    ['/optometria/main/addcontrol', 'id' => $object->id]) ?></li>
                            <li class="divider"></li>
                            <li><?= Html::a('Remitir', ['/optometria/certificados/consulta', 'id' => $object->historia_id,'tipo'=>'remision']) ?></li>
                            <li><?= Html::a('Examenes', ['/optometria/certificados/consulta', 'id' => $object->historia_id, 'tipo' => 'examen']) ?></li>
                            <li><?= Html::a('Prescribir Medicamento', ['/medicamento/admin/prescripcionmedica/', 'id' => $object->historia_id]) ?></li>
                            <li><?= Html::a('Expedir Certificado', ['/optometria/certificados/index/', 'id' => $object->historia_id]) ?></li>
                            <li><?= Html::a('Prescribir anteojos', ['/optometria/certificados/prescribiranteojos/', 'id' => $object->historia_id]) ?></li>
                        </ul>
                    </div>
                <?php elseif (Yii::$app->user->can('Paciente')): ?>
                    <?= Html::a('<i class="glyphicon glyphicon-edit"></i> Agregar control',
                        ['/optometria/main/addcontrol', 'id' => $object->id], ['class' => 'btn btn-info btn-xs pull-right']) ?>
                <?php endif; ?>

                <p>
                    <strong>Profesional:</strong><?= $object->historia->profesional->usuario->nombres . ' ' . $object->historia->profesional->usuario->apellidos ?>
                </p>
                <strong>Diagnóstico(s) :</strong>
                <br/>
                <?php foreach ($object->optDiagnostico as $diagnostico): ?>
                    <strong><?= $diagnostico->ojo == 'Ojo Derecho' ? 'OD:' : 'OI:' ?></strong>
                    <strong>Codigo-CIE</strong><?= $diagnostico->codigoCIE->codigo ?> /
                    <strong>Nominación</strong> <?= $diagnostico->nominacion ?>
                    <br/>
                <?php endforeach ?>
                <p>
                    <?php $controles = $object->controles;
                    if (!empty($controles)):?>
                        <?= \yii\bootstrap\Collapse::widget([
                            'items' => [
                                [
                                    'label' => 'Controles',
                                    'content' => '
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <br/><br/><br/><br/><br/>
                                        </div>
                                        <div class="overlay"></div>
                                        <div class="loading-img"></div>
                                    </div>',
                                    'options' => [
                                        'data' => ['optid' => $object->id, 'load' => 0]
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