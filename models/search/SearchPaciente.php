<?php

namespace app\models\search;

use app\models\Paciente;
use app\models\Usuario;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class SearchPaciente extends Paciente
{
    public $typo;
    public $valor;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado', 'historia_id'], 'integer'],
            [['motivoconsulta', 'antecedentefamiliar', 'antecedentepersonal', 'tipo', 'disposicion'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributeLabels(){
        return [
            'typo'=>'Selecione para filtrar',
            'valor'=>'valor a buscar'
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        /** @var $identity Usuario */
        $query = Paciente::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->leftJoin('usuario','paciente.idusuario = usuario.id');
        if($params != null){
            $this->valor = $params['SearchPaciente']['valor'];
            if(isset($params['SearchPaciente']['typo'])) {
                $this->typo = $params['SearchPaciente']['typo'];
                if ($this->typo == 1) {
                    $query->filterWhere(['like', 'usuario.nombres', trim($this->valor)])
                        ->orFilterWhere(['like', 'usuario.apellidos', trim($this->valor)]);
                } else {
                    $query->filterWhere(['like', 'usuario.cedula', trim($this->valor)]);
                }
            }
        }else{
            return $dataProvider;
        }

        return $dataProvider;
    }
}
