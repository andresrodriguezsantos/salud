<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eps_cosultorio".
 *
 * @property string $id
 * @property string $nombre
 * @property string $direccion
 * @property string $idciudad
 * @property string $contacto
 * @property integer $estado
 *
 * @property AfiliadoEps[] $afiliadoEps
 * @property Profesional[] $profesionals
 * @property mixed ciudad
 */
class EpsCosultorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eps_cosultorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'idciudad','contacto'], 'required'],
            [['estado'], 'integer'],
            [['nombre', 'direccion', 'idciudad'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'nombre',
            'direccion' => 'dirección',
            'idciudad' => 'ciudad',
            'contacto'=>'datos de contacto',
            'estado' => 'estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfiliadoEps()
    {
        return $this->hasMany(AfiliadoEps::className(), ['eps_cosultorio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiudad()
    {
        return $this->hasOne(Ciudad::className(), ['id' => 'idciudad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfesional()
    {
        return $this->hasMany(Profesional::className(), ['idepsconsultorio' => 'id']);
    }
}
