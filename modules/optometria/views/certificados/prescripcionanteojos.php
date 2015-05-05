<?php
use app\shelper\Util;

?>

<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">PRESCRIPCION OPTTICA</h3>
        </div>
        <div class="box-body">
            <p align="justify" style="font-size: 16px">

            <p style="text-align: center">
                <?= /** @var \app\models\Historia $historia */
                'Paciente: ' . $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos
                . '- IDE: ' . $historia->paciente->usuario->cedula . ' - Edad: ' . Util::edad($historia->paciente->fechanacimiento)
                . ' - Contacto: ' . $historia->paciente->usuario->telefonocelular
                . ' Email: ' . $historia->paciente->usuario->email
                ?>
            </p>
            <label for="">FORMULA OPTICA</label>
            <?= Yii::$app->controller->renderPartial('tablaformulamedica') ?>
            <br>
            <label for="">REFERENCIAS DEL DISPOSTIVO MEDICO (LENTES OFTALMICOS)</label>
            <?= Yii::$app->controller->renderPartial('tabladispositivomedico') ?>
            <br/>
            <label for=""> OBSERVACIONES E INDICACIONES HORARIAS </label>
            <?= \yii\helpers\Html::textarea('', '', ['class' => 'form-control', 'rows' => 2, 'cols' => 12]) ?>
            <br/>
            <label for="">MONTAJE</label>
            <?= Yii::$app->controller->renderPartial('tablamontaje') ?>
            <br/>
            Diagnostico:
            <br/>
            Control;
            <table class="table table-bordered table-striped">
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Dr. XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</td>
                    <td>ESTABLECIMIENTO DISPENSADOR <br> Sello y firma del director cientifico</td>
                </tr>
            </table>
            <br/>
            <table class="table table-bordered table-striped">
                <tr>
                    <td>
                        Para verificar la autenticidad de su formulación, asegúrese de registrar en los espacios
                        inferiores el nombre, registro y sello del profesional y del establecimiento que despacha la
                        fórmula. Tan solo así serán válida reclamaciones sobre el tratamiento.
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>