<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \app\models\Noticias $not */

?>
<div class="col-md-12">
    <div class="box-header">
        <h3 class="box-title" style="text-align: center">Informacion reciente</h3>
    </div>
    <br/><br/>

    <div class="box-body">
        <div class="col-md-3">
            <h4>Listado de Noticias</h4>
            <ul class="list-group">
                <?php
                foreach ($noticia as $not) { ?>
                    <li class="list-group-item">
                        <?= yii\helpers\Html::a($not->titulo, ['/site/verdetalle', 'id' => $not->id]) ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-9">
            <?php
            $ik = 1;
            foreach ($noticia as $not) { ?>
                <?= $ik == 1 ? '<div class="col-md-12">' : '' ?>
                <div class="col-md-6">
                    <div class="thumbnail">
                        <?= Html::img(Url::base() . '/' . $not->urlimg) ?>
                        <div class="caption">
                            <h3 style="text-align:justify"><?= $not->titulo ?></h3>

                            <p style="text-align:justify"><?= $not->anexos ?></p>

                            <p style="text-align : justify;">
                                <?= substr($not->mensaje, 0, 250) . ' ... ' . \yii\helpers\Html::a('Leer mas', ['/site/verdetalle', 'id' => $not->id]) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?= $ik == 2 ? '</div>' : '' ?>
                <?php $ik = ($ik == 2 ? 0 : $ik) ?>
                <?php if ($ik == 2) {
                    break;
                } ?>
                <?php $ik++;
            } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>




