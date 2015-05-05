<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property string $id
 * @property string $titulo
 * @property string $mensaje
 * @property string $anexos
 * @property string $fecha
 * @property string $urlimg
 * @property integer $estado
 */
class Noticias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $picture;
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['picture'], 'file','extensions' => 'jpg, jpeg, png','skipOnEmpty'  =>  false,'on'=>'insert'],
            [['titulo', 'mensaje', 'anexos', 'fecha', 'urlimg'], 'required'],
            [['fecha'], 'safe'],
            [['estado'], 'integer'],
            [['titulo', 'anexos', 'urlimg'], 'string', 'max' => 250],
            [['mensaje'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'mensaje' => 'Mensaje',
            'anexos' => 'Anexos',
            'fecha' => 'Fecha',
            'urlimg' => 'Ruta imagen',
            'picture' => 'imagen de noticia',
            'estado'=>'Visible / No visible'
        ];
    }
}
