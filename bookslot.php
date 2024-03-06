<?php 
session_start();
if(!isset($_SESSION['srfid']))
{
    header("location: userlogin.php");
}
?>
<?php
  require("connectdb.php");
?>

<?php 
    if(isset($_POST['logout']))
    { 
      session_destroy();
      header("location: userlogin.php");
    }
?>

<?php
    $quer="SELECT * FROM `hospital_data`;";
    $result=$conn->query($quer);
?>

<?php
$srfid=$_SESSION['srfid'];
$que="SELECT * FROM `user_signup` WHERE `srfid`='$srfid'; ";
$resul=$conn->query($que);
if($resul->num_rows > 0){
  while($row = $resul->fetch_assoc()){
    $email=$row['email'];
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
    <title>User Page</title>
</head>
<body>
<div class="navbar">
      <ul>
        <li><a href="userhome.php">Home</a></li>
        <li><a href="patientdetails.php">Patient Details</a></li>
        <li><a href="patientoperations.php">Operations</a></li>
        <li><a href="hospitalslist.php">Hospital Information</a><li> 
        <li><a class=active href="bookslot.php">Bed Booking slot-Book Now</a></li>
        <div class="dropdown-menu">
          <button class="btn">Welcome "<?php echo $_SESSION['srfid']; ?>" ! </button>
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
        header("location: userlogin.php");
    }
  ?>

  <div class="bookslot">
    <div class="patientdetails">
        <div class="patientorder">
          <div class="patientata">
            <h3>Hospital Details</h3>
          </div>
        </div>
        <?php
        if($result->num_rows > 0){
      ?>
        <table class="table"> 
          <tr class="heading">
            <th>Hospital Code</th>
            <th>Hospital Name</th>
            <th>Hospital Address</th>
            <th>Normal Bed</th>
            <th>ICU Bed</th>
            <th>Ventillator Bed</th>
          </tr>

      <?php
        while($rows=$result->fetch_assoc())
        {
      ?>
          <tr>
            <td><?php echo $rows['hospital_code']; ?></td>
            <td><?php echo $rows['hospital_name']; ?></td>
            <td><?php echo $rows['hospital_address']; ?></td>
            <td><?php echo $rows['normal_bed']; ?></td>
            <td><?php echo $rows['icu_bed']; ?></td>
            <td><?php echo $rows['vent_bed']; ?></td>
          </tr>
      <?php
        }
      }
      else{
      ?>
      <h4 class="h4">No Data Available</h4>
      <?php
      }
      ?>
      
        </table>
      </div>
    <div class="bookslotform">
      <div class="patientdetail">
        <h1>Book Slot</h1>
      </div>
      <form class="ccc" method="POST">
        <div class="login">
          <label>SRF Id: </label>
          <div class="default">
            <input type="text" placeholder="<?php echo $_SESSION['srfid']; ?>" name="srfid" disabled> 
          </div> 
          <label>Email Address: </label>  
          <div class="default">
            <input type="email" placeholder="<?php echo $email; ?>" name="email" disabled>  
          </div> 
          <label>Hospital Code: </label>
          <input type="text" placeholder="Enter Hospital Code" name="hospital_code" required>  
          <label>Patient Name: </label>
          <input type="text" placeholder="Enter Patient Name" name="patient_name" required>
          <label>Patient Address: </label>
          <input type="text" placeholder="Enter Patient Address" name="patient_address" required>  
          <label>Phone: </label>      
          <input type="text" placeholder="Enter Phone Number" name="phone"  required>
          <label>Oxygen Level: </label>        
          <input type="number" placeholder="Enter Oxygen Level" name="oxygen_level" min="70" max='100' required> 
          <label>Choose Bed Type: </label>
          <select name = "bed_type">
            <option value = "normal_bed" selected>Normal Bed</option>
            <option value = "icu_bed">ICU Bed</option>
            <option value = "vent_bed">Ventillator Bed</option>
         </select>
        <button class="submit" type="submit" name="addhospital">Bookslot</button>
    </div>
    </div>
  </div>
  <?php
  if(isset($_POST['addhospital']))
  { 
    $patient_name=$_POST['patient_name'];
    $patient_address=$_POST['patient_address'];
    $phone=$_POST['phone'];
    $hospital_code=$_POST['hospital_code'];
    $oxygen_level=$_POST['oxygen_level'];
    $bed_type=$_POST['bed_type'];
    $query="INSERT INTO `patientdata`(`srfid`, `hospital_code`, `patient_name`, `patient_address`, `phone`, `oxygen_level`, `bed_type`) VALUES ('$srfid','$hospital_code','$patient_name','$patient_address','$phone','$oxygen_level','$bed_type');";
    if($bed_type=="normal_bed"){
      $queryy="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospital_code' AND `normal_bed` > 0 ;";
      $update="UPDATE `hospital_data` SET `normal_bed`=normal_bed-1 WHERE  `hospital_code`='$hospital_code';";
    }
    elseif($bed_type=="icu_bed"){
      $queryy="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospital_code' AND `icu_bed` > 0 ;";
      $update="UPDATE `hospital_data` SET `icu_bed`=icu_bed-1 WHERE  `hospital_code`='$hospital_code';";
    }
    else{
      $queryy="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospital_code' AND `vent_bed` > 0 ;";
      $update="UPDATE `hospital_data` SET `vent_bed`=vent_bed-1 WHERE  `hospital_code`='$hospital_code';";
    }
      
    $sql="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospital_code' ;";
    $sqlresult=$conn->query($sql);
    $res=$conn->query($queryy);
    if($res->num_rows > 0){

      $que="SELECT * FROM `patientdata` WHERE `srfid`='$srfid';";
      $re=$conn->query($que);
      if($re->num_rows > 0){
        echo"<script>alert('Bed already reserved for the given SRF ID.You can edit it in the Patient Details field.');</script>";
      }
      else{
        if($conn->query($query)==true){
          $quer="INSERT INTO `patient_operations`(`srfid`, `hospital_code`, `patient_name`, `patient_address`, `phone`, `oxygen_level`, `bed_type`, `query`) VALUES ('$srfid', '$hospital_code', '$patient_name', '$patient_address', '$phone', '$oxygen_level', '$bed_type', 'BOOKED') ;";
          if($con->query($quer)==true){
            echo"<script>alert('Bed booked successfully.');</script>";
          }
          $conn->query($update);
        } 
      }
    }
    else{
      if($sqlresult->num_rows == 0){
        echo"<script>alert('Invalid Hospital Code.');</script>";
      }
      else{
        echo"<script>alert('Bed is not available.');</script>";
      }
  }
  }
  $conn->close();
?>
 
</body>
</html>