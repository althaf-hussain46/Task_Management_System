<?php 
include_once("../Config/config.php");
include_once(DIR_URL."../Connection/dbConnection.php");


class  UserCRUD{

    public function createUser(){
    
    
    
    }
    
    public function userDetails($con){
            $fetchUserDetails = "SELECT*FROM user";
            $result = $con->query($fetchUserDetails);
            return $result;
    }
}





?>