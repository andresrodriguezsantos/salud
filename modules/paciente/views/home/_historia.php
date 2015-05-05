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
<?php elseif($lastModel == null):
    ?>
    <li class="time-label">
        <span class="bg-red"><?= date('d M Y', strtotime($model->fecha)) ?></span>
    </li>
<?php endif ?>
<li>
    <?php $object = $model->getObject();
    if ($object instanceof \app\models\optometria\Optometria):
        ?>
        <i class="glyphicon glyphicon-eye-open" title="Historia clinica de optometria"></i>
        <div class="timeline-item">
            <span class="time"><i class="glyphicon glyphicon-time"></i> <?= date('h:i a',strtotime($model->fecha)) ?></span>

            <h3 class="timeline-header"><?= Html::a('Historia Clinica de Optometria',['/optometria/main/view','id'=>$object->id]) ?></h3>
            <div class="timeline-body">
                <p><strong>Profesional:</strong><?= $object->historia->profesional->usuario->nombres.' '.$object->historia->profesional->usuario->apellidos ?>
                    </p>
                <p>

                </p>
            </div>

            <div class='timeline-footer'>

            </div>
        </div>
    <?php endif ?>
    <?php /** @var \app\models\PacienteControl $object */
    if($object instanceof \app\models\PacienteControl): ?>
        <i class="glyphicon glyphicon-edit"></i>
        <div class="timeline-item">
            <span class="time"><i class="glyphicon glyphicon-time"></i> <?= date('h:i a',strtotime($model->fecha)) ?></span>
            <h3 class="timeline-header">Nota : </h3>
            <div class="timeline-body">
                <?= $object->notas ?>
                <?php if(!empty($object->urlimg)): ?>
                    <?= Html::img(\yii\helpers\Url::base().'/'.$object->urlimg) ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

</li>