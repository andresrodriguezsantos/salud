<?php

namespace app\models\optometria;
use app\models\Historia;
use app\models\Permisohistoria;
use Yii;

/**
 * This is the model class for table "optometria".
 *
 * @property string $id
 * @property string $motivoconsulta
 * @property string $antecedentefamiliar
 * @property string $antecedentepersonal
 * @property integer $estado
 * @property string $tipo
 * @property string $disposicion
 * @property string $proxcontrol
 * @property string $historia_id
 *
 *
 * @property OptAgudezavisual $optAgudezavisual
 * @property OptCornea $optCornea
 * @property OptDiagnostico[] $optDiagnostico
 * @property OptExamenexterno[] $optExamenexterno
 * @property OptFondoscopia $optFondoscopia
 * @property OptModulooculomotor $optModulooculomotor
 * @property OptPrescripcion[] $optPrescripcion
 * @property OptPresionarterial[] $optPresionarterial
 * @property OptPresionintraocular[] $optPresionintraocular
 * @property OptRetinoscopia[] $optRetinoscopias
 * @property OptRxenuso $optRxenuso
 * @property Historia $historia
 * @property Permisohistoria[] $permisohistorias
 * @property OptControl[] $controles
 */
class Optometria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'optometria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['motivoconsulta', 'estado', 'tipo','historia_id','proxcontrol'], 'required'],
            [['estado', 'historia_id'], 'integer'],
            [['motivoconsulta', 'antecedentefamiliar', 'antecedentepersonal'], 'string', 'max' => 500],
            [['tipo', 'disposicion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'motivoconsulta' => 'Motivo de consulta',
            'antecedentefamiliar' => 'Antecedente familiar',
            'antecedentepersonal' => 'Antecedente personal',
            'estado' => 'Estado',
            'tipo' => 'Tipo',
            'disposicion' => 'Disposición',
            'proxcontrol'=>'Próximo control',
            'historia_id' => 'Historia ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptAgudezavisual()
    {
        return $this->hasMany(OptAgudezavisual::className(), ['optometria_id' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptCornea()
    {
        return $this->hasMany(OptCornea::className(), ['optometria_id' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptDiagnostico()
    {
        return $this->hasMany(OptDiagnostico::className(), ['optometria_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptExamenexterno()
    {
        return $this->hasMany(OptExamenexterno::className(), ['id_optometria' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptFondoscopia()
    {
        return $this->hasMany(OptFondoscopia::className(), ['idoptometria' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptModulooculomotor()
    {
        return $this->hasMany(OptModulooculomotor::className(), ['optometria_id' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptPrescripcions()
    {
        return $this->hasMany(OptPrescripcion::className(), ['optometriaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptPresionarterial()
    {
        return $this->hasMany(OptPresionarterial::className(), ['idhistoriaclinica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptPresionintraocular()
    {
        return $this->hasMany(OptPresionintraocular::className(), ['idhistoriaclinica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptRetinoscopias()
    {
        return $this->hasMany(OptRetinoscopia::className(), ['optometria_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptRxenuso()
    {
        return $this->hasMany(OptRxenuso::className(), ['optometria_id' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoria()
    {
        return $this->hasOne(Historia::className(), ['id' => 'historia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermisohistorias()
    {
        return $this->hasMany(Permisohistoria::className(), ['optometria_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControles(){
        return $this->hasMany(OptControl::className(),['optometria_id'=>'id']);
    }
}

