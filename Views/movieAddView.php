<?php

//Aca llega el cine que queremos moficiar cartelera correctamente

use DAO\MoviesDAO;
use DAO\ApiDAO;
if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
$apiDAO = new ApiDAO();
$apiDAO->updateMoviesDB();

$moviesPDO = new MoviesDAO();
$thisCinemaMovies = $moviesPDO->getMoviesFromCinema($cinema->getId());
$allMovies = $moviesPDO->getAll();
require_once(VIEWS_PATH."adminNavBar.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo CSS_PATH ?>/adminView.css" rel="stylesheet" type="text/css" media="all">

    <title>Manager</title>
</head>

<body>
    <h1 id="loginTitle"><?php echo $cinema->getName(); ?></h1>
   
    <div class="formContainer">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Movie ID </th>
                    <th>Add to Cinema</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($allMovies as $mov) { ?>

                    <form action="<?php echo FRONT_ROOT ?>Movies/addMovieToCinema" method="post">

                        <tr>
                            <td>
                                <?php echo $mov->getTitle(); ?>
                            </td>
                            <td>
                                <input type="date" name="movieDate">
                            </td>
                            <td>
                                <input type="time" name="movieTime">
                            </td>
                            <td>
                            <input type="number" name="Room" min="1" max="3"/>
                            </td>
                            <td>
                                <?php echo $mov->getId(); ?>
                                <input type="hidden" name="movieId" value="<?php echo $mov->getId(); ?>">
                            </td>
                           
                            <td>
                                <input type="hidden" name="cinemaId" value="<?php echo $cinema->getId() ?>">
                                <input type="hidden" name="cinemaName" value="<?php echo $cinema->getName() ?>">
                                <input type="hidden" name="cinemaAddress" value="<?php echo $cinema->getAddress() ?>">
                                <input type="hidden" name="cinemaTotalSits" value="<?php echo $cinema->getTotalSits() ?>">
                                <input type="hidden" name="cinemaTicketPrice" value="<?php echo $cinema->getTicketPrice() ?>">

                                <!-- $cinemaName,$cinemaAddress,$totalSits,$ticketPrice,$cinemaId)-->
                                <input type="submit" name="submit" value="Add">
                            </td>
                        </tr>
                    </form>
                <?php } ?>

            </tbody>
        </table>

    </div>


    <div class="container">

        <h2> Available Movies in this cinema </h2>
        <form action="<?php echo FRONT_ROOT ?>Movies/deleteAllMovies" method="post">
            <input style="margin-bottom: 20px;" type="submit" value="Delete All">
            <input type="hidden" name="cinemaId" value="<?php echo $cinema->getId() ?>">
            <input type="hidden" name="cinemaName" value="<?php echo $cinema->getName() ?>">
            <input type="hidden" name="cinemaAddress" value="<?php echo $cinema->getAddress() ?>">
            <input type="hidden" name="cinemaTotalSits" value="<?php echo $cinema->getTotalSits() ?>">
            <input type="hidden" name="cinemaTicketPrice" value="<?php echo $cinema->getTicketPrice() ?>">
        </form>
        <form action="<?php echo FRONT_ROOT ?>" method="post">

            <table>
                <thead>
                    <tr>
                        <th>Show ID</th>
                        <th>Cinema ID </th>
                        <th>Movie ID </th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Available Sits</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($thisCinemaMovies as $movie) { ?>
                        <form action="<?php echo FRONT_ROOT ?>Movies/removeMovieFromCinema" method="post">
                            <tr>
                                <td>
                                    <?php echo $movie->getId(); ?>
                                    <input type="hidden" name="idToDelete" value="<?php echo $movie->getId(); ?>">
                                </td>
                                <td><?php echo $movie->getIdCinema(); ?></td>
                                <td><?php echo $movie->getIdMovie(); ?></td>
                                <td><?php echo $movie->getMovieDate(); ?></td>
                                <td><?php echo $movie->getMovieTime(); ?></td>
                                <td><?php echo $movie->getRoom();?> </td>
                                <td><?php echo $movie->getSitsLeft(); ?></td>
                                <td>
                                    <!--Pasing the cinema -->
                                    <input type="hidden" name="cinemaId" value="<?php echo $cinema->getId(); ?>">
                                    <input type="hidden" name="cinemaName" value="<?php echo $cinema->getName(); ?>">
                                    <input type="hidden" name="cinemaAddress" value="<?php echo $cinema->getAddress(); ?>">
                                    <input type="hidden" name="cinemaTotalSits" value="<?php echo $cinema->getTotalSits(); ?>">
                                    <input type="hidden" name="cinemaTicketPrice" value="<?php echo $cinema->getTicketPrice(); ?>">
                                    <input type="submit" value="Remove">
                                </td>
                            </tr>
                        </form>
                    <?php } ?>
                </tbody>
            </table>


    </div>


</body>

</html>