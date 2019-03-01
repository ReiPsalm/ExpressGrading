<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// $row =  $result->fetchArray();
$getData = $subject->GetSubj();
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["subj_id"] . '",';
    $outp .= '"DataDesc":"'  . $row["subj_desc"] . '",';
    $outp .= '"Data_A":"'. $row["subj_term"].' / '. $row["subj_sy"].'"}';
}
$outp .="]";

echo($outp);
?>