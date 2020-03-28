<?php 
namespace Models;


class Cinema {
    private $id_Cinema;
    private $cinemaName;
    private $cinemaAddress;    
    private $totalSits;
    private $ticketPrice;
    private $moviesOnPlay;

    
    function __construct($cinemaName, $cinemaAddress, $totalSits,$ticketPrice){
        $this->cinemaName= $cinemaName;
        $this->cinemaAddress = $cinemaAddress;
        $this->totalSits = $totalSits;
        $this->ticketPrice = $ticketPrice;
        $this->moviesOnPlay = 0;
    }

    function getName(){
        return $this->cinemaName;
    }

    function getMoviesOnPlay(){
        return $this->moviesOnPlay;
    }

    function getId(){
        return $this->id_Cinema;
    }

    function getAddress(){
        return $this->cinemaAddress;
    }

    function getTicketPrice(){
        return $this->ticketPrice;
    }

    function getTotalSits(){
        return $this->totalSits;
    }
    function setMoviesOnPlay($cant){
        $this->moviesOnPlay = $cant;
    }
    function setId($id){
        $this->id_Cinema = $id;
    }


}




?>