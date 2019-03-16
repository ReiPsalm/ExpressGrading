<?php
include_once "../engine/loader.php";
$classR->clrid = $_GET['dataid'];
$getData = $classR->GetEditClr();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<div class="row row-space-10">
    <div class="col-md-6 m-b-15">
        <input type="hidden" id="upmclid" value="<?php echo $_GET['dataid']?>" />
        <input type="text" class="form-control" id="upmclsy" value="<?php echo $row['cr_sy']?>" />
    </div>
    <div class="col-md-6 m-b-15">
        <input type="text" class="form-control" id="upmcltd" value="<?php echo $row['cr_timeDay']?>" />
    </div>
</div>
<div class="row row-space-10">
    <div class="col-md-12 m-b-15">
        <select id="upmclsch" class="form-control">
            <?php include_once "getSchOpt.php"; ?>
        </select>
    </div>
    <div class="col-md-12 m-b-15">
        <select id="upmclt" class="mclt form-control" style="width: 100%">
            <option value="">Select Term</option>
            <option value="First">First Term</option>
            <option value="Second">Second Term</option>
            <option value="Summer">Summer Term</option>
        </select>
    </div>
    <div class="col-md-12 m-b-15">
        <select id="upmclsubj" class="form-control">
            <option value="">Select Subject</option>
            <?php include_once "getSubjOpts.php"; ?>
        </select>
    </div>
</div>