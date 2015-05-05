<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_modulooculomotor".
 *
 * @property string $id
 * @property string $optometria_id
 *
 * @property OptModuloAmplitudFlexibilidad $optModuloAmplitudFlexibilidad
 * @property OptModuloVersionesducciones[] $optModuloVersionesducciones
 * @property Optometria $optometria
 */
class OptModulooculomotor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_modulooculomotor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['optometria_id'], 'required'],
            [['optometria_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'optometria_id' => 'Optometria ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptModuloAmplitudFlexibilidad()
    {
        return $this->hasMany(OptModuloAmplitudFlexibilidad::className(), ['idmodulooculomotor' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptModuloVersionesducciones()
    {
        return $this->hasMany(OptModuloVersionesducciones::className(), ['idmodulooculomotor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptometria()
    {
        return $this->hasOne(Optometria::className(), ['id' => 'optometria_id']);
    }
}
