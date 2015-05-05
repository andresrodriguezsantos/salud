<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_fondoscopia".
 *
 * @property integer $id
 * @property integer $idoptometria
 * @property string $odurlimg
 * @property string $oiurlimg
 * @property string $oddirecta
 * @property string $odindirecta
 * @property string $odobservacion
 * @property string $oidirecta
 * @property string $oiindirecta
 * @property string $oiobservacion
 */
class OptFondoscopia extends \yii\db\ActiveRecord
{
    public $odphoto;
    public $oiphoto;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_fondoscopia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odphoto','oiphoto'],'file','skipOnEmpty'=>false,'extensions'=>'jpg,png','on'=>'create'],
            [['idoptometria'], 'integer'],
            [['odurlimg', 'oiurlimg', 'oddirecta', 'odindirecta', 'odobservacion', 'oidirecta', 'oiindirecta', 'oiobservacion'], 'required','on'=>'create'],
            [['odurlimg', 'oiurlimg', 'oddirecta', 'odindirecta', 'odobservacion', 'oidirecta', 'oiindirecta', 'oiobservacion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('optfondoscopia', 'ID'),
            'idoptometria' => Yii::t('optfondoscopia', 'Idoptometria'),
            'odurlimg' => Yii::t('optfondoscopia', 'Imagen'),
            'oiurlimg' => Yii::t('optfondoscopia', 'Imagen'),
            'oddirecta' => Yii::t('optfondoscopia', 'Oftalmoscopía directa'),
            'odindirecta' => Yii::t('optfondoscopia', 'Oftalmoscopía indirecta'),
            'odobservacion' => Yii::t('optfondoscopia', 'Interpretación y observaciones'),
            'oidirecta' => Yii::t('optfondoscopia', 'Oftalmoscopía directa'),
            'oiindirecta' => Yii::t('optfondoscopia', 'Oftalmoscopía indirecta'),
            'oiobservacion' => Yii::t('optfondoscopia', 'Interpretación y observaciones'),
            'odphoto'=>'Imagen','oiphoto'=>'Imagen'
        ];
    }
}
