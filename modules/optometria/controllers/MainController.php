<?php
/**
 * @since 1.0.0
 */
namespace app\modules\optometria\controllers;

use app\models\AfiliadoEps;
use app\models\EpsCosultorio;
use app\models\Historia;
use app\models\optometria\OptAgudezavisual;
use app\models\optometria\OptAgudezavisualConcorreccion;
use app\models\optometria\OptAgudezavisualConph;
use app\models\optometria\OptAgudezavisualSincorreccion;
use app\models\optometria\OptControl;
use app\models\optometria\OptCornea;
use app\models\optometria\OptCorneaQueratometria;
use app\models\optometria\OptCorneaTopografia;
use app\models\optometria\OptCoverTest;
use app\models\optometria\OptDiagnostico;
use app\models\optometria\OptExamenexterno;
use app\models\optometria\OptFondoscopia;
use app\models\optometria\OptModuloAmplitudFlexibilidad;
use app\models\optometria\OptModulooculomotor;
use app\models\optometria\OptModuloVersionesducciones;
use app\models\optometria\Optometria;
use app\models\optometria\OptRetinoscopia;
use app\models\optometria\OptRxenuso;
use app\models\Paciente;
use app\models\search\SearchOptometria;
use app\models\search\SearchPaciente;
use app\models\Usuario;
use app\shelper\OptometriaHel;
use app\shelper\Util;
use Yii;
use yii\base\Model;
use yii\bootstrap\ActiveForm;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use yii\web\UploadedFile;

class MainController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index', 'list', 'procesaopt', 'view', 'add',
                            'addcornea', 'addretinoscopia', 'addfondoscopia',
                            'addmotor', 'addexamenexterno', 'addmodel',
                            'finpac', 'newdiagnostico', 'Addagudezavisual',
                            'addagudezavisual', 'addrxenuso', 'test', 'addcontrol'
                        ],
                        'allow' => true,
                        'roles' => ['Optometra']
                    ],
                    [
                        'actions'=>['addcontrol'],
                        'allow'=>true,
                        'roles'=>'paciente'
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $historia = new Historia();
        $optometria = new Optometria();

        $agudezavisual = new OptAgudezavisual();
        $agudezavisualconcorreccion = new OptAgudezavisualConcorreccion([
            'vl_derecho_snellen'=>'20/20',
            'vl_derecho_logmar'=>'0.0',
            'vl_izquierdo_snellen'=>'20/20',
            'vl_izquierdo_logmar'=>'0.0',
            'vl_ambos_snellen'=>'20/20',
            'vl_ambos_logmar'=>'0.0'
        ]);
        $agudezavisualconph = new OptAgudezavisualConph([
            'vl_derecho_snellen'=>'20/20',
            'vl_derecho_logmar'=>'0.0',
            'vl_izquierdo_snellen'=>'20/20',
            'vl_izquierdo_logmar'=>'0.0',
            'vl_ambos_snellen'=>'20/20',
            'vl_ambos_logmar'=>'0.0'
        ]);
        $agudezavisualsincorreccion = new OptAgudezavisualSincorreccion([
            'vl_derecho_snellen'=>'20/20',
            'vl_derecho_logmar'=>'0.0',
            'vl_izquierdo_snellen'=>'20/20',
            'vl_izquierdo_logmar'=>'0.0',
            'vl_ambos_snellen'=>'20/20',
            'vl_ambos_logmar'=>'0.0'
        ]);

        $rxenuso = new OptRxenuso();

        $cornea = new OptCornea();
        $corneaqueratometria = new OptCorneaQueratometria();
        $corneatopografia = new OptCorneaTopografia();

        $fondoscopia = new OptFondoscopia();

        $retinoscopia = [
            'estatica' => new OptRetinoscopia(),
            'dinamica' => new OptRetinoscopia(),
            'ciclopegia' => new OptRetinoscopia(),
            'otra' => new OptRetinoscopia()
        ];

        $modulomotor = new OptModulooculomotor();
        $moduloverduc = [
            'versiones' => new OptModuloVersionesducciones(),
            'ducciones' => new OptModuloVersionesducciones()
        ];
        $moduloamplitud = new OptModuloAmplitudFlexibilidad();
        $covertest = new OptCoverTest();

        $biomicroscopia = [
            'biomicroscopía' => new OptExamenexterno(),
        ];

        $examenexterno = [
            'fondo de ojo' => new OptExamenexterno(),
            'complementario' => new OptExamenexterno(),
        ];
        $diagnostico = [
            new OptDiagnostico(['ojo' => 'Ojo Derecho', 'scenario' => 'create','codigoCIE_id'=>1]),
            new OptDiagnostico(['ojo' => 'Ojo izquierdo', 'scenario' => 'create','codigoCIE_id'=>1]),
        ];

        return $this->render('index', [
            'optometria' => $optometria,
            'historia' => $historia,
            'agudezavisual' => $agudezavisual,
            'agudezavisualconcorreccion' => $agudezavisualconcorreccion,
            'agudezavisualconph' => $agudezavisualconph,
            'agudezavisualsincorreccion' => $agudezavisualsincorreccion,
            'rxenuso' => $rxenuso,
            'cornea' => $cornea,
            'corneaqueratometria' => $corneaqueratometria,
            'corneatopografia' => $corneatopografia,
            'fondoscopia' => $fondoscopia,
            'retinoscopia' => $retinoscopia,
            'modulomotor' => $modulomotor,
            'moduloverduc' => $moduloverduc,
            'moduloamplitud' => $moduloamplitud,
            'covertest' => $covertest,
            'examenexterno' => $examenexterno,
            'biomicroscopia' => $biomicroscopia,
            'diagnostico' => $diagnostico,
        ]);
    }

    public function actionProcesaopt()
    {
        $historia = new Historia();
        $optometria = new Optometria();

        $agudezavisual = new OptAgudezavisual();
        $agudezavisualconcorreccion = new OptAgudezavisualConcorreccion();
        $agudezavisualconph = new OptAgudezavisualConph();

        $agudezavisualsincorreccion = new OptAgudezavisualSincorreccion();

        $rxenuso = new OptRxenuso();

        $cornea = new OptCornea();
        $corneaqueratometria = new OptCorneaQueratometria();
        $corneatopografia = new OptCorneaTopografia();

        $fondoscopia = new OptFondoscopia();

        $retinoscopia = [
            'estatica' => new OptRetinoscopia(),
            'dinamica' => new OptRetinoscopia(),
            'ciclopegia' => new OptRetinoscopia(),
            'otra' => new OptRetinoscopia()
        ];

        $modulomotor = new OptModulooculomotor();
        $moduloverduc = [
            'versiones' => new OptModuloVersionesducciones(),
            'ducciones' => new OptModuloVersionesducciones()
        ];
        $moduloamplitud = new OptModuloAmplitudFlexibilidad();
        $covertest = new OptCoverTest();

        $examenexterno = [
            'fondo de ojo' => new OptExamenexterno(),
            'biomicroscopía' => new OptExamenexterno(),
            'complementario' => new OptExamenexterno(),
        ];
        if (Yii::$app->request->isPost) {
            $historia->load(Yii::$app->request->post());
            $optometria->load(Yii::$app->request->post());

            $agudezavisualconph->load(Yii::$app->request->post());
            $agudezavisualconcorreccion->load(Yii::$app->request->post());
            $agudezavisualsincorreccion->load(Yii::$app->request->post());
            $rxenuso->load(Yii::$app->request->post());

            $corneaqueratometria->load(Yii::$app->request->post());
            $corneatopografia->load(Yii::$app->request->post());
            $fondoscopia->load(Yii::$app->request->post());
            $moduloamplitud->load(Yii::$app->request->post());
            $covertest->load(Yii::$app->request->post($covertest->formName()));
            $diagnostico = [];
            $num = count(Yii::$app->request->post('OptDiagnostico'));
            for ($i = 0; $i < $num; $i++) {
                $diagnostico[] = new OptDiagnostico(['scenario' => 'create']);
            }
            $models = ArrayHelper::merge($retinoscopia, $diagnostico, $examenexterno, $moduloverduc);
            Model::loadMultiple($retinoscopia, Yii::$app->request->post());
            Model::loadMultiple($diagnostico, Yii::$app->request->post());
            Model::loadMultiple($examenexterno, Yii::$app->request->post());
            Model::loadMultiple($moduloverduc, Yii::$app->request->post());
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple(
                    [$historia, $optometria, $corneatopografia]
                );
            }
            $historia->fecha = date('Y-m-d h:i:s');
            $historia->model = Optometria::className();
            /** @var Usuario $usuario */
            $usuario = Yii::$app->user->identity;
            $historia->profesional_id = $usuario->profesional->id;
            if ($historia->save()) {
                Yii::$app->session->setFlash('success', 'historia Creada');
                $optometria->historia_id = $historia->id;
                $optometria->estado = 0;
                $optometria->tipo = 'algo';
                $optometria->save();
                $agudezavisual->optometria_id = $optometria->id;
                $agudezavisual->save();

                $agudezavisualconcorreccion->opt_agudezavisual_id = $agudezavisual->id;
                $agudezavisualconph->opt_agudezavisual_id = $agudezavisual->id;
                $agudezavisualsincorreccion->opt_agudezavisual_id = $agudezavisual->id;
                $agudezavisualsincorreccion->save();
                $agudezavisualconcorreccion->save();
                $agudezavisualconph->save();
                $rxenuso->optometria_id = $optometria->id;
                $rxenuso->save();
                //detalles de la cornea
                $cornea->optometria_id = $optometria->id;
                $corneatopografia->odphoto = UploadedFile::getInstance($corneatopografia, 'odphoto');
                $corneatopografia->oiphoto = UploadedFile::getInstance($corneatopografia, 'oiphoto');
                if ($corneatopografia->odphoto) {
                    $corneatopografia->odurlimg = 'uploads/opt/topografia/'
                        . rand(0, 99999999) . '.' . $corneatopografia->odphoto->extension;
                }
                if ($corneatopografia->oiphoto) {
                    $corneatopografia->oiurlimg = 'uploads/opt/topografia/'
                        . rand(0, 99999999) . '.' . $corneatopografia->oiphoto->extension;
                }
                $cornea->save();
                $corneatopografia->idcornea = $cornea->id;
                if ($corneatopografia->save()) {
                    if ($corneatopografia->odphoto) {
                        $corneatopografia->odphoto->saveAs($corneatopografia->odurlimg);
                    }
                    if ($corneatopografia->oiphoto) {
                        $corneatopografia->oiphoto->saveAs($corneatopografia->oiurlimg);
                    }
                }

                if ($corneaqueratometria->validate()) {
                    $cornea->save();
                    $corneaqueratometria->hc_cornea_id = $cornea->id;
                    $corneaqueratometria->save();
                }
                //--------------------------------
                //detalles de fondoscopia
                $fondoscopia->idoptometria = $optometria->id;
                $fondoscopia->odphoto = UploadedFile::getInstance($fondoscopia, 'odphoto');
                $fondoscopia->oiphoto = UploadedFile::getInstance($fondoscopia, 'oiphoto');
                if ($fondoscopia->odphoto)
                    $fondoscopia->odurlimg = 'uploads/opt/fondoscopia/' . rand(0, 99999999) . '.' . $fondoscopia->odphoto->extension;
                if ($fondoscopia->oiphoto)
                    $fondoscopia->oiurlimg = 'uploads/opt/fondoscopia/' . rand(0, 99999999) . '.' . $fondoscopia->oiphoto->extension;
                if ($fondoscopia->save()) {
                    if ($fondoscopia->odphoto)
                        $fondoscopia->odphoto->saveAs($fondoscopia->odurlimg);
                    if ($fondoscopia->oiphoto)
                        $fondoscopia->oiphoto->saveAs($fondoscopia->oiurlimg);
                }
                //--------------------------------
                //detalles de retinoscopia
                /** @var OptRetinoscopia $model */
                foreach ($retinoscopia as $key => $model) {
                    $model->tipo = $key;
                    $model->optometria_id = $optometria->id;
                    $model->save();
                }
                //--------------------------------
                //detalles del modulo oculomotor
                $modulomotor->optometria_id = $optometria->id;
                $moduloamplitud->covertest = $covertest->getJson();
                if ($moduloamplitud->validate() and $covertest->validate()) {
                    $modulomotor->save();
                    $moduloamplitud->idmodulooculomotor = $modulomotor->id;
                    $moduloamplitud->save();
                }
                /** @var OptModuloVersionesducciones $model */
                foreach ($moduloverduc as $key => $model) {
                    $model->photo = UploadedFile::getInstance($model, "[$key]photo");
                    if ($model->photo)
                        $model->urlimg = 'uploads/opt/verduc/' . rand(0, 99999999) . '.' . $model->photo->extension;
                    $model->tipo = $key;
                    $modulomotor->save();
                    $model->idmodulooculomotor = $modulomotor->id;
                    if ($model->save()) {
                        if ($model->photo)
                            $model->photo->saveAs($model->urlimg);
                    }
                }
                //--------------------------------
                /** @var OptExamenexterno $model */
                foreach ($examenexterno as $key => $model) {
                    $model->odphoto = UploadedFile::getInstance($model, "[$key]odphoto");
                    $model->oiphoto = UploadedFile::getInstance($model, "[$key]oiphoto");
                    if ($model->odphoto)
                        $model->odurlimg = 'uploads/opt/examenes/' . rand(0, 99999999) . '.' . $model->odphoto->extension;
                    if ($model->oiphoto)
                        $model->oiurlimg = 'uploads/opt/examenes/' . rand(0, 99999999) . '.' . $model->oiphoto->extension;
                    $model->tipo = $key;
                    $model->id_optometria = $optometria->id;
                    if ($model->save()) {
                        if ($model->odphoto)
                            $model->odphoto->saveAs($model->odurlimg);
                        if ($model->oiphoto)
                            $model->oiphoto->saveAs($model->oiurlimg);
                    }
                }
                /** @var OptDiagnostico $model */
                foreach ($diagnostico as $key => $model) {
                    $model->optometria_id = $optometria->id;
                    $model->save();
                }
            }
            return $this->redirect(['view','id'=>$optometria->id]);
        }
    }

    public function actionAdd($id, $model)
    {
        $optometria = $this->check($id);
        if ($optometria != null) {
            if ($model == 'rxenuso') {
                if (!OptometriaHel::CRxEnUso($optometria, true)) {
                    return $this->render('p_form', [
                        'model' => $model,
                        'vista' => 'rxenuso',
                        'array' => [
                            'rx' => OptometriaHel::CRxEnUso($optometria)
                        ],
                        'optometria' => $optometria
                    ]);
                }
            }
            if ($model == 'agudezavisual') {
                if (!OptometriaHel::CAgConCorreccion($optometria, true) or !OptometriaHel::CAgConPh($optometria, true)) {
                    return $this->render('p_form', [
                        'model' => $model,
                        'vista' => 'opt_agudezavisual',
                        'array' => [
                            'agudezavisualconph' => OptometriaHel::CAgConPh($optometria),
                            'agudezavisualconcorreccion' => OptometriaHel::CAgConCorreccion($optometria),
                            'agudezavisualsincorreccion' => $optometria->optAgudezavisual->optAgudezavisualSincorreccion,
                            'optometria' => $optometria
                        ],
                        'optometria' => $optometria
                    ]);
                } else {
                    Yii::$app->session->setFlash('info', 'Todos los valore ya han sido agregados');
                    return $this->redirect(['view', 'id' => $optometria->id]);
                }
            }
            if ($model == 'cornea') {
                if (!OptometriaHel::CCorneaQueratometria($optometria, true) ||
                    !OptometriaHel::CCorneaTopografia($optometria, true)
                ) {
                    $corneaqueratometria = OptometriaHel::CCorneaQueratometria($optometria);
                    $corneatopografia = OptometriaHel::CCorneaTopografia($optometria);
                    //$corneaqueratometria->scenario = 'create'; $corneatopografia->scenario = 'create';
                    $cornea = new OptCornea();

                    return $this->render('p_form', [
                        'model' => $model,
                        'vista' => 'opt_cornea',
                        'array' => [
                            'cornea' => $cornea,
                            'corneaqueratometria' => $corneaqueratometria,
                            'corneatopografia' => $corneatopografia
                        ],
                        'optometria' => $optometria
                    ]);
                } else {
                    Yii::$app->session->setFlash('info', 'EStos datos ya han sido Registrados');
                    return $this->redirect(['view', 'id' => $optometria->id]);
                }
            }
            if ($model == 'fondoscopia') {
                if (!OptometriaHel::CFondoscopia($optometria, true)) {
                    return $this->render('p_form', [
                        'model' => $model,
                        'optometria' => $optometria,
                        'vista' => 'opt_fondoscopia',
                        'array' => [
                            'fondoscopia' => new OptFondoscopia([
                                'scenario' => 'create',
                            ])
                        ]
                    ]);
                } else {
                    Yii::$app->session->setFlash('warning', 'ya tiene fondoscopia registrada');
                    $this->redirect(['view', 'id' => $optometria->id]);
                }

            }
            if ($model == 'retinoscopia') {
                if (!OptometriaHel::CRetinoscopiaTipo($optometria, Yii::$app->request->post('tipo'), true)) {
                    return $this->render('p_form', [
                        'model' => $model,
                        'optometria' => $optometria,
                        'vista' => 'retinoscopia/retinoscopia',
                        'array' => [
                            'model' => [
                                new OptRetinoscopia([
                                    'scenario' => 'create',
                                    'tipo' => Yii::$app->request->post('tipo')
                                ])
                            ],
                            'key' => 0
                        ]
                    ]);
                } else {
                    Yii::$app->session->setFlash('warning', 'ya tiene Retinoscopia con ' .
                        Yii::$app->request->post('tipo') . ' registrada');
                    return $this->redirect(['view', 'id' => $optometria->id]);
                }
            }
            if ($model == 'motor') {
                $moduloverduc = OptometriaHel::CMotorVerDuc($optometria);
                $moduloample = OptometriaHel::CMotorAmFl($optometria);
                $covertest = new OptCoverTest();
                if (!$moduloample->isNewRecord) {
                    $covertest->parseJson($moduloample->covertest);
                }
                if (empty($moduloverduc)) {
                    $moduloverduc = [
                        'versiones' => new OptModuloVersionesducciones(),
                        'ducciones' => new OptModuloVersionesducciones()
                    ];
                } else {
                    foreach ($moduloverduc as $key => $models) {
                        $moduloverduc[$models->tipo] = $moduloverduc[$key];
                        unset($moduloverduc[$key]);
                    }
                    if (!ArrayHelper::keyExists('versiones', $moduloverduc)) {
                        $moduloverduc['versiones'] = new OptModuloVersionesducciones();
                    }
                    if (!ArrayHelper::keyExists('ducciones', $moduloverduc)) {
                        $moduloverduc['ducciones'] = new OptModuloVersionesducciones();
                    }
                }
                if (!OptometriaHel::CMotorAmFl($optometria, true) || !OptometriaHel::CMotorVerDuc($optometria, true)) {
                    return $this->render('p_form', [
                        'model' => $model,
                        'optometria' => $optometria,
                        'vista' => 'opt_examenmotor',
                        'array' => [
                            'moduloverduc' => $moduloverduc,
                            'moduloamplitud' => $moduloample,
                            'covertest' => $covertest,
                        ]
                    ]);
                } else {
                    Yii::$app->session->setFlash('warning', 'ya se han registrado todos los valores');
                    return $this->redirect(['view', 'id' => $optometria->id]);
                }
            }
            if ($model === 'examenexterno') {
                $examenes = $optometria->optExamenexterno;
                foreach ($examenes as $model) {
                    if ($model->tipo == Yii::$app->request->post('tipo')) {
                        Yii::$app->session->setFlash('danger', 'El tipo de examen externo ' . $model->tipo . ' ya se ha registrado registre otro nombre');
                        $this->redirect(['view', 'id' => $optometria->id]);
                    }
                }
                $examen = new OptExamenexterno(['tipo' => Yii::$app->request->post('tipo'), 'scenario' => 'create']);
                return $this->render('p_form', [
                    'model' => $model,
                    'optometria' => $optometria,
                    'vista' => 'examenexterno/single_examen',
                    'array' => [
                        'model' => $examen,
                        'layout' => 'col-md-12',
                    ]
                ]);
            }
        } else
            throw new HttpException(404, 'pagina no encontrada');
        return false;
    }

    public function actionAddrxenuso($id)
    {
        $optometria = $this->check($id);
        if (!OptometriaHel::CRxEnUso($optometria, true)) {
            $rxenuso = OptometriaHel::CRxEnUso($optometria);
            $rxenuso->optometria_id = $optometria->id;
            if (Yii::$app->request->isAjax) {
                $rxenuso->load(Yii::$app->request->post());
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($rxenuso);
            }
            if (Yii::$app->request->isPost) {
                $rxenuso->load(Yii::$app->request->post());
                if ($rxenuso->save()) {
                    Yii::$app->session->setFlash('success', 'Datos de Rx en uso agregados correctamente');
                    return $this->redirect(['view', 'id' => $optometria->id]);
                }
            }
            return $this->render('p_form', [
                'model' => 'rxenuso',
                'vista' => 'rxenuso',
                'array' => [
                    'rx' => $rxenuso
                ],
                'optometria' => $optometria
            ]);
        }
        Yii::$app->session->setFlash('info', 'valores de Rx en uso ya fueron agregados');
        return $this->redirect(['vies', 'id' => $optometria->id]);
    }

    public function actionAddagudezavisual($id)
    {
        $optometria = $this->check($id);
        if (!OptometriaHel::CAgConCorreccion($optometria, true) or !OptometriaHel::CAgConPh($optometria, true)) {
            $agvconph = OptometriaHel::CAgConPh($optometria);
            $agvconcorreccion = OptometriaHel::CAgConCorreccion($optometria);

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple([$agvconph, $agvconcorreccion]);
            }
            if (Yii::$app->request->isPost) {
                $agvconph->scenario = 'create';
                $agvconcorreccion->scenario = 'create';
                $agvconph->load(Yii::$app->request->post());
                $agvconcorreccion->load(Yii::$app->request->post());
                $agvconph->opt_agudezavisual_id = $optometria->optAgudezavisual->id;
                $agvconcorreccion->opt_agudezavisual_id = $optometria->optAgudezavisual->id;
                if (($agvconph->isNewRecord and $agvconph->save()) or ($agvconcorreccion->isNewRecord and $agvconcorreccion->save())) {
                    Yii::$app->session->setFlash('success', 'Datos agregados Correctamente!');
                    return $this->redirect(['view', 'id' => $optometria->id]);
                }
            }
            $agvconph->scenario = Model::SCENARIO_DEFAULT;
            $agvconcorreccion->scenario = Model::SCENARIO_DEFAULT;
            return $this->render('p_form', [
                'model' => 'agudezavisual',
                'vista' => 'opt_agudezavisual',
                'array' => [
                    'agudezavisualconph' => $agvconph,
                    'agudezavisualconcorreccion' => $agvconcorreccion,
                    'agudezavisualsincorreccion' => $optometria->optAgudezavisual->optAgudezavisualSincorreccion,
                    'optometria' => $optometria
                ],
                'optometria' => $optometria
            ]);
        }
        Yii::$app->session->setFlash('info', 'Todos los valores han sido agregados!');
        return $this->redirect(['view', 'id' => $optometria->id]);
    }

    public function actionAddcornea($id)
    {
        $optometria = $this->check($id);
        if (!OptometriaHel::CCorneaQueratometria($optometria, true) ||
            !OptometriaHel::CCorneaTopografia($optometria, true)
        ) {
            $corneaqueratometria = OptometriaHel::CCorneaQueratometria($optometria);
            $corneatopografia = OptometriaHel::CCorneaTopografia($optometria);
            $corneaqueratometria->scenario = 'create';
            $corneatopografia->scenario = 'create';
            $corneaqueratometria->load(Yii::$app->request->post());
            $corneatopografia->load(Yii::$app->request->post());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple([$corneaqueratometria, $corneatopografia]);
            }
            $cornea = $optometria->optCornea;
            if ($cornea == null)
                $cornea = new OptCornea();

            if (Yii::$app->request->isPost) {
                $corneatopografia->idcornea = $cornea->id;
                $corneatopografia->odphoto = UploadedFile::getInstance($corneatopografia, 'odphoto');
                $corneatopografia->oiphoto = UploadedFile::getInstance($corneatopografia, 'oiphoto');
                $saved = false;
                if (($corneatopografia->oiphoto and $corneatopografia->odphoto)) {
                    if ($cornea->isNewRecord) {
                        $cornea->optometria_id = $optometria->id;
                        $cornea->save();
                    }
                    if ($corneatopografia->odphoto) {
                        $corneatopografia->odurlimg = 'uploads/opt/topografia/'
                            . rand(0, 99999999) . '.' . $corneatopografia->odphoto->extension;
                    }
                    if ($corneatopografia->oiphoto) {
                        $corneatopografia->oiurlimg = 'uploads/opt/topografia/'
                            . rand(0, 99999999) . '.' . $corneatopografia->oiphoto->extension;
                    }
                    $corneatopografia->idcornea = $cornea->id;
                    if ($corneatopografia->save()) {
                        $saved = true;
                        if ($corneatopografia->odphoto) {
                            $corneatopografia->odphoto->saveAs($corneatopografia->odurlimg);
                        }
                        if ($corneatopografia->oiphoto) {
                            $corneatopografia->oiphoto->saveAs($corneatopografia->oiurlimg);
                        }
                    }
                }

                if ($corneaqueratometria->isNewRecord and $corneaqueratometria->validate()) {
                    if ($cornea->isNewRecord) {
                        $cornea->optometria_id = $optometria->id;
                        $cornea->save();
                    }
                    $saved = true;
                    $cornea->save();
                    $corneaqueratometria->hc_cornea_id = $cornea->id;
                    $corneaqueratometria->save();
                }
                if ($saved) {
                    Yii::$app->session->setFlash('success', 'Detalles de Cornea Agregado !');
                    return $this->redirect(['view', 'id' => $optometria->id]);
                }
            }

            return $this->redirect(['add', 'id' => $optometria->id, 'model' => 'cornea']);
        } else {
            Yii::$app->session->setFlash('info', 'EStos datos ya han sido Registrados');
            return $this->redirect(['view', 'id' => $optometria->id]);
        }
    }

    public function actionAddretinoscopia($id)
    {
        $optometria = $this->check($id);
        if ($optometria !== null) {
            /** @var OptRetinoscopia[] $retinoscopia */
            $retinoscopia = [
                new OptRetinoscopia()
            ];
            Model::loadMultiple($retinoscopia, Yii::$app->request->post());
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple($retinoscopia);
            }
            /** @var OptRetinoscopia $model */
            foreach ($retinoscopia as $key => $model) {
                $model->optometria_id = $optometria->id;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Retinoscopia : ' . $model->tipo . '. Agregada ');
                }
            }
            return $this->redirect(['view', 'id' => $optometria->id]);
        } else
            throw new HttpException(404, 'pagina no encontrada');
    }

    public function actionAddfondoscopia($id)
    {
        $optometria = $this->check($id);
        $fondoscopia = new OptFondoscopia();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($fondoscopia);
        }
        if ($optometria !== null) {
            $fondoscopia->load(Yii::$app->request->post());
            $fondoscopia->idoptometria = $optometria->id;
            $fondoscopia->odphoto = UploadedFile::getInstance($fondoscopia, 'odphoto');
            $fondoscopia->oiphoto = UploadedFile::getInstance($fondoscopia, 'oiphoto');
            if ($fondoscopia->odphoto || $fondoscopia->oiphoto) {
                if ($fondoscopia->odphoto) {
                    $fondoscopia->odurlimg = 'uploads/opt/fondoscopia/' . rand(0, 99999999) . $fondoscopia->odphoto->extension;
                }
                if ($fondoscopia->oiphoto) {
                    $fondoscopia->oiurlimg = 'uploads/opt/fondoscopia/' . rand(0, 99999999) . $fondoscopia->oiphoto->extension;
                }
                if ($fondoscopia->save()) {
                    Yii::$app->session->setFlash('success', 'Fondoscopia agregada !!');
                    if ($fondoscopia->odphoto) {
                        $fondoscopia->odphoto->saveAs($fondoscopia->odurlimg);
                    }
                    if ($fondoscopia->oiphoto) {
                        $fondoscopia->oiphoto->saveAs($fondoscopia->oiurlimg);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $optometria->id]);
        } else
            return new HttpException(404, 'pagina no encontrada');
    }

    public function actionAddmotor($id)
    {
        $optometria = $this->check($id);
        if ($optometria !== null) {
            $moduloverduc = OptometriaHel::CMotorVerDuc($optometria);
            $moduloample = OptometriaHel::CMotorAmFl($optometria);
            $covertest = new OptCoverTest();
            $modulo = $optometria->optModulooculomotor;

            if (!$moduloample->isNewRecord) {
                $covertest->parseJson($moduloample->covertest);
            }
            if (empty($moduloverduc)) {
                $moduloverduc = [
                    'versiones' => new OptModuloVersionesducciones(),
                    'ducciones' => new OptModuloVersionesducciones()
                ];
            } else {
                foreach ($moduloverduc as $key => $models) {
                    $moduloverduc[$models->tipo] = $moduloverduc[$key];
                    unset($moduloverduc[$key]);
                }
                if (!ArrayHelper::keyExists('versiones', $moduloverduc)) {
                    $moduloverduc['versiones'] = new OptModuloVersionesducciones();
                }
                if (!ArrayHelper::keyExists('ducciones', $moduloverduc)) {
                    $moduloverduc['ducciones'] = new OptModuloVersionesducciones();
                }
            }

            if (Yii::$app->request->isAjax) {
                Model::loadMultiple($moduloverduc, Yii::$app->request->post());
                $covertest->load(Yii::$app->request->post($covertest->formName()));
                $moduloample->load(Yii::$app->request->post());
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple(ArrayHelper::merge($moduloverduc, [$covertest, $moduloample]));
            }
            if (Yii::$app->request->isPost) {
                Model::loadMultiple($moduloverduc, Yii::$app->request->post());
                $covertest->load(Yii::$app->request->post($covertest->formName()));
                $covertest->scenario = 'create';
                $moduloample->load(Yii::$app->request->post());
                $moduloample->scenario = 'create';
                if ($modulo == null) {
                    $modulo = new OptModulooculomotor();
                    $modulo->optometria_id = $optometria->id;
                    $modulo->save();
                }
                $moduloample->covertest = $covertest->getJson();
                if ($moduloample->validate() and $covertest->validate()) {
                    $moduloample->idmodulooculomotor = $modulo->id;
                    $moduloample->save();
                    Yii::$app->session->setFlash('success', 'Valores de modulo oculomotor ingresados');
                }
                foreach ($moduloverduc as $key => $model) {
                    $model->photo = UploadedFile::getInstance($model, "[$key]photo");
                    if ($model->photo) {
                        $model->scenario = 'create';
                        $model->urlimg = 'uploads/opt/verduc/' . rand(0, 99999999) . $model->photo->extension;
                        $model->tipo = $key;
                        $model->idmodulooculomotor = $modulo->id;
                        if ($model->save() && $model->photo) {
                            $model->photo->saveAs($model->urlimg);
                            Yii::$app->session->setFlash('success', 'modulo oculomotor ' . $key . ' Agregado !');
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $optometria->id]);
            }
        }
        return new HttpException(404, 'pagina no encontrada');
    }

    public function actionAddexamenexterno($id)
    {

        $optometria = $this->check($id);
        $examen = new OptExamenexterno(['tipo' => Yii::$app->request->post('tipo')]);
        $examen->odphoto = UploadedFile::getInstance($examen, 'odphoto');
        $examen->oiphoto = UploadedFile::getInstance($examen, 'oiphoto');
        $examen->load(Yii::$app->request->post());
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($examen);
        }
        $examen->odurlimg = 'uploads/opt/examenes/' . rand(0, 999999) . '.' . $examen->odphoto->extension;
        $examen->oiurlimg = 'uploads/opt/examenes/' . rand(0, 999999) . '.' . $examen->oiphoto->extension;
        $examen->id_optometria = $optometria->id;
        if ($examen->save()) {
            $examen->odphoto->saveAs($examen->odurlimg);
            $examen->oiphoto->saveAs($examen->oiurlimg);
            Yii::$app->session->setFlash('success', 'Examen Externo Agregado!');
            $this->redirect(['view', 'id' => $optometria->id]);
        }
        return $this->redirect(['view', 'id' => $optometria->id]);
    }

    public function actionAddmodel($id)
    {
        $optometria = $this->check($id);
        /** @var OptDiagnostico[] $diagnosticos */
        $diagnosticos = [];
        $num = count(Yii::$app->request->post('OptDiagnostico'));
        for ($i = 0; $i < $num; $i++) {
            $diagnosticos[] = new OptDiagnostico(['scenario' => 'create']);
        }
        Model::loadMultiple($diagnosticos, Yii::$app->request->post());
        foreach ($diagnosticos as $k => $diagnostico) {
            $diagnostico->optometria_id = $optometria->id;
            if ($diagnostico->save())
                Yii::$app->session->setFlash('success', 'dignostico agregado !');
        }
        if ($optometria->load(Yii::$app->request->post())) {
            $optometria->save();
            Yii::$app->session->setFlash('success', 'Disposición agregada correctamente');
        }
        $this->redirect(['view', 'id' => $optometria->id]);
    }

    public function actionFinpac()
    {
        if (Yii::$app->request->isAjax) {
            $query = Paciente::find();
            $query->joinWith(['usuario']);
            $query->where('usuario.cedula = :cedula', ['cedula' => Yii::$app->request->get('ced')]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            /** @var Paciente $paciente */
            $paciente = $query->one();
            $usuario = null;
            $entidad = null;
            if ($paciente != null) {
                $usuario = $paciente->usuario;
                /** @var AfiliadoEps $entidad */
                $entidad = $paciente->getAfiliadoEps()->limit(1)->orderBy(['id' => 'desc'])->one();
                if ($entidad == null) {
                    $entidad = new EpsCosultorio(['nombre' => 'Particular']);
                } else
                    $entidad = $entidad->epsCosultorio;
                $paciente->fechanacimiento = Util::edad($paciente->fechanacimiento);
            }
            return Json::encode([$paciente, $usuario, $entidad]);
        }
        return null;
    }

    public function actionNewdiagnostico()
    {
        return $this->renderPartial('opt_diagnostico', [
            'diagnostico' => $diagnostico = [
                Yii::$app->request->post('id') => new OptDiagnostico(['ojo' => 'Ojo Izquierdo']),
                (Yii::$app->request->post('id') + 1) => new OptDiagnostico(['ojo' => 'Ojo Derecho']),
            ],
            'form' => new \yii\bootstrap\ActiveForm([
                'tagForm' => false
            ]),
            'button' => false
        ]);
    }

    public function actionList()
    {
        $searchModel = new SearchPaciente();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $optometria = $this->check($id);
        return $this->render('view', [
            'optometria' => $optometria
        ]);
    }

    public function actionAddcontrol($id)
    {
        if (Yii::$app->user->can('Paciente')) {
            /** @var Optometria $optometria */
            $optometria = Optometria::findOne($id);
            if ($optometria->historia->paciente->idusuario != Yii::$app->user->getId()) {
                return new UnauthorizedHttpException('no tiene permitido ejecutar esta acción');
            }
        } else
            $optometria = $this->check($id);

        $control = new OptControl([
            'optometria_id' => $optometria->id,
            'fecha' => new Expression('NOW()'),
            'proveedor' => (Yii::$app->user->can('Optometra') ? 'Profesional' : 'Paciente'),
        ]);
        if ($control->load(Yii::$app->request->post())) {
            $control->pic = UploadedFile::getInstances($control, 'pic');
            $urls = [];
            if (!empty($control->pic)) {
                foreach ($control->pic as $pic) {
                    $urls[] = 'uploads/opt/control/' . rand(0, 999999) .
                        '.' . $pic->extension;
                }
                $control->urlimg = $urls;
            }
            $control->urlimg = Json::encode($control->urlimg);
            if ($control->save()) {
                if (!empty($control->pic)) {
                    $control->urlimg = Json::decode($control->urlimg);
                    foreach ($control->pic as $key => $pic) {
                        $pic->saveAs($control->urlimg[$key]);
                    }
                }
                Yii::$app->session->setFlash('success', 'control agregado correctamente!');
            }
            $this->redirect(['/paciente/home/historia', 'id' => $optometria->historia->paciente_id]);
        }
        return $this->render('addcontrol', [
            'model' => $control,
        ]);
    }

    /**
     * @param $id
     * @throws HttpException
     * @return Optometria
     */
    private function check($id)
    {
        $optometria = Optometria::findOne($id);
        if ($optometria != null) {
            if (Yii::$app->user->can('Optometra', ['optometria' => $optometria])) {
                return $optometria;
            } else
                throw new UnauthorizedHttpException('No tienes permisos para ver esta optometria');
        } else
            throw new HttpException(404, 'pagina no encontrada');
    }

}
