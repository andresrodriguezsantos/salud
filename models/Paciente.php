<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paciente".
 *
 * @property integer $id
 * @property string $fechanacimiento
 * @property string $ocupacion
 * @property string $fechaingreso
 * @property string $telefonocelular
 * @property string $nombreacudiente
 * @property string $telefonoacudiente
 * @property string $rh
 * @property string alergias
 * @property boolean $estado
 * @property integer $idusuario
 *
 * @property AfiliadoEps[] $afiliadoEps
 * @property Historia[] $historias
 * @property Usuario $usuario
 */
class Paciente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paciente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechanacimiento','telefonocelular'], 'required'],
            [['rh'],'required','on'=>'pac'],
            [['fechanacimiento', 'fechaingreso'], 'safe'],
            [['estado'], 'boolean'],
            [['idusuario'], 'integer'],
            [['ocupacion', 'telefonocelular', 'nombreacudiente', 'telefonoacudiente','rh'], 'string', 'max' => 250],
            [['alergias'],'string','max'=>500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fechanacimiento' => 'fecha de nacimiento',
            'ocupacion' => 'ocupación',
            'fechaingreso' => 'fecha de ingreso',
            'telefonocelular' => 'teléfono celular del acudiente',
            'nombreacudiente' => 'nombre del acudiente',
            'telefonoacudiente' => 'telefono fijo del acudiente',
            'rh'=>'tipo de sangre',
            'estado' => 'estado',
            'idusuario' => 'usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfiliadoEps()
    {
        return $this->hasMany(AfiliadoEps::className(), ['paciente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorias()
    {
        return $this->hasMany(Historia::className(), ['paciente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'idusuario']);
    }
}
