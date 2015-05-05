<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_control".
 *
 * @property integer $id
 * @property integer $optometria_id
 * @property string $nota
 * @property string $urlimg
 * @property string $proveedor
 * @property string $fecha
 *
 * @property Optometria $optometria
 */
class OptControl extends \yii\db\ActiveRecord
{
    public $pic;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_control';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pic'], 'safe'],
            [['pic'], 'file', 'extensions'=>'jpg, gif, png','maxFiles' => 10],
            [['optometria_id', 'nota', 'urlimg','fecha','proveedor'], 'required'],
            [['optometria_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('notas del paciente', 'ID'),
            'pic'=>Yii::t('app','imagenes'),
            'optometria_id' => Yii::t('notas del paciente', 'Optometria ID'),
            'nota' => Yii::t('notas del paciente', 'Nota'),
            'urlimg' => Yii::t('notas del paciente', 'Urlimg'),
            'proveedor' => Yii::t('notas del paciente', 'Nota agregada por:'),
            'fecha' => Yii::t('notas del paciente', 'Fecha'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptometria()
    {
        return $this->hasOne(Optometria::className(), ['id' => 'optometria_id']);
    }
}
