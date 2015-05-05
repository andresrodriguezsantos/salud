<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ciudad */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Ciudad',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ciudads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciudad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
