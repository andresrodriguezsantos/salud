<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permisohistoria".
 *
 * @property string $id
 * @property string $idprofesionalemisor
 * @property string $idprofesionalreceptor
 * @property string $fechasolicitud
 * @property integer $aceptado
 * @property integer $estado
 * @property string $nota
 * @property string $optometria_id
 *
 * @property Optometria $optometria
 * @property Profesional $idprofesionalemisor0
 * @property Profesional $idprofesionalreceptor0
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
            [['idprofesionalemisor', 'idprofesionalreceptor', 'fechasolicitud', 'aceptado', 'estado', 'nota', 'optometria_id'], 'required'],
            [['idprofesionalemisor', 'idprofesionalreceptor', 'aceptado', 'estado', 'optometria_id'], 'integer'],
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
            'idprofesionalreceptor' => 'profesional receptor',
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
    public function getIdprofesionalemisor0()
    {
        return $this->hasOne(Profesional::className(), ['id' => 'idprofesionalemisor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdprofesionalreceptor0()
    {
        return $this->hasOne(Profesional::className(), ['id' => 'idprofesionalreceptor']);
    }
}
