<?php
include_once "../engine/loader.php";
$Users->id = $_GET['dataid'];
$getData = $Users->Getuser();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input info<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="hidden" id="dataid" value="<?php echo $row['ins_id']; ?>" />
        <input type="text" class="form-control" id="upfname" value="<?php echo $row['ins_fname']; ?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upmname" value="<?php echo $row['ins_mname']; ?>" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="uplname" value="<?php echo $row['ins_lname']; ?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upename" value="<?php echo $row['ins_extname']; ?>" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upmobile" value="<?php echo $row['ins_mobile']; ?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="uphome" value="<?php echo $row['ins_address']; ?>" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upcity" value="<?php echo $row['ins_city']; ?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upgender" value="<?php echo $row['ins_gender']; ?>" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upbday" value="<?php echo $row['ins_bday']; ?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upoffice" value="<?php echo $row['ins_office']; ?>" />
    </div>
</div>