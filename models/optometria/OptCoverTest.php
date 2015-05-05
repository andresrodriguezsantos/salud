<?php
/**
 * Created by PhpStorm.
 * User: jhon
 * Date: 8/01/15
 * Time: 09:45 PM
 */

namespace app\models\optometria;


use yii\base\Model;
use yii\helpers\Json;

class OptCoverTest extends Model{
    public $m6;
    public $m3;
    public $m1;
    public $cm50;
    public $cm30;
    public $cm20;
    public $cm10;

    /**
     * @return array
     */
    public function rules(){
        return [
            [['m6','m3','m1','cm50','cm30','cm20','cm10'],'required','on'=>'create']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(){
        return [
            'm6' => '6M',
            'm3' => '3M',
            'm1' => '1M',
            'cm50'=>'50Cm',
            'cm30'=>'30Cm',
            'cm20'=>'20Cm',
            'cm10'=>'10Cm'
        ];
    }

    /**
     * @return string
     */
    public function getJson(){
        return Json::encode($this);
    }

    /**
     * @param $string
     */
    public function parseJson($string){
        $this->load(Json::decode($string));
    }

    public function load($data){
        $this->m6 = $data['m6'];
        $this->m3 = $data['m3'];
        $this->m1 = $data['m1'];
        $this->cm50 = $data['cm50'];
        $this->cm30 = $data['cm30'];
        $this->cm20 = $data['cm20'];
        $this->cm10 = $data['cm10'];
    }
} 