<?php

namespace Models;

class Reservation
{

    private $reservationID;
    private $functionID;
    private $userID;
    private $reservedSits;
    private $status;
    private $reservationDay;
    private $totalAmount;
    private $ticketPrice;
    private $cinemaName;
    private $movieName;
    private $movieDate;
    private $movieTime;
    private $creditCard;
    private $movieRoom;

    function __construct($userID, $functionID, $reservedSits, $ticketPrice, $cinemaName, $movieName, $movieDate, $movieTime)
    {
        $this->userID = $userID;
        $this->functionID = $functionID;
        $this->reservedSits = $reservedSits;
        $this->status = "Active";
        $this->reservationDay = $this->getToday();
        $this->ticketPrice = $ticketPrice;
        $this->totalAmount = $this->reservedSits * $this->ticketPrice;
        $this->cinemaName = $cinemaName;
        $this->movieName = $movieName;
        $this->movieDate = $movieDate;
        $this->movieTime = $movieTime;
    }

    private function getToday()
    {
        return date("Y/m/d");
    }

    function getReservationID()
    {
        return $this->reservationID;
    }
    function getCinemaName()
    {
        return $this->cinemaName;
    }

    function getRoom()
    {
        return $this->movieRoom;
    }

    function getMovieName()
    {
        return $this->movieName;
    }

    function getMovieDate()
    {
        return $this->movieDate;
    }

    function getMovieTime()
    {
        return $this->movieTime;
    }

    function getFunctionID()
    {
        return $this->functionID;
    }

    function getuserID()
    {
        return $this->userID;
    }

    function getReservatedSits()
    {
        return $this->reservedSits;
    }

    function getTicketPrice()
    {
        return $this->ticketPrice;
    }
    function getStatus()
    {
        return $this->status;
    }
    function getReservationDay()
    {
        return $this->reservationDay;
    }
    function getTotalAmount()
    {
        return $this->totalAmount;
    }
    function setTotalAmount($amount)
    {
        $this->totalAmount = $amount;;
    }

    function setReservationID($id)
    {
        $this->reservationID = $id;
    }

    function getCreditCard()
    {
        return $this->creditCard;
    }

    function setCreditCard($card)
    {
        $this->creditCard = $card;
    }

    function setID($id)
    {
        $this->reservationID = $id;
    }
    function setCinemaName($name)
    {
        $this->cinemaName = $name;
    }

    function setMovieTitle($title)
    {
        $this->movieName = $title;
    }

    function setReservationDate($date)
    {
        $this->reservationDay = $date;
    }

    function setRoom($room)
    {
        $this->movieRoom = $room;
    }
}
