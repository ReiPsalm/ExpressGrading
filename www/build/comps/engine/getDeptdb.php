<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$getData = $Dept->GetDept();
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["dept_id"] . '",';
    $outp .= '"DataDesc":"'. $row["dept_desc"].'"}';
}
$outp .="]";

echo($outp);
?>