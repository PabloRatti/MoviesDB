<?php 
if (!isset($_SESSION["logedUser"])){
    header("location: ./LoginView.php");
}
require_once(VIEWS_PATH."adminNavBar.php");

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
    <h1> Stadistics</h1>

  
</body>

</html>