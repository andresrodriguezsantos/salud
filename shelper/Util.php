<?php
/**
 * Created by PhpStorm.
 * User: Andres RS
 * Date: 02/03/2015
 * Time: 5:23 PM
 */

namespace app\shelper;


class Util
{


    public static function edad($fecha_de_nacimiento)
    {
        if (is_string($fecha_de_nacimiento)) {
            $fecha_de_nacimiento = strtotime($fecha_de_nacimiento);
        }
        $diferencia_de_fechas = time() - $fecha_de_nacimiento;
        return round($diferencia_de_fechas / (60 * 60 * 24 * 365)) . " Años";
    }

}