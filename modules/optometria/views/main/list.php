<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SearchOptometria */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var $model \app\models\optometria\Optometria */

$this->title = Yii::t('app', 'Pacientes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-body" style="overflow: hidden">
            <div class="box-header">
                <h3 class="box-title">Pacientes</h3>
            </div>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <div class="col-md-12">
                <div class="box-header">
                    <i class="glyphicon glyphicon-list"></i>

                    <h3 class="box-title">Listado de Pacientes</h3>
                </div>
                <?php if ($dataProvider->getTotalCount() > 0): ?>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Paciente</th>
                            <th>Documento</th>
                            <th>Ciudad</th>
                            <th>telefono celular</th>
                            <th>telefono fijo</th>
                            <th>Opciones.</th>
                        </tr>
                        <?= ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemOptions' => ['class' => 'item'],
                            'itemView' => /**
                             * @param $model \app\models\Paciente
                             * @param $key
                             * @param $index
                             * @param $widget
                             * @return string
                             */
                                function ($model, $key, $index, $widget) {
                                    return '<tr id="' . $key . '">
                                 <td>' . Html::a($model->usuario->nombres . ' ' . $model->usuario->apellidos,
                                        [
                                            'index', 'd' => $model->usuario->cedula
                                        ]) . '</td>
                                 <td>' . $model->usuario->cedula . '</td>
                                 <td>' . $model->usuario->ciudad->nombre . '</td>
                                 <td>' . $model->usuario->telefonocelular . '</td>
                                 <td>' . $model->usuario->telefonofijo . '</td>
                                 <td>' . Html::a('<i class="glyphicon glyphicon-eye-open"></i> Ver Historia clinica', ['/paciente/home/historia', 'id' => $model->id], ['class' => 'btn btn-xs btn-default']) . '</td>
                                </tr>';
                                },
                        ]) ?>
                    </table>
                <?php else: ?>
                    <div class="alert alert-info">
                        <h4>No se encontraron resultados</h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
