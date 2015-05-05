<?php
use app\shelper\OptometriaHel;
use app\shelper\Util;

/**
 * @var \app\models\Historia $historia
 * @var $form \yii\bootstrap\ActiveForm
 */

?>
<div class="col-md-12" xmlns="http://www.w3.org/1999/html">
    <div class="box-header">
        <h3 class="box-title" style="text-align: center; color: #04ccfe"> RESUMEN DE HISTORIA CLINICA </h3>
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
            <?php /** @var \app\models\optometria\Optometria $model */
            $model = $historia->object;
            if ($model instanceof \app\models\optometria\Optometria):?>
                <b>Motivo de consulta:</b> <?= $model->motivoconsulta ?>
                <br/>
                <b>Antecedentes personales: </b> <?= $model->antecedentepersonal ?>
                <br/>
                <b>Antecedentes familiares: </b> <?= $model->antecedentefamiliar ?>
                <br/>
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
                <?php $rxenuso = $model->optRxenuso ? $model->optRxenuso : new \app\models\optometria\OptRxenuso();?>
                <br/>
                <b>RX EN USO:</b>
                OD: <?= $rxenuso->odcilindro . ' ' . $rxenuso->oddip . ' ' . $rxenuso->oddm . ' ' . $rxenuso->odeje . ' ' . $rxenuso->odesfera ?>
                <br/>
                ADD: <?= $rxenuso->odadd ?> / OI: <?= $rxenuso->oicilindro . ' ' . $rxenuso->oidip . ' ' . $rxenuso->oidm . ' ' . $rxenuso->oieje . ' ' . $rxenuso->oiesfera ?>
                <br/>
                ADD: <?= $rxenuso->oiadd ?>
            <?php endif ?>
            <br/><br/>
            <?php $queratometria = OptometriaHel::CCorneaQueratometria($model) ?>
            <strong>CORNEA:</strong>
            <br/>
            <strong>Queratometria:
                OD: </strong> <?= $queratometria->odcilindro . ' ' . $queratometria->odeje . ' ' . $queratometria->odesfera ?>
            <strong>OI: </strong><?= $queratometria->oicilindro . ' ' . $queratometria->oieje . ' ' . $queratometria->oioesfera ?>
            <br/>
            <?php $topografia = OptometriaHel::CCorneaTopografia($model); ?>
            <strong>Topografia: </strong>
            <br/>
            OD: <?= $topografia->odobservacion . ' / OI: ' . $topografia->oiobservacion ?>
            <br/>
            <strong>FONDOSCOPIA:</strong>
            <?php $fondoscopia = $model->optFondoscopia ? $model->optFondoscopia : new \app\models\optometria\OptFondoscopia(); ?>
            OD: <?= $fondoscopia->odobservacion . ' / OI: ' . $fondoscopia->oiobservacion ?>
            <br/>
            <strong>RETINOSCOPIA:</strong>
            <?php $retinoscopias = $model->optRetinoscopias; ?>
            <?php foreach ($retinoscopias as $retinoscopia): ?>
                <?= 'OD: ' . $retinoscopia->odcilindro . ' ' . $retinoscopia->odeje . ' ' . $retinoscopia->odesfera . ' /OI: ' . $retinoscopia->oicilindro . ' ' . $retinoscopia->oieje . ' ' . $retinoscopia->oiesfera ?>
                <br/>
            <?php endforeach ?>
            <br/>
            <strong>SUBJETIVO: No aplica en la bd</strong>
            <br/>
            <?php if ($model->optModulooculomotor):
                $motoramplitud = $model->optModulooculomotor->optModuloAmplitudFlexibilidad;
                $cover = \yii\helpers\Json::decode($motoramplitud->covertest, false);;?>
                <strong>EXAMEN MOTOR: Cover test: </strong>
                <?= '<strong>6m. </strong>' . $cover->m6 . '/ <strong>3m. </strong>' . $cover->m3 . '/ <strong>1m. </strong>' . $cover->m1 .
            '/ <strong>50cm. </strong>' . $cover->cm50 . '/ <strong>30cm. </strong>' . $cover->cm30 . '/ <strong>20cm. </strong>'
            . $cover->cm20 . '/ <strong>10cm. </strong>' . $cover->cm10 ?>
                <br/>
            <?php endif ?>

            <?php $motor = $model->optModulooculomotor ? $model->optModulooculomotor : new \app\models\optometria\OptCoverTest(); ?>
            <strong>BIOMICROSCOPIA:</strong>
            <?php $biomicroscopia = OptometriaHel::CBiomicroscopia($model); ?>
            <?= 'OD: ' . $biomicroscopia->odobservacion . ' / OI: ' . $biomicroscopia->oiobservacion ?>
            <br/>
            <strong>EXAMEN EXTERNO</strong>
            <?php $externo = $model->optExamenexterno ?>
            <?php foreach ($externo as $examenexterno): ?>
                <?php if ($examenexterno->tipo != 'biomicroscopia'): ?>
                    <strong>Examen: </strong>
                    <?= $examenexterno->tipo ?>
                    <br/>
                    <?= '<strong>OD: </strong>' . $examenexterno->odobservacion . ' / <strong> OI: </strong>' . $examenexterno->oiobservacion ?>
                <?php endif ?>
            <?php endforeach ?>
            <br/>
            <strong>DIAGNOSTICO: </strong>
            <?php if ($model instanceof \app\models\optometria\Optometria):
                $diagnostico = $model->optDiagnostico ?>
                <?php foreach ($diagnostico as $diag): ?>
                <br/><?= $diag->ojo ?> : <?= $diag->nominacion ?> CIE-10 : <?= $diag->codigoCIE->codigo ?>
            <?php endforeach ?>
            <?php endif ?>
            <br/><br/>


            <br><br/><br/>

        <div style="width: 100%">
            <div style="width: 45%; float: left">
                Dr. <?= $historia->profesional->usuario->nombres . ' ' . $historia->profesional->usuario->apellidos ?>
                <br/>
                Registro CTNPO: <?= $historia->profesional->registroprofesional ?>
            </div>
            <div style="width: 45%; float: left; text-align: right">
                <?= $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos ?>
                <br/>
                Paciente
            </div>
        </div>
        </p>
    </div>
</div>