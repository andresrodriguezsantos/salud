<?php //limpiece bien el culito antes del examen se lo van jurgar ondo!!
/**
 * @var $certificado \app\models\Certificado
 * @var $historia \app\models\Historia
 */ ?>
<div class="col-md-12">
    <div class="box-header">
        <h3 class="box-title" style="text-align: center; color: #04ccfe">SOLICITUD DE EXÁMENES ESPECIALIZADOS</h3>
    </div>
    <div class="box-body">
        <p align="justify" style="text-align: justify; font-size: 16px">
            <b style="text-align: center">
                <?= 'Paciente: ' . $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos
                . '- IDE: ' . $historia->paciente->usuario->cedula . ' - Edad: ' . \app\shelper\Util::edad($historia->paciente->fechanacimiento)
                . ' - Contacto: ' . $historia->paciente->usuario->telefonocelular
                . ' Email: ' . $historia->paciente->usuario->email
                ?>
            </b>
            <br>
        <ol>
            <?php $campos = $certificado->campos;
            foreach ($campos as $key => $campo):?>
                <?php if ($key != 'Observación'): ?>
                    <li>
                        <?= $campo ?>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ol>
        Diagnóstico:
        <?php $model = $historia->object; ?>
        <?php if ($model instanceof \app\models\optometria\Optometria):
            $diagnostico = $model->optDiagnostico ?>
            <?php foreach ($diagnostico as $diag): ?>
            <br/><?= $diag->ojo ?> : <?= $diag->nominacion ?> CIE-10 : <?= $diag->codigoCIE->codigo ?>
        <?php endforeach ?>
        <?php else: ?>
            no le entra
        <?php endif ?>
        <br><br/>
        <strong>Observaciones:</strong>
        <br/>
        <?= $certificado->campos['Observación'] ?>
        <?php
        if ($model instanceof \app\models\optometria\Optometria):
            ?>
            <br/>
            Control: <?= $model->proxcontrol ?>
        <?php endif ?>
        <br><br/><br/>
        Dr. <?= $historia->profesional->usuario->nombres . ' ' . $historia->profesional->usuario->apellidos ?> <br/>
        Registro CTNPO: <?= $historia->profesional->registroprofesional ?> <br/>
        </p>
    </div>
</div>