<?php 
session_start();
if(!isset($_SESSION['adminloginid']))
{
    header("location: adminlogin.php");
}
?>
<?php 
    if(isset($_POST['logout']))
    { 
      session_destroy();
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
    <title>Admin Home</title>
</head>
<body class="admin">
<div class="navbar">
      <ul>
        <li><a  class=active href="adminhome.php">Home</a></li>
        <li><a href="adminhospitaldetails.php">Hospital Details</a></li>
        <li><a href="adminpage.php">Add Hospital Details</a></li>
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
    <div class="msg">
        <h1>Covid Centre</h1>
        <p>Karnataka Bed Booking System</p>
      </div>
</body>
</html>