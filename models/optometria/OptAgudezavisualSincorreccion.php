<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_agudezavisual_sincorreccion".
 *
 * @property string $id
 * @property string $vl_derecho_snellen
 * @property string $vl_derecho_logmar
 * @property string $vl_izquierdo_snellen
 * @property string $vl_izquierdo_logmar
 * @property string $vl_ambos_snellen
 * @property string $vl_ambos_logmar
 * @property string $vp_derecho
 * @property string $vp_izquierdo
 * @property string $vp_ambos
 * @property string $opt_agudezavisual_id
 *
 * @property OptAgudezavisual $optAgudezavisual
 */
class OptAgudezavisualSincorreccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_agudezavisual_sincorreccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vl_derecho_snellen', 'vl_derecho_logmar', 'vl_izquierdo_snellen', 'vl_izquierdo_logmar', 'vl_ambos_snellen', 'vl_ambos_logmar', 'vp_derecho', 'vp_izquierdo', 'vp_ambos', 'opt_agudezavisual_id'], 'required'],
            [['opt_agudezavisual_id'], 'integer'],
            [['vl_derecho_snellen', 'vl_derecho_logmar', 'vl_izquierdo_snellen', 'vl_izquierdo_logmar', 'vl_ambos_snellen', 'vl_ambos_logmar', 'vp_derecho', 'vp_izquierdo', 'vp_ambos'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vl_derecho_snellen' => 'Visión lejana Ojo Derecho Snellen',
            'vl_derecho_logmar' => 'Visión lejana Ojo Derecho Logmar',
            'vl_izquierdo_snellen' => 'Visión lejana Ojo Izquierdo Snellen',
            'vl_izquierdo_logmar' => 'Visión lejana Ojo Izquierdo Logmar',
            'vl_ambos_snellen' => 'Visión lejana Ojo Ambos Snellen',
            'vl_ambos_logmar' => 'Visión lejana Ojo Ambos Logmar',
            'vp_derecho' => 'visión proxima ',
            'vp_izquierdo' => 'Visión proxima ojo izquierdo',
            'vp_ambos' => 'Vision Proxima Ambos',
            'opt_agudezavisual_id' => 'Opt Agudezavisual ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptAgudezavisual()
    {
        return $this->hasOne(OptAgudezavisual::className(), ['id' => 'opt_agudezavisual_id']);
    }
}
