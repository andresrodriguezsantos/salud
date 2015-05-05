<?php
/** @var Cliente $listacliente */
use yii\grid\GridView;
use yii\helpers\Html;

?>

<?=
GridView::widget([
    'dataProvider' => $model,
    'filterModel' => $listasearch,
    'columns' => [
        'codigo',
        'nombre',
        'definicionprofesional',
        'definicionpaciente',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{editarcie}',
            'buttons' => [
                'editarcie' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', $url, [
                        'data-pjax' => '0',
                    ]);
                }
            ]
        ],
    ],//colums
]);
?>