<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// $row =  $result->fetchArray();
$getData = $classR->GetClr();
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["cr_id"] . '",';
    $outp .= '"Data_A":"'. $row["cr_sy"].'",';
    $outp .= '"Data_B":"'. $row["cr_term"].'",';
    $outp .= '"Data_C":"'. $row["subj_desc"].'",';
    $outp .= '"Data_D":"'. $row["Sec_desc"].'",';//section
    $outp .= '"Data_E":"'. $row["cr_timeDay"].'",';
    $outp .= '"Data_F":"'. $row["sch_id"].'"}';
}
$outp .="]";

echo($outp);
?>