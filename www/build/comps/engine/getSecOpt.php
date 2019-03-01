<option value="">Select Section</option>
<?php
include_once "../engine/loader.php";
$getData = $Section->GetSec();
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    echo'
    <option value="'.$row['Sec_id'].'">'.$row['Sec_desc'].'</option>
    ';
}
?>