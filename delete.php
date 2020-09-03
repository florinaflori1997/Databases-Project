<?php
session_start();// Starting Session
$host = "localhost";
$dbtitle = "root";
$dbyear = "";
$dbname = "movie_database";
//create connection
$conn = new mysqli($host, $dbtitle, $dbyear, $dbname);
if (mysqli_connect_error()) {
 die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} else {
  print_r($_POST);
  $movie_id = key($_POST);
  echo $movie_id;
  $movie_id = substr($movie_id, 0,1);
  echo $movie_id ;

  $DELETE = "DELETE FROM movies WHERE movie_id = ?";
  $up = $conn->prepare($DELETE);
  $up->bind_param("i", $movie_id);
  $up->execute();
  $up->close();
  // if ($up->error) {  echo "FAILURE!!! " . $up->error; }

  ?>
  <b id="back"><a href="movies_main_page.php">back</a></b>
  <?php
  header("location: movies_main_page.php"); // Redirecting To Profile Page
  $conn->close();
}
?>
