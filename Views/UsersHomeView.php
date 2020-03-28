<?php

use DAO\MoviesDAO;
use Models\User;
use DAO\usersDAO;

$pdo = new MoviesDAO();

if (!isset($_SESSION["logedUser"])) {
  $guestUser = new User("Guest", "1", "user");
  $_SESSION["logedUser"] = $guestUser;
}
$today = date("Y/m/d");

//$movies = $pdo->getAllFunctions();

if (isset($data)) {
  $movies = $data;

} else {
  $movies = $pdo->Getall();
  //$movies = $pdo->GetMoviesByFunctionsDate($today, '2020-12-12');  
 
}



/********* Testing FB Users ***********/
/*
if (isset($_SESSION["fbUser"])) {
  $User = $_SESSION["fbUser"];
  $fbUser = new User($User->getEmail(), $User->getID(), "user");
  $pdo = new usersPDO();
  $pdo->registerUser($fbUser);
  $fbUserWithID = $pdo->getUser($User->getEmail(), $User->getID());
  $_SESSION["logedUser"] =  $fbUserWithID;
} 
*/

require(VIEWS_PATH . "navBar.php");

?>

<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link href="<?php echo CSS_PATH ?>/Home.css" rel="stylesheet" type="text/css" media="all">

</head>

<body>

  <h1 id='mainTitle'>Welcome to Cinemax </h1>
  <form action="<?php echo FRONT_ROOT ?>Movies/Filter" method="POST">
    <input type="date" name="filterDate">
    <select name="category">
      <option value="None">None</option>

      <option value="Action">Action</option>
      <option value="Adventure">Adventure</option>
      <option value="Animation">Animation</option>
      <option value="Comedy">Comedy</option>
      <option value="Crime">Crime</option>
      <option value="Documentary">Documentary</option>
      <option value="Drama">Drama</option>
      <option value="Family">Family</option>
      <option value="Fantasy">Fantasy</option>
      <option value="History">History</option>
      <option value="Horror">Horror</option>
      <option value="Music">Music</option>
      <option value="Mistery">Mistery</option>
      <option value="Romance">Romance</option>
      <option value="Science Fiction">Science Fiction</option>
      <option value="Tv Movie">Tv Movie</option>
      <option value="Thriller">Thriller</option>
      <option value="War">War</option>
      <option value="Western">Western</option>

    </select>
    <input type="submit" name="submit" value="Filter">
  </form>
  <?php
                if (!empty($movies)) {
                  foreach ($movies as $movie) { ?>
      <div class="wrapper">
        <div class="main_card">
          <div class="card_left">
            <div class="card_datails">
              <h1><?php echo $movie->getTitle(); ?></h1>
              <div class="card_cat">
                <p class="year">Release : <?php echo $movie->getReleaseDate() ?></p>
                <p class="genre">Votes : <?php echo $movie->getVotes() ?> </p>
                <p class="time">Popularity : <?php echo $movie->getPopularity() ?></p>
              </div>
              <div class="disc">
                <p><?php echo $movie->getOverview() ?></p>
              </div>


              <form action="<?php echo FRONT_ROOT ?>Tickets/cinemaSelectView" method="post">

                <input type="hidden" name="movieID" value="<?php echo $movie->getId(); ?>">
                <input type="hidden" name="movieTitle" value="<?php echo $movie->getTitle() ?>">
                <input type="hidden" name="movieVotes" value="<?php echo $movie->getVotes() ?>">
                <input type="hidden" name="moviePopularity" value="<?php echo $movie->getPopularity() ?>">
                <input type="hidden" name="movieOverview" value="<?php echo $movie->getOverview() ?>">
                <input type="hidden" name="moviePosterURL" value="<?php echo $movie->getPosterUrl() ?>">
                <input type="hidden" name="movieRelease" value="<?php echo $movie->getReleaseDate() ?>">
                <div class="buttonsContainer">
                  <input class="btn" type="submit" name="submit" value="Get Tickets">

                </div>
              </form>

            </div>
          </div>
          <div class="card_right">
            <div class="img_container">
              <img src="<?php echo "  https://image.tmdb.org/t/p/w500" . $movie->getPosterUrl() ?>" alt="">
            </div>

          </div>
        </div>
      </div>



      <!-- pre url imgs poster_path https://image.tmdb.org/t/p/w500-->


  <?php }
                                                                } ?>



</body>

</html>