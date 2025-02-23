<?php
session_start();
if(isset($_SESSION['user_id'])){
    header("location:build/comps/view/home.php");
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Apr 2016 04:05:16 GMT -->
<head>
	<meta charset="utf-8" />
	<title>Express Grading</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="build/library/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="build/library/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="build/library/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="build/library/css/animate.min.css" rel="stylesheet" />
	<link href="build/library/css/style.min.css" rel="stylesheet" />
	<link href="build/library/css/style-responsive.min.css" rel="stylesheet" />
	<link href="build/library/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- Lobibox return messages -->
    <link rel="stylesheet" href="build/library/plugins/lobibox-master/demo/demo.css"/>
    <link rel="stylesheet" href="build/library/plugins/lobibox-master/dist/css/lobibox.min.css"/>
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="build/library/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login bg-black animated fadeInDown">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
				<img src="build/library/img/logoB.png" height="39" width="35" /> Express Grading
                    <small>Class Record Management</small>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
                <form id="Expform" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="email" id="username" class="form-control input-lg" placeholder="Email Address" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" id="password" class="form-control input-lg" placeholder="Password" />
                    </div>
                    <div class="login-buttons">
                        <button type="submit" id="login" class="btn btn-success btn-block btn-lg">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end login -->
		<center>
			Copyright &copy; <a target="_blank" href="https://reipsalm.github.io/SammySusana/">2019 Sammy Susana Web Development</a>
		</center>
        
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="build/library/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="build/library/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="build/library/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="build/library/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="build/library/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="build/library/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="build/library/js/apps.min.js"></script>
  	<script src="build/comps/applet/appscript.js"></script>
	<!-- Modal alerts -->
	<script src="build/library/plugins/lobibox-master/js/lobibox.js"></script>
	<script src="build/library/plugins/lobibox-master/demo/demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Appex.UserLogin();
		});
	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Apr 2016 04:05:16 GMT -->
</html>

