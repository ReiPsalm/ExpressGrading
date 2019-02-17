<?php
/*
Author: Rei Psalm Susana
Title: DB credentials via file
PS: The purpose of this method is to secure and and avoid DB credentials to be written in the php file
*/
class HostDb{
    //database credential
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $db_pkey;
    /*
    we will declare the conn object here so
    it will be visibly available within the class
    */
    public $conn;

    /*function for the connection*/
    public function connect_Db(){
        //open the file (mine is not in a subfolder but you can also have a choice pod)
        $openFile = fopen(__DIR__."\.dtn", "r") or die("Unable to open file!");
        //read the content of the file making the content to be read as pain text
        $FileCont = fread($openFile, filesize(__DIR__."\.dtn"));
        //pass variable via list function pra ma extract ang value sa array from explode
        list($this->db_pkey,$this->db_host,$this->db_name,$this->db_user,$this->db_pass) = explode(",", $FileCont);

        //check the key first
        if($this->db_pkey == "G-KaPdRgUkXp2s5v8y/B?E(H+MbQeThV"){
            //try connection
            try{
                //PDO method to connect sa Database
                $this->conn = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name,$this->db_user,$this->db_pass);
                //echo "Connection Success to: ".$this->db_host;
            }catch(PDOException $exception){
                echo "Connection Error: ". $exception->getMessage();
            }
            //it will return the value in the connection (this is not visible or mapasa as a string, to echo the conn will only cause error)
            return $this->conn;

        }elseif($this->db_pkey){
            echo "Error Connecting Server!";
        }
    }
}
?>