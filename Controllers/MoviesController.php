<?php

namespace Controllers;

use Models\Cinema;
use DAO\MoviesDAO;

class MoviesController
{

    function moviesAddView($cinemaName, $cinemaAddress, $totalSits, $ticketPrice, $cinemaId)
    {

        $cinema = new Cinema($cinemaName, $cinemaAddress, $totalSits, $ticketPrice);

        $cinema->setId($cinemaId);

        require_once(VIEWS_PATH . "movieAddView.php");
    }

    function usersHomeView()
    {
        require(VIEWS_PATH . "UsersHomeView.php");
    }

    function LoginView()
    {
        require(VIEWS_PATH . "LoginView.php");
    }
    function userReservationsView()
    {
        require(VIEWS_PATH . "userReservationsView.php");
    }



    function addMovieToCinema($movieDate, $movieTime, $movieRoom, $movieId, $cinemaId, $cinemaName, $cinemaAddress, $cinemaTotalSits, $cinemaTicketPrice)
    {

        $db = new MoviesDAO();
        $db->addMovieToCinema($movieId, $cinemaId, $movieRoom, $movieDate, $movieTime, $cinemaTotalSits);
        //need to pas all parameters to rebuild the cinema and have acces to him in moviesAddView
        $this->moviesAddView($cinemaName, $cinemaAddress, $cinemaTotalSits, $cinemaTicketPrice, $cinemaId);
    }

    function removeMovieFromCinema($idToDelete, $cinemaId, $cinemaName, $cinemaAddress, $cinemaTotalSits, $cinemaTicketPrice)
    {
        $db = new MoviesDAO();
        $db->removeMovieFromCinema($idToDelete, $cinemaId);
        $this->moviesAddView($cinemaName, $cinemaAddress, $cinemaTotalSits, $cinemaTicketPrice, $cinemaId);
    }

    function deleteAllMovies($cinemaId, $cinemaName, $cinemaAddress, $cinemaTotalSits, $cinemaTicketPrice)
    {
        $db = new MoviesDAO();
        $db->deleteAllMovies($cinemaId);
        $this->moviesAddView($cinemaName, $cinemaAddress, $cinemaTotalSits, $cinemaTicketPrice, $cinemaId);
    }

    function AdminView()
    {
        require_once(VIEWS_PATH . "adminView.php");
    }



    function filterMoviesByGenre($movies, $genre)
    {
        $newArray = array();
        $genres = $this->getGenres();
        $genres = $genres["genres"];

        $key = 0;
        if ($genre != "None") {
            foreach ($genres as $gen) {
                if ($gen["name"] == $genre) {
                    $key = $gen["id"];
                }

                if ($key > 0) {
                    foreach ($movies as $mov) {
                        if ($mov->getGenreID() == $key) {
                            array_push($newArray, $mov);
                        }
                    }
                }
            }
        } else $newArray = $movies;
        $newArray = array_unique($newArray, SORT_REGULAR);
        return $newArray;
    }

    function getGenres(){
        
    }

    function filter($limitDate, $genre)
    {

        if (!$limitDate) $limitDate = '2020-12-12';

        $db = new MoviesDAO();
        $data = $db->GetMoviesByFunctionsDate(null, $limitDate);

        $data = $this->filterMoviesByGenre($data, $genre);
        require_once(VIEWS_PATH . "UsersHomeView.php");
    }

    function filterByDate($startDate, $limitDate)
    {

        if (!$limitDate) $limitDate = '2020-12-12';
        if (!$startDate) $startDate = date("Y/m/d");
        $db = new MoviesDAO();
        $data = $db->GetMoviesByFunctionsDate($startDate, $limitDate);
        require_once(VIEWS_PATH . "moviesSellsView.php");
    }
}
