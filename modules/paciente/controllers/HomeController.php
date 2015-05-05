<?php

namespace app\modules\paciente\controllers;

use app\models\Historia;
use app\models\Paciente;
use app\models\PacienteControl;
use app\models\Profesional;
use app\models\Usuario;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class HomeController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index', 'historia', 'registrar'
                        ],
                        'allow' => true,
                        'roles' => ['Profesional']
                    ],
                    [
                        'actions' => [
                            'index', 'historia', 'notas'
                        ],
                        'allow' => true,
                        'roles' => ['Paciente']
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {

        return $this->render('bienvenida', ['usuario' => Yii::$app->user->identity]);
    }

    public function actionHistoria($id)
    {
        $paciente = Paciente::findOne($id);
        $query = Historia::find()
            ->where('paciente_id = :id', ['id' => $paciente->id])
            ->orderBy('fecha desc');
        $historias = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('historia', [
            'paciente' => $paciente,
            'historias' => $historias
        ]);
    }

    public function actionNotas()
    {
        /** @var Paciente $paciente */
        $historia = new Historia();
        $control = new PacienteControl();
        $profesionales = Profesional::find()
            ->leftJoin('historia', 'historia.profesional_id = profesional.id')
            ->leftJoin('paciente', 'paciente.id = historia.paciente_id')
            ->where('paciente.idusuario = :user', [':user' => \Yii::$app->user->id])->all();
        $data = ArrayHelper::merge(['' => 'seleccione'], ArrayHelper::map($profesionales, 'id', function ($element) {
            return $element->usuario->nombres . ' ' . $element->usuario->apellidos;
        }));
        //$control->load(Yii::$app->request->post());
        if ($control->load(Yii::$app->request->post())) {
            $paciente = Paciente::findOne(['idusuario' => Yii::$app->user->id]);
            $historia->load(Yii::$app->request->post());
            $historia->fecha = new Expression('NOW()');
            $historia->paciente_id = $paciente->id;
            $historia->profesional_id = Yii::$app->request->post('Historia')['profesional_id'];
            $historia->model = PacienteControl::className();

            if ($historia->save()) {
                $control->picture = UploadedFile::getInstance($control, 'picture');
                $control->historia_id = $historia->id;
                $ruta = "";
                if ($control->picture) {
                    $ruta = 'uploads/control/' . rand(0, 999999999) . '.' . $control->picture->extension;
                    $control->urlimg = $ruta;
                }
                if ($control->save()) {
                    if ($control->picture) {
                        $control->picture->saveAs($ruta);
                    }
                    Yii::$app->session->setFlash('success', 'Datos Guardados Correctamente');
                    $historia = new Historia();
                    $control = new PacienteControl();
                }
            }
        }

        return $this->render('form_control', [
            'control' => $control,
            'data' => $data,
            'historia' => $historia
        ]);
    }

    public function actionRegistrar()
    {
        $paciente = new Paciente(['scenario' => 'pac']);
        $user = new Usuario(['scenario' => 'insert']);
        if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post()) && $paciente->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($user);
        }
        if (Yii::$app->request->isPost) {
            if ($paciente->load(Yii::$app->request->post()) and $user->load(Yii::$app->request->post())) {
                $user->password = Yii::$app->security->generatePasswordHash($user->cedula);
                $paciente->telefonocelular = $user->telefonocelular;
                if ($user->validate() and $paciente->validate()) {
                    $user->save();
                    $paciente->idusuario = $user->id;
                    $paciente->save();
                    Yii::$app->session->setFlash('success', 'Nuevo paciente reistrado correctamente');
                    return $this->redirect(['historia', 'id' => $paciente->id]);
                } else
                    var_dump($user->getErrors(), $paciente->getErrors());
            }
        }
        return $this->render('registro', [
            'usuario' => $user,
            'paciente' => $paciente
        ]);
    }

}
