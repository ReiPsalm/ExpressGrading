<?php
include_once "../engine/loader.php";
$SepID = explode("-",$_GET['dataid']);
$Clr = $SepID[1];
$studID = $SepID[0];

include("TardyPF.php");
include("MdcPF.php");
include("ExcPF.php");
?>
<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">
    <li class="active"><a href="#quiz" data-toggle="tab"><i class="fa fa-thumbs-down text-danger m-r-5"></i> <span class="hidden-xs">Tardy Performance</span></a></li>
    <li class=""><a href="#oral" data-toggle="tab"><i class="fa fa-warning text-warning m-r-5"></i> <span class="hidden-xs">Mediocre Performance</span></a></li>
    <li class=""><a href="#exam" data-toggle="tab"><i class="fa fa-thumbs-up text-success m-r-5"></i> <span class="hidden-xs">Excellent Performance</span></a></li>
</ul>
<div class="tab-content" data-sortable-id="index-3">
    <div class="tab-pane fade active in" id="quiz">
        <div data-scrollbar="true">
            <div class="table-responsive">
                <div class="m-b-15 border-bottom-1">
                    <p class="text- text-justify">
                        <b class="text text-danger">NOTE!</b><br>
                        <i>The data presented are only <i class="text text-info"><b>"PREDICTIVE DATA"</b></i> base on the Student's current performance and will not affect the final outcome of the instructor's final record.</i>
                    </p>
                </div>
                <table class="table table-bordered tbl_quiz">
                    <thead>
                        <tr>
                            <th>Midterm Grade</th>
                            <th>Attendance</th>
                            <th>Orals</th>
                            <th>Quiz</th>
                            <th>Semi Exam</th>
                            <th>Final Exam</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-danger"><?php echo $PMGrade ?></td>
                            <td class="text-danger"><?php echo $fail[0] ?></td>
                            <td class="text-danger"><?php echo $fail[1] ?></td>
                            <td class="text-danger"><?php echo $fail[2] ?></td>
                            <td class="text-danger"><?php echo $fail[3] ?></td>
                            <td class="text-danger"><?php echo $fail[4] ?></td>
                            <td class="text-danger"><?php echo $Tardy_Grade ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="oral">
        <div data-scrollbar="true">
            <div class="table-responsive">
                <div class="m-b-15 border-bottom-1">
                    <p class="text- text-justify">
                        <b class="text text-danger">NOTE!</b><br>
                        <i>The data presented are only <i class="text text-info"><b>"PREDICTIVE DATA"</b></i> base on the Student's current performance and will not affect the final outcome of the instructor's final record.</i>
                    </p>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Midterm Grade</th>
                            <th>Attendance</th>
                            <th>Orals</th>
                            <th>Quiz</th>
                            <th>Semi Exam</th>
                            <th>Final Exam</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                        <tr>
                            <td class="text-warning"><?php echo $MdcPMGrade ?></td>
                            <td class="text-warning"><?php echo $med[0] ?></td>
                            <td class="text-warning"><?php echo $med[1] ?></td>
                            <td class="text-warning"><?php echo $med[2] ?></td>
                            <td class="text-warning"><?php echo $med[3] ?></td>
                            <td class="text-warning"><?php echo $med[4] ?></td>
                            <td class="text-warning"><?php echo $MDC_Grade ?></td>
                        </tr>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="exam">
        <div data-scrollbar="true">
            <div class="table-responsive">
                <div class="m-b-15 border-bottom-1">
                    <p class="text- text-justify">
                        <b class="text text-danger">NOTE!</b><br>
                        <i>The data presented are only <i class="text text-info"><b>"PREDICTIVE DATA"</b></i> base on the Student's current performance and will not affect the final outcome of the instructor's final record.</i>
                    </p>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Midterm Grade</th>
                            <th>Attendance</th>
                            <th>Orals</th>
                            <th>Quiz</th>
                            <th>Semi Exam</th>
                            <th>Final Exam</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-success"><?php echo $ExcPMGrade ?></td>
                            <td class="text-success"><?php echo $excl[0] ?></td>
                            <td class="text-success"><?php echo $excl[1] ?></td>
                            <td class="text-success"><?php echo $excl[2] ?></td>
                            <td class="text-success"><?php echo $excl[3] ?></td>
                            <td class="text-success"><?php echo $excl[4] ?></td>
                            <td class="text-success"><?php echo $ECX_Grade ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>