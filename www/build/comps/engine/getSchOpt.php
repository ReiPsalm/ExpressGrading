<option value="">Select School</option>
<?php
include_once "../engine/loader.php";
$getData = $School->GetSchool();
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    echo'
    <option value="'.$row['sch_id'].'">'.$row['sch_desc'].'</option>
    ';
}
?>