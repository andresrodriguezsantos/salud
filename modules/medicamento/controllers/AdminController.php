<?php

namespace app\modules\medicamento\controllers;

use app\models\medicamento\Medicamento;
use app\models\medicamento\MedPreMed;
use app\models\medicamento\MedPresentacion;
use app\models\medicamento\MedSubtipoTerapeutico;
use app\models\medicamento\MedTipoTerapeutico;
use app\models\medicamento\OptPrescripcionMed;
use app\models\Usuario;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'registrarpresentacion', 'actualizar',
                            'registrarmedicamento', 'likepresentacion', 'likesubtipo',
                            'editarpresentacion', 'deletepresentacion', 'addpresentacion',
                            'removepresentacion', 'redirectremovepresentacion', 'removemedpresentacion'
                        ],
                        'allow' => true,
                        'roles' => ['LabGerente']
                    ],
                    [
                        'actions' => ['prescripcionmedica', 'fillopts', 'getpresentaciones', 'buscarmedicamento'],
                        'allow' => true,
                        'roles' => ['Profesional']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $medicamento = new Medicamento();
        $presentacion = new MedPresentacion();
        $listatipo = MedTipoTerapeutico::find()
            ->where(['estado' => 1])
            ->limit(20)
            ->orderBy('nombre')
            ->all();
        $listasubtipo = MedSubtipoTerapeutico::find()
            ->joinWith('tipoterapeutico')
            ->orderBy('med_tipo_terapeutico.nombre', 'med_subtipo_terapeutico.nombre')
            ->where(['med_subtipo_terapeutico.estado' => 1])
            ->limit(20)
            ->all();
        $listapresentacion = MedPresentacion::find()
            ->where(['estado' => 1])
            ->limit(20)
            ->orderBy('nombre')
            ->all();
        $meds = Medicamento::find()
            ->where(['idlaboratorio' => $this->getIdLab()]);
        $medicamentos = new ActiveDataProvider([
            'query' => $meds,
            'sort' => ['attributes' => ['nombrecomercial']]
        ]);
        return $this->render('registro', [
            'medicamento' => $medicamento,
            'presentacion' => $presentacion,
            'listatipo' => $listatipo,
            'listasubtipo' => $listasubtipo,
            'medicamentos' => $medicamentos,
            'listapre' => $listapresentacion,
        ]);
    }

    /**
     * @return string idlaboratio
     */
    function getIdLab()
    {
        /** @var Usuario $user */
        $user = Yii::$app->user->identity;
        return $user->labuser->laboratoriosede->idlaboratorio;
    }

    public function actionRegistrarpresentacion()
    {
        $presentacion = new MedPresentacion();
        $medicamento = new Medicamento();
        $meds = Medicamento::find()
            ->where(['idlaboratorio' => $this->getIdLab()]);
        $medicamentos = new ActiveDataProvider([
            'query' => $meds,
            'sort' => ['attributes' => ['nombrecomercial']]
        ]);
        if (Yii::$app->request->post($presentacion->formName())['id'] != null) {
            $presentacion = MedPresentacion::findOne(Yii::$app->request->post($presentacion->formName())['id']);
        }
        if ($presentacion->load(Yii::$app->request->post())) {
            $presentacion->idlaboratorio = 1;
            $flash = $presentacion->isNewRecord ? 'Presentation Registered Correctly' : 'Datos Actualizados Correctamente';
            if ($presentacion->save())
                Yii::$app->session->setFlash('success', $flash);
            $presentacion = new MedPresentacion();
        }
        $listapre = MedPresentacion::find()->orderBy('nombre')->limit(10)->all();
        return $this->render('index_presentacion', [
            'presentacion' => $presentacion,
            'listapre' => $listapre,
            'medicamento' => $medicamento,
            'medicamentos' => $medicamentos
        ]);
    }

    public function actionRegistrarmedicamento()
    {
        $medicamento = new Medicamento();
        if (Yii::$app->request->post('dato')) {
            $tarjeta = Json::decode(Yii::$app->request->post('dato'));
            $medicamento->idsubtipoterapeutico = $tarjeta['subtipo']['id'];
            /** @var Usuario $user */
            $medicamento->idlaboratorio = $this->getIdLab();
            $medicamento->nombrecomercial = $tarjeta['nombre'];
            $medicamento->composicion = $tarjeta['composicion'];
            $medicamento->descripcion = $tarjeta['descripcion'];
            $medicamento->idareasalud = $tarjeta['area']['id'];
            if ($medicamento->save()) {
                $medpre = new MedPreMed();
                $medpre->idmedicamento = $medicamento->id;
                $medpre->idpresentacion = $tarjeta['presentacion']['id'];
                $medpre->save();
                Yii::$app->session->setFlash('success', 'Medicamento Registtrado ');
                return $this->redirect(['index']);
            }
        }
        //return false;
    }

    public function actionActualizar($id)
    {
        /** @var Medicamento $medicamento */
        $medicamento = Medicamento::findOne($id);
        if ($medicamento != null) {

            if (Yii::$app->request->isPost && $medicamento->load(Yii::$app->request->post())) {
                if ($medicamento->save()) {
                    Yii::$app->session->setFlash('success', 'Información Actualizada correctamente');
                    return $this->redirect(['index']);
                }
            }
            return $this->render('actualizar', ['medicamento' => $medicamento]);
        } else
            throw new HttpException(404, 'Pagina no ha sido Enocntrada');
    }

    public function actionDeletepresentacion($id)
    {
        $pre = MedPresentacion:: findOne(['id' => $id]);
        if ($pre != null)
            $medicamento = MedPreMed::find()->where([
                'idpresentacion' => $pre->id
            ])->all();
        if ($medicamento != null)
            foreach ($medicamento as $medi) {
                $medi->delete();
            }
        if ($pre->delete()) {
            Yii::$app->session->setFlash('success', 'Datos Eliminados Correctamente');
        }
        return $this->redirect(['registrarpresentacion']);
    }

    public function actionAddpresentacion($id)
    {
        $med = Medicamento::findOne($id);
        if ($med != null) {
            $medpre = new MedPreMed();
            if (Yii::$app->request->post()) {
                /** @var MedPreMed $medpre */
                $medpre->load(Yii::$app->request->post());
                $medpre->idmedicamento = $id;
                if ($medpre->save())
                    Yii::$app->session->setFlash('success', 'Nueva Presentacion Asiganda Correctamente');
            }
            return $this->render('index_medic_present', [
                'medpre' => $medpre,
                'medicamento' => $med
            ]);
        }
        throw new HttpException('404', 'No se ha encontrado la pagina');
    }

    public function actionRemovemedpresentacion($id)
    {
        $medpre = MedPreMed::findOne($id);
        if ($medpre != null) {
            if ($medpre->delete())
                Yii::$app->session->setFlash('success', 'Datos Eliminados Correctamente');
        }
        return $this->redirect(['registrarpresentacion']);
    }

    public function actionRedirectremovepresentacion($id)
    {
        $medpre = MedPreMed::findAll(['idmedicamento' => $id]);
        $medicamento = Medicamento::findOne($id);
        return $this->render('lista_eliminar_med_pre', [
            'presentaciones' => $medpre,
            'medicamento' => $medicamento
        ]);
    }

    public function actionGetpresentaciones($id)
    {
        $presentaciones = MedPreMed::find()
            ->joinWith(['medicamento', 'presentacion'])
            ->where('medicamento.id = :med', [':med' => $id])
            ->asArray()
            ->all();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Json::encode($presentaciones);
    }

    public function actionFillopts()
    {
        if (Yii::$app->request->isAjax) {
            $ar = ['medicamento.id as id', 'medicamento.composicion as label', 'idlaboratorio'];
            if (Yii::$app->request->get('tipo') == 'comercial') {
                $ar = ['medicamento.id as id', 'medicamento.nombrecomercial as label', 'idlaboratorio'];
            }
            /** @var ActiveQuery $data */
            $data = \app\models\medicamento\Medicamento::find()
                ->select($ar)
                ->leftJoin('laboratorio', 'medicamento.idlaboratorio = laboratorio.id')
                ->asArray();
            if (Yii::$app->request->get('lab') != null) {
                $data->where('laboratorio.id = :id', [':id' => Yii::$app->request->get('lab')]);
            }
            $data = $data->all();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }

    // ACCIONES PARA EL FILTRO LIKE VISTA LISTADO PRESENTACION
    public function actionLikepresentacion()
    {
        if (Yii::$app->request->isAjax) {
            $tabla = "";
            // if (Yii::$app->request->get('dato')) {
            $info = Yii::$app->request->get('dato');
            if ($info != null) {
                $presentacion = MedPresentacion::find()
                    ->where(['LIKE', 'nombre', Yii::$app->request->get('dato')])
                    ->orderBy('nombre')
                    ->limit('10')
                    ->all();
            } else {
                $presentacion = MedPresentacion::find()
                    ->orderBy('nombre')
                    ->limit('10')
                    ->all();
            }
            foreach ($presentacion as $key => $pre) {
                $tabla .= '<tr>
                            <td>' . ($key + 1) . '</td>
                            <td>' . $pre->nombre . '</td>
                            <td>
                                <button class="btn btn-xs btn-success btn-add-pres" value="' . $pre->id . '">
                                    <i class="fa-plus glyphicon glyphicon-check"></i>Editar
                                </button>
                                 <button class="btn btn-xs btn-danger btn-remove-pre" value="' . $pre->id . '">
                                    <i class="fa-plus glyphicon glyphicon-remove"></i> Eliminar
                                </button>
                            </td>
                       </tr>';
            }
            //  }
            return $tabla;
        } else
            return $this->redirect(['index']);
    }

// ESTA FUNCION FILTRA LOS SUBTIPOS DE LA LISTASUBTIPO EN LA VISTA LISTA TERAPEUTIC LIST
    public function actionLikesubtipo()
    {
        if (Yii::$app->request->isAjax) {
            $tabla = "";
            $info = Yii::$app->request->get('dato');
            if ($info != null) {
                $subtipo = MedSubtipoTerapeutico::find()
                    ->where(['LIKE', 'nombre', Yii::$app->request->get('dato')])
                    ->orderBy('nombre')
                    ->limit('20')
                    ->all();
            } else {
                $subtipo = MedSubtipoTerapeutico::find()
                    ->orderBy('nombre')
                    ->limit('20')
                    ->all();
            }
            foreach ($subtipo as $key => $pre) {
                $tabla .=
                    '<tr>
                            <td>' . $pre->tipoterapeutico->nombre . '</td>
                            <td>' . $pre->nombre . '</td>
                            <td>
                                <button class="btn btn-xs btn-success btn-addsubtipo"
                                    value="' . $pre->id . '"><i
                                    class="fa-plus glyphicon glyphicon-check"></i>Add item
                                 </button>
                            </td>
                        </tr>';
            }
            return $tabla;
        } else
            return $this->redirect(['index']);
    }

    //ACCIONES PARA PRESCRIBIR MEDICAMENTOS
    public function actionPrescripcionmedica()
    {
        $prescripcion = new OptPrescripcionMed();
        $guarda = false;
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->get('dato') && Yii::$app->request->get('idh')) {
                $data = Json::decode(Yii::$app->request->get('dato'));
                Yii::$app->response->format = Response::FORMAT_JSON;
                foreach ($data as $model) {
                    $prescripcion->idhistoriaclinica = Yii::$app->request->get('idh');
                    $prescripcion->idmedicamento = $model['medicamento']['id'];
                    $prescripcion->dosis = $model['dosis'];
                    $prescripcion->duracion = $model['duracion'];
                    $prescripcion->viaadministracion = $model['administracion'];
                    $prescripcion->unidades = $model['unidad'];
                    if ($prescripcion->save())
                        $guarda = true;
                    var_dump($model);
                    $prescripcion = new OptPrescripcionMed();
                }
            }
            if ($guarda) {
                $prescripcion = new OptPrescripcionMed();
                Yii::$app->session->setFlash('success', 'Datos guardados correctamente');
                $this->redirect(['prescripcionmedica']);
            }
        }
        return $this->render('prescripcionmed', [
            'prescripcion' => $prescripcion
        ]);
    }

    public function actionBuscarmedicamento()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->get('dato');
            if ($id != null) {
                $datos = [];
                $medicamento = Medicamento::findOne(['id' => $id]);
                if ($medicamento != null) {
                    return Json::encode($medicamento);
                };
            }
        }
    }


} // FINAL DEL CONTROLADOR
