<?php
include_once "../engine/loader.php";
$sepData = explode("-",$_GET['dataid']);
$getqData = $Quiz->GetQzRecord($sepData[0],$sepData[1]);
$getoData = $Orals->GetOrRecord($sepData[0],$sepData[1]);
$getexData = $Exams->GetExRecord($sepData[0],$sepData[1]);
?>
<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">
    <li class="active"><a href="#quiz" data-toggle="tab"><i class="fa fa-edit m-r-5"></i> <span class="hidden-xs">Quiz</span></a></li>
    <li class=""><a href="#oral" data-toggle="tab"><i class="fa fa-child m-r-5"></i> <span class="hidden-xs">Orals</span></a></li>
    <li class=""><a href="#exam" data-toggle="tab"><i class="fa fa-pencil m-r-5"></i> <span class="hidden-xs">Exams</span></a></li>
</ul>

<div class="tab-content" data-sortable-id="index-3">
    <div class="tab-pane fade active in" id="quiz">
        <div data-scrollbar="true">
            <div class="table-responsive">
                <table class="table table-bordered tbl_quiz">
                    <thead>
                        <tr>
                            <th>Quiz ID</th>
                            <th>Quiz Date</th>
                            <th>Quiz Score</th>
                            <th>Quiz Period</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($rowq = $getqData->fetchArray(SQLITE3_ASSOC)){
                        echo'
                        <tr>
                            <td>'.$rowq['quiz_id'].'</td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'quiz\',$(this).text(),\'date\',\''.$rowq['quiz_id'].'\')">
                            '.$rowq['quiz_date'].'
                            </td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'quiz\',$(this).text(),\'points\',\''.$rowq['quiz_id'].'\')">
                            '.$rowq['quiz_points'].'
                            </td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'quiz\',$(this).text(),\'period\',\''.$rowq['quiz_id'].'\')">
                            '.$rowq['quiz_period'].'
                            </td>
                        </tr>    
                        ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="oral">
        <div data-scrollbar="true">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Oral ID</th>
                            <th>Oral Date</th>
                            <th>Oral Score</th>
                            <th>Oral Period</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($rowo = $getoData->fetchArray(SQLITE3_ASSOC)){
                        echo'
                        <tr>
                            <td >'.$rowo['oral_id'].'</td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'oral\',$(this).text(),\'date\',\''.$rowo['oral_id'].'\')">
                            '.$rowo['oral_date'].'
                            </td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'oral\',$(this).text(),\'points\',\''.$rowo['oral_id'].'\')">
                            '.$rowo['oral_points'].'
                            </td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'oral\',$(this).text(),\'period\',\''.$rowo['oral_id'].'\')">
                            '.$rowo['oral_period'].'
                            </td>
                        </tr>    
                        ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="exam">
        <div data-scrollbar="true">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Exam ID</th>
                            <th>Exam Date</th>
                            <th>Exam Score</th>
                            <th>Exam Period</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($rowex = $getexData->fetchArray(SQLITE3_ASSOC)){
                        echo'
                        <tr>
                            <td>'.$rowex['exam_id'].'</td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'exam\',$(this).text(),\'date\',\''.$rowex['exam_id'].'\')">
                            '.$rowex['exam_date'].'
                            </td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'exam\',$(this).text(),\'points\',\''.$rowex['exam_id'].'\')">
                            '.$rowex['exam_points'].'
                            </td>
                            <td contenteditable="true" onblur="Appex.TblRecUpdate(\'exam\',$(this).text(),\'period\',\''.$rowex['exam_id'].'\')">
                            '.$rowex['exam_period'].'</td>
                        </tr>    
                        ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
