<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// $row =  $result->fetchArray();
$getData = $Section->GetSec();
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["Sec_id"] . '",';
    $outp .= '"DataDesc":"'. $row["Sec_desc"].'"}';
}
$outp .="]";

echo($outp);
?>