<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property string $id
 * @property string $nombre
 *
 * @property Departamento[] $departamentos
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('pais', 'ID'),
            'nombre' => Yii::t('pais', 'país'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentos()
    {
        return $this->hasMany(Departamento::className(), ['idpais' => 'id']);
    }
}
