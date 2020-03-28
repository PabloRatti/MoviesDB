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
    <div id="containerRegistration">
        <form method="post" action="<?php echo FRONT_ROOT ?>/Login/registerUser">
            <label for="username">Name:</label>
            <input type="text" id="username"  requiered>

            <label for="usersurname">Surname:</label>
            <input type="text" id="usersurname"  requiered>
            
            <label for="useremail">Email:</label>
            <input type="email" id="useremail" name="useremail" requiered> 

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

           
            <label for="passwordCheck">Password:</label>
            <input type="password" id="passwordCheck" name="passwordCheck" required>
            <div id="lower">
                <input style="margin-right: 130px;" type="submit" name="register2" value="<?php echo "register" ?>">
              <a href="./LoginView">Back</a>
              </div>

            
        </form>

    </div>
    <!--/ container-->
    <!-- End Page Content -->




</body>

</html>