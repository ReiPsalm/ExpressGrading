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

            return $GetCourse;
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
}
?>