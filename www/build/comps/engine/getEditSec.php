<?php
include_once "../engine/loader.php";
$Section->secid = $_GET['dataid'];
$getData = $Section->GetSetSec();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input new section<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-12 m-b-15">
        <input type="hidden" id="dataid" value="<?php echo $_GET['dataid']; ?>" />
        <input type="text" class="form-control" id="upsection" placeholder="<?php echo $row['Sec_desc']; ?>" />
    </div>
</div>