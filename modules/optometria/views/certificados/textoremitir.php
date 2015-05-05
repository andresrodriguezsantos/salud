<?php
use app\shelper\Util;

/**
 * @var \app\models\Historia $historia
 * @var $form \yii\bootstrap\ActiveForm
 */

?>
<div class="col-md-12">
    <div class="box-header">
        <h3 class="box-title" style="text-align: center; color: #04ccfe"> REMISION A ESPECIALIDAD MEDICA </h3>
    </div>
    <div class="box-body" style="overflow: hidden">
        <p align="justify" style="font-size: 16px; text-align: justify">
            <b style="text-align: center">
                <?= 'Paciente: ' . $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos
                . '- IDE: ' . $historia->paciente->usuario->cedula . ' - Edad: ' . Util::edad($historia->paciente->fechanacimiento)
                . ' - Contacto: ' . $historia->paciente->usuario->telefonocelular
                . ' Email: ' . $historia->paciente->usuario->email
                ?>
            </b>
            <br><br/>
            <b>Remision a :</b>
            <?php if (isset($form)): ?>
                <?= $form->field($certificado, 'campos[destinatario]')->label(false) ?>
            <?php else: ?>
                <?= $certificado->campos['destinatario'] ?>
            <?php endif ?>
            <br/><br/>
            <?php /** @var \app\models\optometria\Optometria $model */
            $model = $historia->object;
            if ($model instanceof \app\models\optometria\Optometria):?>
                <b>MOTIVO DE CONSULTA:</b> <?= $model->motivoconsulta ?>
                <br/><br/>
                <b>AGUDEZA VISUAL (sin Rx)</b><br/>
                Vision lejana: OD: Snellen: <?= $model->optAgudezavisual->optAgudezavisualSincorreccion->vl_derecho_snellen . ' Logmar: ' .
            $model->optAgudezavisual->optAgudezavisualSincorreccion->vl_derecho_logmar .
            ' OI : Snellen: ' . $model->optAgudezavisual->optAgudezavisualSincorreccion->vl_izquierdo_snellen . ' Logmar: ' . $model->optAgudezavisual->optAgudezavisualSincorreccion->vl_izquierdo_logmar .
            ' AO: Snellen: ' . $model->optAgudezavisual->optAgudezavisualSincorreccion->vl_ambos_snellen . ' Logmar: ' . $model->optAgudezavisual->optAgudezavisualSincorreccion->vl_ambos_logmar
                ?>
                <br/>
                Vision proxima: OD: <?= $model->optAgudezavisual->optAgudezavisualSincorreccion->vp_derecho . ' OI: ' . $model->optAgudezavisual->optAgudezavisualSincorreccion->vp_izquierdo .
                ' AO: ' . $model->optAgudezavisual->optAgudezavisualSincorreccion->vp_ambos
                ?>
            <?php endif ?>
            <br/><br/>
            <b>HALLAZGOS CLINICOS: </b>
            <?php if (isset($form)): ?>
                <?= $form->field($certificado, 'campos[hallazgos]')->label(false) ?>
            <?php else: ?>
                <?= $certificado->campos['hallazgos'] ?>
            <?php endif ?>
            <br/><br/>
            <b>DIAGNOSTICO PRESUNTIVO: </b>
            <?php if ($model instanceof \app\models\optometria\Optometria):
                $diagnostico = $model->optDiagnostico ?>
                <?php foreach ($diagnostico as $diag): ?>
                <br/><?= $diag->ojo ?> : <?= $diag->nominacion ?> CIE-10 : <?= $diag->codigoCIE->codigo ?>
            <?php endforeach ?>
            <?php endif ?>
            <br/><br/>
            <b>Observaciones: </b>
            <?php if (isset($form)): ?>
                <?= $form->field($certificado, 'campos[observaciones]')->label(false) ?>
            <?php else: ?>
                <?= $certificado->campos['observaciones'] ?>
            <?php endif ?>
            <br/><br/>
            Solicitamos notificar al profesional remisor acerca de los hallazgos clínicos del paciente para efectos de
            seguimiento profesional.
            <br><br/><br/>
            Dr. <?= $historia->profesional->usuario->nombres . ' ' . $historia->profesional->usuario->apellidos . '.     .      .      .    .' .
            $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos ?> <br/>
            Registro CTNPO: <?= $historia->profesional->registroprofesional . '.    .    .    .    .' ?> Paciente
        </p>
    </div>
</div>