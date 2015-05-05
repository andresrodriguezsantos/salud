<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_retinoscopia".
 *
 * @property integer $id
 * @property integer $optometria_id
 * @property string $tipo
 * @property string $odesfera
 * @property string $odcilindro
 * @property string $odeje
 * @property string $odsnellenvl
 * @property string $odlogmarvl
 * @property string $odsnellenvp
 * @property string $odlogmarvp
 * @property string $oiesfera
 * @property string $oicilindro
 * @property string $oieje
 * @property string $oisnellenvl
 * @property string $oilogmarvl
 * @property string $oisnellenvp
 * @property string $oilogmarvp
 * @property string $ambossnellenvl
 * @property string $amboslogmarvl
 * @property string $ambossnellenvp
 * @property string $amboslogmarvp
 */
class OptRetinoscopia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_retinoscopia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['optometria_id', 'tipo', 'odesfera', 'odcilindro', 'odeje', 'odsnellenvl', 'odlogmarvl',
                'odsnellenvp', 'odlogmarvp', 'oiesfera', 'oicilindro', 'oieje', 'oisnellenvl', 'oilogmarvl',
                'oisnellenvp', 'oilogmarvp', 'ambossnellenvl', 'amboslogmarvl', 'ambossnellenvp', 'amboslogmarvp'], 'required','on'=>'create'],
            [['optometria_id'], 'integer'],
            [['tipo'], 'string', 'max' => 50],
            [['odesfera', 'odcilindro', 'odeje', 'odsnellenvl', 'odlogmarvl', 'odsnellenvp', 'odlogmarvp', 'oiesfera', 'oicilindro', 'oieje', 'oisnellenvl', 'oilogmarvl', 'oisnellenvp', 'oilogmarvp', 'ambossnellenvl', 'amboslogmarvl', 'ambossnellenvp', 'amboslogmarvp'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('optfondoscopia', 'ID'),
            'optometria_id' => Yii::t('optfondoscopia', 'Optometria ID'),
            'tipo' => Yii::t('optfondoscopia', 'Tipo'),
            'odesfera' => Yii::t('optfondoscopia', 'Esfera'),
            'odcilindro' => Yii::t('optfondoscopia', 'Cilindro'),
            'odeje' => Yii::t('optfondoscopia', 'Eje'),
            'odsnellenvl' => Yii::t('optfondoscopia', 'Agudeza Visual VL'),
            'odlogmarvl' => Yii::t('optfondoscopia', 'LogMAR'),
            'odsnellenvp' => Yii::t('optfondoscopia', 'Agudeza Visual VP'),
            'odlogmarvp' => Yii::t('optfondoscopia', 'LogMAR'),
            'oiesfera' => Yii::t('optfondoscopia', 'Esfera'),
            'oicilindro' => Yii::t('optfondoscopia', 'Cilindro'),
            'oieje' => Yii::t('optfondoscopia', 'Eje'),
            'oisnellenvl' => Yii::t('optfondoscopia', 'Agudeza Visual VL'),
            'oilogmarvl' => Yii::t('optfondoscopia', 'LogMAR'),
            'oisnellenvp' => Yii::t('optfondoscopia', 'Agudeza Visual VP'),
            'oilogmarvp' => Yii::t('optfondoscopia', 'LogMAR'),
            'ambossnellenvl' => Yii::t('optfondoscopia', 'Agudeza Visual VL'),
            'amboslogmarvl' => Yii::t('optfondoscopia', 'LogMAR'),
            'ambossnellenvp' => Yii::t('optfondoscopia', 'Agudeza Visual VP'),
            'amboslogmarvp' => Yii::t('optfondoscopia', 'LogMAR'),
        ];
    }
}
