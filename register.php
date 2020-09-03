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
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
		$error = "Username, Password or Email is invalid";
	}
	else{
		// Define $username and $password
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		// mysqli_connect() function opens a new connection to the MySQL server.
		$conn = mysqli_connect("localhost", "root", "", "movie_database");
		// SQL query to fetch information of registerd users and finds user match.
		$query = "SELECT username from users where username = ? LIMIT 1";
    $INSERT = " INSERT INTO users (username, password, email ) VALUES (?, ?, ?)";
		// To protect MySQL injection for Security purpose
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    if ($rnum==0) {
     $stmt->close();
     $stmt = $conn->prepare($INSERT);
     $stmt->bind_param("sss", $username, $password, $email);
     $stmt->execute();
     $stmt->close();
     $conn->close();
     $_SESSION['login_user'] = $username; // Initializing Session
     //echo "New account!";
     header("location: movies_main_page.php"); // Redirecting To Profile Page
    } else {
    //echo "Error!";
    echo "Account already exists!";
    ?>
    <b><a href="register_index.php">back</a></b>
    <?php
   }
 }
mysqli_close($conn); // Closing Connection
}
?>

</div>
</div>
</div>
  </body>
</html>
