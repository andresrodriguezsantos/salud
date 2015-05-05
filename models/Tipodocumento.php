<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipodocumento".
 *
 * @property integer $id
 * @property string $descripcion
 * @property boolean $estado
 *
 * @property Usuario[] $usuarios
 */
class Tipodocumento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipodocumento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['estado'], 'boolean'],
            [['descripcion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'descripción',
            'estado' => 'estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idtipodocumento' => 'id']);
    }
}
