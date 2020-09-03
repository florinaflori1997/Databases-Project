<?php
include('login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
header("location: movies_main_page.php"); // Redirecting To Profile Page
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>The Little Movie Database | LogIn</title>
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
  			<div class="user_card">
  				<div class="d-flex justify-content-center">
  					<div class="brand_logo_container">
  						<img src="images/logo.png" class="brand_logo" alt="Logo">
  					</div>
  				</div>
  				<div class="d-flex justify-content-center form_container">
  					<form action="register.php" method="post">
  						<div class="input-group mb-3">
  							<div class="input-group-append">
  								<span class="input-group-text"><i class="fas fa-user"></i></span>
  							</div>
  							<input type="text" name="username" class="form-control input_user" value="" placeholder="username" required>
  						</div>
  						<div class="input-group mb-3">
  							<div class="input-group-append">
  								<span class="input-group-text"><i class="fas fa-key"></i></span>
  							</div>
  							<input type="password" name="password" class="form-control input_pass" value="" placeholder="password" required>
  						</div>
              <div class="input-group mb-2">
  							<div class="input-group-append">
  								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
  							</div>
  							<input type="email" name="email" class="form-control input_email" value="" placeholder="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
  						</div>
              <div id="reg-err" class="mt-1" style="display: none;">
                User already used!
              </div>
              <div class="d-flex justify-content-center mt-3 login_container">
      					<button type="submit" name="submit" class="btn login_btn">Register</button>
      				</div>
  					</form>
  				</div>
          <div class="mt-4">
  					<div class="d-flex justify-content-center links">
  						Already registered? <a href="index.php" class="ml-2">Sign In</a>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </body>
</html>
