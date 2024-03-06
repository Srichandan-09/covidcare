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
    <title>Login In</title>
</head>

<body>
    <div class="navbar">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="hlogin.php">Hospital Details</a></li>
        <div class="dropdown-menu">
          <button class="admin-btn">Sign IN</button>
          <div class="menu-content">
            <a class="links-hidden" href="adminlogin.php">admin</a>
            <a class="links-hidden" href="hospitallogin.php">hospital</a>
            <a class="links-hidden" href="userlogin.php">user</a>
          </div>
        </div>
        <li><a href="login.php">Bed Booking slot-Book Now</a></li>
        <li class="name"><a href="#phone"><i>Call us now +91 8496817445</i></a></li>
      </ul>
    </div>
    <div class="alert">
        <span class="close" onclick="this.parentElement.style.display='none';">&times;</span> 
         You should Login to <strong>Access Hospital Details!</strong>
    </div>
    <div class="adminlogin">
    <h1>Login</h1>
    </div>
    <div>
    <form class="aaa" method="POST">
    <div class="login">
        <label>SRF ID: </label>
        <input type="text" placeholder="Enter srf ID" name="srfid" required>  
        <label>Password: </label>  
        <input type="password" placeholder="Enter Password" name="password" required>  
        <button class="submit" type="submit" name="signin">Sign In</button>
        <div class="signup">Not yet registered?.
            <a href="usersignup.php"> click here</a> to register
        </div>
    </div>
    </form>
  <?php
  if(isset($_POST['signin']))
  { 
    $srfid=$_POST['srfid'];
    $password=$_POST['password'];
    $query="SELECT * FROM `user_signup` WHERE `srfid`='$srfid' AND `password`='$password';";
    $result=$conn->query($query);
    if($result->num_rows > 0)
    {   
      echo "<script>alert('Logged in Successfully');</script>";
      session_start();
      $_SESSION['srfid']=$_POST['srfid'];
      header("location: bookslot.php");
    }
    else{
          echo"<script>alert('Invalid Credentials');</script>";
    }
  }
  $conn->close();
?>
   
</body>
</html>