<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$getData = $Students->GetStud();
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["stud_id"] . '",';
    $outp .= '"DataDesc":"'. $row["stud_lname"].', '.$row["stud_fname"].' '.$row["stud_mname"]. ' '.$row['stud_extname'].'"}';
}
$outp .="]";

echo($outp);
?>