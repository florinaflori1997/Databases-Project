<?php
session_start();// Starting Session
$title = $_POST['title'];
$year = $_POST['year'];
$genre_id = $_POST['genre'];

$time = $_POST['timing'];
$minute = substr($time, -2);
$hour = substr($time, 0, -3);
$timing = (int)$hour * 60 + (int)$minute;

$country_id = $_POST['country'];
$review = $_POST['review'];

$host = "localhost";
$dbtitle = "root";
$dbyear = "";
$dbname = "movie_database";
//create connection
$conn = new mysqli($host, $dbtitle, $dbyear, $dbname);
if (mysqli_connect_error()) {
 die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} else {
  for($i=0;$i<6;++$i)
  {
    next($_POST);
  }
  $movie_id = key($_POST);
  // echo $movie_id;
  $movie_id = substr($movie_id, 0,1);
  echo $movie_id .$title. $genre_id. $year. $timing. $country_id. $review. $movie_id;
  //
  $UPDATE = "UPDATE movies SET title = ? WHERE movie_id = ?";
  $up = $conn->prepare($UPDATE);
  $up->bind_param("si", $title, $movie_id);
  $up->execute();
  $up->close();
  //
  $UPDATE = "UPDATE movies SET year = ? WHERE movie_id = ?";
  $up = $conn->prepare($UPDATE);
  $up->bind_param("ii", $year, $movie_id);
  $up->execute();
  $up->close();
  //
  $UPDATE = "UPDATE movies SET genre_id = ? WHERE movie_id = ?";
  $up = $conn->prepare($UPDATE);
  $up->bind_param("ii", $genre_id, $movie_id);
  $up->execute();
  $up->close();
  //
  $UPDATE = "UPDATE movies SET timing = ? WHERE movie_id = ?";
  $up = $conn->prepare($UPDATE);
  $up->bind_param("ii", $timing, $movie_id);
  $up->execute();
  $up->close();
  //
  $UPDATE = "UPDATE movies SET country_id = ? WHERE movie_id = ?";
  $up = $conn->prepare($UPDATE);
  $up->bind_param("ii", $country_id, $movie_id);
  $up->execute();
  $up->close();
  //
  $UPDATE = "UPDATE movies SET review = ? WHERE movie_id = ?";
  $up = $conn->prepare($UPDATE);
  $up->bind_param("si", $review, $movie_id);
  $up->execute();
  $up->close();

  ?>
  <b id="back"><a href="movies_main_page.php">back</a></b>
  <?php
  header("location: movies_main_page.php"); // Redirecting To Main Page
  $conn->close();
}
?>
