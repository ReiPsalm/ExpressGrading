<?php
include_once "../engine/loader.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$getArch= $classR->GetClr('1');
while($rowArch = $getArch->fetchArray(SQLITE3_ASSOC)) {
    if($rowArch['cr_archdate'] != ''){
        $datenow = new DateTime(date("Y-m-d"));
        $dateArch = new DateTime(date($rowArch['cr_archdate']));

        $dateArchdiff = $datenow->diff($dateArch);

        if($dateArchdiff->m >= 3){
            try{
                $classR->ArchDel($rowArch['cr_id']);
            }catch(PDOException $e){
                echo 'Connection Error :'.$e->getMessage();
            }
        }
    }
}

$getData = $classR->GetClr('0');
$outp = "[";
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"DataID":"'  . $row["cr_id"] . '",';
    $outp .= '"Data_A":"'. $row["cr_sy"].'",';
    $outp .= '"Data_B":"'. $row["cr_term"].'",';
    $outp .= '"Data_C":"'. $row["subj_desc"].'",';
    $outp .= '"Data_D":"'. $row["Sec_desc"].'",';//section
    $outp .= '"Data_E":"'. $row["cr_timeDay"].'",';
    $outp .= '"Data_F":"'. $row["sch_desc"].'"}';
}
$outp .="]";

echo($outp);
?>