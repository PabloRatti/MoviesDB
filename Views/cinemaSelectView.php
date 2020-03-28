<?php

use DAO\MoviesDAO;


if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
$PDO = new MoviesDAO();
$cinemas = $PDO->getCinemasFromMovie($_SESSION["selectedMovie"]->getId());
$selectedMovie = $_SESSION["selectedMovie"];
require(VIEWS_PATH."navBar.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo CSS_PATH ?>/cinemaSelect.css" rel="stylesheet" type="text/css" media="all">
    <title>Cinemas</title>
</head>

<body>
    <h1 id="mainTitle">Select Cinema</h1>

    <div class="wrapper">
        <div class="main_card">
            <div class="card_left">
                <div class="card_datails">
                    <h1><?php echo $selectedMovie->getTitle(); ?></h1>
                    <h4>Movie ID: <?php echo $selectedMovie->getId(); ?></h4>
                    <div class="card_cat">
                        <p class="year">Release : <?php echo $selectedMovie->getReleaseDate() ?></p>
                        <p class="genre">Votes : <?php echo $selectedMovie->getVotes() ?> </p>
                        <p class="time">Popularity : <?php echo $selectedMovie->getPopularity() ?></p>
                    </div>
                    <div class="disc">
                        <p><?php echo $selectedMovie->getOverview() ?></p>
                    </div>
                </div>
            </div>
            <div class="card_right">
                <div class="img_container">
                    <img src="<?php echo "  https://image.tmdb.org/t/p/w500" . $selectedMovie->getPosterUrl() ?>" alt="">
                </div>

            </div>
        </div>
    </div>

    <div class="formContainer">
        <h2>Available Cinemas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Cinema</th>
                    <th>Address</th>
                    <th>Ticket Price</th>
                    <th>Reservation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cinemas as $cinema) { ?>

                    <form class="form" action="<?php echo FRONT_ROOT ?>Tickets/makeReservationView" method="post">

                        <tr>
                            <td><?php echo $cinema->getName(); ?></td>
                            <td><?php echo $cinema->getAddress(); ?></td>
                            <td><?php echo $cinema->getTicketPrice(); ?></td>
                            <input type="hidden" name="cinemaID" value="<?php echo $cinema->getId();?>">
                            <input type="hidden" name="cinemaName" value="<?php echo $cinema->getName();?>">
                            <input type="hidden" name="ticketPrice" value="<?php echo $cinema->getTicketPrice();?>">
                            <th><input type="submit" value="Reservation"></th>
                        </tr>
                    </form>
                <?php } ?>
            </tbody>
        </table>

    </div>


</body>

</html>