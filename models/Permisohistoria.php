<?php

namespace app\models;

use app\models\optometria\Optometria;
use Yii;

/**
 * This is the model class for table "permisohistoria".
 *
 * @property string $id
 * @property string $idprofesionalemisor
 * @property string $
 * @property string $fechasolicitud
 * @property integer $aceptado
 * @property integer $estado
 * @property string $nota
 * @property string $optometria_id
 *
 * @property Optometria $optometria
 * @property Profesional $profesionalemisor
 */
class Permisohistoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permisohistoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idprofesionalemisor', 'fechasolicitud', 'aceptado', 'estado', 'nota', 'optometria_id'], 'required'],
            [['idprofesionalemisor', 'aceptado', 'estado', 'optometria_id'], 'integer'],
            [['fechasolicitud'], 'safe'],
            [['nota'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idprofesionalemisor' => 'profesional emisor',
            'fechasolicitud' => 'fecha de solicitud',
            'aceptado' => 'aceptado',
            'estado' => 'estado',
            'nota' => 'nota',
            'optometria_id' => 'optometría',
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
    public function getProfesionalemisor()
    {
        return $this->hasOne(Profesional::className(), ['id' => 'idprofesionalemisor']);
    }
}
