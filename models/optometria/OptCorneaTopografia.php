<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_cornea_topografia".
 *
 * @property string $id
 * @property string $idcornea
 *
 * @property string $oiobservacion
 * @property string $oiurlimg
 * @property string $odobservacion
 * @property string $odurlimg
 *
 * @property OptCornea $idcornea0
 */
class OptCorneaTopografia extends \yii\db\ActiveRecord
{
    public $odphoto;
    public $oiphoto;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_cornea_topografia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odphoto','oiphoto'],'file','skipOnEmpty'=>true, 'extensions'=>'jpg,png','on'=>'create'],
            [['odobservacion','oiobservacion'], 'required','on'=>'create'],
            [['idcornea'], 'integer'],
            [['oiurlimg', 'oiobservacion','odobservacion', 'odurlimg'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idcornea' => 'Idcornea',
            'oiurlimg' => 'Ojo Izquierdo Imagen',
            'odobservacion' => 'Interpretación y observaciones',
            'oiobservacion' => 'Interpretación y observaciones',
            'odurlimg' => 'Ojo Derecho Imagen',
            'odphoto' => 'Imagen',
            'oiphoto' => 'Imagen'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdcornea0()
    {
        return $this->hasOne(OptCornea::className(), ['id' => 'idcornea']);
    }
}
