<?php
/**
 * Created by PhpStorm.
 * User: jhon
 * Date: 8/05/15
 * Time: 02:03 AM
 */

namespace app\modules\paciente\controllers;


use app\models\optometria\Optometria;
use app\models\Permisohistoria;
use app\models\Usuario;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\JsExpression;
use yii\web\Response;

class HistoriaController extends Controller{

    public function actionGetpin($id,$pin)
    {
        \Yii::$app->response->format = Response::FORMAT_HTML;
        /** @var Optometria $optometria */
        $optometria = Optometria::findOne($id);
        if($optometria!= null){
            $usuario = $optometria->historia->paciente->usuario;
            if($pin == $usuario->pin)
                return 'autorised';
            else
                return 'pinerror';
        }
        return 0;
    }

    public function actionGetpermision($id,$nota)
    {
        /** @var Optometria $optometria */
        $optometria = Optometria::findOne($id);
        /** @var Usuario $user */
        if($optometria!=null){
            $user = \Yii::$app->user->identity;
            $permiso = Permisohistoria::findOne([
                'idprofesionalemisor'=>$user->profesional->id,
                'optometria_id'=>$optometria->id,'estado'=>1
            ]);
            if($permiso == null){
                $solicitud = new Permisohistoria([
                    'nota'=>$nota,
                    'aceptado'=>0,
                    'fechasolicitud'=> new Expression('NOW()'),
                    'estado'=>1,
                    'idprofesionalemisor'=>$user->profesional->id,
                    'optometria_id'=>$optometria->id
                ]);
                if($solicitud->save()){
                    return 'send';
                }else
                    return 'nosend'.var_dump($solicitud->getErrors());
            }else{
                return 'resenderror';
            }
        }
        return 0;
    }
}