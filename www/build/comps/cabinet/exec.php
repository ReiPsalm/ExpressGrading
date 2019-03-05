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
}else if($_POST['action'] == "savesec"){
    $Section->secdesc = $_POST['secdesc'];
    
    try{
        if ($Section->SaveSec()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "editsec"){
    $Section->secid = $_POST['idData'];
    $Section->secdesc = $_POST['newsec'];
    try{
        if ($Section->EditSec()) {
            echo "1";
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
}else if($_POST['action'] == "savestud"){
    $Students->studid = $_POST['studid'];
    $Students->name = $_POST['fname'];
    $Students->yrlvl = $_POST['yrlvl'];
    $Students->subj = $_POST['subj'];
    $Students->course = $_POST['course'];
    try{
        if ($Students->SaveStud()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "editstud"){
    $Students->studid = $_POST['studid'];
    $Students->name = $_POST['fname'];
    $Students->yrlvl = $_POST['yrlvl'];
    $Students->subj = $_POST['subj'];
    $Students->course = $_POST['course'];
    try{
        if ($Students->EditStud()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "savedept"){
    $Dept->deptdesc = $_POST['deptdesc'];
    
    try{
        if ($Dept->SaveDept()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "editDept"){
    $Dept->deptid = $_POST['idData'];
    $Dept->deptdesc = $_POST['newDept'];
    try{
        if ($Dept->EditDept()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "savedean"){
    $Dean->fname = $_POST['fname'];
    $Dean->mname = $_POST['mname'];
    $Dean->lname = $_POST['lname'];
    $Dean->ename = $_POST['ename'];
    $Dean->dept = $_POST['dept'];
    try{
        if ($Dean->SaveDean()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "editdean"){
    $Dean->deanid = $_POST['dataid'];
    $Dean->fname = $_POST['fname'];
    $Dean->mname = $_POST['mname'];
    $Dean->lname = $_POST['lname'];
    $Dean->ename = $_POST['ename'];
    $Dean->dept = $_POST['dept'];
    try{
        if ($Dean->EditDean()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "savesubj"){
    $subject->subjdesc = $_POST['subj'];
    $subject->subjdesc = $_POST['subj'];
    try{
        if ($subject->SaveSubj()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "upsubj"){
    $subject->subjid = $_POST['dataid'];
    $subject->subjdesc = $_POST['subj'];
    $subject->Secid = $_POST['secid'];
    try{
        if ($subject->EditSubj()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "uploadcsv"){
    $sample = json_decode($_POST['students'],true);
    try{
        $i=0;
        foreach ($sample as $val) {

            $Courses->coursedesc = $val['Course'];
            $getData = $Courses->GetSetCourseid();
            $row = $getData->fetchArray(SQLITE3_ASSOC);

            $Students->studid = $val['Id'];
            $Students->name = $val['Name'];
            $Students->yrlvl = $val['Level'];
            $Students->subj = $_POST['subjcsv'];
            $Students->course = $row['course_id'];
            try{
                if ($Students->SaveStud()) {
                    echo "1";
                }else{
                    echo "0";
                }
            }catch(PDOException $e){
                echo 'Connection Error :'.$e->getMessage();
            }
            
            $i++;
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else{
    echo "6";
}

?>