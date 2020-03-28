<?php

namespace Controllers;

use DAO\usersDAO;
use Models\User;

class LoginController
{
    function Login($username, $userpass, $action)
    {

        /*if ($action == "fbLogin"){
            $fbLoger = new facebookController();
            $logerLink = $fbLoger->getLoginLink();
            
        }*/
        $pdo = new usersDAO();
        if ($action == "register") {

            $this->registrationValidatedView();
        } else {

            $userLogin = $pdo->getUser($username, $userpass);

            if ($userLogin) {
                $_SESSION["logedUser"] = $userLogin;
                if ($userLogin->getUserType() == "user") {
                    $this->UsersHomeView();
                } else {
                    $this->adminView();
                }
            } else {
                $this->LoginView();
            }
        }
    }

    function registerUser($email, $pass, $pass2)
    {
        $dao = new usersDAO();
        if ($pass == $pass2) {
            $newUser = new User($email, $pass, "user");
            $dao->registerUser($newUser);
            $this->LoginView();
        } else $this->registrationValidatedView();
    }

    function registrationValidatedView()
    {
        require_once(VIEWS_PATH . "registrationValidatedView.php");
    }

    function adminView()
    {
        require_once(VIEWS_PATH . "adminView.php");
    }
    function UsersHomeView()
    {
        require_once(VIEWS_PATH . "UsersHomeView.php");
    }


    function LoginView()
    {
        if (isset($_SESSION["logedUser"])) session_destroy();
        if (isset($_SESSION["fbUser"])) session_destroy();
        $_SESSION["logedUser"] = null;
        require_once(VIEWS_PATH . "LoginView.php");
    }



    function userReservationsView()
    {
        if ($_SESSION["logedUser"]->getEmail() != "Guest") {
            require(VIEWS_PATH . 'userReservationsView.php');
        }
    }
}
