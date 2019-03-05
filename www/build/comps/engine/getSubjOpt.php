<option value="">Select Section</option>
<?php
include_once "../engine/loader.php";
$getData = $tbljoins->getSubSec();
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    echo'
    <option value="'.$row['subj_id'].'-'.$row['Sec_id'].'">'.$row['subj_desc'].'('.$row['Sec_desc'].')</option>
    ';
}
?>