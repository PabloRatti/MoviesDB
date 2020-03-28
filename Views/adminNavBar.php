<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo CSS_PATH ?>/navBar.css" rel="stylesheet" type="text/css" media="all">

    <title>Document</title>
</head>

<body>
    <ul>
        <li><a href="./adminView">Home</a></li>
        <li><a href="./LoginView">Back to Login</a></li>

        <li style="float:right"><a class="active" href="#about">About</a></li>

        <li style="float:right;"><a href="#contact">User: <?php echo $_SESSION["logedUser"]->getEmail();?></a></li>
    </ul>
</body>

</html>