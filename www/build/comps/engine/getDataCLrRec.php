<?php
//select * from student then check classes to refer on tbl_classlist
//set student classes to array and use for foreach loop then compare data to bolean if true
//fucntion to get [GetStud] [GetEditClr]
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$classR->clrid = $_GET['dataid'];
$getStud = $Students->GetStud();

$getData = $Dept->GetDept();
$outp = "[";
while($row = $getStud->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["stud_id"] . '",';
    $outp .= '"Data_A":"'. $row["stud_name"].'"}';
}
$outp .="]";

echo($outp);
?>