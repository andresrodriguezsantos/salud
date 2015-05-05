<?php

namespace app\models;

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
            [['codigo'],'unique'],
            [['codigo', 'nombre', 'definicionprofesional', 'definicionpaciente'], 'required'],
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
            'codigo' => 'código CIE',
            'nombre' => 'diagnóstico',
            'definicionprofesional' => 'definición',
            'definicionpaciente' => 'reseña para el paciente',
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
