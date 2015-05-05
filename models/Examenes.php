<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "examenes".
 *
 * @property string $id
 * @property integer $idareasalud
 * @property string $nombre
 * @property string $tipo
 *
 * @property Areasalud $areasalud
 */
class Examenes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'examenes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idareasalud', 'nombre', 'tipo'], 'required'],
            [['idareasalud'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['tipo'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idareasalud' => 'Idareasalud',
            'nombre' => 'Nombre',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getareasalud()
    {
        return $this->hasOne(Areasalud::className(), ['id' => 'idareasalud']);
    }
}
