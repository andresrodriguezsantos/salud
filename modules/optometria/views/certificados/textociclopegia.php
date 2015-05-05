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
        denominado <b>refracción bajo cicloplegia</b>,
        declaro que he comprendido la naturaleza del procedimiento,
        sus riesgos y sus posibles efectos secundarios y que entiendo que el procedimiento es una indicación prioritaria
        recomendada por el profesional tratante para resolver mi problema, una vez se confirme que no existen
        contraindicaciones
        para su realización, así pues de forma voluntaria: <br/><br/>

        Doy mi consentimiento para que: <br/><br/>

        1. Se me realice la refracción bajo cicloplegia, y las maniobras u operaciones necesarias para garantizar los
        mejores resultados de la prueba.
        <br/>
        2. Se me apliquen los fármacos tópicos oculares denominados Ciclogyl y/o Midriacyl en las dosis recomendadas por
        el profesional tratante para realizar la prueba.
        <br/>
        3. Se realicen fotografías y/o graben los procedimientos asociados a la prueba para usar dicho material con
        fines didácticos o científicos
        siempre y cuando el nombre del paciente y de sus familiares se mantenga en el anonimato.
        <br/>
        4. El procedimiento sea realizado exclusivamente por personal capacitado para tal fin.
        <br/><br/>
        Además, certifico que antes de la intervención he informado al optómetra tratante acerca de mis enfermedades y/o
        antecedentes generales y oculares de salud, especialmente la ausencia de epilepsia, síndrome de Down,
        alteraciones neurológicas, ingesta de medicamentos psiquiátricos, asma, además he reportado mis alergias
        medicamentosas. Certifico que he aportado las pruebas solicitadas por el cuerpo profesional tratante para el
        estudio de las posibles contraindicaciones. (La mujer se debe informar si está embarazada o en periodo de
        lactancia).
        <br/><br/>
        En cualquier caso, podemos por voluntad propia o de mis acudientes, desautorizar el procedimiento si lo
        estimamos oportuno.
        <br/>
        Soy consciente de que el procedimiento tiene un objeto diagnóstico y que no necesariamente aporta un dato
        conclusivo, por lo tanto, no excluye la práctica de otras pruebas diagnósticas independientes de la presente, en
        caso de que la información aportada sea insuficiente para iniciar un tratamiento basado en un diagnóstico
        certero.
        <br/><br/><br/><br/>
        Dr. <?= $historia->profesional->usuario->nombres . ' ' . $historia->profesional->usuario->apellidos . '.     .      .      .    .' .
        $historia->paciente->usuario->nombres . ' ' . $historia->paciente->usuario->apellidos ?> <br/>
        Registro CTNPO: <?= $historia->profesional->registroprofesional . '.    .    .    .    .' ?> Paciente
    </p>

    <div>