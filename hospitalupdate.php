<?php
  require("connectdb.php");
?>

<?php 
session_start();
if(!isset($_SESSION['hospital_id']))
{
    header("location: hospitallogin.php");
}
?>

<?php
$hospitalid=$_SESSION['hospital_id'];
$query="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospitalid' ; ";
$result=$conn->query($query);
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $hospital_name=$row['hospital_name'];
    $hospital_address=$row['hospital_address'];
    $normal_bed=$row['normal_bed'];
    $icu_bed=$row['icu_bed'];
    $vent_bed=$row['vent_bed'];
  }
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
        <li><a href="hospitalhome.php">Home</a></li>
        <li><a href="hospatientdetails.php">Patient Details</a></li>
        <li><a href="hospitaldetails.php">Hospital Details </a></li>
        <li><a href="hospitaloperations.php">Hospital Operations</a></li>
        <div class="dropdown-menu">
        
          <button class="admin-btn">Welcome <bold><?php echo $_SESSION['hospital_id']; ?></bold></button>
       
          <div class="menu-content">
          <form method="post">
            <button class="links" name="logout">Log Out</button>
          </form>
          </div>
        </div>
        <li class="name"><a href="#phone"><i>Call us now +91 8496817445</i></a></li>
      </ul>
    </div>  
  <?php 
        if(isset($_POST['logout']))
        { 
          session_destroy();
        header("location: hospitallogin.php");
    }
    ?>
  <div class="adminlogin">
    <h1>Update hospital data </h1>
    </div>
    <div>
    <form class="aaa" method="POST">
    <div class="login">
        <label>Hospital Code: </label>
        <div class="default">
        <input type="text"  name="hospital_code" value="<?php echo $_SESSION['hospital_id']; ?>" disabled> 
        </div>
        <label>Hospital Name: </label>
        <input type="text" placeholder="Enter Hospital Name" name="hospital_name" value="<?php echo $hospital_name ?>" required>
        <label>Hospital Address: </label>
        <input type="text" placeholder="Enter Hospital address" name="hospital_address" value="<?php echo $hospital_address ?>" required>  
        <label>Normal Beds: </label>      
        <input type="number" placeholder="Enter Available Normal Beds" name="noraml_bed" min="0" value="<?php echo $normal_bed ?>"  required>
        <label>ICU Beds: </label>        
        <input type="number" placeholder="Enter Available ICU Beds" name="icu_bed" min="0" value="<?php echo $icu_bed ?>" required> 
        <label>Ventillator beds: </label>       
        <input type="number" placeholder="Enter Available Ventillator Beds" name="vent_bed" min="0" value="<?php echo $vent_bed ?>" required>
        <button class="submit" type="submit" name="addhospital">Submit</button>
    </div>
  </div>
  <?php
  if(isset($_POST['addhospital']))
  { 
    $hospital_nam=$_POST['hospital_name'];
    $hospital_addres=$_POST['hospital_address'];
    $noraml_be=$_POST['noraml_bed'];
    $icu_be=$_POST['icu_bed'];
    $vent_be=$_POST['vent_bed'];
    $quer="UPDATE `hospital_data` SET `hospital_name`='$hospital_nam',`hospital_address`='$hospital_addres',`normal_bed`='$noraml_be',`icu_bed`='$icu_be',`vent_bed`='$vent_be' WHERE `hospital_code`='$hospitalid' ;";
    if($hospital_name==$hospital_nam and $hospital_address==$hospital_addres and $normal_bed==$noraml_be and $icu_bed==$icu_be and $vent_bed==$vent_be){
      echo"<script>alert('Same Data already Exists with the given Hospital Code.');</script>";
    }
    elseif($conn->query($quer)==true){
        $queryy="INSERT INTO `hospital_operations`(`hospital_code`, `hospital_name`, `hospital_address`, `normal_bed`, `icu_bed`, `vent_bed`, `query`) VALUES ('$hospitalid', '$hospital_nam', '$hospital_addres', '$noraml_be', '$icu_be', '$vent_be', 'UPDATED') ;";
        if($conn->query($queryy)==true){
          $_SESSION['hospital_id'];
          header("location: hospitaldetails.php");
        }
    }
    }
    $conn->close();
    ?>
</body>
</html>