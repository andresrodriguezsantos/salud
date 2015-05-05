<?php

namespace app\models\search;


use app\models\Codigocie;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class searchCodigocie extends Codigocie{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params){
        $query = Codigocie::find();
        $data = new ActiveDataProvider([
            'query'=>$query
        ]);
        $query->orderBy('nombre');
        if(!($this->load($params) && $this->validate())){
            return $data;
        }
        $query->andFilterWhere(['like','nombre',$this->nombre]);
        return $data;
    }
}