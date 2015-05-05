<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SearchOptometria */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Optometrias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="optometria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Optometria',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'nombres',
                'value' => 'historia.paciente.nombres'
            ],
            'motivoconsulta',
            'antecedentefamiliar',
            'antecedentepersonal',
            'estado',
            // 'tipo',
            // 'disposicion',
            // 'historia_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
