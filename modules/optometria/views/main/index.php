<?php
/** @var $this \yii\web\View */
use kartik\popover\PopoverX;
use yii\bootstrap\ActiveForm;

/** @var $optometria app\models\optometria\Optometria */
/** @var $historia \app\models\Historia */
/** @var $agudezavisual \app\models\optometria\OptAgudezavisual */
/** @var $agudezavisualconcorreccion \app\models\optometria\OptAgudezavisualConcorreccion */
/** @var $agudezavisualconph \app\models\optometria\OptAgudezavisualConph */
/** @var $agudezavisualsincorreccion \app\models\optometria\OptAgudezavisualSincorreccion */
/** @var $rxenuso \app\models\optometria\OptRxenuso */
/** @var $cornea \app\models\optometria\OptCornea */
/** @var $corneaqueratometria \app\models\optometria\OptCorneaQueratometria */
/** @var $corneatopografia \app\models\optometria\OptCorneaTopografia */
/** @var $fondoscopia \app\models\optometria\OptFondoscopia */
/** @var $retinoscopia \app\models\optometria\OptRetinoscopia[] */
/** @var $modulomotor \app\models\optometria\OptModulooculomotor */
/** @var $moduloverduc \app\models\optometria\OptModuloVersionesducciones[] */
/** @var $moduloamplitud \app\models\optometria\OptModuloAmplitudFlexibilidad */
/** @var $covertest \app\models\optometria\OptCoverTest */
/** @var $examenexterno \app\models\optometria\OptExamenexterno */
/** @var $biomicroscopia \app\models\optometria\OptExamenexterno */
/** @var $diagnostico \app\models\optometria\OptDiagnostico[] */
$this->title = 'Nueva historia clinica';
$this->params['breadcrumbs'][] = ['url' => ['/optometria/main/list'], 'label' => 'Pacientes'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <div class="box box-default">
        <div class="box-header">
            <i class="glyphicon glyphicon-align-right"></i>

            <h3 class="box-title">HISTORIA CLÍNICA DE OPTOMETRÍA</h3>

            <div style="margin: 1%" class="text-info">
                / <span class="nombres"></span>
                / <span class="nacimiento"></span>
                / <span class="documento"></span>
                / <span class="email"></span>
                / <span class="telefono"></span>
            </div>

            <?= PopoverX::widget([
                'header' => 'Información',
                'size' => PopoverX::SIZE_LARGE,
                'type' => PopoverX::TYPE_INFO,
                'placement' => PopoverX::ALIGN_LEFT_TOP,
                'content' => 'Servicio de ayuda',
                'toggleButton' => ['label' => '<i class="glyphicon glyphicon-question-sign"></i> Ayuda',
                    'class' => 'btn btn-info btn-xs pull-right', 'style' => 'margin: 10px;']
            ]) ?>
        </div>
        <div class="box-body" style="overflow: hidden">
            <?php $form = ActiveForm::begin([
                'action' => ['procesaopt'],
                'enableAjaxValidation' => true,
                'options' => [
                    'enctype' => 'multipart/form-data'
                ],
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}",
                ]
            ]) ?>
            <?= \yii\bootstrap\Tabs::widget([
                'items' => [
                    [
                        'label' => 'Datos personales',
                        'content' => $this->render('opt_datospersonales', [
                            'optometria' => $optometria,
                            'historia' => $historia,
                            'form' => $form
                        ]),
                        'contentOptions' => ['class' => 'in']
                    ],
                    [
                        'label' => 'Detalles de consulta',
                        'content' => $this->render('opt_detconsulta', [
                            'optometria' => $optometria,
                            'historia' => $historia,
                            'form' => $form
                        ])
                    ],
                    [
                        'label' => 'Agudeza Visual',
                        'content' => $this->render('opt_agudezavisual', [
                            'agudezavisual' => $agudezavisual,
                            'agudezavisualconcorreccion' => $agudezavisualconcorreccion,
                            'agudezavisualconph' => $agudezavisualconph,
                            'agudezavisualsincorreccion' => $agudezavisualsincorreccion,
                            'form' => $form,
                            'optometria' => $optometria
                        ]),
                        'contentOptions' => ['class' => 'in']
                    ],
                    [
                        'label' => 'Rx en Uso',
                        'content' => $this->render('rxenuso', [
                            'rx' => $rxenuso,
                            'form' => $form
                        ])
                    ],
                    [
                        'label' => 'Cornea',
                        'content' => $this->render('opt_cornea', [
                            'cornea' => $cornea,
                            'corneaqueratometria' => $corneaqueratometria,
                            'corneatopografia' => $corneatopografia,
                            'form' => $form
                        ]),
                        'contentOptions' => ['class' => '']
                    ],
                    [
                        'label' => 'Fondoscopía (Oftalmoscopía)',
                        'content' => $this->render('opt_fondoscopia', [
                            'fondoscopia' => $fondoscopia,
                            'form' => $form
                        ]),
                        'contentOptions' => ['class' => '']
                    ],
                    [
                        'label' => 'Retinoscopía',
                        'content' => $this->render('opt_retinoscopia', [
                            'retinoscopia' => $retinoscopia,
                            'form' => $form
                        ]),
                        'contentOptions' => ['class' => '']
                    ],
                    [
                        'label' => 'Examen Motor',
                        'content' => $this->render('opt_examenmotor', [
                            'moduloverduc' => $moduloverduc,
                            'moduloamplitud' => $moduloamplitud,
                            'covertest' => $covertest,
                            'form' => $form
                        ]),
                        'contentOptions' => ['class' => '']
                    ],
                    [
                        'label' => 'Biomicroscopía',
                        'content' => $this->render('examenexterno/exbiomicroscopia', [
                            'model' => $biomicroscopia['biomicroscopia'],
                            'key' => 'biomicroscopia',
                            'form' => $form
                        ]),
                        'contentOptions' => ['class' => '']
                    ],
                    [
                        'label' => 'Examenes Externos',
                        'content' => $this->render('opt_examenexterno', [
                            'examenexterno' => $examenexterno,
                            'form' => $form
                        ]),
                        'contentOptions' => ['class' => '']
                    ],
                    [
                        'label' => 'Diagnóstico',
                        'content' => $this->render('opt_diagnostico', [
                            'diagnostico' => $diagnostico,
                            'form' => $form,
                            'button' => true,
                            'submit' => false
                        ]),
                        'contentOptions' => ['class' => '']
                    ],
                    [
                        'label' => 'Disposición y control',
                        'content' => $this->render('opt_disposicion', [
                            'optometria' => $optometria,
                            'form' => $form
                        ])
                    ]
                ]
            ]) ?>
            <?php \yii\bootstrap\Modal::begin([
                'header' => '<h5>Compleatar Acción ?</h5>',
                'toggleButton' => ['label' => 'Guardar historia clinica', 'class' => 'btn btn-primary'],
                'footer' => \yii\helpers\Html::submitButton('Guardar historia', ['class' => 'btn btn-primary']) .
                    \yii\helpers\Html::button('cancelar', ['class' => 'btn btn-warning', 'data-dismiss' => 'modal']),
                'size' => \yii\bootstrap\Modal::SIZE_LARGE
            ]) ?>
            <?= $form->errorSummary(\yii\helpers\ArrayHelper::merge([
                $optometria, $agudezavisualsincorreccion,
            ], $diagnostico)) ?>
            <div class="alert alert-warning">
                <i class="glyphicon glyphicon-ban-circle"></i>

                Esta seguro de guardar esta historia clinica una vez guardada es irreversible ?
            </div>
            <?php \yii\bootstrap\Modal::end() ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>

<?php $this->registerJsFile('@web/js/opt.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END,
]) ?>
