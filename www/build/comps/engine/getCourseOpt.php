<?php
include_once "../engine/loader.php";
$getData = $Courses->GetCourse();
while($row = $getData->fetchArray(SQLITE3_ASSOC)) {
    echo'
    <option value="'.$row['course_id'].'">'.$row['course_desc'].'</option>
    ';
}
?>