<?php
use app\shelper\Util;

?>
<div class="col-md-12">
    <div class="box-header">
        <h3 class="box-title" style="text-align: center; color: #04ccfe"> CERTIFICADO DE INCAPACIDAD</h3>
    </div>
    <div class="box-body">
        <p align="justify" style="text-align: justify; font-size: 16px">
            <b style="text-align: center">
                <?=
                'Paciente: ' . $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos
                . '- IDE: ' . $historia->paciente->usuario->cedula . ' - Edad: ' . Util::edad($historia->paciente->fechanacimiento)
                . ' - Contacto: ' . $historia->paciente->usuario->telefonocelular
                . ' Email: ' . $historia->paciente->usuario->email
                ?>
            </b>
            <br/>
            Señores:
            <br/>
            <?php if (isset($form)): ?>
                <?= $form->field($certificado, 'campos[Señores]')->label(false) ?>
            <?php else: ?>
                <?= $certificado->campos['Señores'] ?>
            <?php endif ?>
            <br/><br/>
            <?php /** @var \app\models\optometria\Optometria $model */
            $model = $historia->object;
            if ($model instanceof \app\models\optometria\Optometria):
                ?>
                MOTIVO DE CONSULTA: <?= $model->motivoconsulta ?> <br>
            <?php endif ?>
            <br/>
            HALLAZGOS CLÍNICOS
            <br/>
            AGUDEZA VISUAL (sin Rx)
            Visión lejana: OD: Snellen <?= '' ?> logMAR <?= '' ?> / OI: Snellen <?= '' ?> logMAR <?= '' ?> / AO:
            Snellen <?= '' ?> logMAR <?= '' ?>
            Visión próxima: OD: <?= '' ?> / OI: <?= '' ?> / AO:  <?= '' ?>
            <br/>
            Otros hallazgos clínicos relevantes para remisión, tratamiento o incapacidad:
            <?php if (isset($form)): ?>
                <?= $form->field($certificado, 'campos[Hallazgos]')->label(false)->textarea(['cols' => 12, 'rows' => 5]) ?>
            <?php else: ?>
                <?= $certificado->campos['Hallazgos'] ?>
            <?php endif ?>
            <br/><br/>
            Diagnóstico:
            <?php
            if ($model instanceof \app\models\optometria\Optometria):
                ?>
                <?php $diagnostico = $model->optDiagnostico ?>
                <?php foreach ($diagnostico as $diag): ?>
                <br/><?= $diag->ojo ?> : <?= $diag->nominacion ?> CIE-10 : <?= $diag->codigoCIE->codigo ?>
            <?php endforeach ?>
            <?php endif ?>
            <br><br/>
            Incapacidad: <br/>
            Se certifica incapacidad clínica por un periodo de:
            <?php if (isset($form)): ?>
                <?= $form->field($certificado, 'campos[Tiempo]')->label(false) ?>
            <?php else: ?>
                <?= $certificado->campos['Tiempo'] ?>
            <?php endif ?>
            contados(as) a partir de la fecha y hora del examen.
            <br/><br/>
            Agradezco la atención y colaboración dispensadas en cuanto al cumplimiento de las sugerencias dadas y la
            próxima
            cita de control, me suscribo.
            <br/>
            <?php
            if ($model instanceof \app\models\optometria\Optometria):
                ?>
                Control: <?= $model->proxcontrol ?>
            <?php endif ?>
            <br><br/><br/>
            Dr. <?= $historia->profesional->usuario->nombres . ' ' . $historia->profesional->usuario->apellidos ?> <br/>
            Registro CTNPO: <?= $historia->profesional->registroprofesional ?> <br/>
        </p>
    </div>
</div>