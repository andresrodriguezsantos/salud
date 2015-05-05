<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "afiliado_eps".
 *
 * @property string $id
 * @property string $tipo
 * @property string $clasificacion
 * @property string $afiliacion
 * @property boolean $estado
 * @property string $eps_cosultorio_id
 * @property string $paciente_id
 *
 * @property EpsCosultorio $epsCosultorio
 * @property Paciente $paciente
 */
class AfiliadoEps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'afiliado_eps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'clasificacion', 'afiliacion', 'eps_cosultorio_id', 'paciente_id'], 'required'],
            [['eps_cosultorio_id', 'paciente_id'], 'integer'],
            [['tipo', 'clasificacion', 'afiliacion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'tipo',
            'clasificacion' => 'clasificación',
            'afiliacion' => 'afiliación',
            'estado' => 'estado',
            'eps_cosultorio_id' => 'EPS consultorio',
            'paciente_id' => 'paciente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpsCosultorio()
    {
        return $this->hasOne(EpsCosultorio::className(), ['id' => 'eps_cosultorio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaciente()
    {
        return $this->hasOne(Paciente::className(), ['id' => 'paciente_id']);
    }
}
