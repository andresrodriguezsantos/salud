<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paciente_control".
 *
 * @property string $id
 * @property string $historia_id
 * @property string $notas
 * @property string $urlimg
 *
 * @property Historia $historia
 */
class PacienteControl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $picture;

    public static function tableName()
    {
        return 'paciente_control';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['picture','file'],
            //['picture','file','skipOnEmpty'=>true,'on'=>'update'],
            [['historia_id', 'notas'], 'required'],
            [['historia_id'], 'integer'],
            [['notas'], 'string', 'max' => 500],
            [['urlimg'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('notas del paciente', 'ID'),
            'historia_id' => Yii::t('notas del paciente', 'historia'),
            'notas' => Yii::t('notas del paciente', 'nota del paciente'),
            'urlimg' => Yii::t('notas del paciente', 'ruta de imagen'),
            'picture' => 'imagen de perfil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoria()
    {
        return $this->hasOne(Historia::className(), ['id' => 'historia_id']);
    }
}
