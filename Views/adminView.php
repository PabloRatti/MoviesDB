<?php

use DAO\CinemaDAO;
require_once(VIEWS_PATH."adminNavBar.php");
$DAO = new CinemaDAO();
if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
$cinemaList = $DAO->GetAll();

//cinemalist esta correcto hasta aca

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
    <h1 id="loginTitle">Cinemas Manager</h1>
    <a href="<?php echo FRONT_ROOT?>Estadistics/balancesView">Balances</a>

    <div class="formContainer">
        <form action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Cinema</th>
                        <th>Address</th>
                        <th>Ticket Price</th>
                        <th>Total Sits</th>
                        <th>Add Cinema</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="cinemaName"></td>
                        <td><input type="text" name="cinemaAddress"></td>
                        <td><input type="text" name="ticketPrice"></td>
                        <td><input type="text" name="totalSits"></td>
                        <th><input type="submit" name="submitedCinema" class="btn" value="Add" /></th>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div class="container">

        <h2> Available Cinemas </h2>
        <form action="<?php echo FRONT_ROOT ?>Movies/moviesAddView" method="post">

            <table>
                <thead>
                    <tr>
                        <th>Cinema</th>
                        <th>Address</th>
                        <th>Ticket Price</th>
                        <th>Movies playing</th>
                        <th>Total Sits</th>
                        <th>CinemaId</th>
                        <th>Edit Cinema</th>
                    </tr>
                </thead>
                <tbody>


                    <?php foreach ($cinemaList as $cinema) { ?>
                        <form action="<?php echo FRONT_ROOT ?>Movies/moviesAddView" method="post">
                            <tr>
                                <td>

                                    <?php echo $cinema->getName(); ?>
                                    <input type="hidden" name="cinemaName" value="<?php echo $cinema->getName(); ?>">
                                </td>
                                <td>
                                    <?php echo $cinema->getAddress(); ?>
                                    <input type="hidden" name="cinemaAddress" value="<?php echo $cinema->getAddress(); ?>">
                                </td>
                                <td>
                                    <?php echo $cinema->getTicketPrice(); ?>
                                    <input type="hidden" name="ticketPrice" value="<?php echo $cinema->getTotalSits(); ?>">
                                </td>
                                <td>
                                    <?php echo $cinema->getMoviesOnPlay(); ?>
                                </td>
                                <td>
                                    <?php echo $cinema->getTotalSits(); ?>
                                    <input type="hidden" name="totalSits" value="<?php echo $cinema->getTotalSits(); ?>">
                                </td>
                                <td>
                                    <?php echo $cinema->getId(); ?>
                                    <input type="hidden" name="cinemaId" value="<?php echo $cinema->getId(); ?>">
                                </td>
                                <td>
                                    <input type="submit" value="Edit" name="cinemaToEdit">
                                </td>
                            </tr>
                        </form>
                    <?php }  ?>
                </tbody>
            </table>


    </div>

</body>

</html>