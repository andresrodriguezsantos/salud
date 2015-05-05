<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_prescripcion".
 *
 * @property string $id
 * @property string $odadicion
 * @property string $oiadicion
 * @property string $distancians
 * @property string $optometriaid
 *
 * @property Optometria $optometria
 * @property OptPrescripcionTipo[] $optPrescripcionTipos
 */
class OptPrescripcion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_prescripcion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odadicion', 'oiadicion', 'distancians', 'optometriaid'], 'required'],
            [['odadicion', 'oiadicion'], 'number'],
            [['optometriaid'], 'integer'],
            [['distancians'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'odadicion' => 'Odadicion',
            'oiadicion' => 'Oiadicion',
            'distancians' => 'Distancians',
            'optometriaid' => 'Optometriaid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptometria()
    {
        return $this->hasOne(Optometria::className(), ['id' => 'optometriaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptPrescripcionTipos()
    {
        return $this->hasMany(OptPrescripcionTipo::className(), ['opt_prescripcion_id' => 'id']);
    }
}
