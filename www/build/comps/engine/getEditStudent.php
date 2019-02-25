<?php
include_once "../engine/loader.php";
$Students->studid = $_GET['dataid'];
$getData = $Students->GetSetStud();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input student<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-4 m-b-15">
        <input type="text" class="form-control" disabled="disabled" id="upstudid" placeholder="<?php echo $row['stud_id']; ?>" />
    </div>
    <div class="col-md-4 m-b-15">
        <input type="text" class="form-control" id="upfname" placeholder="<?php echo $row['stud_fname']; ?>" />
    </div>
    <div class="col-md-4 m-b-15">
        <input type="text" class="form-control" id="upmname" placeholder="<?php echo $row['stud_mname']; ?>" />
    </div>
    <div class="col-md-4 m-b-15">
        <input type="text" class="form-control" id="uplname" placeholder="<?php echo $row['stud_lname']; ?>" />
    </div>
    <div class="col-md-4 m-b-15">
        <input type="text" class="form-control" id="upexname" placeholder="<?php echo $row['stud_extname']; ?>" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-4 m-b-15">
        <select id="upyrlvl" class="form-control">
            <option value="">Select Level</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="col-md-4 m-b-15">
        <select id="upcourse" class="form-control">
            <option value="">Select Course</option>
        </select>
    </div>
</div>