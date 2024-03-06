<?php 
session_start();
if(!isset($_SESSION['hospital_id']))
{
    header("location: hospitallogin.php");
}
?>
<?php 
    if(isset($_POST['logout']))
    { 
      session_destroy();
      header("location: hospitallogin.php");
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
<body>
<div class="navbar">
      <ul>
        <li><a  class=active href="hospitalhome.php">Home</a></li>
        <li><a href="hospatientdetails.php">Patient Details</a></li>
        <li><a href="hospitaldetails.php">Hospital Details</a></li>
        <li><a href="hospitalpage.php">Insert Hospital Data</a></li>
        <div class="dropdown-menu">
          <button class="btn" name="btn" >Welcome "<?php echo $_SESSION['hospital_id']; ?>"</button>
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