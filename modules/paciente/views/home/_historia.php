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
            <span class="time"><i
                    class="glyphicon glyphicon-time"></i> <?= date('h:i a', strtotime($model->fecha)) ?></span>

            <h3 class="timeline-header"><?= Html::a('Historia Clinica de Optometria', ['/optometria/main/view', 'id' => $object->id]) ?></h3>

            <div class="timeline-body">
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
                <ul class="timeline">
                    <?php foreach ($controles as $key => $control): ?>

                        <li>
                            <i class="glyphicon glyphicon-edit" title="Control"></i>

                            <div class="timeline-item">

                            <span class="time">
                                <i class="glyphicon glyphicon-tima"></i> <?= date('d/m/Y h:i a', strtotime($control->fecha)) ?>
                            </span>

                                <div class="timeline-header">
                                    <h4>Control</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-info"><?= $control->nota ?></p>
                                    <?php $pics = \yii\helpers\Json::decode($control->urlimg);
                                    if (!empty($pics)):
                                        ?>
                                        <?php foreach ($pics as $key2 => $pic): ?>
                                        <p><?= Html::a('<i class="glyphicon glyphicon-picture"></i> Imagen de control #' . ($key2 + 1), '@web/' . $pic, ['data-lightbox' => 'image-' . $key, 'data-title' => $control->nota]) ?></p>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    <li>
                        <i class="glyphicon glyphicon-time"></i>
                    </li>
                </ul>
                <?php endif ?>
            </div>

            <div class='timeline-footer'>
                <?php if (Yii::$app->user->can('Optometra', ['optometria' => $object]) or Yii::$app->user->can('Paciente')): ?>
                    <?= Html::a('<i class="glyphicon glyphicon-edit"></i> Agregar control', ['/optometria/main/addcontrol', 'id' => $object->id],['class'=>'btn btn-primary btn-xs']) ?>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>
    <?php /** @var \app\models\PacienteControl $object */
    if ($object instanceof \app\models\PacienteControl): ?>
        <i class="glyphicon glyphicon-edit"></i>
        <div class="timeline-item">
            <span class="time"><i
                    class="glyphicon glyphicon-time"></i> <?= date('h:i a', strtotime($model->fecha)) ?></span>

            <h3 class="timeline-header">Nota : </h3>

            <div class="timeline-body">
                <?= $object->notas ?>
                <?php if (!empty($object->urlimg)): ?>
                    <?= Html::img(\yii\helpers\Url::base() . '/' . $object->urlimg) ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

</li>