<?php
include_once "../engine/loader.php";
$Dept->deptid = $_GET['dataid'];
$getData = $Dept->GetSetDept();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input new department<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-12 m-b-15">
        <input type="hidden" id="dataid" value="<?php echo $_GET['dataid']; ?>" />
        <input type="text" class="form-control" id="updeptdesc" placeholder="<?php echo $row['dept_desc']; ?>" />
    </div>
</div>