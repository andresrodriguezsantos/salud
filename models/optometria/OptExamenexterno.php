<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_examenexterno".
 *
 * @property string $id
 * @property string $id_optometria
 * @property string $tipo
 * @property string $odobservacion
 * @property string $odurlimg
 * @property string $oiobservacion
 * @property string $oiurlimg
 *
 * @property Optometria $idOptometria
 */
class OptExamenexterno extends \yii\db\ActiveRecord
{
    public $odphoto;
    public $oiphoto;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_examenexterno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odphoto','oiphoto'],'file','skipOnEmpty'=>true,'extensions'=>'jpg,png','on'=>'create'],
            [['id_optometria',  'tipo', 'odobservacion', 'odurlimg', 'oiobservacion', 'oiurlimg'], 'required','on'=>'create'],
            [['id_optometria'], 'integer'],
            [['tipo', 'odobservacion', 'odurlimg', 'oiobservacion', 'oiurlimg'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_optometria' => 'Id Optometria',
            'tipo' => 'Tipo',
            'odobservacion' => 'Interpretación y observaciones',
            'odurlimg' => 'Imagen',
            'odphoto'=>'Imagen',
            'oiobservacion' => 'Interpretación y observaciones',
            'oiurlimg' => 'Imagen',
            'oiphoto'=>'Imagen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOptometria()
    {
        return $this->hasOne(Optometria::className(), ['id' => 'id_optometria']);
    }
}
