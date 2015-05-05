<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_cornea".
 *
 * @property string $id
 * @property string $optometria_id
 *
 * @property Optometria $optometria
 * @property OptCorneaQueratometria $optCorneaQueratometria
 * @property OptCorneaTopografia $optCorneaTopografia
 */
class OptCornea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_cornea';
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
    public function getOptCorneaQueratometria()
    {
        return $this->hasMany(OptCorneaQueratometria::className(), ['hc_cornea_id' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptCorneaTopografia()
    {
        return $this->hasMany(OptCorneaTopografia::className(), ['idcornea' => 'id'])->one();
    }
}
