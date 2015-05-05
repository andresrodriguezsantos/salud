<?php
/* @var array $btn */
/* @var array $url */
/** @var \app\models\medicamento\Medicamento $model */
use yii\bootstrap\Modal;
use yii\helpers\Html;

Modal::begin([
    'header' => '<h3 style="color: #8EC4EC">Informacion general del medicamento</h3>',
    'toggleButton' => $btn,
    'footer' => Html::button('cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-default'])
]); ?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>TAARJETA DE ADMISION</th>
            <th>INFORMACION</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>Area</th>
            <td><?= $model->idareasalud ?></td>
        </tr>
        <tr>
            <th>Nombre Comercial</th>
            <td><?= $model->nombrecomercial ?></td>
        </tr>
        <tr>
            <th>Composicion</th>
            <td><?= $model->composicion ?></td>
        </tr>
        <tr>
            <th>Tipo terapeutico</th>
            <td><?= $model->subtipoterapeutico->tipoterapeutico->nombre ?></td>
        </tr>
        <tr>
            <th>Subtipo terapeutico</th>
            <td><?= $model->subtipoterapeutico->nombre ?></td>
        </tr>
        <tr>
            <th>Presentacion</th>
            <td>
                <?php /** @var \app\models\medicamento\MedPreMed $medpre */
                foreach ($model->presentaciones as $medpre):?>
                    <?= $medpre->presentacion->nombre ?>,
                <?php endforeach ?>
            </td>
        </tr>
        <tr>
            <th>Descripcion</th>
            <td><?= $model->descripcion ?></td>
        </tr>
        </tbody>
    </table>
<?php
Modal::end();