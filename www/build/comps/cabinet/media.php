<?php
session_start();
include_once "../engine/loader.php";

if(isset($_FILES['file']['name'])){
    // print_r($_FILES);
    $filename = $_FILES['file']['name'];

    /* Location */
    $location = "../../library/img/".$filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    
    /* Valid Extensions */
    $valid_extensions = array("jpg","jpeg","png");
    /* Check file extension */
    if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
       $uploadOk = 0;
    }
    
    if($uploadOk == 0){
       echo 0;
    }else{
       /* Upload file */

        $Users->img = $filename;
        $Users->id = $_SESSION['ins_id'];

        try{
            if ($Users->Uploadimg()) {
                if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo "0";
            }
        }catch(PDOException $e){
            echo 'Connection Error :'.$e->getMessage();
        }
    }
}else{
    echo "6";
}

?>