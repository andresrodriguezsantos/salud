<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EpsCosultorio */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Eps Cosultorio',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Eps Cosultorios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eps-cosultorio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
