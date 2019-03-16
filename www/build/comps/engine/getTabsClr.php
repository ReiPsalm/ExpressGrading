<?php
include_once "../engine/loader.php";
$sepData = explode("-",$_GET['dataid']);
$Exams->studid = $Orals->studid = $quizzes->studid = $sepData[0];
$Exams->crid = $Orals->crid = $quizzes->crid = $sepData[1];
$getqData = $quizzes->GetQuizStud();
$getoData = $Orals->GetOralStud();
$getxData = $Exams->GetExamStud();
?>

<div class="tab-pane fade active in" id="default-tab-1">
    <!-- attendance table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attendance ID</th>
                <th>Attendance Date</th>
                <th>Attendance Points</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Exam ID</th>
                <th>Exam Date</th>
                <th>Exam Points</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rowx = $getxData->fetchArray(SQLITE3_ASSOC)) {
                    echo "
                    <tr>
                        <td>".$rowx['exam_id']."</td>
                        <td>".$rowx['exam_date']."</td>
                        <td>".$rowx['exam_points']."</td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
<div class="tab-pane fade" id="default-tab-5">
    <!-- Term grades table -->
    <!-- Exams table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Term ID</th>
                <th>Term</th>
                <th>Term Grade</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
