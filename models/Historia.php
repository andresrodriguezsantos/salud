<?php

namespace app\models;

use app\models\optometria\Optometria;
use Yii;

/**
 * This is the model class for table "historia".
 *
 * @property string $id
 * @property string $fecha
 * @property string $paciente_id
 * @property integer profesional_id
 * @property mixed model
 *
 * @property Paciente $paciente
 * @property Profesional $profesional
 * @property mixed $object
 */
class Historia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paciente_id'], 'required'],
            [['id', 'paciente_id', 'profesional_id'], 'integer'],
            [['fecha'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'fecha',
            'paciente_id' => 'paciente',
            'profesional_id' => 'profesional',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaciente()
    {
        return $this->hasOne(Paciente::className(), ['id' => 'paciente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfesional()
    {
        return $this->hasOne(Profesional::className(), ['id' => 'profesional_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasMany($this->model, ['historia_id' => 'id'])->one();
    }
}
