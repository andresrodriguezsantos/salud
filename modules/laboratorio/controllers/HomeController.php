<?php

namespace app\modules\laboratorio\controllers;

use app\models\laboratorio\Laboratorio;
use app\models\laboratorio\LabSede;
use app\models\laboratorio\LabUsuario;
use Yii;
use yii\web\Controller;

class HomeController extends Controller
{
    public  $defaultAction = 'welcome';

    public function actionWelcome()
    {
        if (!Yii::$app->user->isGuest) {
            $laboratorio_sede = LabSede::find()
                ->joinWith(['labUsuarios','laboratorio']) // en el join with se coloca el nombre de la relacion en los modelos
                ->where(['lab_usuario.idusuario'=>Yii::$app->user->id]) // en esta parte se coloca los nombres de la tabla y columna de la bd
                ->one();
            //return var_dump($laboratorio_sede);
           return $this->render('bienvenida',[
              'lab_sede'=>$laboratorio_sede
           ]);
        }
    }
}
