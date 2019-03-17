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
    <!-- quizzes form -->
    <div class="panel panel-inverse overflow-hidden">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a onclick="Appex.SaveQuiz()" class="btn btn-inverse accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseQuiz">
                    <i class="fa fa-plus-circle"></i> 
                    Add new Data
                </a>
            </h3>
        </div>
        <div id="collapseQuiz" class="panel-collapse collapse">
            <div class="panel-body">
                <form id="Expformq" class="m-b-15">
                    <label class="control-label">Input Quiz<i class="text text-danger">*</i></label>
                    <div class="row row-space-10">
                        <div class="col-md-6 m-b-15">
                            <input type="hidden" id="qcr" value="<?php echo $sepData[1]?>" />
                            <input type="hidden" id="studq" value="<?php echo $sepData[0]?>" />
                            <input type="text" class="form-control datepicker-default" id="qd" placeholder="Date" />
                        </div>
                        <div class="col-md-6 m-b-15">
                            <input type="text" class="form-control" id="qp" placeholder="Quiz points"/>
                        </div>
                    </div>
                </form>
                <div class="border-bottom-1">
                    <button type="submit" id="saveq" class="saveq btn btn-sm btn-primary btn-block"><i class="fa fa-check"></i> Save Quiz</button>
                </div>
            </div>
        </div>
    </div>
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
    <!-- Orals form -->
    <div class="panel panel-inverse overflow-hidden">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a onclick="Appex.SaveOrals()" class="btn btn-inverse accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOral">
                    <i class="fa fa-plus-circle"></i> 
                    Add new Data
                </a>
            </h3>
        </div>
        <div id="collapseOral" class="panel-collapse collapse">
            <div class="panel-body">
                <form id="Expformo" enctype="multipart/form-data" method="POST" class="m-b-15">
                    <label class="control-label">Input Orals<i class="text text-danger">*</i></label>
                    <div class="row row-space-10">
                        <div class="col-md-6 m-b-15">
                        <input type="hidden" id="ocr" value="<?php echo $sepData[1]?>" />
                        <input type="hidden" id="studo" value="<?php echo $sepData[0]?>" />
                            <input type="text" class="form-control datepicker-default" id="od" placeholder="Date" />
                        </div>
                        <div class="col-md-6 m-b-15">
                            <input type="text" class="form-control" id="op" placeholder="Recitation points" />
                        </div>
                    </div>
                </form>
                <div class="border-bottom-1">
                    <button type="submit" id="saveo" class="saveq btn btn-sm btn-primary btn-block"><i class="fa fa-check"></i> Save Oral</button>
                </div>
            </div>
        </div>
    </div>
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
    <!-- Exam form -->
    <div class="panel panel-inverse overflow-hidden">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a onclick="Appex.SaveExams()" class="btn btn-inverse accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseExam">
                    <i class="fa fa-plus-circle"></i> 
                    Add new Data
                </a>
            </h3>
        </div>
        <div id="collapseExam" class="panel-collapse collapse">
            <div class="panel-body">
                <form id="Expformo" enctype="multipart/form-data" method="POST" class="m-b-15">
                    <label class="control-label">Input Exams<i class="text text-danger">*</i></label>
                    <div class="row row-space-10">
                        <div class="col-md-6 m-b-15">
                        <input type="hidden" id="ocx" value="<?php echo $sepData[1]?>" />
                        <input type="hidden" id="studx" value="<?php echo $sepData[0]?>" />
                            <input type="text" class="form-control datepicker-default" id="odx" placeholder="Date" />
                        </div>
                        <div class="col-md-6 m-b-15">
                            <input type="text" class="form-control" id="opx" placeholder="Recitation points" />
                        </div>
                    </div>
                </form>
                <div class="border-bottom-1">
                    <button type="submit" id="savex" class="saveq btn btn-sm btn-primary btn-block"><i class="fa fa-check"></i> Save Oral</button>
                </div>
            </div>
        </div>
    </div>
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
                <th>Periodical ID</th>
                <th>Periodical Date</th>
                <th>Periodical Grade</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
