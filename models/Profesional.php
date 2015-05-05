<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesional".
 *
 * @property integer $id
 * @property string $registroprofesional
 * @property string $urlfoto
 * @property string $urlregistro
 * @property boolean $estado
 * @property integer $idusuario
 *
 * @property Historia[] $historias
 * @property PermisoHistoria[] $permisoHistorias
 * @property Usuario $usuario
 */
class Profesional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $picture;
    public $picture2;

    public static function tableName()
    {
        return 'profesional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['picture2','file','skipOnEmpty'=>true,'on'=>'update'],
            [['picture','picture2'], 'file','skipOnEmpty'  =>  false, 'on'=>'insert' ],
            [['registroprofesional', 'urlfoto', 'urlregistro', 'idusuario'], 'required'],
            [['estado'], 'boolean'],
            [['idusuario'], 'integer'],
            [['registroprofesional', 'urlfoto', 'urlregistro'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'registroprofesional' => 'No. registro profesional',
            'urlfoto' => 'imagen de perfil',
            'urlregistro' => 'imagen de registro profesional',
            'estado' => 'estado',
            'idusuario' => 'Idusuario',
            'idepsconsultorio' => 'Idepsconsultorio',
            'picture' => 'imagen de perfil',
            'picture2' => 'imagen de registro profesional'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorias()
    {
        return $this->hasMany(Historia::className(), ['profesional_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermisoHistorias()
    {
        return $this->hasMany(PermisoHistoria::className(), ['idprofesionalreceptor' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'idusuario']);
    }
}
