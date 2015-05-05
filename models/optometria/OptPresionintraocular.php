<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_presionintraocular".
 *
 * @property string $id
 * @property string $idhistoriaclinica
 * @property string $derechopresion
 * @property string $izquierdopresion
 *
 * @property Optometria $idhistoriaclinica0
 */
class OptPresionintraocular extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_presionintraocular';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idhistoriaclinica', 'derechopresion', 'izquierdopresion'], 'required'],
            [['idhistoriaclinica'], 'integer'],
            [['derechopresion', 'izquierdopresion'], 'string', 'max' => 250]
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
            'derechopresion' => 'Derechopresion',
            'izquierdopresion' => 'Izquierdopresion',
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
