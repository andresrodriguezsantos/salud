<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesional_eps".
 *
 * @property string $id
 * @property string $id_eps
 * @property string $id_profesional
 * @property string $idprofesion
 * @property string $horarioentrada
 * @property string $horariosalida
 * @property integer $estado
 *
 * @property EpsCosultorio $eps
 * @property Profesional $idProfesional
 * @property Profesion $profesion
 */
class ProfesionalEps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profesional_eps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_eps', 'id_profesional', 'idprofesion'], 'required'],
            [['id_eps', 'id_profesional', 'idprofesion', 'estado'], 'integer'],
            [['horarioentrada', 'horariosalida'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\models\pais', 'ID'),
            'id_eps' => Yii::t('app\models\pais', 'EPS'),
            'id_profesional' => Yii::t('app\models\pais', 'profesional'),
            'idprofesion' => Yii::t('app\models\pais', 'profesión'),
            'horarioentrada' => Yii::t('app\models\pais', 'horario de ingreso'),
            'horariosalida' => Yii::t('app\models\pais', 'horario de salida'),
            'estado' => Yii::t('app\models\pais', 'estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEps()
    {
        return $this->hasOne(EpsCosultorio::className(), ['id' => 'id_eps']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProfesional()
    {
        return $this->hasOne(Profesional::className(), ['id' => 'id_profesional']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getprofesion()
    {
        return $this->hasOne(Profesion::className(), ['id' => 'idprofesion'])->one();
    }

}
