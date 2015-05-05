<?php
/**
 * @since 1.0.0
 */
namespace app\controllers;

use app\models\Examenes;
use yii\web\Response;

class CertificadosController extends \yii\web\Controller
{
    public function actionFiltro($id){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return Examenes::find()
            ->select(['id as value','nombre as label'])
            ->where('idareasalud = :id',[':id'=>$id])
            ->asArray(true)
            ->all();
    }
}
