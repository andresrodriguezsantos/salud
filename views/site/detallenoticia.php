<?php
use yii\helpers\Html;

?>

<div class="col-md-12">
    <div class="col-md-7">
        <h2 style="text-align: center">
            <?= /** @var \app\models\Noticias $noticia */
            $noticia->titulo ?></h2>

        <p style="text-align: justify">
            <?= $noticia->mensaje ?><br/>
            <?= Html::a('Regresar', Yii::$app->request->getReferrer(), ['class' => 'btn btn-primary']) ?>
        </p>

    </div>
    <div class="col-md-5">
        <br/><br/><br/>

        <div class="mid-grid-left">
            <?= /** @var \app\models\Noticias $noticia */
            \yii\helpers\Html::img(\yii\helpers\Url::base() . '/' . $noticia->urlimg, ['style' => 'max-height:300px']) ?>
        </div>
    </div>
</div>