<?php
include_once "../engine/loader.php";
$Students->studid = $_GET['dataid'];
$getData = $Students->GetSetStud();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input student<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" disabled="disabled" id="upstudid" value="<?php echo $row['stud_id']; ?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upfname" value="<?php echo $row['stud_name']; ?>" />
    </div>
    <div class="col-md-12 m-b-15">
        <select id="upyrlvl" class="form-control">
            <option value="">Select Level</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
</div>
<label class="control-label">Update Subject<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-12 m-b-15">
        <select id="upsubj" class="form-control" multiple="multiple">
            <?php include_once "getSubjOpt.php"; ?>
        </select>
    </div>
</div>
<label class="control-label">Update Course<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-12 m-b-15">
        <select id="upcourse" class="form-control">
            <?php include_once "getCourseOpt.php"; ?>
        </select>
    </div>
</div>