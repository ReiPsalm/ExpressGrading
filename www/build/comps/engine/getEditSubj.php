<?php
include_once "../engine/loader.php";
$subject->subjid = $_GET['dataid'];
$getData = $subject->GetSetSubj();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<label class="control-label">Input subject<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-12 m-b-15">
        <input type="hidden" id="dataid" value="<?php echo $_GET['dataid']; ?>" />
        <input type="text" class="form-control" id="upsubj" placeholder="<?php echo $row['subj_desc']; ?>" />
    </div>
</div>
<label class="control-label">Input School year<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upfsy" placeholder="<?php echo $row['subj_sy']; ?>" />
    </div>
</div>
<label class="control-label">Term and Section<i class="text text-danger">*</i></label>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <select id="upterm" class="form-control">
            <option value="">Select Term</option>
            <option value="1st Term">1st Term</option>
            <option value="2nd Term">2nd Term</option>
            <option value="Summer Term">Summer Term</option>
        </select>
    </div>
    <div class="col-md-6 m-b-15">
        <select id="upsection" class="form-control">
        <?php include_once "getSecOpt.php"; ?>
        </select>
    </div>
</div>