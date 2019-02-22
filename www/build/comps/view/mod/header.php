<div id="header" class="header navbar navbar-default navbar-fixed-top">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <a href="index.html" class="navbar-brand"><span><img src="../../library/img/logoB.png" height="39" width="35" /> </span> 
            Express Grading</a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->
        
        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../../library/img/<?php echo $_SESSION['ins_fname'].$_SESSION['ins_lname']; ?>.jpg" alt="" />
                    <span class="hidden-xs"><?php echo $_SESSION['ins_fname']." ".$_SESSION['ins_lname']; ?></span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
                    <li><a href="javascript:;">Edit Profile</a></li>
                    <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                    <li><a href="javascript:;">Calendar</a></li>
                    <li><a href="javascript:;">Setting</a></li>
                    <li class="divider"></li>
                    <li><a href="../engine/terminator.php">Log Out</a></li>
                </ul>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>