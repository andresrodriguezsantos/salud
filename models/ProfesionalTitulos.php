<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesional_titulos".
 *
 * @property string $id
 * @property string $idprofesional
 * @property string $nombre
 * @property string $universidad
 *
 * @property Profesional $profesional
 */
class ProfesionalTitulos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profesional_titulos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idprofesional', 'nombre', 'universidad'], 'required'],
            [['idprofesional'], 'integer'],
            [['nombre', 'universidad'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('profesional_titulos', 'ID'),
            'idprofesional' => Yii::t('profesional_titulos', 'profesional'),
            'nombre' => Yii::t('profesional_titulos', 'título obtenido'),
            'universidad' => Yii::t('profesional_titulos', 'institucion que otorga el título'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getprofesional()
    {
        return $this->hasOne(Profesional::className(), ['id' => 'idprofesional']);
    }
}
