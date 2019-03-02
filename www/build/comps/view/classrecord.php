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
	<!-- Lobibox return messages -->
    <link rel="stylesheet" href="../../library/plugins/lobibox-master/demo/demo.css"/>
    <link rel="stylesheet" href="../../library/plugins/lobibox-master/dist/css/lobibox.min.css"/>

	<link href="../../library/plugins/sweetalert-master/dist/sweetalert.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<link href="../../library/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="../../library/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="../../library/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
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
			<div class="panel panel-inverse">
			    <div class="panel-heading">
					<div class="panel-heading-btn">
						<button href="#exp_modal" data-toggle="modal" class="btn btn-xs btn-info" title="Add course">
							<i class="fa fa-plus"></i> New Class Record
						</button>
			        </div>
			        <h4 class="panel-title">Search Class Record</h4>
			    </div>
			    <div class="panel-body">
					<form id="ExpformSort" method="POST" class="border-bottom-1 m-b-15">
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<select id="yrlvl" class="form-control">
									<option value="">Select School Year</option>
								</select>
							</div>
							<div class="col-md-6 m-b-15">
								<select id="yrlvl" class="form-control">
									<option value="">Select Term</option>
								</select>
							</div>
						</div>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<select id="yrlvl" class="form-control">
									<option value="">Select Subject</option>
								</select>
							</div>
							<div class="col-md-6 m-b-15">
								<select id="yrlvl" class="form-control">
									<option value="">Select Section</option>
								</select>
							</div>
						</div>
					</form>
					<div class="pull-right">
						<button type="submit" id="savedt" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>
					</div>
			    </div>
			</div>

			<div class="panel panel-inverse">
			    <div class="panel-heading">
			        <h4 class="panel-title">Class Record</h4>
			    </div>
			    <div class="panel-body">
					
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
	<script src="../../library/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="../../library/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="../../library/js/apps.min.js"></script>
	<script src="../applet/appscript.js"></script>
	<!-- Modal alerts -->
	<script src="../../library/plugins/lobibox-master/js/lobibox.js"></script>
	<script src="../../library/plugins/lobibox-master/demo/demo.js"></script>
	<script src="../../library/plugins/sweetalert-master/dist/sweetalert-dev.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/page_with_footer.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Apr 2016 04:05:06 GMT -->
</html>

