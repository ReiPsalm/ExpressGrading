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

    public function GetSetCourseid(){
        try{
            $sqlGetSetCourse = "SELECT * FROM tbl_course WHERE course_desc='".$this->coursedesc."'";
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

class SchoolMod{
    private $conn;

    public $schooldesc;
    public $schoolid;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveSchool(){
        try{
            $sqlSaveSchool = "INSERT INTO tbl_school (sch_desc) VALUES ('".$this->schooldesc."')";
            if($this->conn->exec($sqlSaveSchool)){
                return true;
            }else{
                return false;
            }

        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function GetSchool(){
        try{
            $sqlGetSchool = "SELECT * FROM tbl_school";
            $restGetSchool = $this->conn->query($sqlGetSchool);

            return $restGetSchool;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetSetSchool(){
        try{
            $sqlGetSetSchool = "SELECT * FROM tbl_school WHERE sch_id='".$this->sch_id."'";
            $resGetSetSchool = $this->conn->query($sqlGetSetSchool);

            return $resGetSetSchool;
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
    public $name;
    public $yrlvl;
    public $subj;
    public $course;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveStud(){
        try{
            $sqlSaveStud = "INSERT INTO tbl_student ";
            $sqlSaveStud .= "(stud_id,stud_name,stud_yearlvl,stud_classes,course_id) ";
            $sqlSaveStud .= "VALUES ('".$this->studid."','".$this->name."','".$this->yrlvl."','".$this->subj."','".$this->course."')";
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
            $sqlGetStud = "SELECT * FROM tbl_student ORDER BY stud_name ASC";
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

    public function GetNumtStud(){
        try{
            $sqlGetNumtStud = "SELECT COUNT(*) as count FROM tbl_student WHERE stud_id='".$this->studid."'";
            $resGetNumtStud = $this->conn->query($sqlGetNumtStud);

            return $resGetNumtStud;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditStud(){
        try{
            $sqlEditStud = "UPDATE tbl_student SET  ";
            $sqlEditStud .= "stud_name='".$this->name."',";
            $sqlEditStud .= "stud_yearlvl='".$this->yrlvl."',stud_classes='".$this->subj."',";
            $sqlEditStud .= "course_id='".$this->course."' ";
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

    public function UpStudSubj(){
        try{
            $sqlUpStudSubj = "UPDATE tbl_student SET ";
            $sqlUpStudSubj .= "stud_classes='".$this->subj."' WHERE stud_id='".$this->studid."'";
            if($this->conn->exec($sqlUpStudSubj)){
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
            $sqlSaveSubj .= "(subj_desc,Sec_id) ";
            $sqlSaveSubj .= "VALUES ('".$this->subjdesc."','".$this->Secid."')";
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
            $sqlEditSubj .= "subj_desc='".$this->subjdesc."',Sec_id='".$this->Secid."' ";
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

class ClrecordMod{
    private $conn;

    public $clrid;
    public $term;
    public $sy;
    public $timeDay;
    public $subjid;
    public $schid;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function AddCLr(){
        try{
            $sqlAddCLr = "INSERT INTO tbl_classlist ";
            $sqlAddCLr .= "(cr_term,cr_sy,cr_timeDay,subj_id,sch_id) VALUES ";
            $sqlAddCLr .= "('".$this->term."','".$this->sy."','".$this->timeDay."','".$this->subjid."','".$this->schid."')";
            if($this->conn->exec($sqlAddCLr)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetClr(){
        try{
            $sqlGetClr = "SELECT * FROM tbl_classlist ";
            $sqlGetClr .= "INNER JOIN tbl_subject ON tbl_classlist.subj_id=tbl_subject.subj_id ";
            $sqlGetClr .= "INNER JOIN tbl_section ON tbl_subject.Sec_id=tbl_section.Sec_id";
            $resGetClr = $this->conn->query($sqlGetClr);

            return $resGetClr;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetEditClr(){
        try{
            $sqlGetEditClr = "SELECT * FROM tbl_classlist ";
            $sqlGetEditClr .= "INNER JOIN tbl_subject ON tbl_classlist.subj_id=tbl_subject.subj_id ";
            $sqlGetEditClr .= "INNER JOIN tbl_section ON tbl_subject.Sec_id=tbl_section.Sec_id ";
            $sqlGetEditClr .= "WHERE tbl_classlist.cr_id='".$this->clrid."'";
            $resGetEditClr = $this->conn->query($sqlGetEditClr);

            return $resGetEditClr;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetDataClr(){
        try{
            $sqlGetDataClr = "SELECT * FROM tbl_classlist ";
            $sqlGetDataClr .= "INNER JOIN tbl_subject ON tbl_classlist.subj_id=tbl_subject.subj_id ";
            $sqlGetDataClr .= "INNER JOIN tbl_section ON tbl_subject.Sec_id=tbl_section.Sec_id ";
            $sqlGetDataClr .= "WHERE tbl_classlist.cr_id='".$this->clrid."'";
            $resGetDataClr = $this->conn->query($sqlGetDataClr);

            return $resGetDataClr;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetCLrStud(){
        try{
            //Get student from certain CLr base on subj_id
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditClr(){
        try{
            $sqlEditClr = "UPDATE tbl_classlist SET ";
            $sqlEditClr .= "cr_term='".$this->term."',cr_sy='".$this->sy."',cr_timeDay='".$this->timeDay."',";
            $sqlEditClr .= "subj_id='".$this->subjid."',sch_id='".$this->schid."' ";
            $sqlEditClr .= "WHERE cr_id='".$this->clrid."'";

            if($this->conn->exec($sqlEditClr)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class TblJoinsMod{
    private $conn;

    public $id;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function getSubSec(){
        try{
            $sqlgetSubSec = "SELECT * FROM tbl_subject ";
            $sqlgetSubSec .= "INNER JOIN tbl_section ON  tbl_subject.Sec_id=tbl_section.Sec_id ";
            $resgetSubSec = $this->conn->query($sqlgetSubSec);

            return $resgetSubSec;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}
?>