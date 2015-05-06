<?php
/**
 * @since 1.0.0
 */
namespace app\controllers;

use app\models\Ciudad;
use app\models\ContactForm;
use app\models\Departamento;
use app\models\EpsCosultorio;
use app\models\laboratorio\Laboratorio;
use app\models\LoginForm;
use app\models\Noticias;
use app\models\Paciente;
use app\models\Profesional;
use app\models\ProfesionalEps;
use app\models\Usuario;
use app\rules\HisOwnerUser;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        /** @var Usuario $user */
        return $this->render('index');
    }

    public function actionRegistro()
    {
        //$this->layout = 'login';
        $model = new Usuario(['scenario' => 'insert']);
        $login = new LoginForm();
        $laboratorio = new Laboratorio();
        $model->load(Yii::$app->request->post());
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else if (Yii::$app->request->post('typo') == 'pac') {
            Yii::$app->session->set('user', Json::encode($model));
            return $this->redirect(['regpaciente', 'user' => Json::encode($model), 'idp' => $model->idpais]);
        } else if (Yii::$app->request->post('typo') == 'pro') {
            Yii::$app->session->set('user', Json::encode($model));
            return $this->redirect(['regprofesional', 'user' => Json::encode($model), 'idp' => $model->idpais]);
        } else if (Yii::$app->request->post('typo') == 'lab') {
            Yii::$app->session->set('user', Json::encode($model));
            return $this->redirect(['/laboratorio/admin', 'user' => Json::encode($model), 'idp' => $model->idpais]);
        }
        return $this->render('registro_pre', ['model2' => $model, 'login' => $login, 'laboratorio' => $laboratorio]);
    }

    public function actionRegpaciente()
    {
        $model = new Usuario(['scenario' => 'insert']);
        $model2 = new Paciente();
        $user = Json::decode(Yii::$app->request->get('user'));
        $model->nombres = $user['nombres'];
        $model->apellidos = $user['apellidos'];
        $model->cedula = $user['cedula'];
        $model->idpais = Yii::$app->request->get('idp');
        $model->pin = rand(0, 9999);
        $model->attributes = (Yii::$app->request->post('Usuario'));
        $model->password = Yii::$app->security->generatePasswordHash($model->cedula);
        if ($model->validate()) {
            $model2->attributes = Yii::$app->request->post('Paciente');
            $model2->rh = '';
            $model2->alergias = '';
            if ($model2->validate()) {
                $model->save();
                $model2->idusuario = $model->id;
                if ($model2->save()) {
                    Yii::$app->authManager->assign(
                        Yii::$app->authManager->getRole('Paciente'), $model->id
                    );
                    Yii::$app->session->setFlash('success', 'Paciente Registrado Correctamente / Datos de Ingreso: / El usuario corresponde a la direccion email registrada,/
                     El password corresponde a su Numero de identificacion');
                    Yii::$app->session->setFlash('success', 'POR SU SEGURIDAD LE INVITAMOS A QUE REALIZE EL CAMBIO DE SU CONTRASEÑA');
                    return $this->redirect('login');
                } else
                    Yii::$app->session->setFlash('danger', 'Hubo Inconvenientes en su registro !! Por favor intentelo de nuevo');
            }
        }
        return $this->render('registro_pac', ['model2' => $model, 'model' => $model2]);
    }

    public function actionRegprofesional()
    {
        $model = new Usuario(['scenario' => 'pro']);
        $model2 = new Profesional(['scenario' => 'insert']);
        $model3 = new ProfesionalEps();
        $eps_cosul = new EpsCosultorio();

        $user = Json::decode(Yii::$app->request->get('user'));
        $model->nombres = $user['nombres'];
        $model->apellidos = $user['apellidos'];
        $model->cedula = $user['cedula'];
        $model->idpais = Yii::$app->request->get('idp');
        $model->pin = rand(0, 9999);
        if ($model->load(Yii::$app->request->post()) && $model->validate(['nombre', 'direccion', 'contacto'])) {
            //comprueba si viene eps nueva
            if ($eps_cosul->load(Yii::$app->request->post()) and $eps_cosul->validate(['nombre', 'direccion', 'contacto'])) {
                $eps_cosul->idciudad = $model->idciudad;
                if ($eps_cosul->save()) {
                    $model3->load(Yii::$app->request->post());
                    $model3->id_eps = $eps_cosul->id;
                }
            } else {
                $model3->load(Yii::$app->request->post());
            }
            if ($model3->id_eps != '0') {
                $model2->load(Yii::$app->request->post());
                $model2->picture = UploadedFile::getInstance($model2, 'picture');
                $model2->picture2 = UploadedFile::getInstance($model2, 'picture2');
                if ($model2->picture && $model2->picture2 and $model2->validate(['registroprofesional']) and $model3->validate(['id_eps'])) {
                    $model->password = Yii::$app->security->generatePasswordHash($model->cedula);
                    $model->save();
                    $model2->idusuario = $model->id;
                    $rut1 = 'uploads/profesional/' . $model2->picture->baseName . rand(0, 1000) . '.' . $model2->picture->extension;
                    $rut2 = 'uploads/profesional/' . $model2->picture2->baseName . rand(0, 1000) . '.' . $model2->picture2->extension;
                    $model2->picture->saveAs($rut1);
                    $model2->picture2->saveAs($rut2);
                    $model2->urlfoto = $rut1;
                    $model2->urlregistro = $rut2;
                    if ($model2->save()) {
                        $model3->id_profesional = $model2->id;
                        if ($model3->save()) {
                            Yii::$app->authManager->assign(
                                Yii::$app->authManager->getRole('Optometra'), $model->id
                            );
                            Yii::$app->session->setFlash('success', '
                        Profesional Registrado Correctamente / Datos de Ingreso: / El usuario corresponde a la direccion email registrada,/
                        El password corresponde a su Numero de identificacion /
                        POR SU SEGURIDAD LE INVITAMOS A QUE REALIZE EL CAMBIO DE SU CONTRASEÑA');
                            return $this->redirect('login');
                        }
                    }
                }
            } else
                $model3->addError('id_eps', 'No selecciono clinica o no pudo ser resgistrada!');
        }
        return $this->render('registro_pro', [
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            'eps_con' => $eps_cosul
        ]);
    }

    public function actionRegistrarclinica()
    {
        $eps = new EpsCosultorio();
        if (Yii::$app->request->post()) {
            $eps->load(Yii::$app->request->post());
            if ($eps->save()) {
                Yii::$app->session->setFlash('success', 'sdafjjakhdfkahkdf');
            } else {
                var_dump($eps->getErrors());
            }

        }
        return $this->render('reg_clinica', [
            'eps' => $eps
        ]);
    }

    public function actionLogin()
    {
        //$this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('Paciente'))
                return $this->redirect(Yii::$app->request->baseUrl . '/paciente/home');
            elseif (Yii::$app->user->can('Optometra'))
                return $this->redirect(Yii::$app->request->baseUrl . '/profesional/home/welcome');
            elseif (Yii::$app->user->can('LabGerente'))
                return $this->redirect(Yii::$app->request->baseUrl . '/laboratorio/home/welcome');
            else
                // return var_dump('Administrador');
                return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->mailer->compose('contact', [
                'model' => $model
            ])->setTo(Yii::$app->params['adminEmail'])
                ->setFrom($model->email)
                ->setSubject('Clinnikbox.com')
                ->send();
            Yii::$app->session->setFlash('success', 'Mensaje enviado correctamente gracias!');
        }
        return $this->render('contact', [
            'model' => $model,
        ]);

    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionConstruccion()
    {
        return $this->render('construccion');
    }

    public function actionLoadglobal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->post('tipo') == 'pais') {
            return Json::encode(ArrayHelper::map(Departamento::find()
                ->where(['idpais' => Yii::$app->request->post('id')])
                ->addOrderBy('nombre')
                ->all(), 'id', 'nombre'));
        }
        if (Yii::$app->request->post('tipo') == 'departamento') {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return Json::encode(ArrayHelper::map(Ciudad::find()
                ->where(['departamento_id' => Yii::$app->request->post('id')])
                ->addOrderBy('nombre')
                ->all(), 'id', 'nombre'
            ));
        }
        return $this->goHome();
    }

    public function actionNoticias()
    {
        $noticias = Noticias::find()
            ->where(['estado' => 1])
            ->orderBy(['id' => SORT_DESC])
            ->limit(10)
            ->all();
        return $this->render('noticias', [
            'noticia' => $noticias
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionVerdetalle($id)
    {
        $noticia = Noticias::findOne($id);
        if ($noticia != null) {
            return $this->render('detallenoticia', [
                'noticia' => $noticia
            ]);
        }
        return null;
    }


    public function actionInit()
    {
        $user = new Usuario();
        $user->nombres = 'Administarador General Sistema';
        $user->apellidos = 'Adminstrador de Clinikbox';
        $user->cedula = '1234';
        $user->password = Yii::$app->security->generatePasswordHash($user->cedula);
        $user->email = 'admin@mail.com';
        $user->idciudad = 1;
        $user->direccion = 'NO APLICA';
        $user->telefonocelular = '1234';
        if ($user->save()) {
            Yii::$app->authManager->assign(
                Yii::$app->authManager->getRole('Administrador'), $user->id
            );
            return 'Usuario Registrado';
        } else
            return null;
    }

    public function actionRbac()
    {
        $auth = Yii::$app->authManager;
        $rule = new HisOwnerUser();
    }
}
