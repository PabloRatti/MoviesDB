<?php

namespace Controllers;

use Facebook;

class facebookController
{


    function getLoginLink()
    {
        
        if (!session_id()) {
            session_start();
        } 

        // Initialize the Facebook PHP SDK v5.
        $fb = new Facebook\Facebook([
            'app_id'                => '439121773418488',
            'app_secret'            => '7ee0b357ad45643d9075c3d9ad7de182',
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl("      
        http://localhost/Lab%20IV/TP_Final/Controllers/facebookResponseController.php", $permissions);
       //parece ser que la referencia al ser un link y no un require
       //pierde el acceso a la cadena de requires que hace el autoload
       return '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    }

    function logOut(){
        $fb = new Facebook\Facebook([
            'app_id'                => '439121773418488',
            'app_secret'            => '7ee0b357ad45643d9075c3d9ad7de182',
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $logoutUrl = $helper->getLogoutUrl('{access-token}', 'http://example.com');
        
        return '<a href="' . $logoutUrl . '">Logout of Facebook!</a>';

    }

    function userReservationsView(){
        require_once(VIEWS_PATH.'userReservationsView.php');
    }

    function UsersHomeView(){
        require_once(VIEWS_PATH.'UsersHomeView.php');

    }

    function LoginView(){
        require_once(VIEWS_PATH.'LoginView.php');

    }
}
