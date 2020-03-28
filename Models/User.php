<?php 
namespace Models;

class User{

    private $userEmail;
    private $userPass;
    private $userID;
    private $userType;

    function __construct($mail,$pass,$userType){
            $this->userEmail = $mail;
            $this->userPass = $pass;
            $this->userType = $userType;
    }

    function getUserType(){
        return $this->userType;
    }

    function setUserType($type){
        $this->userType = $type;
    }

    function getEmail(){
        return $this->userEmail;
    }

    function getPass(){
        return $this->userPass;
    }
    function getUserID(){
        return $this->userID;
    }

    function setUserID($id){
        $this->userID = $id;
    }

}
