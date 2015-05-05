<?php

namespace app\modules\admin\controllers;

use app\models\Codigocie;
use app\models\search\searchCodigocie;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\Response;

class CodigocieController extends Controller
{
    public function actionIndex()
    {
        $codigo = new Codigocie();
        $listasearch = new searchCodigocie();
        $listacie = $listasearch->search(Yii::$app->request->queryParams);
        if (Yii::$app->request->isAjax) {
            $codigo->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($codigo);
        }
        if (Yii::$app->request->post()) {
            $codigo->load(Yii::$app->request->post());
            if ($codigo->save())
                Yii::$app->session->setFlash('success', 'Codigo Creado Correctamente');
            $codigo = new Codigocie();
        }
        return $this->render('index', [
            'codigo' => $codigo,
            'lista' => $listacie,
            'listasearch' => $listasearch
        ]);
    }

    public function actionEditarcie($id)
    {
        $codigo = Codigocie::findOne($id);
        if (Yii::$app->request->isAjax) {
            $codigo->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($codigo);
        }
        if (Yii::$app->request->post()) {
            $codigo->load(Yii::$app->request->post());
            if ($codigo->update()) {
                Yii::$app->session->setFlash('success', 'Codigo Actualizado Correctamente');
                return $this->redirect(['index']);
            }
        }
        if ($codigo != null) {
            return $this->render('form_editar', [
                'codigo' => $codigo
            ]);
        }
    }


}
