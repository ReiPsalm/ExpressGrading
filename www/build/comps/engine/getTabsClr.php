<?php
include_once "../engine/loader.php";
$sepData = explode("-",$_GET['dataid']);
// $getqData = $Quiz->GetQuizStud();
// $getoData = $Orals->GetOralStud();
// $getxData = $Exams->GetExamStud();
?>


<div class="tab-pane fade" id="default-tab-1">
    <!-- quizzes form -->
    <div class="panel-group" id="accordion">
        <div class="panel panel-inverse overflow-hidden">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAtt">
                        Add Quiz <i class="fa fa-plus-circle pull-right"></i>
                    </a>
                </h3>
            </div>
            <div id="collapseAtt" class="panel-collapse collapse">
                <div class="panel-body">
                    <form id="Expformat" class="m-b-15">
                        <label class="control-label">Input Quiz<i class="text text-danger">*</i></label>
                        <div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="hidden" id="atcrid" value="<?php echo $sepData[1]?>" />
                                <input type="hidden" id="atstudid" value="<?php echo $sepData[0]?>" />
                                <input type="date" class="form-control datepicker-default" id="atDate" placeholder="Date"/>
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input type="text" class="form-control" id="qp" placeholder="Quiz points"/>
                            </div>
                        </div>
                    </form>
                    <div class="border-bottom-1">
                        <button type="submit" id="saveat" class="saveq btn btn-sm btn-primary btn-block"><i class="fa fa-check"></i> Save Quiz</button>
                    </div>
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
            
        </tbody>
    </table>
</div>
<div class="tab-pane fade" id="default-tab-2">
    <!-- Orals form -->
    <div class="panel-group" id="accordion">
        <div class="panel panel-inverse overflow-hidden">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOr">
                        Add Oral <i class="fa fa-plus-circle pull-right"></i>
                    </a>
                </h3>
            </div>
            <div id="collapseOr" class="panel-collapse collapse">
                <div class="panel-body">
                    <form id="Expformat" class="m-b-15">
                        <label class="control-label">Input Oral<i class="text text-danger">*</i></label>
                        <div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="hidden" id="Orcrid" value="<?php echo $sepData[1]?>" />
                                <input type="hidden" id="Orstudid" value="<?php echo $sepData[0]?>" />
                                <input type="date" class="form-control datepicker-default" id="OrDate" placeholder="Date"/>
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input type="text" class="form-control" id="op" placeholder="Oral points"/>
                            </div>
                        </div>
                    </form>
                    <div class="border-bottom-1">
                        <button type="submit" id="saveOr" class="saveq btn btn-sm btn-primary btn-block"><i class="fa fa-check"></i> Save Quiz</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Orals table -->
</div>
<div class="tab-pane fade" id="default-tab-3">
    <!-- Exam form -->
    <div class="panel-group" id="accordion">
        <div class="panel panel-inverse overflow-hidden">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEx">
                        Add Exam <i class="fa fa-plus-circle pull-right"></i>
                    </a>
                </h3>
            </div>
            <div id="collapseEx" class="panel-collapse collapse">
                <div class="panel-body">
                    <form id="Expformat" class="m-b-15">
                        <label class="control-label">Input Exam<i class="text text-danger">*</i></label>
                        <div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="hidden" id="Excrid" value="<?php echo $sepData[1]?>" />
                                <input type="hidden" id="Exstudid" value="<?php echo $sepData[0]?>" />
                                <input type="date" class="form-control datepicker-default" id="ExDate" placeholder="Date"/>
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input type="text" class="form-control" id="ep" placeholder="Exam points"/>
                            </div>
                        </div>
                    </form>
                    <div class="border-bottom-1">
                        <button type="submit" id="saveEx" class="saveq btn btn-sm btn-primary btn-block"><i class="fa fa-check"></i> Save Quiz</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Exams table -->
</div>
<div class="tab-pane fade" id="default-tab-4">
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
