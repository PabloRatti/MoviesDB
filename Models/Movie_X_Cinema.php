<?php 
namespace Models;

class Movie_X_Cinema{
       private $id_MXC;
       private $id_Cinema ;
       private $movieRoom;
       private $id_Movie ;
       private $movieDate ;
       private $movieTime ;
       private $sitsLeft;

       function __construct ($idCinema,$idMovie,$date,$time,$sitsLeft){
           $this->id_Cinema = $idCinema;
           $this->id_Movie = $idMovie;
           $this->movieDate = $date;
           $this->movieTime = $time;
           $this->sitsLeft = $sitsLeft;
       }

       public function getId(){
           return $this->id_MXC;
       }

       public function getIdCinema(){
           return $this->id_Cinema;
       }
       public function getRoom(){
           return $this->movieRoom;
       }

       public function getIdMovie(){
           return $this->id_Movie;
       }

       public function getMovieDate(){
           return $this->movieDate;
       }

       public function getMovieTime(){
           return $this->movieTime;
       }
       public function getSitsLeft(){
           return $this->sitsLeft;
       }

       public function SetSitsLeft($cant){
           $this->sitsLeft = $cant;
       }

       public function setId($id){
           $this->id_MXC = $id;
       }
    
       public function setRoom($room){
           $this->movieRoom = $room;
       }

       
}
