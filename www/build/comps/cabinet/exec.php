<?php
session_start();
include_once "../engine/loader.php";

if($_POST['action'] == "login"){
    $Users->uname = $_POST['uname'];
    $Users->upass = $_POST['upass'];

    try {
        if ($Users->LoginUser()) {
            echo "1";
        }elseif (!$Users->LoginUser()) {
            echo "2";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "savecourse"){
    $Courses->coursedesc = $_POST['course'];
    
    try{
        if ($Courses->SaveCourse()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "editcourse"){
    $Courses->courseid = $_POST['idData'];
    $Courses->coursedesc = $_POST['newcourse'];
    try{
        if ($Courses->EditCourse()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else{
    echo "6";
}

?>