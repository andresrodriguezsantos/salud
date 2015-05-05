<?php
/**
 * @var $certificado \app\models\Certificado
 */
use yii\helpers\Html; ?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title"> Menu de Certificados disponibles</h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><?= Html::a('Resumen de Historia C.', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'historia'], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= Html::a('Asistencia a consulta', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'consulta'], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= Html::a('Incapacidad', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'incapacidad'], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= Html::a('Libre', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'libre'], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= Html::a('Solicitud Examenes', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'examen'], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= Html::a('Solic. Examen Especializado', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'examen especializado'], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= Html::a('Remision Espec. Medica', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'remision'], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= Html::a('Consen. Infor. Cuerpo Ext.', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'consentimientoinformado'], ['class' => 'menu-btn']) ?></li>
                    <li class="list-group-item"><?= Html::a('Consen. Infor. Ciclopegia', ['/optometria/certificados/consulta/', 'id' => Yii::$app->request->get('id'), 'tipo' => 'ciclopegia'], ['class' => 'menu-btn']) ?></li>
                </ul>
            </div>
            <div class="col-md-9">
                <?php $form = \yii\bootstrap\ActiveForm::begin([
                    'action' => ['certificados/pdf', 'id' => $historia->id],
                    'enableClientValidation' => false,
                    'enableClientScript' => false,
                    'options' => [
                        'target' => '_blank'
                    ]
                ]) ?>
                <?= $form->field($certificado, 'tipo', ['inputOptions' => ['value' => Yii::$app->request->get('tipo', 'consulta')]])->hiddenInput()->label(false) ?>
                <?php echo Yii::$app->controller->renderPartial($page, ['historia' => $historia, 'certificado' => $certificado, 'form' => $form]) ?>
                <?php
                echo Html::submitButton('<i class="fa glyphicon glyphicon-print"></i> Generar certificado', [
                    'class' => 'btn btn-info',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'generar el pdf'
                ]);
                ?>
                <?php $form->end() ?>
            </div>
        </div>
    </div>
</div>