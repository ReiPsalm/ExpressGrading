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
            
            //check existing student and update current classes
            $Students->studid = $val['Id'];
            $getDatas = $Students->GetNumtStud();
            $rows = $getDatas->fetchArray();

            if($rows['count'] == 1){
                
                try{
                    //get current subj
                    $Students->studid = $val['Id'];
                    $getCurSubj = $Students->GetSetStud();
                    $subjrows = $getCurSubj->fetchArray();
                    
                    $Students->studid = $val['Id'];
                    $Students->subj = $subjrows['stud_classes'].','.$_POST['classcsv'];
                    if ($Students->UpStudSubj()) {
                        echo "x";
                    }else{
                        echo "0";
                    }
                }catch(PDOException $e){
                    echo 'Connection Error :'.$e->getMessage();
                }
            }else{

                //fetch courseid
                $Courses->coursedesc = $val['Course'];
                $getData = $Courses->GetSetCourseid();
                $row = $getData->fetchArray(SQLITE3_ASSOC);
                
                $Students->studid = $val['Id'];
                $Students->name = $val['Name'];
                $Students->yrlvl = $val['Level'];
                $Students->subj = $_POST['classcsv'];
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
            }
            
            $i++;
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "SaveCLr"){
    $classR->term = $_POST['mclt'];
    $classR->sy = $_POST['mclsy'];
    $classR->timeDay = $_POST['mcltd'];
    $classR->subjid = $_POST['mclsubj'];
    $classR->schid = $_POST['mclsch'];
    $classR->mcldean = $_POST['mcldean'];

    try{
        if ($classR->AddCLr()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "UpCLr"){
    $classR->clrid = $_POST['upmclid'];
    $classR->term = $_POST['upmclt'];
    $classR->sy = $_POST['upmclsy'];
    $classR->timeDay = $_POST['upmcltd'];
    $classR->subjid = $_POST['upmclsubj'];
    $classR->schid = $_POST['upmclsch'];
    $classR->mcldean = $_POST['upmcldean'];

    try{
        if ($classR->EditClr()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "saveschool"){
    $School->schooldesc = $_POST['school'];
    try{
        if ($School->SaveSchool()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "editschool"){
    $School->sch_id = $_POST['idData'];
    $School->sch_desc = $_POST['newschool'];
    try{
        if ($School->EditSchool()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "saveq"){
    $quizzes->qpoints = $_POST['qp'];
    $quizzes->qdate = $_POST['qd'];
    $quizzes->qperiod = $_POST['qperiod'];
    $quizzes->studid = $_POST['studid'];
    $quizzes->crid = $_POST['qcr'];
    try{
        if(empty($quizzes->qperiod)){
            echo "2";
        }else if ($quizzes->SaveQuiz()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "saveo"){
    $Orals->opoints = $_POST['op'];
    $Orals->odate = $_POST['od'];
    $Orals->operiod = $_POST['operiod'];
    $Orals->studid = $_POST['studid'];
    $Orals->crid = $_POST['ocr'];
    try{
        if(empty($Orals->operiod)){
            echo "2";
        }else if ($Orals->SaveOrals()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "savex"){
    $Exams->xpoints = $_POST['opx'];
    $Exams->xdate = $_POST['odx'];
    $Exams->xperiod = $_POST['xperiod'];
    $Exams->studid = $_POST['studid'];
    $Exams->crid = $_POST['ocx'];
    try{
        if(empty($Exams->xperiod)){
            echo "2";
        }else if ($Exams->SaveExams()) {
            echo "1";
        }else{
            echo "0";
        }
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else if($_POST['action'] == "saveprof"){

    try{
        $Users->fname = $_POST['fname'];
        $Users->mname = $_POST['mname'];
        $Users->lname = $_POST['lname'];
        $Users->ename = $_POST['ename'];
        $Users->mobile = $_POST['mobile'];
        $Users->home = $_POST['home'];
        $Users->city = $_POST['city'];
        $Users->sex = $_POST['sex'];
        $Users->bday = $_POST['bday'];
        $Users->work = $_POST['work'];
        $Users->id = $_POST['dataid'];

        try{
            if ($Users->Edituser()) {
                $Users->uid = $_POST['acctid'];
                $Users->uname = $_POST['user'];
                $Users->upass = $_POST['pass'];

                if ($Users->UserAcct()) {
                    echo "1";
                }else{
                echo "00";
                }
            }else{
                echo "0";
            }
        }catch(PDOException $e){
            echo 'Connection Error :'.$e->getMessage();
        }
            
    }catch(PDOException $e){
        echo 'Connection Error :'.$e->getMessage();
    }
}else{
    echo "6";
}

?>