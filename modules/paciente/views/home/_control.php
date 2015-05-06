<?php
/**
 * @autor jhon j toloza
 * @since 1.0
 * @var $controles \app\models\optometria\OptControl[]
 * @var $this \yii\web\View
 */
use yii\helpers\Html;

?>
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
                        <p><?= Html::a('<i class="glyphicon glyphicon-picture"></i> Imagen de control #'
                                . ($key2 + 1), '@web/' . $pic, ['rel' => 'image-' . $key, 'title' => $control->nota,'class'=>'fancybox']) ?></p>
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