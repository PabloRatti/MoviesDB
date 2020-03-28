<?php

use DAO\ReservationsDAO;
use DAO\MoviesDAO;

use DAO\CinemaDAO;
if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
require_once(VIEWS_PATH."adminNavBar.php");
$pdo = new ReservationsDAO();
$cinemasPDO = new CinemaDAO();

if (isset($filteredCinemas)) {
    $cinemas = $filteredCinemas;
} else $cinemas = $cinemasPDO->getAll();

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

    <h1> Cinemas Balances</h1>
    <form style="margin-bottom: 20px; margin-left:10px;" action="<?php echo FRONT_ROOT ?>Cinema/filterCinemasByReservationsDates" method="post">
        <input type="date" name="firstDate">
        <input style=" margin-left:10px;" type="date" name="secondDate">
        <input style=" margin-left:10px;" type="submit" name="submit" value="filter">
    </form>
    <div style="width: 80%; margin: 0 auto;" class="formContainer">
        <table>
            <thead>
                <tr>
                    <th>Cinema</th>
                    <th>Tickets Sold</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cinemas as $cine) {
                    $estadistics = $pdo->getCinemaBalance($cine->getId());
                
                    ?>
                    <tr>
                        <td><?php echo $cine->getName(); ?></td>
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