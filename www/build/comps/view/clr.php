<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../../../");
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/page_with_footer.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Apr 2016 04:05:06 GMT -->
<head>
	<meta charset="utf-8" />
	<title>Express Grading</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="../../library/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="../../library/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../../library/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="../../library/css/animate.min.css" rel="stylesheet" />
	<link href="../../library/css/style.min.css" rel="stylesheet" />
	<link href="../../library/css/style-responsive.min.css" rel="stylesheet" />
	<link href="../../library/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="../../library/plugins/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../../library/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php include "mod/header.php"; ?>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<?php include "mod/Sidebar.php"; ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
		<!-- begin page-header -->
		<h1 class="page-header">Class Record Module</h1>
			<!-- end page-header -->

			<!-- begin panel -->
			<div class="panel panel-inverse" data-sortable-id="ui-typography-14">
				<div class="panel-heading">
					<h4 class="panel-title">Class Details</h4>
				</div>
				<div class="panel-body" id="cldata">
					
				</div>
			</div>
			<!-- end panel -->

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<button href="#?dataID=<?php echo $_GET['dataid']?>" class="btn btn-xs btn-info" title="Add course">
							<i class="fa fa-file" ></i> Export Class record
						</button>
					</div>
					<h4 class="panel-title">Class Record</h4>
				</div>
				<div class="panel-body">
				<!--select * from student then check classes to refer on tbl_classlist if true display student-->
					<table id="data-table" class="table table-striped table-bordered">
						<thead>
						<tr>
							<th>Student ID</th>
							<th>Student Name</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
							<td>01105205</td>
							<td>SUSANA REI PSALM M.</td>
							<td>
								<div class="btn-group m-r-5 m-b-5">
									<a href="javascript:;" data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle">Attendance <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="javascript:;">Present</a></li>
										<li><a href="javascript:;">Excused</a></li>
										<li><a href="javascript:;">Absent</a></li>
									</ul>
								</div>
								<div class="btn-group m-r-5 m-b-5">
									<button class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Add Quiz</button>
								</div>
								<div class="btn-group m-r-5 m-b-5">
									<button class="btn btn-inverse btn-sm"><i class="fa fa-child"></i> Add Orals</button>
								</div>
								<div class="btn-group m-r-5 m-b-5">
									<button class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Student Record</button>
								</div>
							</td>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- end #content -->
		
		<!-- begin #footer -->
		<div id="footer" class="footer">
		    Copyright &copy; <a target="_blank" href="https://reipsalm.github.io/SammySusana/">2019 Sammy Susana Web Development</a>
		</div>
		<!-- end #footer -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../../library/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="../../library/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="../../library/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="../../library/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="../../library/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../../library/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../../library/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="../../library/js/apps.min.js"></script>
	<script src="../applet/appscript.js"></script>

	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Appex.GetDataSets(<?php echo $_GET['dataid']?>,'getDataCLrSets','cldata');
			
		});
	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/page_with_footer.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Apr 2016 04:05:06 GMT -->
</html>

