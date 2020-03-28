<?php

use DAO\MoviesDAO;
if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
$pdo = new MoviesDAO();
$functions = $pdo->getFunctionsForMovieInCinema($_SESSION["selectedMovie"]->getId(), $cinemaId);
require(VIEWS_PATH."navBar.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo CSS_PATH ?>/cinemaSelect.css" rel="stylesheet" type="text/css" media="all">

    <title>Reservation</title>
</head>

<body>
    <h1>Reservation for <?php echo $_SESSION["selectedMovie"]->getTitle(); ?> </h1>

    <div class="formContainer">
        <h2>Available Functions in <?php echo $cinemaName ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Tickets</th>
                    <th>Reservation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($functions as $func) { ?>
                    <form class="form" action="<?php echo FRONT_ROOT ?>Tickets/confirmReservationView" method="post">
                        <tr>
                            <td><?php echo $func->getMovieDate() ?></td>
  

                            <td><?php echo $func->getMovieTime() ?></td>
                            <input type="hidden" name="funcID" value="<?php echo $func->getId(); ?>">
                            <td><input type="number" name="quantity" min="1" max="99" required></td>
                            <input type="hidden" name="ticketPrice" value="<?php echo $ticketPrice ?>">
                            <input type="hidden" name="cinemaName" value="<?php echo $cinemaName ?>">
                            <input type="hidden" name="movieTitle" value="<?php echo $_SESSION["selectedMovie"]->getTitle(); ?>">
                            <input type="hidden" name="movieDate" value="<?php echo $func->getMovieDate(); ?>">
                            <input type="hidden" name="movieTime" value="<?php echo $func->getMovieTime(); ?>">
                            <input type="hidden" name="movieRoom" value="<?php echo $func->getRoom(); ?>">

                            <td><input type="submit" value="Reservation"></td>
                        </tr>
                    </form>
                <?php } ?>
            </tbody>
        </table>

    </div>
</body>

</html>