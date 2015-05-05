<?php
/**
 * @since 1.0.0
 */
namespace app\modules\admin\controllers;

use app\models\Areasalud;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;


class AreasaludController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ciudad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $area = new Areasalud();
        $lista = Areasalud::find()->all();
        if (Yii::$app->request->post()) {
            $area->load(Yii::$app->request->post());
            $area->estado = 1;
            if ($area->save())
                Yii::$app->session->setFlash('success', 'Area creada Correctamente');
        }
        return $this->render('form_areasalud', [
            'model' => $area,
            'lista' => $lista
        ]);
    }


}
