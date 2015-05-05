<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_prescripcion_tipo".
 *
 * @property string $id
 * @property string $opt_prescripcion_id
 * @property string $tipo
 * @property string $odesfera
 * @property string $odcilindro
 * @property integer $odeje
 * @property string $odsnellen
 * @property string $odlogmar
 * @property string $oiesfera
 * @property string $oicilindro
 * @property integer $oieje
 * @property string $oisnellen
 * @property string $oilogmar
 * @property string $ambossnellen
 * @property string $amboslogmar
 *
 * @property OptPrescripcion $optPrescripcion
 */
class OptPrescripcionTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_prescripcion_tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['opt_prescripcion_id', 'tipo', 'odesfera', 'odcilindro', 'odeje', 'odsnellen', 'odlogmar', 'oiesfera', 'oicilindro', 'oieje', 'oisnellen', 'oilogmar', 'ambossnellen'], 'required'],
            [['opt_prescripcion_id', 'odeje', 'oieje'], 'integer'],
            [['odesfera', 'odcilindro', 'odlogmar', 'oiesfera', 'oicilindro', 'oilogmar', 'amboslogmar'], 'number'],
            [['tipo'], 'string', 'max' => 250],
            [['odsnellen', 'oisnellen', 'ambossnellen'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'opt_prescripcion_id' => 'Opt Prescripcion ID',
            'tipo' => 'Tipo',
            'odesfera' => 'Odesfera',
            'odcilindro' => 'Odcilindro',
            'odeje' => 'Odeje',
            'odsnellen' => 'Odsnellen',
            'odlogmar' => 'Odlogmar',
            'oiesfera' => 'Oiesfera',
            'oicilindro' => 'Oicilindro',
            'oieje' => 'Oieje',
            'oisnellen' => 'Oisnellen',
            'oilogmar' => 'Oilogmar',
            'ambossnellen' => 'Ambossnellen',
            'amboslogmar' => 'Amboslogmar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptPrescripcion()
    {
        return $this->hasOne(OptPrescripcion::className(), ['id' => 'opt_prescripcion_id']);
    }
}
