<?php
require(VIEWS_PATH . "navBar.php");
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
    <link href="<?php echo CSS_PATH ?>/reservationFinished.css" rel="stylesheet" type="text/css" media="all">

    <title>Congratulations</title>
</head>

<body>
    <div style="margin-top: 100px;" class="containerText">
        <h1>Thank you for trust in us!</h1>
        <h3>We sent you and E-mail with the tickets </h3>
        <h3><?php echo $_SESSION["logedUser"]->getEmail(); ?></h3>
        <div>
</body>

</html>