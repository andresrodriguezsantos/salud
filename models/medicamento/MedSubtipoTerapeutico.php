<?php

namespace app\models\medicamento;

use Yii;

/**
 * This is the model class for table "med_subtipo_terapeutico".
 *
 * @property string $id
 * @property string $idtipoterapeutico
 * @property string $nombre
 * @property integer $estado
 *
 * @property MedTipoTerapeutico $tipoterapeutico
 * @property Medicamento[] $medicamentos
 */
class MedSubtipoTerapeutico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'med_subtipo_terapeutico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'],'uniquebytype'],
            [['idtipoterapeutico', 'nombre'], 'required'],
            [['idtipoterapeutico', 'estado'], 'integer'],
            [['nombre'], 'string', 'max' => 250]
        ];
    }

    public function Uniquebytype(){
        $fin = static::find()->filterWhere([
            'nombre'=>$this->nombre,
            'idtipoterapeutico'=>$this->idtipoterapeutico])
            ->one();
        if($fin!=null){
            $this->addError('nombre','nombre ya registrado');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\model\medicamento', 'ID'),
            'idtipoterapeutico' => Yii::t('app\model\medicamento', ''),
            'nombre' => Yii::t('app\model\medicamento', 'nombre'),
            'estado' => Yii::t('app\model\medicamento', 'estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoterapeutico()
    {
        return $this->hasOne(MedTipoTerapeutico::className(), ['id' => 'idtipoterapeutico']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentos()
    {
        return $this->hasMany(Medicamento::className(), ['idsubtipoterapeutico' => 'id']);
    }
}
