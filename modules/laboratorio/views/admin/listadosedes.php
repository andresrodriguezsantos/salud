<?php
/** @var \app\models\laboratorio\LabSede[] $labsedes */
use yii\helpers\Html;

/** @var $laboratorio \app\modules\laboratorio\laboratorio */
?>
<div class="col-md-12">
    <div class="box box-12">
        <div class="box-header">
            <h3 class="box-title" style="color: #8EC4EC">Listado de sedes asociados al laboratorio </h3>
        </div>
        <div class="box-body">
            <?= Html::a('Agregar Sedes',['registrosede','id'=>$laboratorio->id],['class'=>'btn btn-primary']) ?>
            <?= Html::a('Regresar', \yii\helpers\Url::to(['home/welcome']), ['class' => 'btn btn-warning']) ?>
            <br/><table class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>Ciudad</th>><th>Responsable</th><th>email</th><th>Opciones</th>
                    </tr>
                </thead>
            <tbody>
            <?php foreach($labsedes as $sede): ?>
                    <tr>
                        <td><?= $sede->ciudad? $sede->ciudad->nombre : 'No Definido' ?></td>
                        <td><?= !empty($sede->labUsuarios)?
                                $sede->labUsuarios[0]->usuario->nombres.' '.$sede->labUsuarios[0]->usuario->apellidos:
                                'No asignado' ; ?></td>
                        <td><?= !empty($sede->labUsuarios)?
                                $sede->labUsuarios[0]->email:
                                'No asignado' ; ?>
                        </td>
                        <td>
                           <?= \yii\helpers\Html::a('<i class="glyphicon glyphicon-edit"></i> Edit',['editarsede','id'=>$sede->id],['class'=>'btn btn-xs btn-info']) ?>
                           <?=  $this->render('@app/views/layouts/modals/delete',[
                               'btn'=>[
                                   'label'=>'<i class="glyphicon glyphicon-remove"></i> Eliminar',
                                   'tag'=>'a',
                                   'class'=>'btn btn-danger btn-xs'
                               ],
                               'url'=>[
                                   'deletesede','id'=>$sede->id
                               ]
                           ]);  ?>
                        </td>
                    </tr>
            <?php endforeach ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/eventos.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]);

?>