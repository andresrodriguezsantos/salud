<?php

namespace app\models\laboratorio;

use app\models\Usuario;
use Yii;

/**
 * This is the model class for table "lab_usuario".
 *
 * @property string $id
 * @property string $idusuario
 * @property string $idlaboratoriosede
 * @property string $cargo
 *  @property string $rol
 * @property string $email
 * @property integer $estado
 *
 * @property Usuario $usuario
 * @property LabSede $laboratoriosede
 */
class LabUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idusuario', 'idlaboratoriosede', 'cargo', 'email'], 'required'],
            [['idusuario', 'idlaboratoriosede', 'estado'], 'integer'],
            [['cargo', 'email','rol'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('laboratorio', 'ID'),
            'idusuario' => Yii::t('laboratorio', 'usuario'),
            'idlaboratoriosede' => Yii::t('laboratorio', 'sede'),
            'cargo' => Yii::t('laboratorio', 'cargo del usuario'),
            'email' => Yii::t('laboratorio', 'correo electrónico'),
            'rol' => Yii::t('laboratorio', 'rol'),
            'estado' => Yii::t('laboratorio', 'estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getusuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getlaboratoriosede()
    {
        return $this->hasOne(LabSede::className(), ['id' => 'idlaboratoriosede']);
    }
}
