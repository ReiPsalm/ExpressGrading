<?php
include_once "../engine/loader.php";
$Dean->deanid = $_GET['dataid'];
$getData = $Dean->GetSetDean();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input dean<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="hidden" id="dataid" value="<?php echo $_GET['dataid']; ?>" />
        <input type="text" class="form-control" id="upfname" placeholder="<?php echo $row['dean_fname']; ?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upmname" placeholder="<?php echo $row['dean_mname']; ?>" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="uplname" placeholder="<?php echo $row['dean_lname']; ?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upename" placeholder="<?php echo $row['dean_extname']; ?>" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <select id="updept" class="form-control">
            <option value="">Select Department</option>
            <?php include_once "getDeptOpt.php"; ?>
        </select>
    </div>
</div>