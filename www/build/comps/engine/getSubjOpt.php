<option value="">Select Section</option>
<?php
include_once "../engine/loader.php";
$getData = $subject->GetSubj();
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    echo'
    <option value="'.$row['subj_id'].'">'.$row['subj_desc'].'</option>
    ';
}
?>