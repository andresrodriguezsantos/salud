<?php
/**
 * Created by PhpStorm.
 * User: jhon
 * Date: 19/03/15
 * Time: 09:57 AM
 */

namespace app\modules\paciente\controllers;


use app\models\Historia;
use app\models\Paciente;
use app\models\PacienteControl;
use app\models\Usuario;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class HistoriaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'addnota', 'index'
                        ],
                        'allow' => true,
                        'roles' => ['Profesional']
                    ],
                ]
            ]
        ];
    }

    public function actionIndex($id)
    {
        $paciente = Paciente::findOne($id);
        $query = Historia::find()
            ->where('paciente_id = :id', ['id' => $paciente->id])
            ->orderBy('fecha desc');
        $historias = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('historia', [
            'paciente' => $paciente,
            'historias' => $historias
        ]);
    }

    public function actionAddnota($id)
    {
        $paciente = Paciente::findOne($id);
        $pacientecontrol = new PacienteControl();
        if ($pacientecontrol->load(\Yii::$app->request->post()) and $pacientecontrol->validate(['notas'])) {
            /** @var Usuario $user */
            $user = \Yii::$app->user->identity;
            $historia = new Historia([
                'paciente_id' => $paciente->id,
                'profesional_id' => $user->profesional->id,
                'model' => PacienteControl::className(),
                'fecha' => new Expression('now()')
            ]);
            $historia->save();
            $pacientecontrol->picture = UploadedFile::getInstance($pacientecontrol, 'picture');
            $ruta = "";
            if ($pacientecontrol->picture) {
                $ruta = 'uploads/control/' . rand(0, 999999999) . '.' . $pacientecontrol->picture->extension;
                $pacientecontrol->urlimg = $ruta;
            }
            $pacientecontrol->historia_id = $historia->id;
            if ($pacientecontrol->save()) {
                if ($pacientecontrol->picture) {
                    $pacientecontrol->picture->saveAs($ruta);
                }
                \Yii::$app->session->setFlash('success', 'Nota agregada correctamente');
                return $this->redirect(['/paciente/home/historia', 'id' => $paciente->id]);
            }
        }
        return $this->render('form_nota', [
            'paciente' => $paciente,
            'control' => $pacientecontrol
        ]);
    }
}