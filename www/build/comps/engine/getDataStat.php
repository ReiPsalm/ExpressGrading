<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$getStud = $Students->GetStud();
$outp = "[";
while($row = $getStud->fetchArray(SQLITE3_ASSOC)){
    $sClass = explode(",",$row['stud_classes']);

    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["stud_id"] . '",';
        
            $outp .= '"Data_B":"';
            foreach($sClass as $clr){
                $classR->clrid = $clr;
                $getStudSubj = $classR->GetDataClr();
                $rowSubj = $getStudSubj->fetchArray(SQLITE3_ASSOC);
                $outp .= ' <button class=\"btn btn-success btn-xs\" onclick=\"Appex.GetDataSets(\''.$row["stud_id"].'-'.$clr.'\',\'GradeStat\',\'TabStat\')\" href=\"#exp_modal\" data-toggle=\"modal\"><i class=\"fa fa-bar-chart-o\"></i> '.$rowSubj["subj_desc"].'</button>';
            }
            $outp .= '",';
            
    $outp .= '"Data_A":"'. $row["stud_name"].'"}';

}
$outp .="]";

echo($outp);
?>