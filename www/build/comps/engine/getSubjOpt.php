<?php
include_once "../engine/loader.php";
$getData = $classR->GetClr('0');
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    echo'
    <option value="'.$row['cr_id'].'">'.$row['subj_desc'].'('.$row['Sec_desc'].')</option>
    ';
}
?>