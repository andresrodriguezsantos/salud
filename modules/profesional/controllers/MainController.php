<?php

namespace app\modules\profesional\controllers;

use app\models\Historia;
use app\models\Paciente;
use app\models\PacienteControl;
use app\models\Profesional;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

class MainController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionNotas()
    {
        /** @var Paciente $paciente */
        $historia = new Historia();
        $control = new PacienteControl();
        if ($control->load(Yii::$app->request->post())) {
            $historia->load(Yii::$app->request->post());
            $historia->fecha = new Expression('NOW()');
            $historia->paciente_id = 1;
            $profesional = Profesional::findOne(['idusuario' => Yii::$app->user->id]);
            $historia->profesional_id = $profesional->id;
            $historia->model = PacienteControl::className();

            if ($historia->save()) {
                $control->picture = UploadedFile::getInstance($control, 'picture');
                $control->idhistoria = $historia->id;
                $ruta = "";
                if ($control->picture) {
                    if (file_exists(Yii::$app->basePath . '/web/' . $control->urlimg))
                        unlink(Yii::$app->basePath . '/web/' . $control->urlimg);
                    $ruta = 'uploads/control/' . rand(0, 999999999) . '.' . $control->picture->extension;
                    $control->urlimg = $ruta;
                    return var_dump($control->urlimg);
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
            'historia' => $historia
        ]);
    }

}
