<!DOCTYPE html>
<html lang="en">
<head>
    <link rel = "icon" href = "1.png" type = "image/x-icon">
    <link rel="stylesheet" href="style1.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
 
    <div class="navbar">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="hlogin.php">Hospital Details</a></li>
        <div class="dropdown-menu">
        <div class="active">
          <button class="admin-btn">Sign IN</button>
      </div>
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
    <h1>Admin login</h1>
    </div>
    <div>
    <form class="aaa" method="POST">
    <div class="login">
        <label>User Name: </label>
        <input type="text" placeholder="Enter Username" name="username" required>  
        <label>Password: </label>  
        <input type="password" placeholder="Enter Password" name="pass" required>  
        <button class="submit" type="submit" name="signin">Sign In</button>
    </div>
    </form>

    <?php
      if(isset($_POST['signin']))
      { 
        $admin_name="covidcare";
        $admin_password="123";
        $username=$_POST['username'];
        $pass=$_POST['pass'];
        
        if($admin_name==$username and $admin_password==$pass)
        {
          session_start();
          $_SESSION['adminloginid']=$_POST['username'];
          header("location: adminpage.php");
        }
        else{
         echo"<script>alert('Incorrect Password');</script>";
        }
      }

    ?>
</body>
</html>