<!DOCTYPE html>
<html>
<head>
  <title>The Little Movie Database | Add Movie</title>
  <link href="css/style_index.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
    integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

</head>
<body>
  <div class="container h-100">
    <div class="d-flex justify-content-center h-100">
      <div class="added_card">

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
$photo_url = $_POST['photo_url'];

if (!empty($title) || !empty($year) || !empty($genre) || !empty($country)) {
    $host = "localhost";
    $dbtitle = "root";
    $dbyear = "";
    $dbname = "movie_database";
    //create connection
    $conn = new mysqli($host, $dbtitle, $dbyear, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT_USER_ID = "SELECT user_id FROM users WHERE username = ? LIMIT 1";
     $INSERT_PHOTO = "INSERT INTO photos (photo_url) VALUES (?)";
     $SELECT_PHOTO = "SELECT photo_id FROM photos WHERE photo_url = ? LIMIT 1";
     $SELECT_TITLE = "SELECT title FROM movies WHERE (title = ? AND user_id = ?) LIMIT 1";
     $INSERT_MOVIE = "INSERT INTO movies (title, genre_id, year, timing, country_id, review, user_id, photo_id)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
     //
     $stmt = $conn->prepare($SELECT_USER_ID);
 		 $stmt->bind_param("s", $_SESSION['login_user']);
 	   $stmt->execute();
 		 $stmt->bind_result($user_id);
 		 $stmt->store_result();
     $stmt->fetch();
     $stmt->close();
     //
     if (!empty($photo_url))
     {
       $stmt = $conn->prepare($INSERT_PHOTO);
       $stmt->bind_param("s", $photo_url);
       $stmt->execute();
       $stmt->close();
     }
     //
     $stmt = $conn->prepare($SELECT_PHOTO);
     $stmt->bind_param("s", $photo_url);
     $stmt->execute();
     $stmt->bind_result($photo_id);
     $stmt->store_result();
     $stmt->fetch();
     $stmt->close();
     //
     //
     $stmt = $conn->prepare($SELECT_TITLE);
     $stmt->bind_param("si", $title, $user_id);
     $stmt->execute();
     $stmt->bind_result($title);
     $stmt->store_result();
     //
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT_MOVIE);
      $stmt->bind_param("siisisii", $title, $genre_id, $year, $timing, $country_id, $review, $user_id, $photo_id);
      $stmt->execute();
      echo "New movie inserted sucessfully!";
      ?>
      <b id="back"><a href="movies_main_page.php">back</a></b>
      <?php
     } else {
      echo "You already added this movie!";
      ?>
      <b><a href="movies_main_page.php">back</a></b>
      <?php
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
// header("location: movies_main_page.php"); // Redirecting To Profile Page
?>
</div>
</div>
</div>
  </body>
</html>
