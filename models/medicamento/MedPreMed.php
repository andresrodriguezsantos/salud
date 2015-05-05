<?php

namespace app\models\medicamento;

use Yii;

/**
 * This is the model class for table "med_pre_med".
 *
 * @property string $id
 * @property string $idmedicamento
 * @property string $idpresentacion
 *
 * @property Medicamento $medicamento
 * @property MedPresentacion $presentacion
 */
class MedPreMed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'med_pre_med';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idmedicamento', 'idpresentacion'], 'required'],
            [['idmedicamento', 'idpresentacion'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\model\medicamento', 'ID'),
            'idmedicamento' => Yii::t('app\model\medicamento', 'medicamento'),
            'idpresentacion' => Yii::t('app\model\medicamento', 'presentación'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamento()
    {
        return $this->hasOne(Medicamento::className(), ['id' => 'idmedicamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacion()
    {
        return $this->hasOne(MedPresentacion::className(), ['id' => 'idpresentacion']);
    }
}
