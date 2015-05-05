<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\optometria\Optometria */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Optometria',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Optometrias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="optometria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
