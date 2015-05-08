<?php
/**
 * Created by PhpStorm.
 * User: jhon
 * Date: 7/01/15
 * Time: 02:29 PM
 */

namespace app\shelper;


use app\models\optometria\OptAgudezavisualConcorreccion;
use app\models\optometria\OptAgudezavisualConph;
use app\models\optometria\OptAgudezavisualSincorreccion;
use app\models\optometria\OptCorneaQueratometria;
use app\models\optometria\OptCorneaTopografia;
use app\models\optometria\OptExamenexterno;
use app\models\optometria\OptFondoscopia;
use app\models\optometria\OptModuloAmplitudFlexibilidad;
use app\models\optometria\OptModuloVersionesducciones;
use app\models\optometria\Optometria;
use app\models\optometria\OptRetinoscopia;
use app\models\optometria\OptRxenuso;
use app\models\Permisohistoria;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

class OptometriaHel {

    /**
     * retorna la tabla de snellen
     * @return array
     */
    public static function getSnellen(){
        return [
            ''=>'Seleccione',
            '20/5'=>'20/5',
            '20/8'=>'20/8',
            '20/10'=>'20/10',
            '20/13'=>'20/13',
            '20/16'=>'20/16',
            '20/20'=>'20/20',
            '20/25'=>'20/25',
            '20/32'=>'20/32',
            '20/40'=>'20/40',
            '20/50'=>'20/50',
            '20/63'=>'20/63',
            '20/80'=>'20/80',
            '20/100'=>'20/100',
            '20/126'=>'20/126',
            '20/159'=>'20/159',
            '20/200'=>'20/200',
            '20/250'=>'20/250',
            '20/320'=>'20/320',
            '20/400'=>'20/400',
            '20/500'=>'20/500',
            '20/630'=>'20/630',
            '20/800'=>'20/800',
            '20/1000'=>'20/1000',
            '20/1250'=>'20/1250',
            '20/1600'=>'20/1600',
            '20/2000'=>'20/2000',
            'bultos'=>'bultos',
            'ppl'=>'ppl',
            'no ppl'=>'no ppl'
        ];
    }

    /**
     * @return array
     */
    public static function getVisionCuadro(){
        return [
            '0.50'=>'0.50M',
            '0.75'=>'0.75M',
            '1.25'=>'1.25M',
            '1.50'=>'1.50M',
            '1.75'=>'1.75M',
            '2.00'=>'2.00M',
            '2.00-'=>'2.00M-',
        ];
    }

    /**
     * @return array
     */
    public static function getTipoLente(){
        return [
            ''=>'Seleccione',
            'Monofocal'=>'Monofocal',
            'Bifocal'=>'Bifocal',
            'Progresivo'=>'Progresivo',
            'Lenticular'=>'Lenticular',
            'Alto índice'=>'Alto índice'
        ];
    }

    public static function getProximocontrol(){
        return [
            '2 días'=>'2 dias',
            '5 días'=>'5 dias',
            '1 semana'=>'1 semana',
            '15 días'=>'15 dias',
            '20 días'=>'20 dias',
            '1 mes'=>'1 mes',
            '2 meses'=>'2 meses',
            '3 meses'=>'3 meses',
            '6 meses'=>'6 meses',
            '1 año'=>'1 año'
        ];
    }

    /**
     * @param $optometria Optometria
     * @param bool $bool
     * @return OptCorneaQueratometria|boolean
     */
    public static function CCorneaQueratometria($optometria,$bool = false){
        $model = new OptCorneaQueratometria();
        if(($optometria->optCornea)){
            if(($optometria->optCornea->optCorneaQueratometria)){
                $model = $optometria->optCornea->optCorneaQueratometria;
                if($bool)
                    return true;
            }
        }
        if($bool){
            return false;
        }
        return $model;
    }

    /**
     * @param $optometria Optometria
     * @param bool $bool
     * @return OptCorneaTopografia|boolean
     */
    public static function CCorneaTopografia($optometria,$bool = false){
        $model = new OptCorneaTopografia();
        if(!empty($optometria->optCornea)){
            if(!empty($optometria->optCornea->optCorneaTopografia)){
                $model = $optometria->optCornea->optCorneaTopografia;
                if($bool)
                    return true;
            }
        }
        if($bool){
            return false;
        }
        return $model;
    }

    /**
     * @param $optometria Optometria - para comprovar si ya tiene o no fondoscopia
     * @param bool $bool en caso de que sea solicitado retornara true
     * en caso de que no exista optfondoscopia
     * retorna false si ya tiene optfondoscopia asignada
     *
     * @return OptFondoscopia|boolean
     */
    public static function CFondoscopia($optometria,$bool = false){
        $model = new OptFondoscopia();
        if(!empty($optometria->optFondoscopia)){
            $model = $optometria->optFondoscopia;
            if($bool)
                return true;
        }
        if($bool){
            return false;
        }
        return $model;
    }

    /**
     * @param $optometria Optometria
     * @param bool $bool si recibe este parametro devolvera true en caso de que
     * la optometria ya tenga OptModuloAmplitudFlexibilidad registrado | false caso contrario
     * @param array $array
     * @return OptModuloAmplitudFlexibilidad|boolean
     */

    public static function CMotorAmFl($optometria,$bool = false,$array = []){
        $model = new OptModuloAmplitudFlexibilidad($array);
        if(!empty($optometria->optModulooculomotor)){
            if(!empty($optometria->optModulooculomotor->optModuloAmplitudFlexibilidad)){
                if($bool){
                    return true;
                }
                $model = $optometria->optModulooculomotor->optModuloAmplitudFlexibilidad;
            }
        }
        if($bool){
            return false;
        }
        return $model;
    }

    /**
     * @param $optometria Optometria
     * @param bool $bool si recibe este parametro devolvera true en caso de que
     * la optometria ya tenga OptModuloVercionesDucciones registrado | false caso contrario
     * @return OptModuloVersionesducciones[]|boolean
     */
    public static function CMotorVerDuc($optometria,$bool = false){
        $models = [];
        if(!empty($optometria->optModulooculomotor)){
            if(!empty($optometria->optModulooculomotor->optModuloVersionesducciones)){
                if($bool){
                    return true;
                }
                $models = $optometria->optModulooculomotor->optModuloVersionesducciones;
            }
        }
        if($bool){
            return false;
        }
        return $models;
    }

    /**
     * @param $optometria Optometria
     * @param $tipo string
     * @param bool $bool
     * @return OptRetinoscopia|bool
     */
    public static  function CRetinoscopiaTipo($optometria, $tipo ,$bool = false){
        $models = $optometria->optRetinoscopias;
        foreach ($models as $key => $model) {
            if($model->tipo == $tipo){
                if($bool)
                    return true;
                else
                    return $model;
            }
        }
    }

    /**
     * @param $optometria Optometria
     * @param bool $bool
     * @return OptAgudezavisualConph|bool
     */
    public static function CAgConPh($optometria,$bool = false){
        $model = new OptAgudezavisualConph();
        if(!empty($optometria->optAgudezavisual->optAgudezavisualConph)){
            if($bool){
                return true;
            }
            $model = $optometria->optAgudezavisual->optAgudezavisualConph;
        }
        if($bool)
            return false;
        else
            return $model;
    }

    /**
     * @param $optometria Optometria
     * @param bool $bool
     * @return OptAgudezavisualConcorreccion|bool
     */
    public static function CAgConCorreccion($optometria,$bool = false){
        $model = new OptAgudezavisualConcorreccion();
        if(!empty($optometria->optAgudezavisual->optAgudezavisualConcorreccion)){
            if($bool)
                return true;
            $model = $optometria->optAgudezavisual->optAgudezavisualConcorreccion;
        }
        if($bool)
            return false;
        return $model;
    }


    /**
     * @param  $optometria Optometria
     * @param  bool $bool
     * @return  OptRxenuso|bool
     */
    public static function CRxEnUso($optometria,$bool = false){
        $model = new OptRxenuso();
        if(!empty($optometria->optRxenuso)){
            if($bool)
                return true;
            $model = $optometria->optRxenuso;
        }
        if($bool)
            return false;
        return $model;
    }

    /**
     * @param $optometria Optometria
     * @param bool $bool
     * @return bool|OptExamenexterno
     */
    public static function CBiomicroscopia($optometria,$bool = false){
        $model = new OptExamenexterno();
        if(!empty($optometria->optExamenexterno)){
            foreach($optometria->optExamenexterno as $examen){
                if($examen->tipo == 'biomicroscopia'){
                    $model = $examen;
                    if($bool)
                        return true;
                    return  $model;
                }
            }
        }
        if($bool)
            return false;
        return $model;
    }

    /**
     * @param $view View
     * @param $model Model
     * @param $attributeSnellen
     * @param $attributeLogmar
     */
    public static function SetSnellen($view,$model,$attributeSnellen,$attributeLogmar){
        $view->registerJs('$("#'.Html::getInputId($model,$attributeSnellen).'").snellen("#'
            .Html::getInputId($model,$attributeLogmar).'");',View::POS_READY);
    }

    /**
     * @param $object Optometria
      * @param $idemisor int id_profesional
     * @return bool
     * sirve para verificar la si el profesional
     * actual del sistema tiene permiso para ver la historia bloqueda por el
     * profesional dueño de la historia
     */
    public static function ChecPremision($object,$idemisor)
    {
        /** @var Permisohistoria $permiso */
        $permiso = Permisohistoria::findOne(['idprofesionalemisor'=>$idemisor,'optometria_id'=>$object->id,'estado'=>1,'aceptado'=>1]);
        if($permiso!= null and $permiso->aceptado){
            return true;
        }
        return false;
    }
} 