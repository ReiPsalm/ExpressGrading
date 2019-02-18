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
			<h1 class="page-header">Dashboard</h1>
			<!-- end page-header -->
			
			<div class="panel panel-inverse">
			    <div class="panel-heading">
			        <div class="panel-heading-btn">
			            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
			            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			        </div>
			        <h4 class="panel-title">Panel Title here</h4>
			    </div>
			    <div class="panel-body">
			        Panel Content Here
			    </div>
			</div>
		</div>
		<!-- end #content -->
		
		<!-- begin #footer -->
		<div id="footer" class="footer">
		    &copy; <a href="https://reipsalm.github.io/SammySusana/">2019 Sammy Susana Web Development</a>
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
	<script src="../../library/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/page_with_footer.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Apr 2016 04:05:06 GMT -->
</html>

