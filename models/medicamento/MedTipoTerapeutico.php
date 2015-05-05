<?php

namespace app\models\medicamento;

use Yii;

/**
 * This is the model class for table "med_tipo_terapeutico".
 *
 * @property string $id
 * @property string $nombre
 * @property integer $estado
 *
 * @property MedSubtipoTerapeutico[] $medSubtipoTerapeuticos
 */
class MedTipoTerapeutico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'med_tipo_terapeutico';
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
            'id' => Yii::t('app\model\medicamento', 'ID'),
            'nombre' => Yii::t('app\model\medicamento', 'nombre'),
            'estado' => Yii::t('app\model\medicamento', 'estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedSubtipoTerapeuticos()
    {
        return $this->hasMany(MedSubtipoTerapeutico::className(), ['idtipoterapeutico' => 'id']);
    }
}
