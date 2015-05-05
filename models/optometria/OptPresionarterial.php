<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_presionarterial".
 *
 * @property string $id
 * @property string $idhistoriaclinica
 * @property string $odpresion
 * @property string $oipresion
 *
 * @property Optometria $idhistoriaclinica0
 */
class OptPresionarterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_presionarterial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idhistoriaclinica', 'odpresion', 'oipresion'], 'required'],
            [['idhistoriaclinica'], 'integer'],
            [['odpresion', 'oipresion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idhistoriaclinica' => 'Idhistoriaclinica',
            'odpresion' => 'Odpresion',
            'oipresion' => 'Oipresion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdhistoriaclinica0()
    {
        return $this->hasOne(Optometria::className(), ['id' => 'idhistoriaclinica']);
    }
}
