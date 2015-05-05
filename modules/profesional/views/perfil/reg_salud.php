<?php
use app\models\EpsCosultorio;
use app\models\Profesion;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<div class="col-md-4">
    <?php
    $form = ActiveForm::begin(
        ['action' => ['update', 'id' => $eps->id]]
    ); ?>
    <label for="">Profesión</label>
    <?= Html::activeDropDownList($eps, 'idprofesion',
        ArrayHelper::merge(['' => 'Seleccione'], ArrayHelper::map(Profesion::find()
            ->orderBy('descripcion')->all(), 'id', 'descripcion')),
        $options = ['class' => 'form-control', 'value' => $eps->idprofesion])
    ?>
    <label for="">Entidad en la que labora</label>
    <?= Html::activeDropDownList($eps, 'id_eps',
        ArrayHelper::merge(['' => 'Seleccione'], ArrayHelper::map(EpsCosultorio::find()
            ->where(['idciudad' => $ciudad])
            ->orderBy('nombre')->all(), 'id', 'nombre')),
        $options = ['class' => 'form-control', 'value' => $eps->id_eps])
    ?>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class=" col-md-8">
    <label for="">Lugar donde Ejerce la Profesion</label>
    <table class="table table-striped table-bordered">
        <thead>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Ciudad</th>
        <th>Especialidad</th>
        <th>Opciones</th>
        </thead>
        <?php /** @var $dd ProfesionalEps */ ?>

        <?php foreach ($prof_eps as $dd): ?>
            <?php $dd->getEps()->one() ?>
            <tr>
                <td>
                    <?= $dd->eps->nombre ?>
                </td>
                <td>
                    <?= $dd->eps->direccion ?>
                </td>
                <td>
                    <?php $dd->eps->getCiudad()->one() ?>
                    <?= $dd->eps->ciudad->nombre ?>
                </td>
                <td><?= $dd->getprofesion()->descripcion ?> </td>
                <td>
                    <?= Html::a('<i class="glyphicon glyphicon-edit"></i>', ['index', 'id' => $dd->id]) ?>
                    <?= $this->render('@app/views/layouts/modals/delete', [
                        'btn' => [
                            'label' => '<i class="glyphicon glyphicon-remove "></i>',
                            'tag' => 'a'
                        ],
                        'url' => [
                            'delete', 'id' => $dd->id
                        ]

                    ]); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>