<?php
include_once "../engine/loader.php";
$Courses->courseid = $_GET['dataid'];
$getData = $Courses->GetSetCourse();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input new course<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-12 m-b-15">
        <input type="hidden" id="dataid" value="<?php echo $_GET['dataid']; ?>" />
        <input type="text" class="form-control" id="upcourse" value="<?php echo $row['course_desc']; ?>" />
    </div>
</div>