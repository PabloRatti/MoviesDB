<?php
require(VIEWS_PATH . 'navBar.php');
if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
use DAO\ReservationsDAO;

$pdo = new ReservationsDAO();
$res = $pdo->getAllForUser($_SESSION["logedUser"]->getUserID());



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo CSS_PATH ?>/cinemaSelect.css" rel="stylesheet" type="text/css" media="all">

    <title>Reservations</title>
</head>

<body>
    <h1>Your Reservations</h1>


    <div class="formContainer">

        <table class="table">
            <thead>
                <tr>
                    <th>Cinema</th>
                    <th>Movie</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reserved</th>
                    <th>Sits</th>
                    <th>Room</th>
                    <th>Amount</th>
                    
                    <th>Cancel</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($res as $r) { ?>
                    <tr>
                        <td><?php echo $r->getCinemaName(); ?></td>
                        <td><?php echo $r->getMovieName(); ?></td>
                        <td><?php echo $r->getMovieDate(); ?></td>
                        <td><?php echo $r->getMovieTime(); ?></td>
                        <td><?php echo $r->getReservationDay(); ?></td>
                        <td><?php echo $r->getReservatedSits();?></td>
                        <td><?php echo $r->getRoom();?></td>

                        <td><?php echo $r->getTotalAmount();?></td>
                        <form action="<?php echo FRONT_ROOT ?>Tickets/cancelReservation" method="post">
                            <input type="hidden" name="id_reservation" value="<?php echo $r->getReservationID(); ?>">
                            <td><input type="submit" name="submit" value="Cancel"></td>
                        </form>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

    </div>


</body>

</html>