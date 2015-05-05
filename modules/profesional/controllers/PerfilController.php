<?php

namespace app\modules\profesional\controllers;

use app\models\Profesional;
use app\models\ProfesionalEps;
use app\models\ProfesionalTitulos;
use app\models\Usuario;
use Yii;
use yii\filters\AccessControl;
use yii\web\UnauthorizedHttpException;
use yii\web\UploadedFile;

class PerfilController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete', 'welcome', 'registrartitulo', 'removeestudio'],
                        'allow' => true,
                        'roles' => ['Profesional'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $usuario = Usuario::findOne(Yii::$app->user->getId());
        $profesional = $usuario->getProfesional();
        if ($profesional == null) {
            throw new UnauthorizedHttpException('Debe ingresar como un profesional', 403);
        }
        $prof_eps = ProfesionalEps::find()
            ->where(['id_profesional' => $profesional->id])
            ->all();
        if (Yii::$app->request->get('id')) {
            $eps = ProfesionalEps::findOne(Yii::$app->request->get('id'));
        } else {
            $eps = new ProfesionalEps();
        }
        $estudio = new ProfesionalTitulos();
        $allestudios = ProfesionalTitulos::findAll(['idprofesional' => Yii::$app->user->identity->profesional->id]);
        return $this->render('editarperfil',
            ['usuario' => $usuario,
                'profesional' => $profesional,
                'eps' => $eps,
                'prof_eps' => $prof_eps,
                'estudios' => $estudio,
                'allestudios' => $allestudios
            ]);
    }

    public function actionUpdate()
    {
        $usuario = Usuario::findOne(Yii::$app->user->getId());
        /** @var $profesional Profesional */
        $profesional = $usuario->profesional;
        $profesional->scenario = 'update';
        $prof_eps = new ProfesionalEps();
        if (Yii::$app->request->get('id')) {
            $prof_eps = ProfesionalEps::findOne(Yii::$app->request->get('id'));
        }
        $prof_eps->load(Yii::$app->request->post());
        $prof_eps->id_profesional = $profesional->id;
        $usuario->load(Yii::$app->request->post());
        $profesional->load(Yii::$app->request->post());

        $profesional->picture = UploadedFile::getInstance($profesional, 'picture');
        $profesional->picture2 = UploadedFile::getInstance($profesional, 'picture2');
        if ($profesional->picture) {
            if (file_exists(Yii::$app->basePath . '/web/' . $profesional->urlfoto))
                unlink(Yii::$app->basePath . '/web/' . $profesional->urlfoto);
            $ruta = 'uploads/profesional/' . $profesional->picture->baseName . rand(0, 1000) . '.' . $profesional->picture->extension;
            $profesional->picture->saveAs($ruta);
            $profesional->urlfoto = $ruta;
        }
        if ($profesional->picture2) {
            if (file_exists(Yii::$app->basePath . '/web/' . $profesional->urlregistro))
                unlink(Yii::$app->basePath . '/web/' . $profesional->urlregistro);
            $ruta2 = 'uploads/profesional/' . $profesional->picture2->baseName . rand(0, 1000) . '.' . $profesional->picture2->extension;
            $profesional->picture2->saveAs($ruta2);
            $profesional->urlregistro = $ruta2;
        }
        if ($profesional->save(['urlfoto']) || $profesional->save(['urlregistro'])) {
            Yii::$app->session->setFlash('success', 'Informacion Actualizada Correctamente');
        }
        if ($usuario->save()) {
            Yii::$app->session->setFlash('success', 'Informacion Actualizada Correctamente');
        }
        if (Yii::$app->request->post('ProfesionalEps') && $prof_eps->save()) {
            Yii::$app->session->setFlash('success', 'Informacion Actualizada Correctamente');
        }
        return $this->redirect('index');

    }

    public function actionDelete($id)
    {
        $prof_eps = ProfesionalEps::findOne(['id' => $id]);
        if ($prof_eps->delete()) {
            Yii::$app->session->setFlash('success', 'Datos Eliminados Correctamente');
        }
        return $this->redirect('index');
    }

    public function actionRegistrartitulo()
    {
        $estudio = new ProfesionalTitulos();
        if (Yii::$app->request->post()) {
            $estudio->load(Yii::$app->request->post());
            $estudio->idprofesional = Yii::$app->user->identity->profesional->id;
            if ($estudio->save())
                Yii::$app->session->setFlash('success', 'Informacion Guardada Correctamente');
            return $this->redirect(['index']);
        }
    }

    public function actionRemoveestudio($id)
    {
        $est = ProfesionalTitulos::findOne(['id' => $id]);
        if ($est != null) {
            if ($est->delete())
                Yii::$app->session->setFlash('success', 'Informacion Eliminada Correctamente');
            return $this->redirect(['index']);

        }
    }


}
