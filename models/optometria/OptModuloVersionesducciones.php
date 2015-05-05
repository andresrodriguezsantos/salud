<?php

namespace app\models\optometria;

use Yii;

/**
 * This is the model class for table "opt_modulo_versionesducciones".
 *
 * @property string $id
 * @property string $idmodulooculomotor
 * @property string $tipo
 * @property string $urlimg
 * @property string $observacion
 *
 * @property OptModulooculomotor $modulo
 */
class OptModuloVersionesducciones extends \yii\db\ActiveRecord
{
    public $photo;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opt_modulo_versionesducciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo'],'file','skipOnEmpty'=>false,'extensions'=>'jpg,png','on'=>'create'],
            [['tipo', 'urlimg', 'observacion'], 'required','on'=>'create'],
            [['idmodulooculomotor'], 'integer'],
            [['tipo', 'urlimg', 'observacion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idmodulooculomotor' => 'Idmodulooculomotor',
            'tipo' => 'Tipo',
            'urlimg' => 'Urlimg',
            'photo'=>'Imagen',
            'observacion' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulo()
    {
        return $this->hasOne(OptModulooculomotor::className(), ['id' => 'idmodulooculomotor']);
    }
}
