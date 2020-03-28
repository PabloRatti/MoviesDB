<?php require_once(VIEWS_PATH."adminNavBar.php");
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
    <link href="<?php echo CSS_PATH ?>/adminView.css" rel="stylesheet" type="text/css" media="all">

    <title>Manager</title>
</head>

<body>
    <h1 id="loginTitle">Cinemas Manager</h1>
        <a href="<?php echo FRONT_ROOT?>Estadistics/moviesBalancesView">Movie Balances</a>
        <a href="<?php echo FRONT_ROOT?>Estadistics/cinemaBalancesView">Cinema Balances</a>

</body>

</html>