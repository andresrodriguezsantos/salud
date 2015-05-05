<?php
/**
 * @since 1.0.0
 */
namespace app\modules\optometria\controllers;

use app\models\Certificado;
use app\models\Historia;
use app\models\medicamento\OptPrescripcionMed;
use mPDF;
use Yii;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use kartik\mpdf\Pdf;
use yii\web\HttpException;


class CertificadosController extends Controller
{


    public function actionIndex($id)
    {
        $page = 'textoconsulta';
        $certificado = new Certificado();
        $historia = Historia::findOne($id);
        return $this->render('menu', [
            'page' => $page,
            'historia' => $historia,
            'certificado' => $certificado
        ]);
    }

    public function actionConsulta($id, $tipo)
    {
        $page = '';
        $historia = Historia::findOne($id);
        if ($historia != null) {
            $certificado = new Certificado();
            if ($tipo == 'consulta')
                $page = 'textoconsulta';
            if ($tipo == 'incapacidad')
                $page = 'textoincapacidad';
            if ($tipo == 'libre')
                $page = 'textolibre';
            if ($tipo == 'remision')
                $page = 'textoremitir';
            if($tipo == 'examen' || $tipo== 'examen especializado')
                $page = 'examenes';
            if($tipo=='consentimientoinformado')
                $page='textoconsentimientoinformado';
            if($tipo=='ciclopegia')
                $page='textociclopegia';
            if($tipo=='historia')
                $page='textoresumenhc';

            return $this->render('menu', [
                'historia' => $historia,
                'page' => $page,
                'certificado' => $certificado
            ]);
        } else
            throw new HttpException(404, 'Pagina no encontrada');
    }

    public function actionPdf1()
    {
        $mpdf = new mPDF();
        $html = $this->renderPartial('textoprueba');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    public function actionPdf($id)
    {
        /** @var Historia $historia */
        $historia = Historia::findOne($id);
        $certificado = new Certificado();
        if ($historia != null) {
            $certificado->load(Yii::$app->request->post());
            /** @var Certificado $lastcert */
            $lastcert = Certificado::find()
                ->leftJoin('historia', 'certificado.historia_id = historia.id')
                ->leftJoin('profesional', 'historia.profesional_id = profesional.id')
                ->limit(1)
                ->orderBy('id desc')
                ->where('profesional.id = :id', [':id' => 1])
                ->one();
            if ($lastcert != null)
                $certificado->consecutivo = $lastcert->consecutivo + 1;
            else
                $certificado->consecutivo = 1;

            $certificado->fecha = new Expression('NOW()');
            $certificado->historia_id = $historia->id;
            $page = "";
            if ($certificado->tipo == 'consulta')
                $page = 'textoconsulta';
            if($certificado->tipo=='incapacidad')
                $page = 'textoincapacidad';
            if($certificado->tipo == 'libre')
                $page = 'textolibre';
            if($certificado->tipo == 'examen')
                $page = 'textoexamenes';
            if($certificado->tipo == 'examen especializado')
                $page = 'textoexamenespecializado';
            if($certificado->tipo == 'remision')
                $page = 'textoremitir';
            if($certificado->tipo =='consentimientoinformado')
                $page='textoconsentimientoinformado';
            if($certificado->tipo =='ciclopegia')
                $page='textociclopegia';
            if($certificado->tipo == 'historia')
                $page = 'textoresumenhc';

            $content = $this->renderPartial($page, [
                'historia' => $historia,
                'certificado' => $certificado
            ]);
            $certificado->campos = Json::encode($certificado->campos);
            $certificado->save();
            Yii::getAlias('@web/adminlte/css/AdminLTE.css');
            $pdf = new  Pdf([
                'methods'=>[
                    'setHeader'=>'<h4 style="color: #909090"> Dr. '.$historia->profesional->usuario->nombres.' '.
                        $historia->profesional->usuario->apellidos.'</h4><br/>
                    <p style="margin-top: -20px; color: #909090">Numero de Serie : '.$historia->profesional->registroprofesional.'-'.
                        $certificado->consecutivo.'</p> ||'
                        .Html::img(Yii::getAlias('@web/img/logo.jpg'),['style'=>'width: 300px']),
                    'setFooter'=>''
                ],
                'content' => $content,
                'marginTop'=>40
            ]);
            return $pdf->render();
        }
        return new HttpException(404,'Pagina no encontrada!');
    }

    public function actionPrescribiranteojos($id){
        $historia = Historia::findOne($id);
        return  $this->render('prescripcionanteojos',[
            'historia'=>$historia
        ]);
    }

    public function actionGenerarprescripcion($id)
    {
        /** @var OptPrescripcionMed $medicamentos */
        $medicamentos = OptPrescripcionMed::find()
            ->where(['idhistoriaclinica' => $id])
            ->all();
        $historia = Historia::findOne($id);
        $certificado = new Certificado();
        /** @var Certificado $lastcert */
        $lastcert = Certificado::find()
            ->leftJoin('historia', 'certificado.historia_id = historia.id')
            ->leftJoin('profesional', 'historia.profesional_id = profesional.id')
            ->limit(1)
            ->orderBy('id desc')
            ->where('profesional.id = :id', [':id' => 1])
            ->one();
        if ($lastcert != null) {
            $certificado->consecutivo = $lastcert->consecutivo + 1;
        } else {
            $certificado->consecutivo = 1;
        }
        $certificado->fecha = new Expression('NOW()');
        $certificado->historia_id = $historia->id;
        //$certificado->historia_id = $medicamentos->historiaclinica->id;

        $content = $this->renderPartial('prescripcionmedicamentos', [
            'historia' => $historia,
            'medicamentos'=>$medicamentos
        ]);
        $certificado->campos = Json::encode($certificado->campos);
        $certificado->save();

        Yii::getAlias('@web/adminlte/css/AdminLTE.css');
        $pdf = new  Pdf(['methods' => ['setHeader' => '<h4 style="color: #909090"> Dr. ' . $historia->profesional->usuario->nombres . ' ' .
            $historia->profesional->usuario->apellidos . '</h4><br/>
                            <p style="margin-top: -20px; color: #909090">Numero de Serie : ' . $historia->profesional->registroprofesional . '-' .
            $certificado->consecutivo . '</p> ||'
            . Html::img(Yii::getAlias('@web/img/logo.jpg'), ['style' => 'width: 300px']),
            'setFooter' => ''],
            'content' => $content,
            'marginTop' => 40]);
        return $pdf->render();
    }

}
