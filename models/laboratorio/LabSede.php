<?php

namespace app\models\laboratorio;

use app\models\Ciudad;
use Yii;

/**
 * This is the model class for table "lab_sede".
 *
 * @property string $id
 * @property string $idciudad
 * @property string $idlaboratorio
 * @property integer $estado
 *
 * @property Ciudad $ciudad
 * @property Laboratorio $laboratorio
 * @property LabUsuario[] $labUsuarios
 */
class LabSede extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_sede';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idciudad', 'idlaboratorio'], 'required'],
            [['idciudad', 'idlaboratorio', 'estado'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('laboratorio', 'ID'),
            'idciudad' => Yii::t('laboratorio', 'ciudad'),
            'idlaboratorio' => Yii::t('laboratorio', 'laboratorio'),
            'estado' => Yii::t('laboratorio', 'estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getciudad()
    {
        return $this->hasOne(Ciudad::className(), ['id' => 'idciudad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getlaboratorio()
    {
        return $this->hasOne(Laboratorio::className(), ['id' => 'idlaboratorio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabUsuarios()
    {
        return $this->hasMany(LabUsuario::className(), ['idlaboratoriosede' => 'id']);
    }
}
