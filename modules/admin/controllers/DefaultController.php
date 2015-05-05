<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{


    public function actionIndex()
    {
        $searchModel = ['pais', 'Departamento', 'Ciudad'];
        return $this->render('index', [$searchModel]);
    }
}