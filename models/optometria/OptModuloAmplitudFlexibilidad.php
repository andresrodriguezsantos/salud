<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_modulo_amplitud_flexibilidad".
 *
 * @property string $id
 *
 * @property string $derechoamplitud
 * @property string $izquierdoamplitud
 * @property string $derechoflexibilidad
 * @property string $izquierdoflexibilidad
 *
 * @property string $covertest
 * @property string $ppc_or
 * @property string $ppc_fr
 * @property string $ppc_disociado
 * @property string $rfp_vl
 * @property string $rfp_vp
 * @property string $rfn_vl
 * @property string $rfn_vp
 * @property string $idmodulooculomotor
 *
 * @property OptModulooculomotor $modulooculomotor
 */
class OptModuloAmplitudFlexibilidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_modulo_amplitud_flexibilidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['derechoamplitud', 'izquierdoamplitud',
                'derechoflexibilidad', 'izquierdoflexibilidad', 'covertest',
                'ppc_or', 'ppc_fr', 'ppc_disociado', 'rfp_vl','rfp_vp', 'rfn_vl','rfn_vp'], 'required','on'=>'create'],
            [['idmodulooculomotor'], 'integer'],
            [['derechoamplitud', 'izquierdoamplitud', 'derechoflexibilidad', 'izquierdoflexibilidad', 'covertest', 'ppc_or', 'ppc_fr', 'ppc_disociado', 'rfp_vl', 'rfp_vp', 'rfn_vl','rfn_vp'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'derechoamplitud' => 'Amplitud acomodativa',
            'izquierdoamplitud' => 'Amplitud acomodativa',
            'derechoflexibilidad' => 'Flexibilidad acomodativa',
            'izquierdoflexibilidad' => 'Flexibilidad acomodativa',
            'covertest' => 'Covertest',
            'ppc_or' => 'OR (Objeto Real)',
            'ppc_fr' => 'FR (Filtro Rojo)',
            'ppc_disociado' => 'Disociado',
            'rfp_vl' => 'Vision Lejana',
            'rfp_vp' => 'Vision Proxima',
            'rfn_vl' => 'Vision Lejana',
            'rfn_vp' => 'Vision Proxima',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulooculomotor()
    {
        return $this->hasOne(OptModulooculomotor::className(), ['id' => 'idmodulooculomotor']);
    }
}
