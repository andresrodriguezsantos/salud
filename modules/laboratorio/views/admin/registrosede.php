<?php

<<<<<<< HEAD
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

=======
use app\models\Departamento;
use app\models\Pais;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
>>>>>>> origin/master
/* @var $this yii\web\View */
/* @var $model app\models\laboratorio\labsede */
/* @var $form ActiveForm */
$this->title = Yii::t('site', 'Registered Office');
$this->params['breadcrumbs'][] = ['url' => ['registro'], 'label' => 'Registered Office'];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <i class="fa fa- glyphicon glyphicon-folder-open "></i>
            <h3 class="box-title">Registro de Sedes del Laboratorio</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?php echo Yii::$app->controller->renderPartial('form_registro_sede',[
                'labuser'=>$labuser,
                'sede'=>$sede
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
    'header' =>'<h3 class="text-danger">El usuario no se encuetra registrado</h3>',
    'id'=>'formularioincompletoregistrosede',
    'footer'=>Html::button('Close',['data-dismiss'=>'modal','class'=>'btn btn-success'])
]);
echo Alert::widget([
    'body'=>'<h4 style="color: #8EC4EC; text-align: center">Please check that the user is registred in our plataform</h4>',
    'closeButton'=>false
]);
Modal::end();


?>
<?php $this->registerJs("$.comprobar($('select[name=\"LabSede[idciudad]\"]'))") ?>
