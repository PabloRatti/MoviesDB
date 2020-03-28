<?php

namespace Controllers;


use Models\Movie;
use Models\Reservation;
use Models\CreditCard;
use DAO\ReservationsDAO;

class TicketsController
{


    function cinemaSelectView($id, $title, $votes, $popularity, $overview, $posterURL, $release)
    {
       
            $selectedMovie = new Movie($title, $votes, $popularity, $overview, $posterURL, $release);
            $selectedMovie->setId($id);
            $_SESSION["selectedMovie"] = $selectedMovie;
            require(VIEWS_PATH . "cinemaSelectView.php");
     
    }

    function makeReservationView($cinemaId, $cinemaName, $ticketPrice)
    {
        if ($_SESSION["logedUser"]->getEmail() != "Guest") {
        require(VIEWS_PATH . "makeReservationView.php");
        } else $this->LoginView();
    }

    function makeDiscount($reservation)
    {
        $reservationDay = $reservation->getReservationDay();
        $day = $this->getDayNameOfDate($reservationDay);

        if ($day == "Tuesday" || $day == "Wednesday") {
            if ($reservation->getReservatedSits() >= 2) {
                $amount = $reservation->getTotalAmount();
                $discount = (25 * $amount) / 100;
                $total = $amount - $discount;
                $reservation->setTotalAmount($total);
            }
        }
        return $reservation;
    }

    function confirmReservationView($funcID, $quantitySits, $ticketPrice, $cinemaName, $movieTitle, $movieDate, $movieTime,$movieRoom)
    {

        $reservation = new Reservation($_SESSION["logedUser"]->getUserID(), $funcID, $quantitySits, $ticketPrice, $cinemaName, $movieTitle, $movieDate, $movieTime);
        $reservation->setRoom($movieRoom);
        $reservation = $this->makeDiscount($reservation);
        $_SESSION["reservation"] = $reservation;

        require(VIEWS_PATH . "confirmReservationView.php");
    }

    function usersHomeView()
    {
        require(VIEWS_PATH . "UsersHomeView.php");
    }



    function LoginView()
    {
        $_SESSION["logedUser"] = null;
        require_once(VIEWS_PATH . "LoginView.php");
    }

    function userReservationsView()
    {
        require(VIEWS_PATH . 'userReservationsView.php');
    }

    function sendReservationMail($reservation)
    {
        $logedUser = $_SESSION["logedUser"]->getEmail();
        $emisor = 'pablomdq.r.s@gmail.com';
        $body = '
            <!DOCTYPE html>
            <html>
            <head>
             <title>Cinemax Tickets</title>
            </head>
            <body>
            <h1> Cinemax Tickets</h1>
                <h3>' . $reservation->getCinemaName() . '</h3>
                <ul>
                     <li>Movie :' . $reservation->getMovieName() . '</li>
                    <li>Movie Date :' . $reservation->getMovieDate() . '</li>
                    <li>Movie Time :' . $reservation->getMovieTime() . '</li>
                    <li>Reserved Sits :' . $reservation->getReservatedSits() . '</li>
                    <li>Total amount :' . $reservation->getTotalAmount() . '</li>
                    <li>Reservation ID :' . $reservation->getReservationID() . '</li>                 
                    <li>Credit Card :' . $reservation->getCreditCard()->getCardNumber() . '</li>                 

                    </ul>
            </body>
            </html>';
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: " . $reservation->getCinemaName() . " <" . $emisor . ">\r\n";
        $headers .= "Reply-To: " . $emisor . "\r\n";

        if (!mail($logedUser, "Cinema Tickets!", $body, $headers)) {
            echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
        }
    }

    function getTicketsView($cardNumber, $creditCompany)
    {
        $card = new CreditCard($cardNumber, $creditCompany);


        $_SESSION["reservation"]->setCreditCard($card);
        $reservation = $_SESSION["reservation"];

        $pdo = new ReservationsDAO();
        $pdo->Add($reservation);
        $this->sendReservationMail($reservation);
        require(VIEWS_PATH . "reservationFinishedView.php");
    }

    function cancelReservation($id_Reservation)
    {
        $pdo = new ReservationsDAO();
        $pdo->deleteReservation($id_Reservation);
        require(VIEWS_PATH . "userReservationsView.php");
    }

    function getDayNameOfDate($fecha)
    {
        $fechats = strtotime($fecha);
        switch (date('w', $fechats)) {
            case 0:
                return "Sunday";
                break;
            case 1:
                return "Monday";
                break;
            case 2:
                return "Tuesday";
                break;
            case 3:
                return "Wednesday";
                break;
            case 4:
                return "Thursday";
                break;
            case 5:
                return "Friday";
                break;
            case 6:
                return "Saturday";
                break;
        }
    }
}
