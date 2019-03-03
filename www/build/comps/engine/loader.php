<?php
include_once "../privates/gantry.php";
include_once "classes.php";


$coms = new HostDb();

$Users = new UsersClass($coms);
$Courses = new CourseMod($coms);
$Students = new StudentMod($coms);
$Dept = new DeptMod($coms);
$Dean = new DeanMod($coms);
$Section = new SectionMod($coms);
$subject = new SubjMod($coms);

$tbljoins = new TblJoinsMod($coms);
?>