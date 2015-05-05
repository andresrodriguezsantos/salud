<?php

namespace app\modules\admin\controllers;

use app\models\Noticias;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

class NoticiasController extends Controller
{
    public function actionIndex()
    {
        $noticias = new Noticias();
        if (Yii::$app->request->post()) {
            $noticias->load(\Yii::$app->request->post());
            $noticias->fecha = new Expression('NOW()');
            $noticias->picture = UploadedFile::getInstance($noticias, 'picture');
            if ($noticias->picture) {
                if (file_exists(Yii::$app->basePath . '/web/' . $noticias->urlimg))
                    $ruta = 'uploads/noticias/' . $noticias->picture->baseName . rand(0, 1000) . '.' . $noticias->picture->extension;
                $noticias->picture->saveAs($ruta);
                $noticias->urlimg = $ruta;
            }
            $noticias->estado = true;
            if ($noticias->save()) {
                $noticias = new Noticias();
                Yii::$app->session->setFlash('success', 'Noticia Guardada Correctamente');
                return $this->redirect(['index']);
            }
        }
        return $this->render('crear', [
            'noticia' => $noticias]);
    }

    public function actionAdmin()
    {
        $noticias = Noticias::find();
        $list = new ActiveDataProvider([
            'query' => $noticias,
        ]);
        return $this->render('admin', [
            'noticias' => $list
        ]);
    }

    public function actionEliminar($id)
    {
        $noticia = Noticias::findOne($id);
        if ($noticia != null) {
            if ($noticia->delete())
                Yii::$app->session->setFlash('success', 'Datos Eliminados Correctamente');
        }
        return $this->redirect(['admin']);
    }

    public function actionEditar($id)
    {
        $noticia = Noticias::findOne($id);
        if ($noticia != null) {
            if (Yii::$app->request->post()) {
                $noticia->load(\Yii::$app->request->post());
                //$noticia->fecha = date('NOW()');
                $noticia->picture = UploadedFile::getInstance($noticia, 'picture');
                if ($noticia->picture) {
                    if (file_exists(Yii::$app->basePath . '/web/' . $noticia->urlimg))
                        /* unlink(Yii::$app->basePath.'/web/'.$noticias->urlimg);*/
                        $ruta = 'uploads/noticias/' . $noticia->picture->baseName . rand(0, 1000) . '.' . $noticia->picture->extension;
                    $noticia->picture->saveAs($ruta);
                    $noticia->urlimg = $ruta;
                }
                if ($noticia->save()) {
                    Yii::$app->session->setFlash('success', 'Noticia Modificada Correctamente');
                }
            }
            return $this->render('editar', [
                    'noticia' => $noticia]
            );
        }
        //return throw new c

    }
}
