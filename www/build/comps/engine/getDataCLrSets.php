<?php
include_once "../engine/loader.php";
$classR->clrid = $_GET['dataid'];
$getData = $classR->GetDataClr();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<!-- begin page-header -->
<h1 class="page-header">Class Record Module</h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="ui-typography-14">
        <div class="panel-heading">
            <h4 class="panel-title">Class Details</h4>
        </div>
        <div class="panel-body">
            <dl class="dl-horizontal">
                <dt>Class Record ID :</dt>
                <dd><?php echo $_GET['dataid']; ?></dd>
                <dt>School :</dt>
                <dd><?php echo $row['sch_id']?></dd>
                <dt>Subject / Section :</dt>
                <dd><?php echo $row['subj_desc']?> ( <?php echo $row['Sec_desc']?> )</dd>
                <dt>Time / Day :</dt>
                <dd><?php echo $row['cr_timeDay']?></dd>
                <dt>Term / School Year :</dt>
                <dd><?php echo $row['cr_term']?> / <?php echo $row['cr_sy']?></dd>
            </dl>
        </div>
    </div>
    <!-- end panel -->

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Class Record</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="user" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Firstname</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->