<?php

namespace app\modules\profesional\controllers;

use app\models\ProfesionalEps;
use app\models\ProfesionalTitulos;
use Yii;
use yii\web\Controller;

class HomeController extends Controller
{
    public $defaultAction = 'welcome';

    public function actionWelcome()
    {
        if (!Yii::$app->user->isGuest) {
            /** @var Usuario $usuario */
            $usuario = Yii::$app->user->identity;
            $usuario->access_token = null;
            $usuario->password = null;
            $usuario->authKey = null;
            $usuario->username = null;
            $usuario->cedula = null;
            $usuario->pin = null;
            $prof_eps = ProfesionalEps::findAll(['id_profesional' => Yii::$app->user->identity->profesional->id]);
            $titulos = ProfesionalTitulos::findAll(['idprofesional' => \Yii::$app->user->identity->profesional->id]);
            return $this->render('bienvenida', [
                'usuario' => $usuario,
                'estudios' => $titulos,
                'alleps' => $prof_eps
            ]);
        }
    }
}
