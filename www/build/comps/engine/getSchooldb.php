<?php
include_once "../engine/loader.php";
$School->sch_id = $_GET['dataid'];
$getData = $School->GetSetSchool();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input new school<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-12 m-b-15">
        <input type="hidden" id="dataid" value="<?php echo $_GET['dataid']; ?>" />
        <input type="text" class="form-control" id="upschool" placeholder="<?php echo $row['sch_desc']; ?>" />
    </div>
</div>