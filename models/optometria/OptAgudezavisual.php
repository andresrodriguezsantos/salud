<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_agudezavisual".
 *
 * @property string $id
 * @property string $optometria_id
 *
 * @property Optometria $optometria
 * @property OptAgudezavisualConcorreccion $optAgudezavisualConcorreccion
 * @property OptAgudezavisualConph $optAgudezavisualConph
 * @property OptAgudezavisualSincorreccion $optAgudezavisualSincorreccion
 */
class OptAgudezavisual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_agudezavisual';
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
    public function getOptometria()
    {
        return $this->hasOne(Optometria::className(), ['id' => 'optometria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptAgudezavisualConcorreccion()
    {
        return $this->hasMany(OptAgudezavisualConcorreccion::className(), ['opt_agudezavisual_id' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptAgudezavisualConph()
    {
        return $this->hasMany(OptAgudezavisualConph::className(), ['opt_agudezavisual_id' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptAgudezavisualSincorreccion()
    {
        return $this->hasMany(OptAgudezavisualSincorreccion::className(), ['opt_agudezavisual_id' => 'id'])->one();
    }
}
