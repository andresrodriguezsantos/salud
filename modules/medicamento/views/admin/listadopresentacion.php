<h3 style="color: #8EC4EC">Listado de Presentaciones</h3>
<div class="col-md-8 row">
    <div class="form-group">
        <input class="form-control" id="text-filtro-pre">
    </div>
</div>
<div class="col-md-4 row">
    <div class="form-group">
        <button id="btn-buscar-pre" class="btn btn-success pull-right">Search</button>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Num</th>
        <th>Nombre Presentacion</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody id="bodytablalistapresentacion">
    <?php /** @var \app\models\medicamento\MedPresentacion $pre */
    $c = 0;
    foreach ($listapre as $pre) { ?>
        <?php $c++?>
        <tr>
            <td><?= $c ?></td>
            <td><?= $pre->nombre ?></td>
            <td>
                <button class="btn btn-xs btn-success btn-add-pres"
                        value="<?= $pre->id ?>"><i
                        class="fa-plus glyphicon glyphicon-check"></i>Add item
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>