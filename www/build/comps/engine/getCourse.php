<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// $row =  $result->fetchArray();
$getData = $Courses->GetCourse();
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["course_id"] . '",';
    $outp .= '"DataDesc":"'. $row["course_desc"].'"}';
}
$outp .="]";

echo($outp);
?>