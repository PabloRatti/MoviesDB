<?php

namespace Controllers;

class EstadisticsController
{

    function balancesView()
    {
        require_once(VIEWS_PATH . "moviesSellsSelectView.php");
    }

    function moviesBalancesView()
    {
        require_once(VIEWS_PATH . "moviesSellsView.php");
    }

    function cinemaBalancesView()
    {
        require_once(VIEWS_PATH . "cinemasBalancesView.php");
    }

    function adminView(){
        require_once(VIEWS_PATH . "adminView.php");

    }

    function LoginView(){
        require_once(VIEWS_PATH . "LoginView.php");

    }
}
