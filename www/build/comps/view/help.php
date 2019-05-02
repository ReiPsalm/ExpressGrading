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

	<link href="../../library/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
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
			<h1 class="page-header">User manual</h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
                <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
							<h4 class="panel-title">Hello! <?php echo $_SESSION['ins_fname']; ?></h4>
                        </div>
                        <div class="panel-body">
						<div id="wizard">
							<ol>
								<li>
									Greetings! 
									<small>Thank you for purchasing Express Grading</small>
								</li>
								<li>
									Installation
									<small>First time Application Setup guide on PC</small>
								</li>
								<li>
									User Interfaces
									<small>A step by step tour to the application functonalities.</small>
								</li>
								<li>
									Completed
									<small>Congratulations!, your up and ready for the real deal.</small>
								</li>
							</ol>
							<!-- begin wizard step-1 -->
							<div>
								<!-- begin row -->
								<div class="row f-s-13">
									<div class="col-md-12 m-b-15 text-left">
										<!-- <img src="../../library/img/logoB.png" height="100" width="90" /> -->
										<h2 class="text-left">Welcome to Express Grading!</h2>
									</div>

									<div class="col-md-12 m-b-15 text-left">
										<p class="m-b-15">
											Before setting up the application, we would like to say Thank you for purchasing our product!
										</p>
										<p class="m-b-15">
											Express Grading is a custom made application dedicated to make school teachers/instructors work more convenient, it's main goal is to simplify student record 
											and performance easier, with the developers still improving the application, the possibilities of the application is still expandable beyond to what is expected 
											for the user's to explore and with built in <b>Predictive Student Outcome <i>(beta version)</i></b>, the application is able to predict student grade outcome. 
											base on the student performance.
										</p>
										<p class="m-b-15">
											Setting up the application is easy, and we will guide you to the next step of this manual.
										</p>
										<p class="m-b-15">Thank you for trusting our Team!</p>

										<p class="m-b-15">
											<b>Head Developers</b>
										</p>
										<p class="m-b-15"><b><i>Sammy Susana</i></b> & <b><i>Renee Francesca Adorador</i></b></p>
									</div>
								</div>
								<!-- end row -->
							</div>
							<!-- end wizard step-1 -->
							<!-- begin wizard step-2 -->
							<div>
								<fieldset>
									<legend class="pull-left width-full"><i class="fa fa-cogs"></i> Installation </legend>
									<!-- begin row -->
									<div class="row f-s-13">
										<div class="col-md-12 m-b-15 text-left">
											<p class="m-b-15">
												Installing Express Grading is easy!, upon purchase you will be given a setup file and a liscense file via email to avail the Express Grading you can 
												visit and contact us on <a href="https://reipsalm.github.io/SammySusana">https://reipsalm.github.io/SammySusana</a>
											</p>
											<p class="m-b-15">
												<b>1.</b> After downloading the Setup file and liscense file, you can start up the installation by clicking the Setup file, 
												the Setup filename will be <b>ExpGrading.exe</b>.
											</p>
											<p class="m-b-15">
												<b>2.</b> The Setup will ask you for the language you want to install as shown below. Then click <b>"Next"</b>
											</p>
											<p class="m-b-15">
												<img src="../../library/img/manual/a.png" height="400" width="800" />
											</p>
											<p class="m-b-15">
												<b>3.</b> When you have chosen the language at your choice, the setup will ask a few user information, <b>User name</b>, <b>Organization</b> 
												and <b>Serial number</b>. Please copy your liscense number on your <i>liscense file</i>. Then click <b>"Next"</b>
											</p>
											<p class="m-b-15">
												<img src="../../library/img/manual/b.png" height="400" width="800" />
											</p>
											<p class="m-b-15">
												<b>4.</b> You will be then asked if you want to create shortcut on your desktop, this choice is optional depending on your preferences. Then click <b>"Next"</b> 
												and <b>"Install"</b> for the installation to start.
											</p>
											<p class="m-b-15">
												<img src="../../library/img/manual/c.png" height="400" width="800" />
											</p>

											<p class="m-b-15">
												So there you go! your up and ready for the next step!
											</p>
										</div>
									</div>
									<!-- end row -->
								</fieldset>
							</div>
							<!-- end wizard step-2 -->
							<!-- begin wizard step-3 -->
							<div>
								<fieldset>
									<legend class="pull-left width-full"><i class="fa fa-desktop"></i> User Interface</legend>
									<h5 class="m-b-15">
										The Express Grading Application is mainly composed of four (4) modules. The <b>Dashboard</b>,
										<b>Class Record Setup</b>, <b>Student List</b> and <b>Class Record</b>
									</h5>
									<!-- begin row -->
									<div class="row f-s-13">
										<ul class="nav nav-pills">
											<li class="active"><a href="#dashboard" data-toggle="tab"><i class="fa fa-cubes"></i> Dashboard</a></li>
											<li><a href="#ClrST" data-toggle="tab"><i class="fa fa-magic"></i> Class Record Setup</a></li>
											<li><a href="#StList" data-toggle="tab"><i class="fa fa-users"></i> Student List</a></li>
											<li><a href="#CLrecord" data-toggle="tab"><i class="fa fa-book"></i> Class Record</a></li>
											<li><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i> User Profile</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane fade active in" id="dashboard">
												<div class="col-md-12 m-b-15 text-left">
													<p class="m-b-15">
														<b>1.</b> After the installation, you can now login to your user account as shown below the image. Your user account will be included on the <i>liscense file</i> 
														sent to you via email.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/d.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b>2.</b> Upon login you will be redirected to the Dashboard, your dashboard have three parts, the <b>Class record Stat</b>, 
														<b> Active Class record</b> and <b>Student Statistical Outcome</b>.
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.1</i></b> The <b>Class Record Stat</b> show the total count of all <b class="text-danger"><i>Tardy</i></b>, 
														<b class="text-warning"><i>Mediocre</i></b>, and <b class="text-success"><i>Excellent</i></b> Performances of your student 
														base on all the current Acctive Class record you have.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/g.png" height="95" width="700" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.2</i></b> The <b> Active Class record</b> will show you the active class record you have, you also have the ability to place it 
														on <i>Archive</i> when you think you don't need it anymore or you need to clean up some data for the new School year.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/e.png" height="300" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.3</i></b> The <b>Student Statistical Outcome <i>Beta version</i></b> shows you the posible outcome of the student base on its current performance 
														on a specific subject. This will show you a set of posible data, based thier current performances, <i class="text-danger">Tardy</i>, <i class="text-warning">Mediocre</i> 
														and <i class="text-success">Excellent</i> Performances.
													</p>
													<p class="m-b-15">
														<i><b class="text-danger">NOTE:</b> These are only statistical data and will not affect the student performance. The purpose of this feature is to only remind 
														students about the posibilities of thier performances as precaution or encouragement to perform well on the class.</i>
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/f.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.3.1</i></b> The image below is an example of the <b>Student Statistical Outcome</b>, in this case it shows <b class="text-info">IF</b> the student get's 
														tardy on the specific subject.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/h.png" height="300" width="800" />
													</p>
												</div>
											</div>
											<div class="tab-pane fade" id="ClrST">
												<div class="col-md-12 m-b-15 text-left">
													<p class="m-b-15">
														<b>1.</b> Before you can start in your class record you need to set up your students and of couse your class record. The class record is 
														composed of six (6) sub modules. <b>Course</b>, <b>Section</b>, <b>Subject</b>, <b>School</b>, <b>College Dean</b> and <b>Department</b> as shown 
														in the image below
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/i.png" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.1</i></b> The course module is for your student courses you can add and update 
														the data also if need. A sample image is as shown below
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/j.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.2</i></b> The section module is for your class record you can also add and update 
														the data also if needed.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/k.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.3</i></b> The subject module is for your class record, as for every class record has different 
														subject, you can also add and update the data also if needed.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/l.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.4</i></b> For instances that you are also teaching on other school as part-time, you can also assign 
														a dedicated school for a specific class record.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/m.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.5</i></b> Every class record have thier own Dean that is assigned to them, this is for the 
														submition purposes by the end of the period of a specific subject.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/n.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.5</i></b> Just like any class record, each class record is also assigned to a specific department.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/o.png" height="400" width="800" />
													</p>
												</div>
											</div>
											<div class="tab-pane fade" id="StList">
												<div class="col-md-12 m-b-15 text-left">
													<p class="m-b-15">
														<b>1.</b> The student list shows all your current student in a certain school year. You can add students 
														manually or upload it by bulk through .csv, you can also sort the students per subject, by default it 
														shows all your sutdent in all of your active class record.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/p.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b>2.</b> If you want to selectively sort search for your students, you can sort it by subject as shown in the image below.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/q.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b>3.</b> You can also add student manually if needed, in cases you forgot to add a specific student on a certain subject and section.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/r.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b>4.</b> You can also add student by bulk, all you need is a .csv file.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/s.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>4.1</i></b> <b class="text-danger">NOTE: </b> .csv file should be on the right format, the image below shows the needed data 
														to be followed <b class="text-danger"><i>STRICTLY</i></b>.
													</p>
													<p class="m-b-15">
														The first field is the <b>Student ID</b>, the second field is the <b>Student Name</b> <i class="text-danger">(Avoid using comma in this field)</i>, 
														the third filed is the <b>Student Year level</b> and the fourth field is the <b>Student Course</b>
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/t.png" />
													</p>
												</div>
											</div>
											<div class="tab-pane fade" id="CLrecord">
												<div class="col-md-12 m-b-15 text-left">
													<p class="m-b-15">
														<b>1.</b> The class record module show all your active class record, you can add and update 
														any information under this module as shown images below.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/u.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/v.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/w.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b>2.</b> The image shown below, is an example inside your class record. The first tab you'll see 
														on the top is the class record information. The next one below it is the students that is enrolled 
														on that class. You can add class Quizzes, Orals, Attendance and Exams in this module.
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.1</i></b> Before you add some record performance on your student please be mindfull 
														on what period will you put it in <i>(Prelim,Midterm,Semi or Final Period)</i>. If no period will be chosen 
														you will be prompted by the application to specify first on what period it will be dedicated.
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/x.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.2</i></b> The view record <i>(as shown below the image)</i> will show the 
														student's records <i>Orals, Quizzes and Exams</i>
													</p>
													<p class="m-b-15">
														<img src="../../library/img/manual/y.png" height="400" width="800" />
													</p>
													<p class="m-b-15">
														<b class="text-info"><i>2.3</i></b> You can also export the class record. You can have two choices on 
														exporting the class record, you can either Export a <i class="text-danger">(summarized output)</i> which will only show the final grade 
														of all the students or you can have a <i class="text-danger">(detailed information)</i> <b><i class="text-info">(points percentage and equivalencies)</i></b>
													</p>
												</div>
											</div>
											<div class="tab-pane fade" id="profile">
												<p class="m-b-15">
													<b>1</b> You can also update your personal information in the application. By default it is not setup yet and will be needing some 
													input from the user.
												</p>
												<p class="m-b-15">
													<img src="../../library/img/manual/z.png" height="400" width="800" />
												</p>
											</div>
										</div>
									</div>
									<!-- end row -->
								</fieldset>
							</div>
							<!-- end wizard step-3 -->
							<!-- begin wizard step-4 -->
							<div>
								<div class="jumbotron m-b-0 text-center">
									<h1>Congratulations!</h1>
									<p>
										You are now ready to start the school year!. You can still go back here if you need something about the application functionalities. 
										If you need more information please email us on <i class="text-info">repsalmsusana@gmail.com</i> or you can chat us directly at our 
										website <i class="text-info">https://reipsalm.github.io/SammySusana</i>
										<p><a  href="home.php" class="btn btn-success btn-lg" role="button">Go to Dashboard</a></p>
									</p>
								</div>
							</div>
							<!-- end wizard step-4 -->
						</div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		
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
	<script src="../../library/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="../../library/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
	<script src="../../library/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="../../library/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../../library/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="../applet/appscript.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../../library/js/apps.min.js"></script>
	<script src="../../library/plugins/lobibox-master/js/lobibox.js"></script>
	<script src="../../library/plugins/lobibox-master/demo/demo.js"></script>
	<script src="../../library/plugins/sweetalert-master/dist/sweetalert-dev.js"></script>

	<script src="../../library/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="../../library/js/form-wizards.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			FormWizard.init();
		});
	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/page_with_footer.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Apr 2016 04:05:06 GMT -->
</html>

