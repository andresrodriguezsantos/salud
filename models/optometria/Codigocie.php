<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "codigocie".
 *
 * @property string $id
 * @property string $codigo
 * @property string $nombre
 * @property string $definicionprofesional
 * @property string $definicionpaciente
 * @property integer $estado
 *
 * @property OptDiagnostico[] $optDiagnosticos
 */
class Codigocie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'codigocie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'definicionprofesional', 'definicionpaciente', 'estado'], 'required'],
            [['estado'], 'integer'],
            [['codigo', 'nombre'], 'string', 'max' => 250],
            [['definicionprofesional', 'definicionpaciente'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'definicionprofesional' => 'Definicionprofesional',
            'definicionpaciente' => 'Definicionpaciente',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptDiagnosticos()
    {
        return $this->hasMany(OptDiagnostico::className(), ['codigoCIE_id' => 'id']);
    }
}
