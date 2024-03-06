<?php
  require("connectdb.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel = "icon" href = "1.png" type = "image/x-icon">
    <link rel="stylesheet" href="style1.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hospital Login</title>
</head>
<body>
 
    <div class="navbar">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="hlogin.php">Hospital Details</Details></a></li>
        <div class="dropdown-menu">
          <button class="admin-btn">Sign IN</button>
          <div class="menu-content">
            <a class="links-hidden" href="adminlogin.php">admin</a>
            <a class="links-hidden" href="hospitallogin.php">hospital</a>
            <a class="links-hidden" href="userlogin.php">user</a>
          </div>
        </div>
        <li class="name"><a href="#phone"><i>Call us now +91 8496817445</i></a></li>
      </ul>
    </div>
    <div class="adminlogin">
    <h1>Hospital Login</h1>
    </div>
    <div>
    <form class="aaa" method="POST">
    <div class="login">
        <label>Hospital CODE: </label>
        <input type="text" placeholder="Enter Hospital CODE" name="hospital_code" required>  
        <label>Password: </label>  
        <input type="password" placeholder="Enter Password" name="hospital_password" required>  
        <button class="submit" type="submit" name="signin">Sign In</button>
    </div>
    </form>
  <?php
  if(isset($_POST['signin']))
  { 
    $hospital_code=$_POST['hospital_code'];
    $hospital_password=$_POST['hospital_password'];
    $query="SELECT * FROM `addhospital` WHERE `hospital_code`='$hospital_code' AND `hospital_password`='$hospital_password';";
    $result=$conn->query($query);
    if($result->num_rows > 0)
    {   
      echo "<script>alert('Logged in Successfully');</script>";

      session_start();
      $_SESSION['hospital_id']=$_POST['hospital_code'];
      header("location: hospitalpage.php");
    }
    else{
          echo"<script>alert('Invalid Credentials');</script>";
    }
  }
  $conn->close();
?>
   
</body>
</html>