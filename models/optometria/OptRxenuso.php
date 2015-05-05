<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_rxenuso".
 *
 * @property integer $id
 * @property string $odesfera
 * @property string $odcilindro
 * @property string $odeje
 * @property string $oddip
 * @property string $odadd
 * @property string $oddm
 * @property string $oiesfera
 * @property string $oicilindro
 * @property string $oieje
 * @property string $oidip
 * @property string $oiadd
 * @property string $oidm
 * @property string $odobservacion
 * @property string $oiobservacion
 * @property string $tipodelente
 * @property integer $optometria_id
 */
class OptRxenuso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_rxenuso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odesfera', 'odcilindro', 'odeje', 'oddip', 'odadd', 'oddm', 'oiesfera', 'oicilindro',
                'oieje', 'oidip', 'oiadd', 'oidm', 'odobservacion', 'oiobservacion','tipodelente'], 'required','on'=>'create'],
            [['optometria_id'], 'integer'],
            [['odesfera', 'odcilindro', 'odeje', 'oiesfera', 'oicilindro', 'oieje'], 'string', 'max' => 5],
            [['oddip', 'odadd', 'oddm', 'oidip', 'oiadd', 'oidm', 'odobservacion', 'oiobservacion','tipodelente'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('optometria', 'ID'),
            'odesfera' => Yii::t('optometria', 'Esfera'),
            'odcilindro' => Yii::t('optometria', 'Cilindro'),
            'odeje' => Yii::t('optometria', 'Eje'),
            'oddip' => Yii::t('optometria', 'dip'),
            'odadd' => Yii::t('optometria', 'add'),
            'oddm' => Yii::t('optometria', 'dm'),
            'oiesfera' => Yii::t('optometria', 'Esfera'),
            'oicilindro' => Yii::t('optometria', 'Cilindro'),
            'oieje' => Yii::t('optometria', 'Eje'),
            'oidip' => Yii::t('optometria', 'dip'),
            'oiadd' => Yii::t('optometria', 'add'),
            'oidm' => Yii::t('optometria', 'dm'),
            'odobservacion' => Yii::t('optometria', 'OD. Observaciones'),
            'oiobservacion' => Yii::t('optometria', 'OI. Observaciones'),
            'tipodelente' => Yii::t('optometria', 'Tipo de Lente'),
            'optometria_id' => Yii::t('optometria', 'Optometria ID'),
        ];
    }
}
