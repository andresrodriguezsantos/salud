<?php

namespace app\models\medicamento;

use app\models\laboratorio\Laboratorio;
use Yii;

/**
 * This is the model class for table "medicamento".
 *
 * @property integer $id
 * @property integer $idsubtipoterapeutico
 * @property integer $idlaboratorio
 * @property integer idareasalud
 * @property string $nombrecomercial
 * @property string $composicion
 * @property string $descripcion
 * @property string $urlimg
 * @property integer $estado
 *
 * @property MedSubtipoTerapeutico $subtipoterapeutico
 * @property Laboratorio $laboratorio
 * @property MedPreMed $presentaciones
 * @property MedPreMed $areasalud
 */
class Medicamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medicamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsubtipoterapeutico', 'idlaboratorio', 'nombrecomercial', 'composicion', 'descripcion'], 'required'],
            [['idsubtipoterapeutico', 'idlaboratorio','idareasalud', 'estado'], 'integer'],
            [['nombrecomercial', 'composicion', 'descripcion', 'urlimg'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('optfondoscopia', 'ID'),
            'idsubtipoterapeutico' => Yii::t('optfondoscopia', 'subtipo terapéutico'),
            'idlaboratorio' => Yii::t('optfondoscopia', 'laboratorio'),
            'nombrecomercial' => Yii::t('optfondoscopia', 'nombre comercial'),
            'composicion' => Yii::t('optfondoscopia', 'composición'),
            'descripcion' => Yii::t('optfondoscopia', 'descripción'),
            'urlimg' => Yii::t('optfondoscopia', 'Urlimg'),
            'estado' => Yii::t('optfondoscopia', 'estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubtipoterapeutico()
    {
        return $this->hasOne(MedSubtipoTerapeutico::className(), ['id' => 'idsubtipoterapeutico']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratorio()
    {
        return $this->hasOne(Laboratorio::className(), ['id' => 'idlaboratorio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentaciones(){
        return $this->hasMany(MedPreMed::className(),['idmedicamento' => 'id']);
    }

    public function getAreasalud(){
        return $this->hasMany(Areasalud::className(),['id' => 'idareasalud']);
    }
}
