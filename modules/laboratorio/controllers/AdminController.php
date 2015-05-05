<?php

namespace app\modules\laboratorio\controllers;

use app\models\laboratorio\Laboratorio;
use app\models\laboratorio\LabSede;
use app\models\laboratorio\LabUsuario;
use app\models\Usuario;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Console;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\UnauthorizedHttpException;

class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['registrosede', 'validarcedula', 'buscar', 'edit','deletesede','actualizarlaboratorio'],
                'rules' => [
                    [
                        'actions' => ['registrosede', 'validarcedula', 'buscar', 'edit','deletesede','actualizarlaboratorio'],
                        'allow' => true,
                        'roles' => ['LabGerente']
                    ]
                ]
            ]
        ];
    }


    public function actionIndex()
    {
        $laboratorio = new Laboratorio();
        if (Yii::$app->request->get('user')) {
            //creacion de nuevos usuarios
            $usuario = new Usuario();
            $usuario->load(Yii::$app->request->post());
            $user = Json::decode(Yii::$app->request->get('user'));
            $usuario->nombres = $user['nombres'];
            $usuario->nombres = $user['nombres'];
            $usuario->apellidos = $user['apellidos'];
            $usuario->cedula = $user['cedula'];
            $usuario->idpais = Yii::$app->request->get('idp');
            $usuario->password = Yii::$app->security->generatePasswordHash($usuario->cedula);
            if ($usuario->validate()) {
                if ($laboratorio->load(Yii::$app->request->post())) {
                    $laboratorio->email = $usuario->email;
                    $laboratorio->contacto = 'Sin registrar';
                    if ($usuario->save()) {
                        if ($laboratorio->save()) {
                            $labsede = new LabSede();
                            $labsede->idlaboratorio = $laboratorio->id;
                            $labsede->save(false);
                            $labusuario = new LabUsuario();
                            $labusuario->idusuario = $usuario->id;
                            $labusuario->idlaboratoriosede = $labsede->id;
                            $labusuario->cargo = 'LabGerente';
                            $labusuario->rol = 'Administrador';
                            $labusuario->email = $laboratorio->email;
                            $labusuario->save(false);
                            Yii::$app->authManager->assign(
                                Yii::$app->authManager->getRole('LabGerente'), $usuario->id
                            );
                            Yii::$app->session->setFlash('success', 'Laboratorio Registrado Correctamente. \n Sus datos de Ingreso:\n
                              Usuario :  Correo Electronico, Password : Cedula  \n Por su seguridad Por favor Actualize su contraseña ' );
                            return $this->redirect(['registrosede', 'id' => $laboratorio->id]);
                        }

                    }
                }
            }
        } else {
            return $this->redirect(['/site/registro']);
        }
        return $this->render('registro', [
            'model' => $laboratorio,
            'user' => $usuario
        ]);
    }

    public function  actionRegistrosede($id)
    {
        $sede = new LabSede();
        $labuser = new LabUsuario();
        $mensaje = "Registrado Correctamente";
        if ($sede->load(Yii::$app->request->post()) && $labuser->load(Yii::$app->request->post())) {
            $sede->idlaboratorio = $id;
            $dato = LabSede::find()->where('lab_sede.idlaboratorio=:idlab', [':idlab' => $id])->one();
            if ($dato == null) {
                $labuser->rol = 'gerente';
                $rol = Yii::$app->authManager->getRole('LabGerente');
                Yii::$app->authManager->assign($rol, $labuser->idusuario);
                $mensaje .= "<br>El  usuario ha sido asignado como Gerente del Laboratorio";
            } else {
                $mensaje .= "<br>El usuario ha sido asignado como administrador de una sede del laboratorio";
            }
            if ($sede->save()) {
                $labuser->idlaboratoriosede = $sede->id;
                $labuser->save();
                Yii::$app->session->setFlash('success', $mensaje);
                return $this->redirect('index');
            }
        }
        return $this->render('registrosede', [
            'sede' => $sede,
            'labuser' => $labuser
        ]);
    }

    public function actionValidarcedula()
    {
        if (isset($_GET['ced'])) {
            /** @var Usuario $info */
            $info = Usuario::findOne([
                'cedula' => $_GET['ced']
            ]);
            if ($info != null) {
                $lab = LabUsuario::findOne(['idusuario' => $info->id ]);
                if ($lab == null) {
                    $info->password = "";
                    $info->access_token = "";
                    $info->authKey = "";
                    $info->direccion = "";
                    $info->telefonocelular = "";
                    $info->telefonofijo = "";
                    $info->ciudad->nombre;
                    return Json::encode($info);
                } else
                    return Json::encode('Existe');
            } else
                return Json::encode($info);

        }
    }

// esta accion busca todos los usuarios registrados por laboratorio
    public function actionBuscar()
    {
        /** @var Usuario $user */
        $user = Yii::$app->user->identity;
        /** @var LabUsuario $labuser */
        $labuser = LabUsuario::find()->where('idusuario = :id', [':id' => $user->id])->one();
        $labsedes = LabSede::find()
            ->where('idlaboratorio = :id', [':id' => $labuser->laboratoriosede->idlaboratorio])
            ->all();
        $laboratorio = $labuser->laboratoriosede->laboratorio;
        return $this->render('listadosedes', [
            'labsedes' => $labsedes,
            'laboratorio' => $laboratorio,

        ]);
    }

// esta funcion valida que el usuario que vaya a hacer los cambios sea el gerente del laboratorio
    public function actionEdit($id)
    {
        $sede = LabUsuario::findOne($id);
        $usuario = Yii::$app->user->identity;
        /** @var LabUsuario $user */
        $user = LabUsuario::find()->where(['idusuario' => $usuario->getId()])->one();
        if ($user->cargo == 'LabGerente') {
            //if (Yii::$app->user->can('LabGerente', ['cargo' => $sede->cargo])) {
            return $this->render('editsede', ['sede' => $sede]);
            //}
        } else
            throw new UnauthorizedHttpException('No tiene Permisos Adminstrativos', 403);
    }

    // Esta funcion edita la informacion de una sede
    public function  actionEditarsede($id)
    {
        $findsede = LabUsuario::findOne(['idlaboratoriosede' => $id]);
        $labuser = $findsede;
        $sede = $findsede->laboratoriosede;
        if ($sede->load(Yii::$app->request->post()) && $labuser->load(Yii::$app->request->post())) {
            if ($sede->save()) {
                $labuser->idlaboratoriosede = $sede->id;
                $labuser->save();
                Yii::$app->session->setFlash('success','Datos Actualizados Correctamente');
                return $this->redirect('buscar');
            }
        }
        if ($findsede!= null) {
            $usersede = $findsede->usuario;
            if ($usersede != null) {
                $usersede->authKey = "";
                $usersede->access_token = "";
                $usersede->password = "";

                return $this->render('editsede', [
                    'findsede' => $findsede,
                    'usersede' => $usersede,
                    'labuser' => $labuser,
                    'sede'=>$sede,
                ]);
            }
        }

        throw new UnauthorizedHttpException('No se encontraron resultados', 404);
    }

    public function actionDeletesede($id){
        $sede = LabSede::findOne($id);
        if($sede!=null){
            $user = LabUsuario::find()
                ->where(['idlaboratoriosede'=>$sede->id])
            ->one();
            if($user!=null)
                if($user->cargo!='LabGerente'){
                    $user->delete();
                    if($sede->delete())
                        Yii::$app->session->setFlash('success','Datos Eliminados Correctamente');
                }else
                    Yii::$app->session->setFlash('danger','Este Usuario no puede ser Eliminado <br> Por favor intente actualizando la informacion <br> En caso contrario por favor pongase en contacto con CLINIKBOX.COM');
        }
        return $this->redirect(['buscar']);
    }

    public function actionActualizarlaboratorio(){

        /** @var Usuario $user */
        $user = Yii::$app->user->identity;
        /** @var LabUsuario $labuser */
        $labuser = LabUsuario::find()->where('idusuario = :id', [':id' => $user->id])->one();
        $laboratorio = $labuser->laboratoriosede->laboratorio;
        if(Yii::$app->request->post()){
            $laboratorio->load(Yii::$app->request->post());
            if($laboratorio->update())
                Yii::$app->session->setFlash('success','Datos Actualizados Correctamente');
        }
        return $this->render('editar_laboratorio',[
            'model'=>$laboratorio,
        ]);
    }
}

