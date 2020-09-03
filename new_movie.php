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
<!DOCTYPE HTML>
<html>
<head>
  <title>Jelly Movies | Add Movie</title>
<!------------------------->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="css/style_new_movie.css" rel="stylesheet" type="text/css">

<!------------------------->
</head>
<body>
 <!-- <b id="back"><a href="movies_main_page.php">back</a></b> -->
 <div class="container h-100">
   <div class="d-flex justify-content-center h-100">
   <div class="user_card">
     <div id="home" class="tab-pane fade in active">
 <form action="insert_movie.php" method="POST">
   <div class="form-group">
     <label for="UserName">TITLE:</label>
     <input type="text" style="width: 630px;" name="title" required>
   </div>
   <div class="form-group">
     <label>YEAR:</label>
     <input type="text" style="width: 200px;"  maxlength="4"  name="year" required>
   </div>
   <div class="form-group">
     <label>GENRE:</label>
     <?php
     $SELECT = "SELECT genre_id, genre_name
                FROM genres";
     $result = $conn->prepare($SELECT);
     $result->execute();
     $result->bind_result($genre_id, $genre_name);
     $result->store_result();
     ?>
     <select name="genre" style="color: black;">
     <?php
       while($result->fetch()) {
         ?>
           <option value="<?php echo $genre_id;?>"><?php echo $genre_name;?></option>
         <?php } ?>
     </select>
   </div>
   <div class="form-group">
     <label>SCREENING TIME:</label>
     <input type="text" style="width: 200px;" pattern="[0-9]+:[0-9]{2}|[0-9]{2}" title="Only hour:minute format!" name="timing" required>
   </div>
   <div class="form-group">
     <label>COUNTRY:</label>
     <?php
     $SELECT = "SELECT country_id, country_name
                FROM countries";
     $result = $conn->prepare($SELECT);
     $result->execute();
     $result->bind_result($country_id, $country_name);
     $result->store_result();
     ?>
     <select name="country" style="color: black;">
     <?php
       while($result->fetch()) {
         ?>
           <option value="<?php echo $country_id;?>"><?php echo $country_name;?></option>
         <?php } ?>
     </select>
   </div>
   <div class="form-group">
     <label>REVIEW:</label>
     <input type="text" style="width: 612px;" name="review" required>
   </div>
   <div class="form-group">
     <label>URL PICTURE:</label>
     <input type="text" style="width: 574px;" name="photo_url" pattern="https?://.+" title="Include http://" required>
   </div>
   <button type="submit" class="btn btn-default btn-lg">Submit</button>
 </form>

 <p id="back"><a href="movies_main_page.php">back</a></p>

     </div>
    </div>

</div>
</div>
</div>

</body>
</html>
<?php
  $conn->close();
  }
?>
