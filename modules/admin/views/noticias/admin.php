<?php
use yii\grid\GridView;
use yii\helpers\Html;

/** @var $noticias \app\models\noticias */
?>

<div class="panel panel-default panel-info col-md-12">
    <div class="panel-heading">
        <h3 class="box-title" style="color: #8EC4EC">Listado de noticias</h3>
    </div>
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $noticias,

            'columns' => [
                'titulo',
                'mensaje',
                'anexos',
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'template' => "{editar} {eliminar}",
                    'buttons' => [
                        'editar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                                'data-pjax' => '0',
                                'class' => 'btn btn-info btn-lg form-group',
                                'title' => 'Editar la noticia'
                            ]);
                        },

                        'eliminar' => function ($url, $noticias) {
                            return $this->render('@app/views/layouts/modals/delete', [
                                'btn' => [
                                    'label' => '<span class="glyphicon glyphicon-trash"></span>',
                                    'tag' => 'a',
                                    'class' => 'btn btn-danger btn-lg form-group',
                                    'title' => 'Eliminar la noticia',
                                ],
                                'url' => [
                                    'eliminar', 'id' => $noticias->id
                                ]
                            ]);
                        }
                    ],
                    'options' => ['style' => 'word-wrap:break-word; width:130px;'],
                ]
            ]
        ]) ?>
    </div>
</div>
