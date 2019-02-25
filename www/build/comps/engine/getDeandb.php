<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$getData = $Dean->GetDean();
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["dean_id"] . '",';
    $outp .= '"DataDesc":"'. $row["dean_lname"].', '.$row["dean_fname"].' '.$row["dean_mname"]. ' '.$row['dean_extname'].'"}';
}
$outp .="]";

echo($outp);
?>