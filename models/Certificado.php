<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "certificado".
 *
 * @property integer $id
 * @property string $historia_id
 * @property string $tipo
 * @property integer $consecutivo
 * @property string $campos
 * @property string $fecha
 *
 * @property Historia $historia
 */
class Certificado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'certificado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['historia_id', 'tipo', 'consecutivo', 'campos'], 'required'],
            [['historia_id', 'consecutivo'], 'integer'],
            [['campos'], 'string'],
            [['fecha'], 'safe'],
            [['tipo'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'historia_id' => 'Historia ID',
            'tipo' => 'Tipo',
            'consecutivo' => 'Consecutivo',
            'campos' => 'Campos',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoria()
    {
        return $this->hasOne(Historia::className(), ['id' => 'historia_id']);
    }
}
