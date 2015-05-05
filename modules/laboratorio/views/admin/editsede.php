<?php
/** @var $sede \app\models\laboratorio\LabSede */
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var \app\models\Usuario $user */
?>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title" style="text-align: center">Formulario para editar sedes</h3>
            </div>
            <div class="box-body" style="overflow: hidden">
                <h3>Datos del Usuario Actual</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Ciudad</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $usersede->nombres . ' ' . $usersede->apellidos ?></td>
                        <td><?= $usersede->email ?></td>
                        <td><?php echo ($usersede->ciudad)? $usersede->ciudad->nombre :'No Aplica';
                            ?></td>
                        <td><?= $usersede->direccion ?></td>
                        <td><?= $usersede->telefonocelular ?></td>
                    </tr>
                    </tbody>
                </table>
                <h3>Datos del Nuevo Usuario</h3>
                <?php echo Yii::$app->controller->renderPartial('form_registro_sede',[
                    'labuser' => $labuser,
                    'sede' => $sede
                ]) ?>
            </div>
        </div>
    </div>

<?php $this->registerJsFile(\yii\helpers\BaseUrl::home() .'js/global.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]);

$this->registerJsFile(\yii\helpers\BaseUrl::home() . 'js/eventos.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END
]);

Modal::begin([
    'header' =>'<h3 class="text-danger">El usuario no se encuentra registrado</h3>',
    'id'=>'formularioincompletoregistrosede',
    'footer'=>Html::button('Close',['data-dismiss'=>'modal','class'=>'btn btn-success'])
]);
echo Alert::widget([
    'body'=>'<h4 style="color: #8EC4EC; text-align: center">Por favor verifique que el usuario se encuentre registrado en nuestra plataforma</h4>',
    'closeButton'=>false
]);
Modal::end();


?>
<?php $this->registerJs("$.comprobar($('select[name=\"LabSede[idciudad]\"]'))") ?>
