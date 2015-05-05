<?php

namespace app\modules\admin\controllers;

use app\models\medicamento\MedSubtipoTerapeutico;
use app\models\medicamento\MedTipoTerapeutico;
use app\models\search\SearchSubtipoMedicamento;
use app\models\search\SearchTipoMedicamento;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\Response;

class MedicamentoController extends Controller
{

    public function actionIndex()
    {
        $tipo = new MedTipoTerapeutico;
        $subtipo = new MedSubtipoTerapeutico;
        $listsubtiposearch = new SearchSubtipoMedicamento();
        // busquedas para el filtro de tipos terapueticos
        $listasubtipo = $listsubtiposearch->search(Yii::$app->request->queryParams);
        $listtiposearch = new SearchTipoMedicamento();
        $listatipo = $listtiposearch->search(Yii::$app->request->queryParams);
        // crear tipos terapeuticos
        if (isset($_POST['MedTipoTerapeutico'])) {
            $tipo = MedTipoTerapeutico::findOne(['nombre' => $_POST['MedTipoTerapeutico']['nombre']]);
            if ($tipo == null) {
                $tipo = new MedTipoTerapeutico();
                $tipo->load(Yii::$app->request->post());
                if ($tipo->save())
                    $tipo = new MedTipoTerapeutico();
                Yii::$app->session->setFlash('success', 'Type Registered Correctly');
            } else {
                Yii::$app->session->setFlash('danger', 'Tipo Terapeutico ya se encuentra registrado');
            }
        }
        // creacion de subtipos terapeuticos
        if (Yii::$app->request->get('id'))
            $subtipo = MedSubtipoTerapeutico::findOne(Yii::$app->request->get('id'));
        if (isset($_POST['MedSubtipoTerapeutico'])) {
            $subtipo->load(Yii::$app->request->post());
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($subtipo);
            }
            if (Yii::$app->request->isPost) {
                if ($subtipo->save())
                    Yii::$app->session->setFlash('success', 'Subtype Registered Correctly');
            }
        }

        return $this->render('index', [
            'tipo' => $tipo,
            'subtipo' => $subtipo,
            'listasubtipo' => $listasubtipo,
            'listsubtiposearch' => $listsubtiposearch,
            'listatipo' => $listatipo,
            'listtiposearch' => $listtiposearch
        ]);
    }

    public function actionDeletetipo()
    {
        if (Yii::$app->request->get('id'))
            /** @var $pre MedTipoTerapeutico */
            $tipo = MedTipoTerapeutico::findOne(['id' => Yii::$app->request->get('id')]);
        if ($tipo != null)
            $tipo->estado = 0;
        $subtipo = MedSubtipoTerapeutico::find()
            ->where(['idtipoterapeutico' => $tipo->id
            ])->all();
        if ($subtipo != null)
            foreach ($subtipo as $sub) {
                $sub->estado = 0;
                $sub->update();
            }
        if ($tipo->update()) {
            Yii::$app->session->setFlash('info', 'Deleted data correctly');
        }
        return $this->redirect('index');
    }

    public function actionDeletesubtipo()
    {
        $pre = MedSubtipoTerapeutico::findOne(Yii::$app->request->get('id'));
        if ($pre != null) {
            $pre->estado = 0;
            $pre->update();
            Yii::$app->session->setFlash('info', 'Deleted data correctly');
            return $this->redirect('index');
        }
    }

    public function actionLiketablasubtipo()
    {
        if (Yii::$app->request->get('dato')) {
            $subtipo = MedSubtipoTerapeutico::find()
                ->where(['LIKE', 'nombre', Yii::$app->request->get('dato')])
                ->orderBy('nombre')
                ->limit('15')
                ->all();
        } else {
            $subtipo = MedSubtipoTerapeutico::find()
                ->orderBy('nombre')
                ->limit('15')
                ->all();
        }
        if ($subtipo != null) {
            $tabla = "";
            /** @var $s MedSubtipoTerapeutico */
            foreach ($subtipo as $s) {
                $activo = "Inactivo";
                if ($s->estado == 1)
                    $activo = 'Activo';
                $tabla .=
                    '<tr id="' . $s->idtipoterapeutico . '">' .
                    '<td>' . $s->nombre . '</td>' .
                    '<td>' . $s->gettipoterapeutico()->one()->nombre . '</td>' .
                    '<td>' . $activo . '</td>' .
                    '<td>';
                if ($s->estado == 1)
                    $tabla .= '<button class="btn btn-success btn-addsubtipo" value="' . $s->id . '"><i class="fa-plus glyphicon glyphicon-check"></i>Add item</button>';
                else
                    $tabla .= '<button class="btn btn-success btn-addsubtipo" disabled value="' . $s->id . '"><i class="fa-plus glyphicon glyphicon-check"></i>Add item</button>';
                $tabla .= '<button class="btn btn-primary btn-editsubtipo" value="' . $s->id . '"><i class="fa-plus glyphicon glyphicon-edit"></i>Edit item</button>
                            <button class="btn btn-danger btn-removesubtipo" value="' . $s->id . '"><i class="fa-plus glyphicon glyphicon-remove"></i>Delete item</button>
                        </td>' .
                    '</tr>';
            }
            return Json::encode($tabla);
        }
    }

    public function actionLiketablatipo()
    {
        if (Yii::$app->request->get('dato')) {
            $subtipo = MedTipoTerapeutico::find()
                ->where(['LIKE', 'nombre', Yii::$app->request->get('dato')])
                ->orderBy('nombre')
                ->limit('15')
                ->all();
        } else {
            $subtipo = MedTipoTerapeutico::find()
                ->orderBy('nombre')
                ->limit('15')
                ->all();
        }
        if ($subtipo != null) {
            $tabla = "";
            /** @var $s MedTipoTerapeutico */
            foreach ($subtipo as $s) {
                $activo = "Inactivo";
                if ($s->estado == 1)
                    $activo = 'Activo';
                $tabla .=
                    '<tr id=' . $s->id . '>' .
                    '<td>' . $s->nombre . '</td>' .
                    '<td>' . $activo . '</td>' .
                    '<td>';
                $tabla .= '<button class="btn btn-primary btntipoedit" value="' . $s->id . '"><i class="fa-plus glyphicon glyphicon-edit"></i>Edit item</button>
                         <button class="btn btn-danger btntiporemove" value="' . $s->id . '"><i class="fa-plus glyphicon glyphicon-remove"></i>Delete item</button>
                        </td>' .
                    '</tr>';
            }
            return Json::encode($tabla);
        }
    }

    public function actionLikesubtipo()
    {
        if (Yii::$app->request->get('dato')) {
            $subtipo = MedSubtipoTerapeutico::find()
                ->where(['LIKE', 'nombre', Yii::$app->request->get('dato')])
                ->limit('10')
                ->orderBy('nombre')
                ->all();
            if ($subtipo != null) {
                $tabla = "";
                /** @var $s MedSubtipoTerapeutico */
                foreach ($subtipo as $s) {
                    $tabla .=
                        '<tr id="' . $s->idtipoterapeutico . '">' .
                        '<td>' . $s->nombre . '</td>' .
                        '<td>' . $s->tipoterapeutico->nombre . '</td>' .
                        '<td><i class="glyphicon glyphicon-edit"></i></td>' .
                        '</tr>';
                }
                return Json::encode($tabla);
            }
        }
    }

    public function actionLiketipo()
    {
        if (Yii::$app->request->get('dato')) {
            $tipo = MedtipoTerapeutico::find()
                ->where(['LIKE', 'nombre', Yii::$app->request->get('dato')])
                ->limit('5')
                ->orderBy('nombre')
                ->all();
            if ($tipo != null) {
                $tabla = "";
                /** @var $s MedtipoTerapeutico */
                foreach ($tipo as $s) {
                    $tabla .=
                        '<tr id="' . $s->id . '">' .
                        '<td>' . $s->nombre . '</td>' .
                        '<td><button class=" btn btn-success btn-xs btn_filtro_select">Select</button></td>' .
                        '</tr>';
                }
                return Json::encode($tabla);
            }
        }
    }


}