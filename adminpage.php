<?php
  require("connectdb.php");
?>

<?php 
session_start();
if(!isset($_SESSION['adminloginid']))
{
    header("location: adminlogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel = "icon" href = "1.png" type = "image/x-icon">
    <link rel="stylesheet" href="style1.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
<div class="navbar">
      <ul>
        <li><a href="adminhome.php">Home</a></li>
        <li><a href="adminhospitaldetails.php">Hospital Details</a></li>
        <li><a class="active" href="adminpage.php">Add Hospital Details</a></li>
        <div class="dropdown-menu">
          <button class="btn" name="btn" >Welcome "<?php echo $_SESSION['adminloginid']; ?>"</button>
          <div class="menu-content">
          <form method="post">
            <button class="links" name="logout">Log Out</button>
          </form>
          </div>
        </div>
        <li class="name"><a href="#phone"><i>Call us now +91 8496817445</i></a></li>
      </ul>
</div>  
<div>
<div class="adminlogin">
    <h1>Add New Hospital</h1>
    </div>
    <div>
    <form class="aaa" method="POST">
    <div class="login">
    <label>Email Address: </label>
    <input type="email" placeholder="Enter Email Address" name="email_address" required>
    <label>Hospital Code: </label>
    <input type="text" placeholder="Enter Username" name="hospital_code" required>  
    <label>Password: </label>  
    <input type="password" placeholder="Enter Password" name="hospital_password" required>  
    <button class="submit" type="submit" name="addhospital">Submit</button>
    </div>
    </form>

<?php 
    if(isset($_POST['logout']))
    { 
      session_destroy();
      header("location: adminlogin.php");
    }
?>

<?php
  if(isset($_POST['addhospital']))
  { 
    $email_address=$_POST['email_address'];
    $hospital_code=$_POST['hospital_code'];
    $hospital_password=$_POST['hospital_password'];

    $quer="SELECT * FROM `addhospital` WHERE `hospital_code`='$hospital_code' OR `email_address`='$email_address';";
    $result=$conn->query($quer);
    if($result->num_rows > 0){
      echo"<script>alert('User already Exists');</script>";
    }
    else{
      $query="INSERT INTO `addhospital` (`email_address`, `hospital_code`, `hospital_password`) VALUES ('$email_address', '$hospital_code', '$hospital_password');";
      if($conn->query($query)==true){
        echo"<script>alert('Data successfully submitted');</script>";
      }
    }
  }
?>

<?php 
$conn->close();
?>

</body>
</html>