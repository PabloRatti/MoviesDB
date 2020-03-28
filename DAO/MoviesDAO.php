<?php

namespace DAO;

use \Exception as Exception;
use Models\Movie as Movie;
use PDOException;
use DAO\Connection as Connection;
use Models\Movie_X_Cinema;
use Models\Cinema;


class MoviesDAO
{
    private $connection;
    private $tableName = "Movies";    

    public function Add(Movie $movie)
    {

        try {
            $query = "INSERT INTO " . $this->tableName . " (title, votes, popularity, overview, poster_path, releaseDate,genreID) VALUES (:title, :votes, :popularity, :overview, :poster_path, :releaseDate, :genreID);";

            $parameters["title"] = $movie->getTitle();
            $parameters["votes"] = $movie->getVotes();
            $parameters["popularity"] = $movie->getPopularity();
            $parameters["overview"] = $movie->getOverview();
            $parameters["poster_path"] = $movie->getPosterUrl();
            $parameters["releaseDate"] = $movie->getReleaseDate();
            $parameters["genreID"] = $movie->getGenreID();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            //throw $ex;
        }
    }

    public function GetAll()
    {
        try {

            $movieList = array();
            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movie = new Movie($row["title"], $row["votes"], $row["popularity"], $row["overview"], $row["poster_path"], $row["releaseDate"]);
                $movie->setId($row["id_Movie"]);
                $movie->setGenreID($row["genreID"]);
                array_push($movieList,  $movie);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $movieList;
    }




    public function GetAllFunctions()
    {
        try {

            $functionsList = array();
            $query = "SELECT * FROM Movies_X_Cinemas";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieXcinema = new Movie_X_Cinema($row["id_Cinema"], $row["id_Movie"], $row["movieDate"], $row["movieTime"], $row["sitsLeft"]);
                $movieXcinema->setId($row["id_MXC"]);
                array_push($functionsList,  $movieXcinema);
            }
        } catch (Exception $ex) {

            throw $ex;
        }
        return $functionsList;
    }

    public function GetFunctionsByDate($limitDate)
    {
       
        $limit = date_create($limitDate);
        try {
            
            $functionsList = array();
            $query = "SELECT * FROM Movies_X_Cinemas";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row) {
                $movieDate = date_create($row["movieDate"]);
                if ($movieDate <= $limit) {
                    $movieXcinema = new Movie_X_Cinema($row["id_Cinema"], $row["id_Movie"], $row["movieDate"], $row["movieTime"], $row["sitsLeft"]);
                    $movieXcinema->setId($row["id_MXC"]);
                    array_push($functionsList,  $movieXcinema);
                }
            }
            
        } catch (Exception $ex) {
          
            throw $ex;
            
        }
        
        return 'Retorno functio by date!';
    }

    public function GetMoviesByFunctionsDate($startDate, $limitDate)
    {        
        if ($startDate == null) $startDate = date("Y/m/d");
        try {
            $movieList = array();
            $query = "SELECT * FROM Movies_X_Cinemas join Movies 
            on movieDate >= '$startDate'
            and  movieDate <= '$limitDate'
            and Movies_X_Cinemas.id_Movie = Movies.id_Movie";


            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);


            foreach ($resultSet as $row) {
                $movie = new Movie($row["title"], $row["votes"], $row["popularity"], $row["overview"], $row["poster_path"], $row["releaseDate"]);
                $movie->setId($row["id_Movie"]);
                $movie->setGenreID($row["genreID"]);
                array_push($movieList,  $movie);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        $movieList = array_unique($movieList, SORT_REGULAR);
        return $movieList;
    }



    public function getFunctionsForMovieInCinema($movieID, $cinemaID)
    {
        $functionsList = array();
        try {
            $query = "SELECT * FROM Movies_X_Cinemas WHERE id_Movie=" . $movieID . " AND id_Cinema=" . $cinemaID;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieXcinema = new Movie_X_Cinema($row["id_Cinema"], $row["id_Movie"], $row["movieDate"], $row["movieTime"], $row["sitsLeft"]);
                $movieXcinema->setId($row["id_MXC"]);
                $movieXcinema->setRoom($row["movieRoom"]);
                array_push($functionsList,  $movieXcinema);
            }
        } catch (Exception $ex) {

            throw $ex;
        }
        return   $functionsList;
    }



    private function getIDCinemasFromMovie($movieID)
    {
        $idCinemas = array();
        try {
            $query = "SELECT id_Cinema FROM Movies_X_Cinemas WHERE id_Movie=" . $movieID;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                array_push($idCinemas,  $row);
            }
        } catch (Exception $ex) {

            throw $ex;
        }
        return  $idCinemas;
    }

    function getCinemasFromMovie($movieID)
    {
        $cinemasID = $this->getIDCinemasFromMovie($movieID);
        $CinemasForMovie = array();
        foreach ($cinemasID as $id) {
            try {
                $query = "SELECT * FROM Cinemas WHERE id_Cinema=" . $id["id_Cinema"];

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {
                    $cinema = new Cinema($row["cinemaName"], $row["cinemaAddress"], $row["totalSits"], $row["ticketPrice"]);
                    $cinema->setId($row["id_Cinema"]);
                    $cinema->setMoviesOnPlay($row["moviesOnPlay"]);
                    array_push($CinemasForMovie,  $cinema);
                }
            } catch (Exception $ex) {

                throw $ex;
            }
        }
        return  $CinemasForMovie;
    }


    function getMoviesFromCinema($cinemaId)
    {
        try {

            $showsList = array();
            $query = "SELECT * FROM Movies_X_Cinemas WHERE id_Cinema=" . $cinemaId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $movieXcinema = new Movie_X_Cinema($row["id_Cinema"], $row["id_Movie"], $row["movieDate"], $row["movieTime"], $row["sitsLeft"]);
                $movieXcinema->setId($row["id_MXC"]);
                $movieXcinema->setRoom($row["movieRoom"]);
                array_push($showsList,  $movieXcinema);
            }
        } catch (Exception $ex) {

            throw $ex;
        }
        return  $showsList;
    }



    private function UpdateMoviesPlaying($idCinema, $operand, $cant) //anda con + no con -
    {
        try {
            $query = "UPDATE cinemas SET moviesOnPlay=MoviesOnPlay" . $operand . "$cant WHERE id_Cinema =" . $idCinema;
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }

    private function resetMoviesPlaying($idCinema)
    {
        try {
            $query = "UPDATE cinemas SET moviesOnPlay=0 WHERE id_Cinema=" . $idCinema;
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }

    //funcionando bien
    public function addMovieToCinema($movieId, $cinemaId, $movieRoom, $movieDate, $movieTime, $cinemaTotalSits)
    {

        try {
            $query = "INSERT INTO Movies_X_Cinemas(id_Cinema,id_Movie,movieRoom,movieDate,movieTime,sitsLeft) VALUES (:id_Cinema,:id_Movie,:movieRoom,:movieDate,:movieTime, :sitsLeft);";
            $parameters["id_Cinema"] = $cinemaId;
            $parameters["id_Movie"] =  $movieId;
            $parameters["movieRoom"] = $movieRoom;
            $parameters["movieDate"] = $movieDate;
            $parameters["movieTime"] = $movieTime;
            $parameters["sitsLeft"] = $cinemaTotalSits;

            //Validations

            $isAvailable = $this->checkRoomDisponibility($movieRoom, $movieTime, $movieDate);
            
     
            if ($isAvailable == true) {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                $this->UpdateMoviesPlaying($cinemaId, "+", 1);
            }
        } catch (Exception $e) {
            echo 'Throwing';
            throw $e->getMessage();
        }
    }

    private function checkRoomDisponibility($room, $time, $date)
    {
        try {

            $available = false;
            //$query = "SELECT * FROM Movies_X_Cinemas WHERE movieRoom=" . $room . " AND movieTime>=" . $time . " AND movieDate=" . $date;
            $query = "SELECT  * FROM Movies_X_Cinemas WHERE movieDate='$date' AND movieRoom='$room'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if (isset($resultSet)) {
                $funcTime = intval($time); //convierto las horas en int

                $funcEnd = $funcTime + 2; //Minimo de 2 hs de duracion
                $funcBeforeMin = $funcTime - 2; //Minimo de 2hs antes 
              
                if ($resultSet) {
                   
                    foreach ($resultSet as $row) {
                        
                        $mTime = intval($row["movieTime"]);
                        //Las peliculas que no son la mia deben tener funciones minimo 2hs antes y 2 hs despues del comienzo de la pelicular que quiero agregar
                        if ($mTime > $funcEnd || $mTime < $funcBeforeMin) {
                            
                            $available = true;
                        } else $available = false;
                    }
                } else $available = true;
            }
        } catch (Exception $ex) {

            throw $ex;
        }
        return  $available;
    }

    public function removeMovieFromCinema($id, $cinemaId)
    {
        try {
            $query = "DELETE FROM Movies_X_Cinemas WHERE id_MXC=" . $id;
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
        $this->UpdateMoviesPlaying($cinemaId, "-", 1);
    }

    public function deleteAllMovies($cinemaId)
    {
        try {
            $query = "DELETE FROM Movies_X_Cinemas WHERE id_Cinema=" . $cinemaId;
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
        $this->resetMoviesPlaying($cinemaId);
    }
   

    function getGenres()
    {
        $apiDAO = new ApiDAO();

        $genres = $apiDAO->getGenres();
        return $genres;
    }
}
