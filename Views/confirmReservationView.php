<?php

require(VIEWS_PATH."navBar.php");
if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo CSS_PATH ?>/confirmReservation.css" rel="stylesheet" type="text/css" media="all">

    <title>Confirm</title>
</head>

<body>
    <h1 class="title">Confirm Reservation</h1>
    <div class="container">
        <div class="screen">
            <div class="screen-header">
                <div class="screen-header-left">
                    <div class="screen-header-button close"></div>
                    <div class="screen-header-button maximize"></div>
                    <div class="screen-header-button minimize"></div>
                </div>
                <div class="screen-header-right">
                    <div class="screen-header-ellipsis"></div>
                    <div class="screen-header-ellipsis"></div>
                    <div class="screen-header-ellipsis"></div>
                </div>
            </div>
            <div class="screen-body">
                <div class="screen-body-item left">
                    <div class="app-title">
                        <span><?php echo $cinemaName ?></span>

                    </div>
                    <div class="app-contact">Reservation ID: <?php echo $funcID ?></div>
                </div>
                <form action="<?php echo FRONT_ROOT ?>Tickets/getTicketsView" method="POST">

                    <div class="app-form">
                        <div class="app-form-group">
                            <h2><?php echo $_SESSION["selectedMovie"]->getTitle(); ?> </h2>
                        </div>
                        <div class="app-form-group"> User:
                            <input readonly="readonly" class="app-form-control" value="<?php echo $_SESSION["logedUser"]->getEmail(); ?>">
                        </div>
                        <div class="app-form-group"> Sits:
                            <input readonly="readonly"  class="app-form-control" value="<?php echo $quantitySits ?>">
                        </div>
                        <div class="app-form-group"> Reservation Total:
                            <input readonly="readonly"  class="app-form-control" value="<?php echo $_SESSION["reservation"]->getTotalAmount(); ?>">
                        </div>

                        <div class="app-form-group message"> Credit Card Number (No spaces):
                            <input class="app-form-control" name="cardNumber" type="number" required>
                        </div>

                        <label><input name="checkboxVisa" type="checkbox" id="cbox1" value="visa"> Visa</label>

                        <input name="checkboxMaster" type="checkbox" id="cbox2" value="master"> <label for="cbox2">Master</label>
                        <div class="app-form-group buttons">
                            <input type="submit" name="submit" value="Send" class="app-form-button">
                            <a style="text-decoration:none;" class="app-form-button" href="./usersHomeView">Cancel</a>
                </form>
                

            </div>
        </div>
    </div>
    </div>
    </div>

    </div>
</body>

</html>