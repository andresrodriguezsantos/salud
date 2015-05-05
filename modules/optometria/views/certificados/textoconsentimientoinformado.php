<?php use app\shelper\Util; ?>

<div class="col-md-12">
    <div class="box-header">
        <h3 class="box-title" style="text-align: center; color: #04ccfe"> CONSENTIMIENTO INFORMADO <br/>
            para extracción de cuerpo extraño ocular
        </h3>
    </div>
    <p align="justify" style="font-size: 16px; text-align: justify">
        <b style="text-align: center">
            <?=
            'Paciente: ' . $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos
            . '- IDE: ' . $historia->paciente->usuario->cedula . ' - Edad: ' . Util::edad($historia->paciente->fechanacimiento)
            . ' - Contacto: ' . $historia->paciente->usuario->telefonocelular
            . ' Email: ' . $historia->paciente->usuario->email
            ?>
        </b>
        <br><br/>
        En atención a la explicación satisfactoria suministrada a mi y/o mis acudiente por parte del (la) Dr. (a)
        <?= $historia->profesional->usuario->nombres . ' ' . $historia->profesional->usuario->apellidos ?>
        respecto al procedimiento que será practicado en
        <?php if (isset($form)): ?>
            <?= $form->field($certificado, 'campos[Observación]')->label(false) ?>
        <?php else: ?>
            <?= $certificado->campos['Observación'] ?>
        <?php endif ?>
        denominado <b>extracción de cuerpo extraño corneal o conjuntival</b>,
        declaro que he comprendido la naturaleza del procedimiento,
        sus riesgos y sus posibles efectos secundarios y que entiendo que el procedimiento es una indicación prioritaria
        recomendada por el profesional tratante para resolver mi problema, una vez se confirme que no existen
        contraindicaciones
        para su realización, así pues de forma voluntaria: <br/><br/>

        Doy mi consentimiento para que: <br/><br/>

        1. Se me realice el procedimiento anunciado, así como las maniobras para garantizar los mejores resultados
        terapéuticos o correctivos.
        <br/>
        2. Se me administre la anestesia tópica ocular requerida para llevar a cabo el procedimiento, así como las
        medidas complementarias oportunas.
        <br/>
        3. Se realicen fotografías y/o se grabe dicho material con fines didácticos o científicos siempre y cuando el
        nombre del paciente y
        de sus familiares se mantenga en el anonimato.
        <br/>
        4. El procedimiento sea realizado o asistido por el personal autorizado.
        <br/><br/>
        Soy consciente de que una vez practicado el procedimiento debo asistir a (los) control(es) preventivos que el
        profesional
        estime conveniente(s) para realizar una verificación de la buena evolución del tratamiento o en dado caso,
        realizar
        los tratamientos complementarios requeridos para la evolución y culminación del tratamiento.
        <br/><br/><br/><br/>
        Dr. <?= $historia->profesional->usuario->nombres . ' ' . $historia->profesional->usuario->apellidos . '.     .      .      .    .' .
        $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos ?> <br/>
        Registro CTNPO: <?= $historia->profesional->registroprofesional . '.    .    .    .    .' ?> Paciente
    </p>

    <div>