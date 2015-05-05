<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_agudezavisual_conph".
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
class OptAgudezavisualConph extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_agudezavisual_conph';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vl_derecho_snellen', 'vl_derecho_logmar', 'vl_izquierdo_snellen', 'vl_izquierdo_logmar',
                'vl_ambos_snellen', 'vl_ambos_logmar', 'vp_derecho', 'vp_izquierdo',
                'vp_ambos', 'opt_agudezavisual_id'], 'required','on'=>'create'],
            [['vl_derecho_logmar', 'vl_izquierdo_logmar', 'vl_ambos_logmar'], 'number'],
            [['opt_agudezavisual_id'], 'integer'],
            [['vl_derecho_snellen', 'vl_izquierdo_snellen', 'vl_ambos_snellen', 'vp_derecho', 'vp_izquierdo', 'vp_ambos'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vl_derecho_snellen' => 'Vl Derecho Snellen',
            'vl_derecho_logmar' => 'Vl Derecho Logmar',
            'vl_izquierdo_snellen' => 'Vl Izquierdo Snellen',
            'vl_izquierdo_logmar' => 'Vl Izquierdo Logmar',
            'vl_ambos_snellen' => 'Vl Ambos Snellen',
            'vl_ambos_logmar' => 'Vl Ambos Logmar',
            'vp_derecho' => 'Vp Derecho',
            'vp_izquierdo' => 'Vp Izquierdo',
            'vp_ambos' => 'Vp Ambos',
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
