<?php

namespace app\models\medicamento;

use Yii;

/**
 * This is the model class for table "opt_prescripcion_med".
 *
 * @property string $id
 * @property string $idhistoriaclinica
 * @property string $idmedicamento
 * @property string $dosis
 * @property string $duracion
 * @property string $viaadministracion
 * @property string $unidades
 *
 * @property Historia $historiaclinica
 * @property Medicamento $medicamento
 */
class OptPrescripcionMed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_prescripcion_med';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idmedicamento', 'dosis', 'duracion', 'viaadministracion','unidades'], 'required'],
            [['idhistoriaclinica', 'idmedicamento'], 'integer'],
            [['dosis', 'duracion', 'viaadministracion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\model\medicamento', 'ID'),
            'idhistoriaclinica' => Yii::t('app\model\medicamento', 'historia clínica'),
            'idmedicamento' => Yii::t('app\model\medicamento', 'medicamento'),
            'dosis' => Yii::t('app\model\medicamento', 'dosis'),
            'duracion' => Yii::t('app\model\medicamento', 'duración'),
            'viaadministracion' => Yii::t('app\model\medicamento', 'via de administración y observaciones'),
            'unidades' => Yii::t('app\model\medicamento', 'unidades'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function gethistoriaclinica()
    {
        return $this->hasOne(Historia::className(), ['id' => 'idhistoriaclinica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getmedicamento()
    {
        return $this->hasOne(Medicamento::className(), ['id' => 'idmedicamento']);
    }
}
