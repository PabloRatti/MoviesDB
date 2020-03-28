<?php

namespace DAO;

use \Exception as Exception;
use Models\Cinema as Cinema;
use PDOException;
use DAO\Connection as Connection;

class CinemaDAO
{
    private $connection;
    private $tableName = "Cinemas";

    public function Add(Cinema $cinema)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (cinemaName, cinemaAddress,totalSits,ticketPrice) VALUES (:cinemaName, :cinemaAddress, :totalSits , :ticketPrice);";

            $parameters["cinemaName"] = $cinema->getName();
            $parameters["cinemaAddress"] = $cinema->getAddress();
            $parameters["totalSits"] = $cinema->getTotalSits();
            $parameters["ticketPrice"] = $cinema->getTicketPrice();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            echo "Error, data duplicated, please fill again";            
        }
    }


    public function GetAll()
    {
        try {
            $cinemaList = array();
            $query = "SELECT * FROM " . $this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach ($resultSet as $row) {
                $cinema = new Cinema($row["cinemaName"], $row["cinemaAddress"], $row["totalSits"], $row["ticketPrice"]);
                $cinema->setId($row["id_Cinema"]);
                $cinema->setMoviesOnPlay($row["moviesOnPlay"]);
                array_push($cinemaList,  $cinema);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $cinemaList;
    }



    public function remove($cinemaName)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE Cinemas.name=" . $cinemaName;
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }


    public function GetCinemasByDate($startDate, $limitDate)
    {
        if (!$startDate) $startDate = date("Y/m/d");
        if (!$limitDate) $limitDate = '2020/12/12';
        try {

            $cinemaList = array();
            $query = "SELECT * FROM Movies_X_Cinemas join Cinemas 
            on Movies_X_Cinemas.id_Cinema = Cinemas.id_Cinema having
            Movies_X_Cinemas.movieDate >= '$startDate'
            and  Movies_X_Cinemas.movieDate <= '$limitDate'";


            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);


            foreach ($resultSet as $row) {
                $cinema = new Cinema($row["cinemaName"], $row["cinemaAddress"], $row["totalSits"], $row["ticketPrice"]);
                $cinema->setId($row["id_Cinema"]);
                $cinema->setMoviesOnPlay($row["moviesOnPlay"]);
                array_push($cinemaList,  $cinema);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        $cinemaList = array_unique($cinemaList, SORT_REGULAR);
        return $cinemaList;
    }
    /*
    public function GetCinemasByDate($startDate,$limitDate)
    {
       
        try {

            $movieList = array();
            $query = "SELECT * FROM Movies_X_Cinemas join Cinemas 
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
*/
}
