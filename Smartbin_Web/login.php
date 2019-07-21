<?php
session_start();

// Checks if the user is logged in

include('adminserver.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
if (isset($_SESSION['adminname']))
{
	// User is already logged in, send them home!
	header('Location: accounts.php');
	exit;
}

 	?>
  <?php include("header1.php"); ?>
  <div class="header">
  	<h2>Login</h2>
  </div>

  <form method="post" action=" ">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Admin name</label>
  		<input type="text" name="adminname" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_admin">Login</button>
	  </div>
	  <p>
		  NOt a member? <a href="accounts.php">Sign Up</a>
	  </p>

  </form>



 <?php include("footer.php"); ?>
</body>
</html>
