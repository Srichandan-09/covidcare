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
    <title>Sign Up</title>
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
    <div class="adminlogin">
    <h1>Sign Up</h1>
    </div>
    <div>
    <form class="aaa" method="POST">
    <div class="login">
        <label>SRF ID: </label>
        <input type="text" placeholder="Enter SRF ID" name="srfid" required>  
        <label>Email Address: </label>
        <input type="email" placeholder="Enter Email Address" name="email" required>
        <label>Password: </label>  
        <input type="password" placeholder="Create Password" name="password" required>  
        <button class="submit" type="submit" name="signin">Sign Up</button>
        <div class="signup">Already a user?.
            <a href="userlogin.php"> click here</a> to login
        </div>
    </div>
</form>

<?php
  if(isset($_POST['signin']))
  { 
    $srfid=$_POST['srfid'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query="INSERT INTO `user_signup`(`email`, `srfid`, `password`) VALUES ('$email','$srfid','$password');";

    $quer="SELECT * FROM `user_signup` WHERE `srfid`='$srfid' OR `email`='$email';";
    $resul=$conn->query($quer);
    if($resul->num_rows > 0){
      echo"<script>alert('User already Exists');</script>";
    }
    else{
      if( $conn->query($query)==true)
      {   
        echo "<script>alert('successfully registered');</script>";
        session_start();
        $_SESSION['srfid']=$_POST['srfid'];
        header("location: bookslot.php");
      }
    }
  }
  $conn->close();
?>
   
</body>
</html>