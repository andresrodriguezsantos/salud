<?php

namespace app\models;

use app\models\laboratorio\LabUsuario;
use app\rules\LabUserLab;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $cedula
 * @property string $email
 * @property string $direccion
 * @property string $username
 * @property string $telefonofijo
 * @property string $telefonocelular
 * @property string $password
 * @property integer $idciudad
 * @property integer $idtipodocumento
 * @property integer $pin
 * @property string $access_token
 *
 * @property String $idpais
 *
 * @property Paciente $paciente
 * @property Profesional $profesional
 * @property Ciudad $ciudad
 * @property Tipodocumento $idtipodocumento0
 * @property mixed authKey
 * @property LabUsuario labuser
 */
class Usuario extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $idpais;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email','idpais','nombres', 'apellidos', 'cedula', 'telefonocelular', 'idciudad'],'required','on'=>'pro'],
            [['cedula'],'validaCedula'],
            [['email'],'unique'],
            [['idpais','nombres', 'apellidos', 'cedula', 'telefonocelular', 'idciudad'], 'required','on'=>'insert'],
            [['idciudad', 'idtipodocumento'], 'integer'],
            [['pin'],'integer'],
            [['nombres', 'apellidos', 'cedula', 'email', 'direccion', 'telefonofijo', 'telefonocelular', 'password'], 'string', 'max' => 250],
            [['password_reset_token', 'access_token'], 'string', 'max' => 45]
        ];
    }

    public function validaCedula(){
        $user = Usuario::findBySql('SELECT usuario.* FROM `usuario`,`ciudad`,`departamento`,`pais` WHERE usuario.idciudad = ciudad.id'.'
        and ciudad.departamento_id = departamento.id
        and departamento.idpais = pais.id
        and pais.id = :idpais and usuario.cedula = :cedula',[':idpais'=>$this->idpais,':cedula'=>$this->cedula])->all();
        if($user != null){
            $this->addError('cedula',Yii::t('user','El numero de Identificacion ya se encuentra Registrado'));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'nombres',
            'apellidos' => 'apellidos',
            'cedula' => 'No. identificacion',
            'email' => 'email de usuario',
            'direccion' => 'dirección',
            'telefonofijo' => 'teléfono fijo',
            'telefonocelular' => 'teléfono celular',
            'password' => 'contraseña',
            'idciudad' => 'ciudad',
            'idpais' => 'país',
            'idtipodocumento' => 'Tipo de documento',
            'pin'=>'PIN',
            'password_reset_token' => 'Password Reset Token',
            'access_token' => 'Access Token',
        ];
    }

    public function getLabuser(){
        return $this->hasMany(LabUsuario::className(),['idusuario'=>'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaciente()
    {
        return $this->hasMany(Paciente::className(), ['idusuario' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfesional()
    {
        return $this->hasMany(Profesional::className(), ['idusuario' => 'id'])->limit(1)->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiudad()
    {
        return $this->hasOne(Ciudad::className(), ['id' => 'idciudad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdtipodocumento()
    {
        return $this->hasOne(Tipodocumento::className(), ['id' => 'idtipodocumento']);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsename($username)
    {
        return static::findOne(['email'=>$username]);
    }

    public function validatePassword($password){
        return Yii::$app->getSecurity()->validatePassword($password,$this->password);
    }
    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token'=>$token]);
        //iregularidad
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        if (!empty($this->authKey)) {
            return $this->authKey;
        }
        return null;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authKey = Yii::$app->getSecurity()->generateRandomString();
            }
            return true;
        }
        return false;
    }
}
