<?php
include_once "../privates/gantry.php";
include_once "classes.php";


$coms = new HostDb();

$Users = new UsersClass($coms);
$Courses = new CourseMod($coms);
$Students = new StudentMod($coms);
?>