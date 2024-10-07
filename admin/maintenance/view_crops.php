<?php

require_once('../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `crops` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer {
        display: none !important;
    }
</style>
<div class="container-fluid">
    <dl>
        <dt class="muted">Crops Name</dt>
        <dd class="pl-4"><?= isset($crops_name) ? $crops_name : "" ?></dd>
        <dt class="muted">Crops Description</dt>
        <dd class="pl-4"><?= isset($crops_description) ? $crops_description : "" ?></dd>
        <dt class="muted">Crops Location</dt>
        <dd class="pl-4"><?= isset($crops_location) ? $crops_location : "" ?></dd>
    </dl>
    <div class="clear-fix mb-3"></div>
    <div class="text-right">
        <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>