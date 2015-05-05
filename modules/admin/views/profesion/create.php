<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\profesion */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Profesion',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profesion'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
