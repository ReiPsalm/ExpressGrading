<?php
class Users{
    private $conn;

    public $uname;
    public $upass;

    public function __construct($db_get){
        $this->conn = $db_get;
    }

    public function LoginUser(){
        try{
            $sql = "SELECT * FROM tbl_users WHERE user_name='".$this->uname."' AND user_pass='".$this->upass."'";
            $result = $conn->query($sql);
            $row =  $result->fetchArray();

            if($row['user_name'] == $this->uname && $row['user_pass'] == $this->user_pass){
                return true;
            }else{
                return false;
            }

            return $row;
        }catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
}
?>