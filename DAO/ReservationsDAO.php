<?php

namespace DAO;

use Models\Reservation;
use DAO\Connection;
use PDOException;

class ReservationsDAO
{

    private $connection;
    private $tableName = "Reservations";


    function updateSitsLeft($id_MXC, $sitsLess)
    {

        try {
            $query = "UPDATE Movies_X_Cinemas set sitsLeft = sitsLeft-$sitsLess where Movies_X_Cinemas.id_MXC=" . $id_MXC;
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }

    

    public function Add(Reservation $reservation)
    {

        try {
            $query = "INSERT INTO " . $this->tableName . " ( id_MXC , reservedSits,id_User, state , creditCard , totalAmount , ticketPrice ,
            reservationDate,movieTitle,cinemaName,movieDate,movieTime, movieRoom ) VALUES (:id_MXC , :reservedSits, :id_User, :state ,:creditCard ,:totalAmount ,:ticketPrice , :reservationDate,:movieTitle,:cinemaName,:movieDate,:movieTime,:movieRoom)";
            $card = $reservation->getCreditCard();
            $parameters["id_MXC"] = $reservation->getFunctionID();
            $parameters["reservedSits"] = $reservation->getReservatedSits();
            $parameters["id_User"] = $reservation->getuserID();
            $parameters["state"] = $reservation->getStatus();
            $parameters["creditCard"] = $card->getCardNumber();                 
            $parameters["ticketPrice"] = $reservation->getTicketPrice();
            $parameters["movieTitle"] = $reservation->getMovieName();
            $parameters["cinemaName"] = $reservation->getCinemaName();
            $parameters["reservationDate"] = $reservation->getReservationDay();
            $parameters["movieDate"] = $reservation->getMovieDate();
            $parameters["movieTime"] = $reservation->getMovieTime();           
            $parameters["totalAmount"] = $reservation->getTotalAmount();
            $parameters["movieRoom"] = $reservation->getRoom();
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
             $this->updateSitsLeft($reservation->getFunctionID(),$reservation->getReservatedSits());
        } catch (PDOException $ex) {
            //throw $ex;
        }
    }


    public function GetAll()
    {
        try {

            $reservationList = array();
            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                if ($row["id_User"] == $_SESSION["logedUser"]->getuserID()) {
                    $reservation = new Reservation($row["id_User"], $row["id_MXC"], $row["reservedSits"], $row["ticketPrice"], $row["cinemaName"], $row["movieTitle"], $row["movieDate"], $row["movieTime"]);
                    $reservation->setId($row["id_Reservation"]);
                    $reservation->setReservationDate($row["reservationDate"]);
                    $reservation->setCreditCard($row["creditCard"]);
                    array_push($reservationList,   $reservation);
                }
            }
        } catch (PDOException $ex) {
            throw $ex;
        }
        return $reservationList;
    }

    public function GetAllForUser($idUser)
    {
        try {

            $reservationList = array();
            $query = "SELECT * FROM Reservations WHERE id_User=" . $idUser;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                if ($row["id_User"] == $_SESSION["logedUser"]->getuserID()) {
                    $reservation = new Reservation($row["id_User"], $row["id_MXC"], $row["reservedSits"], $row["ticketPrice"], $row["cinemaName"], $row["movieTitle"], $row["movieDate"], $row["movieTime"]);
                    $reservation->setId($row["id_Reservation"]);
                    $reservation->setReservationDate($row["reservationDate"]);
                    $reservation->setCreditCard($row["creditCard"]);
                    $reservation->setRoom($row["movieRoom"]);
                    array_push($reservationList,   $reservation);
                }
            }
        } catch (PDOException $ex) {
            throw $ex;
        }
        return $reservationList;
    }

    function GetAllWithDetails()
    {
        try {

            $reservationList = array();
            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $reservation = new Reservation($row["id_User"], $row["id_MXC"], $row["reservedSits"], $row["ticketPrice"], $row["cinemaName"], $row["movieTitle"], $row["movieDate"], $row["movieTime"]);
                $reservation->setId($row["id_Reservation"]);
                array_push($reservationList,   $reservation);
            }
        } catch (PDOException $ex) {
            throw $ex;
        }
        return $reservationList;
    }

    function deleteReservation($idReservation)
    {
        try {
            $query = "DELETE FROM Reservations WHERE id_Reservation=" . $idReservation;
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);
        } catch (PDOException $e) {
            //$e->getMessage();
        }
    }

    function getReservationsForMovies($movie)
    {
        $reservationList = array();
        $movieTitle = $movie->getTitle();
        try {
            $query = "SELECT * from reservations where movieTitle='$movieTitle'";
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach ($result as $row) {
                $reservation = new Reservation($row["id_User"], $row["id_MXC"], $row["reservedSits"], $row["ticketPrice"], $row["cinemaName"], $row["movieTitle"], $row["movieDate"], $row["movieTime"]);
                $reservation->setId($row["id_Reservation"]);
                array_push($reservationList,   $reservation);
            }
        } catch (PDOException $e) {
            //$e->getMessage();
        }
        return $reservationList;
    }


    function getEstadisticsFromMovie($movie)
    {
        $reservations = $this->getReservationsForMovies($movie);
        $estadistics = array();
        $cantTickets = 0;
        $balance = 0;
        foreach ($reservations as $row) {
            $cantTickets = $cantTickets + $row->getReservatedSits();
            $balance = $balance + ($row->getTicketPrice() * $row->getReservatedSits());
        }

        $estadistics["movie"] = $movie->getTitle();
        $estadistics["ticketsSold"] = $cantTickets;
        $estadistics["balance"] = $balance;
        return $estadistics;
    }

    function getCinemaBalance($idCinema)
    {
        try {
            $cinemaBalance = array();
            $query = "SELECT * FROM reservations join Movies_X_Cinemas on reservations.id_MXC=Movies_X_Cinemas.id_MXC and Movies_X_Cinemas.id_Cinema=".$idCinema;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $ticketsSold = 0;
            $balance = 0;
          
            foreach ($resultSet as $row){
                $balance =  $balance + ($row["ticketPrice"] * $row["reservedSits"]);
                $ticketsSold =  $ticketsSold + $row["reservedSits"];              
            }
            $cinemaBalance["balance"] = $balance;
            $cinemaBalance["ticketsSold"] = $ticketsSold;
       

        } catch (PDOException $ex) {
            throw $ex;
        }
        return $cinemaBalance;

    }
}
