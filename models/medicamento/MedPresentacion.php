<?php

namespace app\models\medicamento;

use Yii;

/**
 * This is the model class for table "med_presentacion".
 *
 * @property string $id
 * @property string $nombre
 * @property string $idlaboratorio
 * @property integer $estado
 *
 * @property MedPreMed[] $medPreMeds
 * @property Laboratorio $laboratorio
 */
class MedPresentacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'med_presentacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'idlaboratorio'], 'required'],
            [['idlaboratorio', 'estado'], 'integer'],
            [['nombre'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('presentacion medicamento', 'ID'),
            'nombre' => Yii::t('presentacion medicamento', 'presentación'),
            'idlaboratorio' => Yii::t('presentacion medicamento', 'laboratorio'),
            'estado' => Yii::t('presentacion medicamento', 'estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedPreMeds()
    {
        return $this->hasMany(MedPreMed::className(), ['idpresentacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getlaboratorio()
    {
        return $this->hasOne(Laboratorio::className(), ['id' => 'idlaboratorio']);
    }
}
