<?php


$adminname = "";
$email    = "";
$Address  = "";
$Phoneno  = "";
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'samrtbin');

if (isset($_POST['reg_admin'])) {
 
  $adminname = mysqli_real_escape_string($db, $_POST['adminname']);
  $Address = mysqli_real_escape_string($db, $_POST['address']);
  $Phoneno = mysqli_real_escape_string($db, $_POST['Phoneno']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

 
  if (empty($adminname)) { array_push($errors, "Adminname is required"); }
  if (empty($Address)) { array_push($errors, "Address is required"); }
  if (empty($Phoneno)) { array_push($errors, "Phone No  is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM registration WHERE adminname='$adminname' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['adminname'] === $adminname) {
      array_push($errors, "Name already exists");
    }


    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) === 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO `registration` (`adminname`,`Address`,`Phone No`, `email`, `password`)
  			  VALUES('$adminname','$Address','$Phoneno', '$email', '$password')";
  	$result=mysqli_query($db, $query);
    if(!$result)
    {
      die("Error SQL");
    }
  	$_SESSION['adminname'] = $adminname;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: adminlogin.php');
  }
}
// // ...

// LOGIN USER
if (isset($_POST['login_admin'])) {
  $adminname = mysqli_real_escape_string($db, $_POST['adminname']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($adminname)) {
  	array_push($errors, "adminname is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM admins WHERE adminname='$adminname' AND password='$password'";
  	$results = mysqli_query($db, $query);

     if (mysqli_num_rows($results) == 1) {
      $row = mysqli_fetch_assoc($results);
  	  $_SESSION['adminname'] = $adminname;
        header("Location: services.php");

  	}
    else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}




?>
