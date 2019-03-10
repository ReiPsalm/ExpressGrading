<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="../../library/img/<?php echo $_SESSION['ins_fname'].$_SESSION['ins_lname']; ?>.jpg" alt="" /></a>
                </div>
                <div class="info">
                <?php echo $_SESSION['ins_fname']." ".$_SESSION['ins_lname']; ?>
                    <small><?php echo $_SESSION['user_role']; ?></small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li><a href="home.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-sliders"></i> 
                    <span>Class Record Setup</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="course.php">Course</a></li>
                    <li><a href="section.php">Section</a></li>
                    <li><a href="subject.php">Subject</a></li>
                    <li><a href="School.php">School</a></li>
                    <li><a href="dean.php">College Dean</a></li>
                    <li><a href="department.php">Department</a></li>
                </ul>
            </li>
            <li><a href="student.php"><i class="fa fa-clipboard"></i> <span>Master List</span></a></li>
            <li><a href="attendance.php"><i class="fa fa-group"></i> <span>Class Attendance</span></a></li>
            <li><a href="classrecord.php"><i class="fa fa-table"></i> <span>Class Record</span></a></li>
            <li><a href="#"><i class="fa fa-life-ring"></i> <span>Help</span></a></li>
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>