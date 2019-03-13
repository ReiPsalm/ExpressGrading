<?php
//select * from student then check classes to refer on tbl_classlist
//set student classes to array and use for foreach loop then compare data to bolean if true
//fucntion to get [GetStud] [GetEditClr]
include_once "../engine/loader.php";
// $classR->clrid = $_GET['dataid'];
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$getStud = $Students->GetStud();

$getData = $Dept->GetDept();
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["dept_id"] . '",';
    $outp .= '"Data_A":"'. $row["dept_desc"].'"}';
}
$outp .="]";

echo($outp);
?>