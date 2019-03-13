<?php
//select * from student then check classes to refer on tbl_classlist
//set student classes to array and use for foreach loop then compare data to bolean if true
//fucntion to get [GetStud] [GetEditClr]
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$getStud = $Students->GetStud();
$outp = "[";
while($row = $getStud->fetchArray(SQLITE3_ASSOC)){
    $sClass = explode(",",$row['stud_classes']);

    foreach($sClass as $clr){
        if($clr == $_GET['dataid']){
            if ($outp != "[") {$outp .= ",";}
            $outp .= '{"DataID":"'  . $row["stud_id"] . '",';
            $outp .= '"Data_A":"'. $row["stud_name"].'"}';
        }
    }

}
$outp .="]";

echo($outp);
?>