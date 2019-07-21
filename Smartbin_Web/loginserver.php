<?php
session_start();
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'samrtbin');
if (isset($_POST['login_user'])) {
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
  	$query = "SELECT * FROM admintable WHERE adminname='$adminname' AND password='$password'" ;
  	$results = mysqli_query($db, $query);

  	if (mysqli_num_rows($results) == 1) {
      $_SESSION['login'] = "ok";
  	  $_SESSION['adminname'] = $adminname;

      $row=$results->fetch_assoc();
      $_SESSION['adminname'] = $row['adminname'];

  	  $_SESSION['success'] = "You are sucessfully logged in";
      header('location:index.php');


      // $destURL = $_SESSION['kickurl'] ? $_SESSION['kickurl'] : 'index.php';
      // unset($_SESSION['kickurl']);
      // header('Location: ' . $destURL);
      // exit();
  	  // else header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>
