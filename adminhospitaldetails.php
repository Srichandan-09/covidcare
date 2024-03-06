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

<?php
    $query="SELECT `hospital_code` , `email_address` FROM `addhospital` ;";
    $result=$conn->query($query);
    $conn->close();
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
        <li><a class="active" href="adminhospitaldetails.php">Hospital Details</a></li>
        <li><a href="adminpage.php">Add Hospital</a></li>
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

<table class="adminhos">
    <tr class="heading">
        <th>Email Address</th>
        <th>Hospital Code</th>
    </tr>
      <?php
        if($result->num_rows > 0){

        while($rows=$result->fetch_assoc())
        {
      ?>
      
      <tr>
        <td><?php echo $rows['email_address']; ?></td>
        <td><?php echo $rows['hospital_code']; ?></td> 
      </tr>
      <?php
        }
      }
      ?>
    </table>
    <?php 
    if(isset($_POST['logout']))
    { 
      session_destroy();
      header("location: adminlogin.php");
    }
?>

</body>
</html>