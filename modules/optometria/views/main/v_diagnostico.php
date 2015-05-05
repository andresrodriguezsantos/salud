<?php
/** @var $optometria \app\models\optometria\Optometria */
/** @var $this \yii\web\View */
use yii\helpers\Html;

$diagnostico = [new \app\models\optometria\OptDiagnostico()];

?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $tabs = \yii\bootstrap\Tabs::begin() ?>
            <?php foreach ($optometria->optDiagnostico as $key => $model): ?>
                <?php $tabs->items[] = [
                    'label' => 'Diagnóstico - ' . ($key + 1),
                    'content' =>
                        Html::beginTag('div') .
                        Html::tag('h4', $model->getAttributeLabel('nominacion')) .
                        Html::tag('p', $model->codigoCIE->codigo) .
                        Html::tag('p', $model->codigoCIE->definicionprofesional) .
                        Html::endTag('div')
                ] ?>
            <?php endforeach; ?>

            <?php $tabs->items[] = [
                'label' => 'Agregar Diagnóstico',
                'content' => Yii::$app->controller->renderPartial('opt_diagnostico', [
                    'diagnostico' => [new \app\models\optometria\OptDiagnostico()],
                    'button' => true,
                    'submit' => true,
                    'form' => new \yii\widgets\ActiveForm([
                        'action' => ['addmodel', 'id' => $optometria->id],
                        'enableAjaxValidation' => true
                    ])
                ])
            ] ?>
            <?php $tabs->end() ?>
        </div>
    </div>
<?php $this->registerJsFile('@web/js/opt.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END,
]) ?>