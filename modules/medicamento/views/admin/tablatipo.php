<?php
?>
<h2 style="text-align: center; color: #8EC4EC">General information Type</h2>
<h3 style="color: #8EC4EC">Find information</h3>
<div class="col-md-4">
    <label for="">Select a therapeutic type</label>
    <input type="text" class="form-control" name="texttablatype" id="texttablatype"/>
</div>
<br/>
<div class="col-md-3">
    <button class="btn btn-success" name="btntablatype" id="btntablatype">Search</button>
</div>
<br/>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Estado</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody id="tablatipo">
    </tbody>
</table>