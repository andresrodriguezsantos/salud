<?php
/** @var $this \yii\web\View */
use app\shelper\OptometriaHel;
use yii\helpers\Html;

/** @var $optometria \app\models\optometria\Optometria */
$this->title = 'Optometría id - ' . $optometria->id;
?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <i class="glyphicon glyphicon-eye-open"></i>

            <h3 class="box-title">Historia clinica de Optometría
                <small class="text-info">
                    /
                    Paciente: <?= $optometria->historia->paciente->usuario->nombres . ' ' . $optometria->historia->paciente->usuario->apellidos ?></small>
            </h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <div class="col-md-6">
                <h4 class="text-info">Detalles del Paciente</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Nombre : </strong>
                        <span class="text-info pull-right"><?= $optometria->historia->paciente->usuario->nombres .
                            ' ' . $optometria->historia->paciente->usuario->apellidos ?></span>
                    </li>
                    <li class="list-group-item">
                        <strong>Documento :</strong>
                        <span
                            class="text-info pull-right"><?= $optometria->historia->paciente->usuario->cedula ?></span>
                    </li>
                    <li class="list-group-item">
                        <strong>Entidad :</strong>
                        <span class="text-info pull-right">
                            <?php
                            /** @var \app\models\AfiliadoEps $entidad */
                            $entidad = $optometria->historia->paciente
                                ->getAfiliadoEps()->orderBy(['id' => 'desc'])->one();
                            if ($entidad == null) {
                                echo 'No Registado!';
                            } else
                                echo $entidad->epsCosultorio->nombre
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <strong>Dirección</strong>
                        <span class="text-info pull-right">
                            <?= $optometria->historia->paciente->usuario->direccion ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <strong>Telefono</strong>
                        <span class="text-info pull-right">
                            <?= $optometria->historia->paciente->usuario->telefonocelular ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <strong>Correo</strong>
                        <span class="text-info pull-right">
                            <?= $optometria->historia->paciente->usuario->email ?>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <h4 class="text-info">Detalles de la Consulta</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Motivo de Consulta</strong>
                        <span><?= Html::encode($optometria->motivoconsulta) ?></span>
                    </li>
                    <li class="list-group-item">
                        <strong>Antecedentes Familiare</strong>
                        <span>
                            <?= Html::encode($optometria->antecedentefamiliar) ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <strong>Antecedentes Personales</strong>
                        <span>
                            <?= Html::encode($optometria->antecedentepersonal) ?>
                        </span>

                    </li>
                    <li class="list-group-item">
                        <strong>Diagnóstico(s)</strong>
                        <?php
                        /** @var \app\models\optometria\OptDiagnostico[] $diagnosticos */
                        $diagnosticos = $optometria->getOptDiagnostico()->orderBy('ojo asc')->all();
                        foreach ($diagnosticos as $diagnostico):
                            ?>
                            <p>
                                <strong><?= $diagnostico->ojo ?>:</strong>
                                <?= $diagnostico->nominacion ?>
                                <br/>
                                <strong>CIE-10: </strong> <?= $diagnostico->codigoCIE->codigo ?>
                            </p>
                        <?php endforeach; ?>
                    </li>
                    <li class="list-group-item">
                        <p><strong>Disposición : </strong><?= \yii\helpers\Html::encode($optometria->disposicion) ?></p>

                        <p><strong>Proxímo Control :</strong> <?= \yii\helpers\Html::encode($optometria->proxcontrol) ?>
                        </p>

                    </li>
                </ul>
            </div>
            <div class="col-lg-12">
                <?php $collapse = \yii\bootstrap\Tabs::begin(['encodeLabels' => false]) ?>
                <?php $collapse->items = [
                    [
                        'label' => 'Agudeza Visual',
                        'content' => \yii\bootstrap\Tabs::widget([
                            'items' => [
                                [
                                    'label' => 'Agudeza Visual Sin Corrección',
                                    'content' => $this->render('agudezavisual/view', [
                                        'model' => $optometria->optAgudezavisual->optAgudezavisualSincorreccion,
                                        'optometria' => $optometria
                                    ])
                                ],
                                [
                                    'label' => 'Agudeza Visual Con Correción',
                                    'content' => $this->render('agudezavisual/view', [
                                        'model' => OptometriaHel::CAgConCorreccion($optometria),
                                        'optometria' => $optometria
                                    ])
                                ],
                                [
                                    'label' => 'Agudeza Visual Con Pin Hole',
                                    'content' => $this->render('agudezavisual/view', [
                                        'model' => OptometriaHel::CAgConPh($optometria),
                                        'optometria' => $optometria
                                    ])
                                ],

                            ]
                        ]),
                        'contentOptions' => ['class' => 'in']
                    ],
                ];
                ?>
                <?php if ($optometria->optRxenuso) {
                    $collapse->items[] = [
                        'label' => 'RX en Uso' /*. ((!OptometriaHel::CRxEnUso($optometria, true)) ?
                        Html::a('Agregar Valores', ['add', 'id' => $optometria->id, 'model' => 'rxenuso'], ['class' => 'label label-info pull-right'])
                        : '')*/,
                        'content' => $this->render('agudezavisual/v_rxenuso', ['model' => OptometriaHel::CRxEnUso($optometria)])
                    ];
                } ?>
                <?php
                if (OptometriaHel::CCorneaTopografia($optometria, true) or OptometriaHel::CCorneaQueratometria($optometria, true)):
                    $collapse->items[] = [
                        'label' => 'Cornea' /*. ((
                        !OptometriaHel::CCorneaTopografia($optometria, true) or
                        !OptometriaHel::CCorneaQueratometria($optometria, true)
                    ) ? Html::a('Agregar valores',
                        ['add', 'id' => $optometria->id, 'model' => 'cornea'],
                        ['class' => 'label label-info pull-right']) : '')*/,
                        'content' => \yii\bootstrap\Tabs::widget([
                            'items' => [
                                [
                                    'label' => 'Queratometría',
                                    'content' => $this->render('cornea/v_queratometria', [
                                        'model' => OptometriaHel::CCorneaQueratometria($optometria),
                                        'optometria' => $optometria
                                    ])
                                ],
                                [
                                    'label' => 'Topografía',
                                    'content' => $this->render('cornea/v_topografia', [
                                        'model' => OptometriaHel::CCorneaTopografia($optometria),
                                        'optometria' => $optometria
                                    ])
                                ]
                            ]
                        ])
                    ];
                endif;
                ?>

                <?php if ($optometria->optFondoscopia) {
                    $collapse->items[] = [
                        'label' => 'Fondoscopía (Oftalmoscopía)' /*. (!OptometriaHel::CFondoscopia($optometria, true) ?
                        Html::a('Agregar Valores',
                            ['add', 'id' => $optometria->id, 'model' => 'fondoscopia'],
                            ['class' => 'label label-info pull-right']) : '')*/,
                        'content' => $this->render('v_fondoscopia', [
                            'model' => OptometriaHel::CFondoscopia($optometria)
                        ])
                    ];
                } ?>
                <?php if ($optometria->optRetinoscopias) {
                    $collapse->items[] = [
                        'label' => 'Retinoscopia',
                        'content' => $this->render('v_retinoscopia', [
                            'optometria' => $optometria
                        ])
                    ];
                } ?>
                <?php
                if (OptometriaHel::CMotorAmFl($optometria, true) or OptometriaHel::CMotorVerDuc($optometria, true)):
                    $collapse->items[] = [
                        'label' => 'Examen Motor',
                        'content' => \yii\bootstrap\Tabs::widget([
                            'items' => [
                                [
                                    'label' => 'Cover test - PPC',
                                    'content' => $this->render('motor/v_motorcp', [
                                        'model' => OptometriaHel::CMotorAmFl($optometria),
                                        'optometria' => $optometria
                                    ])
                                ],
                                [
                                    'label' => 'Versiones - Ducciones',
                                    'content' => $this->render('motor/v_motorvd', [
                                        'models' => OptometriaHel::CMotorVerDuc($optometria),
                                        'optometria' => $optometria
                                    ])
                                ]
                            ]
                        ])
                    ];
                endif
                ?>

                <?php if ($optometria->optExamenexterno) {
                    $collapse->items[] = [
                        'label' => 'Examen Externo',
                        'content' => $this->render('v_examenes', [
                            'optometria' => $optometria
                        ])
                    ];
                } ?>
                <?php
                if (empty($optometria->disposicion) or empty($optometria->proxcontrol)) {
                    $collapse->items[] = [
                        'label' => 'Disposición',
                        'content' => $this->render('v_disposicion', [
                            'optometria' => $optometria
                        ])

                    ];
                }
                ?>
                <?php $collapse->end(); ?>
                <div class="btn-group pull-right" role="group">
                    <?= Html::a('Remitir', ['certificados/remitir', 'id' => $optometria->historia_id], ['class' => 'btn btn-info', 'role' => 'group']) ?>
                    <?= Html::a('Examenes', ['certificados/examen', 'id' => $optometria->historia_id], ['class' => 'btn btn-info', 'role' => 'group']) ?>
                    <?= Html::a('Prescribir Medicamento', ['/medicamento/admin/prescripcionmedica/', 'id' => $optometria->historia_id], ['class' => 'btn btn-info', 'role' => 'group']) ?>
                    <?= Html::a('Expedir Certificado', ['certificados/index/', 'id' => $optometria->historia_id], ['class' => 'btn btn-info', 'role' => 'group']) ?>
                    <?= Html::a('Prescribir anteojos', ['certificados/prescribiranteojos/', 'id' => $optometria->historia_id], ['class' => 'btn btn-info', 'role' => 'group']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
