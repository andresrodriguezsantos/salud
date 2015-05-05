<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_cornea_queratometria".
 *
 * @property string $id
 * @property string $odesfera
 * @property string $odcilindro
 * @property string $odeje
 *
 * @property string $oioesfera
 * @property string $oicilindro
 * @property string $oieje
 * @property string $hc_cornea_id
 *
 * @property OptCornea $hcCornea
 */
class OptCorneaQueratometria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_cornea_queratometria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odesfera', 'odcilindro', 'odeje', 'oioesfera', 'oicilindro', 'oieje'], 'required','on'=>'create'],
            [['hc_cornea_id'], 'integer'],
            [['odesfera', 'odcilindro', 'odeje', 'oioesfera', 'oicilindro', 'oieje'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'odesfera' => 'Meridiano plano',
            'odcilindro' => 'Meridiano curvo',
            'odeje' => 'Eje',
            'oioesfera' => 'Meridiano plano',
            'oicilindro' => 'Meridiano curvo',
            'oieje' => 'Eje',
            'hc_cornea_id' => 'Hc Cornea ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHcCornea()
    {
        return $this->hasOne(OptCornea::className(), ['id' => 'hc_cornea_id']);
    }
}
