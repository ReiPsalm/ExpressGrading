<?php
include_once "../engine/loader.php";
// $subject->subjid = $_GET['dataid'];
$getData = $subject->GetSetSubj($_GET['dataid']);
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input subject<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="hidden" id="dataid" value="<?php echo $_GET['dataid']; ?>" />
        <input type="text" class="form-control" id="upsubj" value="<?php echo $row['subj_desc']; ?>" />
        
    </div>
    <div class="col-md-6 m-b-15">
        <select id="upSec" class="form-control">
        <?php include_once "getSecOpt.php"; ?>
        </select>
    </div>
</div>