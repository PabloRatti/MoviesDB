<?php

use DAO\ReservationsPDO;
use DAO\MoviesPDO;


if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
$pdo_movies = new MoviesDAO();
$pdo = new ReservationsDAO();
require_once(VIEWS_PATH."adminNavBar.php");

if (isset($data)) {
    $movies = $data;
} else $movies = $pdo_movies->GetMoviesByFunctionsDate(null, '2020-12-12');


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo CSS_PATH ?>/adminView.css" rel="stylesheet" type="text/css" media="all">

    <title>Document</title>
</head>

<body>
    <h1> Movies Balance</h1>
    <form style="margin-bottom: 20px; margin-left:10px;" action="<?php echo FRONT_ROOT ?>Movies/filterByDate" method="post">
        <input type="date" name="firstDate">
        <input style=" margin-left:10px;" type="date" name="secondDate">
        <input style=" margin-left:10px;" type="submit" name="submit" value="filter">
    </form>
    <div style="width: 80%; margin: 0 auto;" class="formContainer">
        <table>
            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Tickets Sold</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movies as $mov) {
                    $estadistics = $pdo->getEstadisticsFromMovie($mov);
                    ?>
                    <tr>
                        <td><?php echo $estadistics["movie"] ?></td>
                        <td><?php echo $estadistics["ticketsSold"] ?></td>
                        <td>$<?php echo $estadistics["balance"] ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </form>
    </div>


  
</body>

</html>