<?php

use Controllers\facebookController;
use Controllers\LoginController;

$loger = new facebookController();
$logerLink = $loger->getLoginLink();

if (isset($_SESSION["logedUser"])){
    $_SESSION["logedUser"] = null;
}
if (isset($_SESSION["fbUser"])) {
  $loginController = new LoginController();
  $loginController->UsersHomeView();     
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo CSS_PATH ?>/Layout.css" rel="stylesheet" type="text/css" media="all">

    <title>Login</title>
</head>

<body>
    <!-- Begin Page Content -->
    <h1 id="loginTitle">Cinemax Login</h1>
    <div id="container">
        <form method="post" action="<?php echo FRONT_ROOT ?>/Login/Login">
            <label for="username">Username:</label>
            <input type="email" id="username" name="username" >
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <div id="lower">
                <input type="submit" name="register" value="<?php echo "register" ?>">
                <input type="submit" name="login" value="Login">
            </div>

            <!--/ lower-->
            <?php echo $logerLink ?>
        </form>

    </div>
    <!--/ container-->
    <!-- End Page Content -->




</body>

</html>