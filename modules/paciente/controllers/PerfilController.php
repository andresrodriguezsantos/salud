<?php
/**
 * Created by PhpStorm.
 * User: Andres R S
 * Date: 17/12/14
 * Time: 04:45 PM
 */

namespace app\modules\paciente\controllers;

use app\models\AfiliadoEps;
use app\models\Paciente;
use app\models\Usuario;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\UnauthorizedHttpException;

class PerfilController extends Controller
{

    public function actionIndex()
    {
        /** @var $model Usuario */
        /** @var $model2 Paciente */
        $model = Usuario::findOne(\Yii::$app->user->getId());
        $model2 = $model->paciente;
        if ($model2 == null) {
            new HttpException(403, 'No ha iniciado sesion');
        }
        if (Yii::$app->request->get('id'))
            $model3 = AfiliadoEps::findOne(Yii::$app->request->get('id'));
        else
            $model3 = new AfiliadoEps();
        $data = AfiliadoEps::find()
            ->where(['Paciente_id' => $model2->id])
            ->all();
        return $this->render('editarperfil', [
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            'data' => $data
        ]);

    }

    public function actionUpdate()
    {
        $model = Usuario::findOne(Yii::$app->user->getId());
        /** @var $model2 Paciente */
        $model2 = $model->paciente;
        if (Yii::$app->request->get('id')) {
            $model3 = AfiliadoEps::findOne(Yii::$app->request->get('id'));
        } else {
            $model3 = new AfiliadoEps();
            $model3->paciente_id = $model2->id;
        }
        $model->load(Yii::$app->request->post());
        if (Yii::$app->request->post())
            $model2->load(Yii::$app->request->post());
        if (Yii::$app->request->post())
            $model3->load(Yii::$app->request->post('AfiliadoEps'));
        if ($model->save())
            Yii::$app->session->setFlash('success', 'Informacion Actualizada Correctamente');
        else
            return var_dump($model->getErrors());
        if ($model2->save())
            Yii::$app->session->setFlash('success', 'Informacion Actualizada Correctamente');
        if ($model3->save())
            Yii::$app->session->setFlash('success', 'Informacion Actualizada Correctamente');
        return $this->redirect(['index']);
    }

    public function beforeAction()
    {
        if (Yii::$app->user->isGuest) {
            throw new UnauthorizedHttpException('debe ingresar como paciente', 403);
        }
        return true;
    }
}