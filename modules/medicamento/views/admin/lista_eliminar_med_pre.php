<?php
/**
 * @var $medicamento  \app\models\medicamento\Medicamento
 */
?>


<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <i class="glyphicon glyphicon-remove"></i>

            <h3 class="box-title">Eliminar Presentaciones de Medicamentos</h3>
        </div>
        <div class="box-body">
            <h4>Datos del Medicamento</h4>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nombre de Medicamento</th>
                    <th>Subtipo Terapeutico</th>
                    <th>Composicion</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= /** @var \app\models\medicamento\Medicamento $medicamento */
                        $medicamento->nombrecomercial ?></td>
                    <td><?= $medicamento->subtipoterapeutico->nombre ?> </td>
                    <td><?= $medicamento->composicion ?></td>
                </tr>
                </tbody>
            </table>
            <br/><br/>
            <h4>Datos de Presentaciones Asociadas al Medicamento</h4>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nombre de presentacion</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var \app\models\medicamento\MedPreMed $presentaciones */
                foreach ($presentaciones as $pre): ?>
                    <tr>
                        <td><?= ($pre->presentacion->nombre) ? $pre->presentacion->nombre : 'No Aplica' ?></td>
                        <td>
                            <?= $this->render('@app/views/layouts/modals/delete', [
                                'btn' => [
                                    'label' => '<i class="glyphicon glyphicon-remove "></i> Eliminar',
                                    'tag' => 'a',
                                    'class' => 'btn btn-danger btn-xs'
                                ],
                                'url' => [
                                    'removemedpresentacion', 'id' => $pre->id
                                ]
                            ]); ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>


        </div>
    </div>
</div>