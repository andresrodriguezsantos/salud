<?php

namespace app\modules\admin\controllers;

use app\models\Examenes;
use Yii;

class ExamenesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $examenn = new Examenes();
        $lista = Examenes::find()->all();
        if (Yii::$app->request->post()) {
            $examenn->load(Yii::$app->request->post());
            if ($examenn->save()) {
                Yii::$app->session->setFlash('success', 'Examen guardado correctamente');
                $examenn = new Examenes();
            }
        }
        return $this->render('form_examenes', [
            'examen' => $examenn,
            'lista' => $lista
        ]);
    }

}
