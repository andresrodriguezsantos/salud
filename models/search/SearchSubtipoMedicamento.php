<?php
/**
 * Created by PhpStorm.
 * User: Andres R S
 * Date: 23/01/2015
 * Time: 7:42 PM
 */

namespace app\models\search;


use app\models\medicamento\MedSubtipoTerapeutico;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SearchSubtipoMedicamento extends MedSubtipoTerapeutico{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params){
        $query = MedSubtipoTerapeutico::find();
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