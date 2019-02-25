<?php
include_once "../engine/loader.php";
$getData = $Dept->GetDept();
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    echo'
    <option value="'.$row['dept_id'].'">'.$row['dept_desc'].'</option>
    ';
}
?>