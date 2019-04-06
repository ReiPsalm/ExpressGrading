<?php
include_once "../engine/loader.php";
$getData = $Dean->GetDean();
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    echo'
    <option value="'.$row['dean_id'].'">'.$row['dean_lname'].', '.$row['dean_fname'].' '.$row['dean_mname'].'</option>
    ';
}
?>