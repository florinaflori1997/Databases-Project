<?php
include('session.php');
if(!isset($_SESSION['login_user'])){
  header("location: index.php"); // Redirecting To Home Page
}
$host = "localhost";
$dbtitle = "root";
$dbyear = "";
$dbname = "movie_database";
//create connection
$conn = new mysqli($host, $dbtitle, $dbyear, $dbname);
if (mysqli_connect_error()) {
 die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} else {
?>
<!DOCTYPE html>
<html>
<head>
 <title>Jelly Movies</title>
 <link href="css/style_main_page.css" rel="stylesheet" type="text/css">
</head>
<body>
  <h1> TV SHOWS </h1>
 <div class="container">
   <?php
   $SELECT = "SELECT title,
                year,
                (SELECT genre_name FROM genres WHERE tv.genre_id=genre_id) as genre,
                timing,
                (SELECT country_name FROM countries WHERE tv.country_id=country_id) as country,
                review
              FROM tv_shows as tv";
   $result = $conn->query($SELECT);
   if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
       ?>
       <!--movie-card-->
  <div class="movie-card">
    <!--movie-header-->
    <div class="movie-header manOfSteel">
      <div class="header-icon-container">
        <a href="#">
          <i class="material-icons header-icon"></i>
        </a>
      </div>
    </div>
    <!--movie-content-->
    <div class="movie-content">
      <div class="movie-content-header">
      <!--title-->
        <a href="#">
          <h3 class="movie-title">
            <?php echo $row["title"]. " (" . $row["year"] . ") <br>"; ?>
          </h3>
 				</a>
 			</div>
 			<div class="movie-info">
        <!--genre-->
 				<div class="info-section">
 					<label>Genre</label>
 					<span><?php echo $row["genre"] ?></span>
 				</div>
        <!--timing-->
 				<div class="info-section">
 					<label>Country</label>
 					<span><?php echo $row["country"] ?></span>
 				</div>
        <!--country-->
 				<div class="info-section">
 					<label>Screening Time</label>
 					<span><?php echo $row["timing"] ?></span>
 				</div>
        <!--review??-->
 				<div class="info-section">
 					<label>Review</label>
 					<span><?php echo $row["review"] ?></span>
 				</div>
        <!--  -->
 			</div><!--movie-content-->
 		</div><!--movie-header-->
 	</div><!--movie-card-->
  <?php
    }
  } else { echo "0 results"; }
  ?>

 </div><!--container-->
 <div id="profile">
  <b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
  <b id="logout"><a href="logout.php">Log Out</a></b>
  <b id="add"><a href="new_movie.php">add movie</a></b>
  </div>
 </body>
</html>
<?php
  $conn->close();
  }
?>
