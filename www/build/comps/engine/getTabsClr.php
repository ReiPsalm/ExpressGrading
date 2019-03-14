<?php
include_once "../engine/loader.php";
$sepData = explode("-",$_GET['dataid']);
$Orals->studid = $quizzes->studid = $sepData[0];
$Orals->crid = $quizzes->crid = $sepData[1];
$getqData = $quizzes->GetQuizStud();
$getoData = $Orals->GetOralStud();
?>

<div class="tab-pane fade active in" id="default-tab-1">
    <!-- attendance table -->
</div>
<div class="tab-pane fade" id="default-tab-2">
    <!-- quizzes table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Quiz ID</th>
                <th>Quiz Date</th>
                <th>Quiz Points</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rowq = $getqData->fetchArray(SQLITE3_ASSOC)) {
                    echo "
                    <tr>
                        <td>".$rowq['quiz_id']."</td>
                        <td>".$rowq['quiz_date']."</td>
                        <td>".$rowq['quiz_points']."</td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
<div class="tab-pane fade" id="default-tab-3">
    <!-- Orals table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Oral ID</th>
                <th>Oral Date</th>
                <th>Oral Points</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rowo = $getoData->fetchArray(SQLITE3_ASSOC)) {
                    echo "
                    <tr>
                        <td>".$rowo['oral_id']."</td>
                        <td>".$rowo['oral_date']."</td>
                        <td>".$rowo['oral_points']."</td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
<div class="tab-pane fade" id="default-tab-4">
    <!-- Exams table -->
</div>
<div class="tab-pane fade" id="default-tab-5">
    <!-- Term grades table -->
</div>
