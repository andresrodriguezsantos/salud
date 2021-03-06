<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "areasalud".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $estado
 */
class Areasalud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areasalud';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['estado'], 'integer'],
            [['nombre'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('area_salud', 'ID'),
            'nombre' => Yii::t('area_salud', 'nombre'),
            'estado' => Yii::t('area_salud', 'estado'),
        ];
    }
}
