<?php
include_once "../engine/loader.php";
$classR->clrid = $_GET['dataid'];
$getData = $classR->GetDataClr();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<dl class="dl-horizontal">
    <dt>Class Record ID :</dt>
    <dd><?php echo $_GET['dataid']; ?></dd>
    <dt>School :</dt>
    <dd><?php echo $row['sch_desc']?></dd>
    <dt>Subject / Section :</dt>
    <dd><?php echo $row['subj_desc']?> ( <?php echo $row['Sec_desc']?> )</dd>
    <dt>Time / Day :</dt>
    <dd><?php echo $row['cr_timeDay']?></dd>
    <dt>Term / School Year :</dt>
    <dd><?php echo $row['cr_term']?> / <?php echo $row['cr_sy']?></dd>
</dl>