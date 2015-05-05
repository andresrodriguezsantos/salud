<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header">
            <i class="glyphicon glyphicon-"></i>
            <?php /** @var \app\models\optometria\Optometria $model */
            $model = $historia->object;
            ?>
            <h3 class="box-title" style="text-align: center; color: #04ccfe">PRESCRIPCION FARMACEUTICA</h3>
        </div>
        <div class="box-body">
            <label for="">RX/.</label>
            <br/>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Medicamentos</th>
                </tr>
                <tbody>
                <?php /** @var \app\models\medicamento\OptPrescripcionMed $med */
                foreach ($medicamentos as $med): ?>
                    <tr>
                        <td>
                            <?=
                            $med->medicamento->nombrecomercial ?>
                            <br> <?= ' Unidades: ' . $med->unidades . ' Dosis: ' . $med->dosis . ' Duracion: ' . $med->duracion
                            ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            <br/>
            <label for="">Observaciones: </label>
            <?= $med->viaadministracion ?>
            <br/><br/>
            <label for="">Diagnostico : </label>
            <?php
            if ($model instanceof \app\models\optometria\Optometria):
                ?>
                <?php $diagnostico = $model->optDiagnostico ?>
                <?php foreach ($diagnostico as $diag): ?>
                <br/><?= $diag->ojo ?> : <?= $diag->nominacion ?> CIE-10 : <?= $diag->codigoCIE->codigo ?>
            <?php endforeach ?>
            <?php endif ?>
            <br/>
            <?php
            if ($model instanceof \app\models\optometria\Optometria):
                ?>
                Control: <?= $model->proxcontrol ?>
            <?php endif ?>
            <br><br/><br/>
            Dr. <?= $historia->profesional->usuario->nombres . ' ' . $historia->profesional->usuario->apellidos ?> <br/>
            Registro CTNPO: <?= $historia->profesional->registroprofesional ?> <br/>
        </div>
    </div>
</div>