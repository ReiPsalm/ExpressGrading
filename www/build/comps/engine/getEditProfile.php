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
        <input type="hidden" id="acctid" value="<?php echo $row['user_id']; ?>" />
        <input type="text" class="form-control" id="upfname" value="<?php echo $row['ins_fname']; ?>" placeholder="First name" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upmname" value="<?php echo $row['ins_mname']; ?>" placeholder="Middle name" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="uplname" value="<?php echo $row['ins_lname']; ?>" placeholder="Last name" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upename" value="<?php echo $row['ins_extname']; ?>" placeholder="Ext. name" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upmobile" value="<?php echo $row['ins_mobile']; ?>" placeholder="Mobile" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="uphome" value="<?php echo $row['ins_address']; ?>" placeholder="Address" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upcity" value="<?php echo $row['ins_city']; ?>" placeholder="City" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upgender" value="<?php echo $row['ins_gender']; ?>" placeholder="Gender" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upbday" value="<?php echo $row['ins_bday']; ?>" placeholder="Birthday" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upoffice" value="<?php echo $row['ins_office']; ?>" placeholder="Workplace" />
    </div>
</div>
<label class="control-label">Account info<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upuser" value="<?php echo $row['user_name']; ?>" placeholder="Username" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="uppass" value="<?php echo $row['user_pass']; ?>" placeholder="Password" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="uprole" value="<?php echo $row['user_role']; ?>" readonly />
    </div>
</div>