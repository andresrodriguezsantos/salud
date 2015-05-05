<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_diagnostico".
 *
 * @property integer $id
 * @property string $nominacion
 * @property string $ojo
 * @property string $optometria_id
 * @property string $codigoCIE_id
 *
 * @property Codigocie $codigoCIE
 * @property Optometria $optometria
 */
class OptDiagnostico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_diagnostico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nominacion', 'optometria_id', 'codigoCIE_id','ojo'], 'required','on'=>'create'],
            [['optometria_id', 'codigoCIE_id'], 'integer'],
            [['nominacion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nominacion' => 'Diagnostico Nominacion',
            'ojo'=>'ojo',
            'optometria_id' => 'Optometria',
            'codigoCIE_id' => 'Diagnostico Codigo CIE-10',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoCIE()
    {
        return $this->hasOne(Codigocie::className(), ['id' => 'codigoCIE_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptometria()
    {
        return $this->hasOne(Optometria::className(), ['id' => 'optometria_id']);
    }
}
