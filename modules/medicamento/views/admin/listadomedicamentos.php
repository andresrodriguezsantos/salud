<?php
use yii\grid\GridView;
use yii\helpers\Html;

/** @var $medicamento \app\models\medicamento\Medicamento */
?>
    <h3 class="box-title" style="color: #8EC4EC">Listado de Medicamentos</h3>
<?=
GridView::widget([
    'dataProvider' => $medicamentos,
    'columns' => [
        'nombrecomercial',
        [
            'label' => 'Tipo Teapeutico',
            'value' => 'subtipoterapeutico.tipoterapeutico.nombre'
        ],
        [
            'label' => 'Subtipo Terapeutico',
            'value' => 'subtipoterapeutico.nombre',
        ],
        'composicion',
        [

            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{verdetalle} " . (Yii::$app->controller->action->id != 'registrarpresentacion' ? "{actualizar}" : "") . " {addpresentacion} {redirectremovepresentacion}",
            'buttons' => [
                'verdetalle' => function ($url, $medicamento) {
                    return $this->render('@app/views/layouts/modals/infomedicamento', [
                        'btn' => [
                            'label' => '<i class="glyphicon glyphicon-eye-open"></i> Ver',
                            'tag' => 'a',
                            'class' => 'btn btn-success btn-xs'
                        ],
                        'model' => $medicamento,
                    ]);
                },
                'actualizar' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-edit"></span> Editar', $url, [
                        'data-pjax' => '0',
                        'class' => 'btn btn-xs btn-info',
                        'title' => 'Actualizar Informacion del Medicamento'
                    ]);
                },
                'addpresentacion' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Agregar', $url, [
                        'data-pjax' => '0',
                        'class' => 'btn btn-xs btn-warning',
                        'title' => 'Agregar nuevas Presentaciones al medicamento'
                    ]);
                },
                /* 'removepresentacion'=>function($url, $medicamento){
                     return $this->render('@app/modules/medicamento/views/admin/lista_eliminar_med_pre',[
                         'btn'=>[
                             'label'=>'<i class="glyphicon glyphicon-eye-open"></i> Eliminar',
                             'tag'=>'a',
                             'class'=>'btn btn-danger btn-xs'
                         ],
                         'model'=>$medicamento,
                     ]);*/
                'redirectremovepresentacion' => function ($url, $medicamento) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span> Eliminar', $url, [
                        'data-pjax' => '0',
                        'class' => 'btn btn-xs btn-danger',
                        'title' => 'Eliminar Presentaciones de Medicamentos'
                    ]);
                }
            ]
        ]
    ]
]) ?>