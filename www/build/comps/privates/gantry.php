<?php
/*
Author: Rei Psalm Susana
Title: DB credentials via file
PS: The purpose of this method is to secure and and avoid DB credentials to be written in the php file
*/
class HostDb extends SQLite3{
    //database credential
    private $db_pkey;
    /*
    we will declare the conn object here so
    it will be visibly available within the class
    */
    // public $connection;

    /*function for the connection*/
    public function __construct(){
        //open the file (mine is not in a subfolder but you can also have a choice pod)
        $openFile = fopen(__DIR__."\.dtn", "r") or die("Unable to open file!");
        //read the content of the file making the content to be read as pain text
        $FileCont = fread($openFile, filesize(__DIR__."\.dtn"));
        //pass variable via list function pra ma extract ang value sa array from explode
        list($this->db_pkey,) = explode(",", $FileCont);

        //check the key first
        if($this->db_pkey == "G-KaPdRgUkXp2s5v8y/B?E(H+MbQeThV"){
            //try connection
            $this->open('../privates/expgrading.db');

        }elseif($this->db_pkey){
            echo "Error Connecting Server!";
        }
    }
}
?>