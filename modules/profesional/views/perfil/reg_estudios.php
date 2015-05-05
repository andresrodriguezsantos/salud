<div class="col-md-6">
    <?php use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    $form = ActiveForm::begin(
        ['action' => ['registrartitulo']]
    ); ?>
    <?= $form->field($estudios, 'nombre') ?>
    <?= $form->field($estudios, 'universidad') ?>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-md-6">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nombre Titulo</th>
            <th>Universidad que otorga</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allestudios as $all): ?>
            <tr>
                <td><?= $all->nombre ?></td>
                <td><?= $all->universidad ?></td>
                <td>
                    <?= $this->render('@app/views/layouts/modals/delete', [
                        'btn' => [
                            'label' => '<i class="glyphicon glyphicon-remove "></i> Eliminar',
                            'tag' => 'a',
                            'class' => 'btn btn-danger btn-xs'
                        ],
                        'url' => [
                            'removeestudio', 'id' => $all->id
                        ]
                    ]); ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>