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
 <title>The Little Movie Database</title>
 <link href="css/style_main_page.css" rel="stylesheet" type="text/css">
</head>
<body>
</br></br>
  <img id="site_logo" src="images/logo_1.png"/>
 <div class="container">
   <?php
   //----------
   $SELECT1 = "SELECT movie_id,
                title,
                year,
                (SELECT genre_name FROM genres WHERE m.genre_id=genre_id) as genre,
                timing,
                (SELECT country_name FROM countries WHERE m.country_id=country_id) as country,
                (SELECT country_code FROM countries WHERE m.country_id=country_id) as country_code,
                review,
                photo_id
              FROM movies as m
              WHERE user_id = (SELECT user_id FROM users WHERE username = ?)";
   $result = $conn->prepare($SELECT1);
   $result->bind_param("s", $_SESSION['login_user']);
   $result->execute();
   $result->bind_result($movie_id, $title, $year, $genre, $timing, $country, $country_code, $review, $photo_id);
   $result->store_result();
   //-------
     while($result->fetch()) {
       //taking photo from db
       $SELECT3 = "SELECT photo_url FROM photos WHERE photo_id = ?";
       $result3 = $conn->prepare($SELECT3);
       $result3->bind_param("i", $photo_id);
       $result3->execute();
       $result3->bind_result($photo_url);
       $result3->store_result();
       $result3->fetch();
       $result3->close();
       //procesing time
       if($timing >= 60){
         $hour = 0;
         while($timing >= 60)
         {
           $hour = $hour + 1;
           $timing = $timing - 60;
         }
         if($timing == 0)
         $timing = "00";
         $timing = $hour . ":" . $timing;
       }
       //echo $photo_url;
       ?>
       <!--movie-card-->
  <div class="movie-card">
    <!--movie-header-->
                                                        <!-- photo -->
    <div style="background: url(<?php echo $photo_url; ?>); background-repeat: no-repeat; background-size: cover;"
                                        class="movie-header photo" >
      <div class="header-icon-container">
        <a href="#">
          <i class="material-icons header-icon"></i>
        </a>
      </div>
    </div>
    <!--movie-content-->
    <div class="movie-content">
      <form action="movie_action.php" method="POST" >
        <div class="movie-content-header">
        <!--title-->
            <div class="title-section">
                                                      <!-- title -->
              <input type="text" name="title" value="<?php echo $title;?>" style="float: left; width: 220px;">
                                                      <!-- year -->
              <input type="text" name="year" value="<?php echo $year;?>" style="float: right; width: 40px;"
                      maxlength="4" ></br></br>
            </div>
   			</div>
   			<div class="movie-info">
          <!--genre-->
   				<div class="info-section">
              <label>GENRE</label>
              <?php
              $SELECT = "SELECT genre_id, genre_name
                         FROM genres";
              $g = $conn->prepare($SELECT);
              $g->execute();
              $g->bind_result($genre_id, $genre_name);
              $g->store_result();
              ?>
              <select name="genre" style="color: black;">
              <?php
                while($g->fetch()) {
                  ?>
                    <option <?php if($genre == $genre_name){ echo " selected"; }?>
                      value="<?php echo $genre_id;?>"

                      > <?php echo $genre_name;?></option>
                  <?php } ?>
              </select></br></br>
   				</div>
          <!--timing-->
   				<div class="info-section">
   					<label>Country</label>
                                                    <!-- country -->
            <input type="text" name="country" style="float: left; width: 220px;" value="<?php echo $country; ?>">
                                                    <!-- country code -->
            <input type="text" name="country" style="float: right; width: 30px;" value="<?php echo $country_code; ?>"></br></br>
   				</div>
          <!--country-->
   				<div class="info-section">
   					<label>Screening Time</label>
                                                    <!-- time -->
            <input type="text" name="timing" value="<?php echo $timing; ?>" pattern="[0-9]+:[0-9]{2}|[0-9]{2}" title="Only hour:minute format!"></br></br>
   				</div>
          <!--review??-->
   				<div class="info-section">
   					<label>Review</label>
                                                    <!-- review -->
            <input type="text" name="review" value="<?php echo $review; ?>"></br></br>
   				</div>
          <!--  -->
          <input type="image" class="buttons" src="images/modify_png.png" alt="Submit" width="70" height="70" name="<?php echo $movie_id; ?>">
          <input form="deleteForm" type="image" class="buttons" src="images/delete_png.png" alt="Submit" width="70" height="70" name="<?php echo $movie_id; ?>">
   			</div><!--movie-content-->
      </form>
      <form action="delete.php"  method="POST" id="deleteForm">
      </form>

 		</div><!--movie-header-->
 	</div><!--movie-card-->
  <?php
    }
    $result->close();
  ?>
  <div class="movie-add">
    <a id="add" href="new_movie.php">
      <img id="add_img" src="images/add-png.png"/>
    </a>
  </div>
 </div><!--container-->
 <div id="profile">
  <b id="welcome">Welcome:  <i><?php echo $login_session; ?></i></b>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b id="logout"><a href="logout.php">Log Out</a></b>

  </div>
 </body>
</html>
<?php
  $conn->close();
  }
?>
