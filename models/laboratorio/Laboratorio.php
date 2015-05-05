<?php

namespace app\models\laboratorio;

use Yii;

/**
 * This is the model class for table "laboratorio".
 *
 * @property string $id
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property string $contacto
 * @property string $email
 * @property string $nota
 * @property string $nit
 * @property integer $publicidad
 * @property integer $estado
 *
 * @property LabSede[] $labSedes
 * @property Medicamento[] $medicamentos
 */
class Laboratorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'laboratorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'],'unique'],
            [['nombre', 'direccion', 'telefono', 'contacto', 'email', 'nota','nit'], 'required'],
            [['publicidad', 'estado'], 'integer'],
            [['nit'],'string','max'=>50],
            [['nombre', 'direccion', 'telefono', 'contacto', 'email'], 'string', 'max' => 250],
            [['nota'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('laboratorio', 'ID'),
            'nombre' => Yii::t('laboratorio', 'nombre del laboratorio'),
            'nit'=>Yii::t('laboratorio', 'NIT'),
            'direccion' => Yii::t('laboratorio', 'dirección'),
            'telefono' => Yii::t('laboratorio', 'teléfono'),
            'contacto' => Yii::t('laboratorio', 'contacto encargado'),
            'email' => Yii::t('laboratorio', 'correo electrónico'),
            'nota' => Yii::t('laboratorio', 'nota'),
            'publicidad' => Yii::t('laboratorio', 'publicidad'),
            'estado' => Yii::t('laboratorio', 'estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabSedes()
    {
        return $this->hasMany(LabSede::className(), ['idlaboratorio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentos()
    {
        return $this->hasMany(Medicamento::className(), ['idlaboratorio' => 'id']);
    }
}
