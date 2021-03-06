<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tipodocumento */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Tipodocumento',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipodocumentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipodocumento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
