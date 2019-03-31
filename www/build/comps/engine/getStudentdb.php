<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if($_REQUEST['subjid'] != '*'){
    $getData = $Students->GetStud();
    $outp = "[";
    while($row = $getData->fetchArray(SQLITE3_ASSOC)){
        $sClass = explode(",",$row['stud_classes']);

        foreach($sClass as $clr){
            if($clr == $_REQUEST['subjid']){
                if ($outp != "[") {$outp .= ",";}
                $outp .= '{"DataID":"'  . $row["stud_id"] . '",';
                $outp .= '"DataDesc":"'. $row["stud_name"].'"}';
            }
        }

    }
    $outp .="]";
}else if($_REQUEST['subjid'] == '*'){
    $getData = $Students->GetStud();
    $outp = "[";
    while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
        if ($outp != "[") {$outp .= ",";}
        $outp .= '{"DataID":"'  . $row["stud_id"] . '",';
        $outp .= '"DataDesc":"'.$row["stud_name"].'"}';
    }
    $outp .="]";
}


echo($outp);
?>