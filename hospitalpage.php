<?php 
session_start();
if(!isset($_SESSION['hospital_id']))
{
    header("location: adminlogin.php");
}
$hospitalid=$_SESSION['hospital_id'];
?>
<?php
  require("connectdb.php");
?>

<?php
$hospitalid=$_SESSION['hospital_id'];
$query="SELECT `email_address` FROM `addhospital` WHERE `hospital_code`='$hospitalid' ; ";
$result=$conn->query($query);
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $email=$row['email_address'];
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
        <li><a href="hospitaldetails.php">Hospital Details</a></li>
        <li><a href="hospitaloperations.php">Hospital Operations</a></li>
        <li><a class="active" href="hospitalpage.php">Insert Hospital Data</a></li>
        
        <div class="dropdown-menu">
        
          <button class="btn">Welcome "<bold><?php echo $_SESSION['hospital_id']; ?> !"</bold></button>
       
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
    <h1>Insert hospital data </h1>
    </div>
    <div>
    <form class="aaa" method="POST">
    <div class="login">
        <label>Hospital Code: </label>
        <div class="default">
        <input type="text" placeholder="<?php echo $_SESSION['hospital_id']; ?>" name="hospital_code" disabled> 
        </div> 
        <label>Email Address: </label>  
        <div class="default">
        <input type="email" placeholder="<?php echo $email; ?>" name="email_address" disabled>  
        </div> 
        <label>Hospital Name: </label>
        <input type="text" placeholder="Enter Hospital Name" name="hospital_name" required>
        <label>Hospital Address: </label>
        <input type="text" placeholder="Enter Hospital address" name="hospital_address" required>  
        <label>Normal Beds: </label>      
        <input type="number" placeholder="Enter Available Normal Beds" name="noraml_bed" min="0"  required>
        <label>ICU Beds: </label>        
        <input type="number" placeholder="Enter Available ICU Beds" name="icu_bed" min="0" required> 
        <label>Ventillator beds: </label>       
        <input type="number" placeholder="Enter Available Ventillator Beds" name="vent_bed" min="0" required>
        <button class="submit" type="submit" name="addhospital">Submit</button>
    </div>
  </div>
  <?php
  if(isset($_POST['addhospital']))
  { 
    $hospital_name=$_POST['hospital_name'];
    $hospital_address=$_POST['hospital_address'];
    $noraml_bed=$_POST['noraml_bed'];
    $icu_bed=$_POST['icu_bed'];
    $vent_bed=$_POST['vent_bed'];
    $query="INSERT INTO `hospital_data` (`hospital_code`, `hospital_name`, `hospital_address`, `normal_bed`, `icu_bed`, `vent_bed`) VALUES ('$hospitalid', '$hospital_name', '$hospital_address', '$noraml_bed', '$icu_bed', '$vent_bed' );";
    
    $que="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospitalid';";
    $re=$conn->query($que);
    if($re->num_rows > 0){
      echo"<script>alert('Data already Exists with the given Hospital Code. You can edit it in the Hospital Details field.');</script>";
    }
    else{
      if($conn->query($query)==true){
        $quer="INSERT INTO `hospital_operations`(`hospital_code`, `hospital_name`, `hospital_address`, `normal_bed`, `icu_bed`, `vent_bed`, `query`) VALUES ('$hospitalid', '$hospital_name', '$hospital_address', '$noraml_bed', '$icu_bed', '$vent_bed', 'INSERTED') ;";
        if($con->query($quer)==true){
          echo"<script>alert('Data successfully submitted.');</script>";
          $con->close();
        }
      }

    }
  }
  $conn->close();
?>
  <?php
    if(isset($_POST['details']))
    {
      $_SESSION['hospital_id']=$hospitalid;
      header("location: hospitaldetails.php");
    }
  ?>

</body>
</html>