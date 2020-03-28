<?php

namespace Controllers;

use DAO\CinemaDAO;
use Models\Cinema;

class CinemaController
{

    function cinemaAddView()
    {
        require(VIEWS_PATH . "adminView.php");
    }
    function movieSellsView()
    {
        require(VIEWS_PATH . "movieSellsView.php");
    }

    function Add($cinemaName, $cinemaAddress, $ticketPrice, $totalSits)
    {
        $newCinema = new Cinema($cinemaName, $cinemaAddress, $totalSits, $ticketPrice);
        $cinemaDAO = new CinemaDAO();
        $cinemaDAO->Add($newCinema);
        $this->cinemaAddView();
    }

    function remove($cinemaName)
    {
        $cinemaPDO = new CinemaDAO();
        $cinemaPDO->remove($cinemaName);
        $this->cinemaAddView();
    }

    function filterCinemasByReservationsDates($start, $end)
    {
        $cinemaPDO = new CinemaDAO();
        $filteredCinemas = $cinemaPDO->getCinemasByDate($start, $end);
        require(VIEWS_PATH . "cinemasBalancesView.php");
    }
}
