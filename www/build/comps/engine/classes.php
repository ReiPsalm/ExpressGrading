<?php
class UsersClass{
    private $conn;

    public $uname;
    public $upass;
    public $uid;
    public $role;

    public $fname;
    public $mname;
    public $lname;
    public $ename;
    public $mobile;
    public $home;
    public $img;
    public $city;
    public $sex;
    public $bday;
    public $work;
    public $id;

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

                $_SESSION['ins_id'] = $row['ins_id'];
                $_SESSION['ins_fname'] = $row['ins_fname'];
                $_SESSION['ins_mname'] = $row['ins_mname'];
                $_SESSION['ins_lname'] = $row['ins_lname'];
                $_SESSION['ins_extname'] = $row['ins_extname'];
                $_SESSION['ins_img'] = $row['ins_img'];
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function Getuser(){
        try{
            $sqlGetuser = "SELECT * FROM tbl_users LEFT JOIN tbl_instructor ON tbl_users.ins_id=tbl_instructor.ins_id WHERE tbl_users.ins_id='".$this->id."'";
            $resGetuser = $this->conn->query($sqlGetuser);

            return $resGetuser;
        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function UserAcct(){
        try{
            $sqlUserAcct = "UPDATE tbl_users SET ";
            $sqlUserAcct .= "user_name='".$this->uname."',user_pass='".$this->upass."',user_role='".$this->role."' ";
            $sqlUserAcct .= "WHERE user_id='".$this->uid."'";

            if($this->conn->exec($sqlUserAcct)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function Edituser(){
        try{
            $sqlEdituser = "UPDATE tbl_instructor SET ";
            $sqlEdituser .= "ins_fname='".$this->fname."',ins_mname='".$this->mname."',ins_lname='".$this->lname."',";
            $sqlEdituser .= "ins_extname='".$this->ename."',ins_mobile='".$this->mobile."',ins_address='".$this->home."',";
            $sqlEdituser .= "ins_city='".$this->city."',ins_gender='".$this->sex."',ins_bday='".$this->bday."',";
            $sqlEdituser .= "ins_office='".$this->work."' ";
            $sqlEdituser .= "WHERE ins_id='".$this->id."'";

            if($this->conn->exec($sqlEdituser)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function Uploadimg(){
        try{
            $sqlUploadimg = "UPDATE tbl_instructor SET ";
            $sqlUploadimg .= "ins_img='".$this->img."' WHERE ins_id='".$this->id."'";

            if($this->conn->exec($sqlUploadimg)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditAcct(){
        try{
            $sqlEditAcct = "UPDATE tbl_users SET ".$this->col."='".$this->valset."' WHERE user_id='".$this->id."'";
            if($this->conn->exec($sqlEditAcct)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
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

    public function EditSchool(){
        try{
            $sqlEditSchool = "UPDATE tbl_school SET  sch_desc='".$this->sch_desc."' WHERE sch_id='".$this->sch_id."'";
            if($this->conn->exec($sqlEditSchool)){
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
            $sqlGetStud = "SELECT * FROM tbl_course INNER JOIN tbl_student ON tbl_course.course_id=tbl_student.course_id ORDER BY stud_name ASC";
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

    public function GetSetSubj($subjid){
        try{
            $sqlGetSetSubj = "SELECT * FROM tbl_subject WHERE subj_id='".$subjid."'";
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
    public $mcldean;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function AddCLr(){
        try{
            $sqlAddCLr = "INSERT INTO tbl_classlist ";
            $sqlAddCLr .= "(cr_term,cr_sy,cr_arch,cr_archdate,cr_timeDay,subj_id,sch_id,dean_id) VALUES ";
            $sqlAddCLr .= "('".$this->term."','".$this->sy."','0','x','".$this->timeDay."','".$this->subjid."','".$this->schid."','".$this->mcldean."')";
            if($this->conn->exec($sqlAddCLr)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetClr($crstat){
        try{
            $sqlGetClr = "SELECT * FROM tbl_classlist ";
            $sqlGetClr .= "LEFT JOIN tbl_subject ON tbl_classlist.subj_id=tbl_subject.subj_id ";
            $sqlGetClr .= "LEFT JOIN tbl_school ON tbl_classlist.sch_id=tbl_school.sch_id ";
            $sqlGetClr .= "LEFT JOIN tbl_section ON tbl_subject.Sec_id=tbl_section.Sec_id ";
            $sqlGetClr .= "WHERE cr_arch='".$crstat."'";
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
            $sqlGetDataClr .= "INNER JOIN tbl_school ON tbl_classlist.sch_id=tbl_school.sch_id ";
            $sqlGetDataClr .= "WHERE tbl_classlist.cr_id='".$this->clrid."'";
            $resGetDataClr = $this->conn->query($sqlGetDataClr);

            return $resGetDataClr;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetCLrStud(){
        try{
            $sqlGetCLrStud = "SELCT * FROM tbl_classlist WHERE cr_id='".$this->clrid."'";
            $resGetCLrStud = $this->conn->query($sqlGetCLrStud);
            
            return $resGetCLrStud;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function EditClr(){
        try{
            $sqlEditClr = "UPDATE tbl_classlist SET ";
            $sqlEditClr .= "cr_term='".$this->term."',cr_sy='".$this->sy."',cr_timeDay='".$this->timeDay."',";
            $sqlEditClr .= "subj_id='".$this->subjid."',sch_id='".$this->schid."',dean_id='".$this->mcldean."' ";
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

    public function AcrhiveClr($crid,$archdate){
        try{
            $sqlAcrhiveClr = "UPDATE tbl_classlist SET cr_arch='1',cr_archdate='".$archdate."' WHERE cr_id='".$crid."'";
            
            if($this->conn->exec($sqlAcrhiveClr)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function ArchDel($crid){
        try{
            $sqlArchDel = "DELETE FROM tbl_classlist WHERE cr_id='".$crid."'";

            if($this->conn->exec($sqlArchDel)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class QuizMod{
    private $conn;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveQuiz(){
        try{
            $sqlSaveQuiz = "INSERT INTO tbl_quizes (quiz_points,quiz_date,quiz_period,stud_id,cr_id) ";
            $sqlSaveQuiz .= "VALUES('".$this->points."','".$this->quiz_date."','".$this->period."','".$this->student_id."','".$this->cr_id."')";
            if($this->conn->exec($sqlSaveQuiz)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetQuizStud(){
        try{
            $sqlGetQuiz = "SELECT COUNT(*) as result FROM tbl_quizes WHERE quiz_date='".$this->quiz_date."' AND quiz_period='".$this->period."' AND cr_id='".$this->cr_id."' AND stud_id='".$this->student_id."'";
            $sqlGetQuiz_result = $this->conn->query($sqlGetQuiz);
            $sqlGetQuiz_row    = $sqlGetQuiz_result->fetchArray();
        
            return $sqlGetQuiz_row['result'];
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetQzRecord($studid,$clrid){
        try{
            $sqlGetQzRecord = "SELECT * FROM tbl_quizes WHERE stud_id='".$studid."' AND cr_id='".$clrid."'";
            $resGetQzRecord = $this->conn->query($sqlGetQzRecord);

            return $resGetQzRecord;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function UpdateQuizStud($qz_tbl,$qz_data,$qz_id){
        try{
            $sqlUpdateQuizStud = "UPDATE tbl_quizes SET ";
            $sqlUpdateQuizStud .= "quiz_".$qz_tbl."='".$qz_data."' ";
            $sqlUpdateQuizStud .= "WHERE quiz_id='".$qz_id."'";
            if($this->conn->exec($sqlUpdateQuizStud)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class OralsMod{
    private $conn;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveOrals(){
        try{
            $sqlSaveOrals = "INSERT INTO tbl_orals (oral_points,oral_date,oral_period,stud_id,cr_id) ";
            $sqlSaveOrals .= "VALUES('".$this->points."','".$this->oral_date."','".$this->period."','".$this->student_id."','".$this->cr_id."')";

            if($this->conn->exec($sqlSaveOrals)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetOralStud(){
        try{
            $sqlGetOral = "SELECT COUNT(*) as result FROM tbl_orals WHERE oral_date='".$this->oral_date."' AND oral_period='".$this->period."' AND cr_id='".$this->cr_id."' AND stud_id='".$this->student_id."'";
            $sqlGetOral_result = $this->conn->query($sqlGetOral);
            $sqlGetOral_row    = $sqlGetOral_result->fetchArray();
        
            return $sqlGetOral_row['result'];
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetOrRecord($studid,$clrid){
        try{
            $sqlGetOrRecord = "SELECT * FROM tbl_orals WHERE stud_id='".$studid."' AND cr_id='".$clrid."'";
            $resGetOrRecord = $this->conn->query($sqlGetOrRecord);

            return $resGetOrRecord;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function UpdateOralStud($or_tbl,$or_data,$or_id){
        try{
            $sqlUpdateOralStud = "UPDATE tbl_orals SET ";
            $sqlUpdateOralStud .= "oral_".$or_tbl."='".$or_data."' ";
            $sqlUpdateOralStud .= "WHERE quiz_id='".$or_id."'";
            if($this->conn->exec($sqlUpdateOralStud)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class ExamsMod{
    private $conn;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function SaveExams(){
        try{
            $sqlSaveExams = "INSERT INTO tbl_exams (exam_points,exam_date,exam_period,stud_id,cr_id) ";
            $sqlSaveExams .= "VALUES('".$this->points."','".$this->exam_date."','".$this->period."','".$this->student_id."','".$this->cr_id."')";
            if($this->conn->exec($sqlSaveExams)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetExamStud(){
        try{
            $sqlGetExam = "SELECT COUNT(*) as result FROM tbl_exams WHERE exam_date='".$this->exam_date."' AND exam_period='".$this->period."' AND cr_id='".$this->cr_id."' AND stud_id='".$this->student_id."'";
            $sqlGetExam_result = $this->conn->query($sqlGetExam);
            $sqlGetExam_row    = $sqlGetExam_result->fetchArray();
        
            return $sqlGetExam_row['result'];
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetExRecord($studid,$clrid){
        try{
            $sqlGetExRecord= "SELECT * FROM tbl_exams WHERE stud_id='".$studid."' AND cr_id='".$clrid."'";
            $resGetExRecord = $this->conn->query($sqlGetExRecord);

            return $resGetExRecord;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
    
    public function UpdateExamStud($ex_tbl,$ex_data,$ex_id){
        try{
            $sqlUpdateExamStud = "UPDATE tbl_orals SET ";
            $sqlUpdateExamStud .= "oral_".$ex_tbl."='".$ex_data."' ";
            $sqlUpdateExamStud .= "WHERE quiz_id='".$ex_id."'";
            if($this->conn->exec($sqlUpdateExamStud)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }
}

class GradeCalc{
    private $conn;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function GetQAO($tbl,$col,$studid,$pfrom,$pto,$crid){
        try{
            // $sqlGetQAO = "SELECT * FROM tbl_".$tbl." WHERE stud_id='".$studid."'";
            $sqlGetQAO = "SELECT COUNT(".$col."_points) as PtCount, SUM(".$col."_points) as PtSum,".$col."_period ";
            $sqlGetQAO .= "FROM tbl_".$tbl." WHERE stud_id='".$studid."' ";
            $sqlGetQAO .= "AND (".$col."_period='".$pfrom."' OR ".$col."_period='".$pto."' AND (cr_id='".$crid."'))";
            $resGetQAO = $this->conn->query($sqlGetQAO);

            return $resGetQAO;
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function GetExam($studid,$experiod,$crid){
        try{
            $sqlGetExam = "SELECT SUM(exam_points) as Expoints FROM tbl_exams ";
            $sqlGetExam .= "WHERE stud_id='".$studid."' ";
            $sqlGetExam .= "AND (exam_period='".$experiod."' AND cr_id='".$crid."')";
            $resGetExam = $this->conn->query($sqlGetExam);

            return $resGetExam;
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

class AttendanceMod{
    private $conn;

    public $id;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function GetAttendance(){
        $sqlGetAttendance = "SELECT COUNT(*) as result FROM tbl_attendance WHERE att_date='".$this->att_date."' AND att_period='".$this->period."' AND cr_id='".$this->cr_id."' AND stud_id='".$this->student_id."'";
        $result = $this->conn->query($sqlGetAttendance);
        $row    = $result->fetchArray();
        
        return $row['result'];
       
    }

    public function SaveAttendance(){
        try{
            $sqlSaveAttendance  = "INSERT INTO tbl_attendance (att_date,att_points,att_period,stud_id,cr_id) ";
            $sqlSaveAttendance .= "VALUES('".$this->att_date."','".$this->points."','".$this->period."','".$this->student_id."','".$this->cr_id."')";
            if($this->conn->exec($sqlSaveAttendance)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function UpdateAttendance(){
        try{
            $sqlUpdateAttendance = "UPDATE tbl_attendance SET  ";
            $sqlUpdateAttendance .= "att_points='".$this->points."'";
            $sqlUpdateAttendance .= "WHERE stud_id='".$this->student_id."' AND cr_id='".$this->cr_id."' AND att_date ='".$this->att_date."'";
            if($this->conn->exec($sqlUpdateAttendance)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo "Connection Error: ". $e->getMessage();
        }
    }

    public function saveAttendance_qoe($points,$period,$student_id,$cr_id,$date){
        $sqlSaveAttendance  = "INSERT INTO tbl_attendance (att_date,att_points,att_period,stud_id,cr_id) ";
        $sqlSaveAttendance .= "VALUES('".$date."','".$points."','".$period."','".$student_id."','".$cr_id."')";
        $this->conn->exec($sqlSaveAttendance);
    }

    public function checkAttendance_qoe($period,$student_id,$cr_id,$date){
        $sqlGetAttendance = "SELECT COUNT(*) as result FROM tbl_attendance WHERE att_date='".$date."' AND att_period='".$period."' AND cr_id='".$cr_id."' AND stud_id='".$student_id."'";
        $result = $this->conn->query($sqlGetAttendance);
        $row    = $result->fetchArray();
        
        return $row['result'];
    }

}
?>