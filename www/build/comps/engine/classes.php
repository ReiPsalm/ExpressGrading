<?php
class UsersClass{
    private $conn;

    public $uname;
    public $upass;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function LoginUser(){
        try{
            $sql = "SELECT * FROM tbl_users LEFT JOIN tbl_instructor ON tbl_users.ins_id=tbl_instructor.ins_id WHERE tbl_users.user_name='".$this->uname."' AND tbl_users.user_pass='".$this->upass."'";
            $result = $this->conn->query($sql);
            $row =  $result->fetchArray();

            if($row['user_name'] == $this->uname && $row['user_pass'] == $this->upass){
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_pass'] = $row['user_pass'];
                $_SESSION['user_role'] = $row['user_role'];
                $_SESSION['ins_fname'] = $row['ins_fname'];
                $_SESSION['ins_mname'] = $row['ins_mname'];
                $_SESSION['ins_lname'] = $row['ins_lname'];
                $_SESSION['ins_extname'] = $row['ins_extname'];
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
}

class DeptMod{
    private $conn;

    public $deptid;
    public $deptdesc;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveDept(){
        try{
            $sqlSaveDept = "INSERT INTO tbl_department (dept_desc) VALUES ('".$this->deptdesc."')";
            if($this->conn->exec($sqlSaveDept)){
                return true;
            }else{
                return false;
            }

        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function GetDept(){
        try{
            $sqlGetDept = "SELECT * FROM tbl_department";
            $restGetDept = $this->conn->query($sqlGetDept);

            return $restGetDept;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetSetDept(){
        try{
            $sqlGetSetDept = "SELECT * FROM tbl_department WHERE dept_id='".$this->deptid."'";
            $resGetSetDept = $this->conn->query($sqlGetSetDept);

            return $resGetSetDept;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditDept(){
        try{
            $sqlEditDept = "UPDATE tbl_department SET  dept_desc='".$this->deptdesc."' WHERE dept_id='".$this->deptid."'";
            if($this->conn->exec($sqlEditDept)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class SectionMod{
    private $conn;

    public $secdesc;
    public $secid;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveSec(){
        try{
            $sqlSaveSec = "INSERT INTO tbl_section (Sec_desc) VALUES ('".$this->secdesc."')";
            if($this->conn->exec($sqlSaveSec)){
                return true;
            }else{
                return false;
            }

        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function GetSec(){
        try{
            $sqlGetSec = "SELECT * FROM tbl_section";
            $restGetSec = $this->conn->query($sqlGetSec);

            return $restGetSec;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetSetSec(){
        try{
            $sqlGetSetSec = "SELECT * FROM tbl_section WHERE Sec_id='".$this->secid."'";
            $resGetSetSec = $this->conn->query($sqlGetSetSec);

            return $resGetSetSec;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditSec(){
        try{
            $sqlEditSec = "UPDATE tbl_section SET  Sec_desc='".$this->secdesc."' WHERE Sec_id='".$this->secid."'";
            if($this->conn->exec($sqlEditSec)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class CourseMod{
    private $conn;

    public $coursedesc;
    public $courseid;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveCourse(){
        try{
            $sqlSaveCourse = "INSERT INTO tbl_course (course_desc) VALUES ('".$this->coursedesc."')";
            if($this->conn->exec($sqlSaveCourse)){
                return true;
            }else{
                return false;
            }

        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function GetCourse(){
        try{
            $sqlGetCourse = "SELECT * FROM tbl_course";
            $restGetCourse = $this->conn->query($sqlGetCourse);

            return $restGetCourse;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetSetCourse(){
        try{
            $sqlGetSetCourse = "SELECT * FROM tbl_course WHERE course_id='".$this->courseid."'";
            $resGetSetCourse = $this->conn->query($sqlGetSetCourse);

            return $resGetSetCourse;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
    
    public function EditCourse(){
        try{
            $sqlEditCourse = "UPDATE tbl_course SET  course_desc='".$this->coursedesc."' WHERE course_id='".$this->courseid."'";
            if($this->conn->exec($sqlEditCourse)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class DeanMod{
    private $conn;

    public $deanid;
    public $fname;
    public $mname;
    public $lname;
    public $ename;
    public $dept;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveDean(){
        try{
            $sqlSaveDean = "INSERT INTO tbl_dean ";
            $sqlSaveDean .= "(dean_fname,dean_mname,dean_lname,dean_extname,dept_id) ";
            $sqlSaveDean .= "VALUES ('".$this->fname."','".$this->mname."','".$this->lname."','".$this->ename."','".$this->dept."')";
            if($this->conn->exec($sqlSaveDean)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function GetDean(){
        try{
            $sqlGetDean= "SELECT * FROM tbl_dean";
            $resGetDean = $this->conn->query($sqlGetDean);

            return $resGetDean;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetSetDean(){
        try{
            $sqlGetSetDean = "SELECT * FROM tbl_dean WHERE dean_id='".$this->deanid."'";
            $resGetSetDean = $this->conn->query($sqlGetSetDean);

            return $resGetSetDean;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditDean(){
        try{
            $sqlEditDean = "UPDATE tbl_dean SET  ";
            $sqlEditDean .= "dean_fname='".$this->fname."',dean_mname='".$this->mname."',";
            $sqlEditDean .= "dean_lname='".$this->lname."',dean_extname='".$this->ename."',";
            $sqlEditDean .= "dept_id='".$this->dept."' ";
            $sqlEditDean .= "WHERE dean_id='".$this->deanid."'";
            if($this->conn->exec($sqlEditDean)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class StudentMod{
    private $conn;

    public $studid;
    public $fname;
    public $mname;
    public $lname;
    public $exname;
    public $yrlvl;
    public $course;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveStud(){
        try{
            $sqlSaveStud = "INSERT INTO tbl_student ";
            $sqlSaveStud .= "(stud_id,stud_fname,stud_mname,stud_lname,stud_extname,stud_yearlvl,course_id) ";
            $sqlSaveStud .= "VALUES ('".$this->studid."','".$this->fname."','".$this->mname."','".$this->lname."','".$this->exname."','".$this->yrlvl."','".$this->course."')";
            if($this->conn->exec($sqlSaveStud)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function GetStud(){
        try{
            $sqlGetStud = "SELECT * FROM tbl_student";
            $resGetStud = $this->conn->query($sqlGetStud);

            return $resGetStud;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetSetStud(){
        try{
            $sqlGetSetStud = "SELECT * FROM tbl_student WHERE stud_id='".$this->studid."'";
            $resGetSetStud = $this->conn->query($sqlGetSetStud);

            return $resGetSetStud;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditStud(){
        try{
            $sqlEditStud = "UPDATE tbl_student SET  ";
            $sqlEditStud .= "stud_fname='".$this->fname."',stud_mname='".$this->mname."',";
            $sqlEditStud .= "stud_lname='".$this->lname."',stud_extname='".$this->exname."',";
            $sqlEditStud .= "stud_yearlvl='".$this->yrlvl."',course_id='".$this->course."' ";
            $sqlEditStud .= "WHERE stud_id='".$this->studid."'";
            if($this->conn->exec($sqlEditStud)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class SubjMod{
    private $conn;

    public $subjdesc;
    public $subjid;
    public $subjsy;
    public $subjterm;
    public $Secid;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveSubj(){
        try{
            $sqlSaveSubj = "INSERT INTO tbl_subject ";
            $sqlSaveSubj .= "(subj_desc) ";
            $sqlSaveSubj .= "VALUES ('".$this->subjdesc."')";
            if($this->conn->exec($sqlSaveSubj)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetSubj(){
        try{
            $sqlGetSubj= "SELECT * FROM tbl_subject";
            $resGetSubj = $this->conn->query($sqlGetSubj);

            return $resGetSubj;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetSetSubj(){
        try{
            $sqlGetSetSubj = "SELECT * FROM tbl_subject WHERE subj_id='".$this->subjid."'";
            $resGetSetSubj = $this->conn->query($sqlGetSetSubj);

            return $resGetSetSubj;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditSubj(){
        try{
            $sqlEditSubj = "UPDATE tbl_subject SET  ";
            $sqlEditSubj .= "subj_desc='".$this->subjdesc."' ";
            $sqlEditSubj .= "WHERE subj_id='".$this->subjid."'";
            if($this->conn->exec($sqlEditSubj)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}
?>