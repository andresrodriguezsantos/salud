<?php

/** @var $this \yii\web\View */
/** @var $tipo \app\models\medicamento\MedTipoTerapeutico */
/** @var $listatipo \app\models\medicamento\MedTipoTerapeutico[] */
/** @var $subtipo \app\models\medicamento\MedSubtipoTerapeutico */
/** @var $listtiposearch \app\models\search\SearchTipoMedicamento */
/** @var $listasubtipo \app\models\medicamento\MedSubtipoTerapeutico[] */
/** @var $listsubtiposearch \app\models\search\SearchSubtipoMedicamento */
use yii\grid\GridView;
use yii\helpers\Html;

?>
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title" style="color: #8EC4EC">Register Types and Subtypes Therapeuthic</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#listadoterapeutico" data-toggle="tab">Therapeutic List</a></li>
                    <li <?= (Yii::$app->request->get('id')) ? 'class="active"' : ''; ?>><a href="#subtipos"
                                                                                           data-toggle="tab">Subtypes
                            Therapeutic</a></li>
                    <li <?= (!Yii::$app->request->get('id')) ? 'class="active"' : ''; ?>><a href="#tipos"
                                                                                            data-toggle="tab">TypesTherapeutic</a>
                    </li>
                    <li class="pull-left header" style="color: #8EC4EC"><i class="glyphicon glyphicon-save"></i></li>
                </ul>
                <div class="tab-content" style="overflow: hidden">
                    <div class="tab-pane <?= (!Yii::$app->request->get('id')) ? 'active' : ''; ?>" id="tipos">
                        <?php echo $this->render('registrotipo', ['tipo' => $tipo]) ?>
                    </div>
                    <div class="tab-pane <?= (Yii::$app->request->get('id')) ? 'active' : ''; ?>" id="subtipos">
                        <?php echo $this->render('registrosubtipo', ['subtipo' => $subtipo]) ?>
                    </div>
                    <div class="tab-pane" id="listadoterapeutico">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <h3 style="color: #8EC4EC">Therapeutic Type</h3>
                                <?=
                                GridView::widget([
                                    'dataProvider' => $listatipo,
                                    'filterModel' => $listtiposearch,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        'nombre',
                                    ]]);
                                ?>
                            </div>
                            <div class="col-md-6">
                                <h3 style="color: #8EC4EC">Therapeutic SubType</h3>
                                <?= GridView::widget([
                                    'dataProvider' => $listasubtipo,
                                    'filterModel' => $listsubtiposearch,
                                    'columns' => [
                                        'tipoterapeutico.nombre',
                                        'nombre',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{index}',
                                            'buttons' => [
                                                'index' => function ($url, $model) {
                                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', $url, [
                                                        'data-pjax' => '0',
                                                    ]);
                                                }
                                            ]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


