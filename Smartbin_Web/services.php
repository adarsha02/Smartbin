<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="services.css">
  </head>
  <body>
    <?php include("header1.php"); ?>
    <div class="first">
  
    </div>
    <div class="this">
    <?php
      $db = mysqli_connect('localhost', 'root', '', 'samrtbin');
      $user_check_query = "SELECT * FROM trash WHERE location='hemja'  LIMIT 1";

      $result = mysqli_query($db, $user_check_query);
  


      if (mysqli_num_rows($result) > 0) {
        echo "<table><tr><th>ID</th><th>location</th><th>status</th></tr>";
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["location"]."</td><td>" . $row["id"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    ?>
</div>
<div class="clearfix"></div>
<?php include("footer.php"); ?>


  </body>
</html>
