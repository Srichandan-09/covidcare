<?php
  require("connectdb.php");
?>

<?php 
session_start();
if(!isset($_SESSION['srfid']))
{
    header("location: userlogin.php");
}
?>

<?php
$srfid=$_SESSION['srfid'];
$query="SELECT * FROM `patientdata` WHERE `srfid`='$srfid' ; ";
$result=$conn->query($query);
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $hospital_cod=$row['hospital_code'];
    $patient_nam=$row['patient_name'];
    $patient_addres=$row['patient_address'];
    $phon=$row['phone'];
    $oxygen_leve=$row['oxygen_level'];
    $bed_typ=$row['bed_type'];
  }
}
?>

<?php
  if(isset($_POST['updatepatient']))
  { 
    $hospital_code=$_POST['hospital_code'];
    $patient_name=$_POST['patient_name'];
    $patient_address=$_POST['patient_address'];
    $phone=$_POST['phone'];
    $oxygen_level=$_POST['oxygen_level'];
    $bed_type=$_POST['bed_type'];
    
    $quer="UPDATE `patientdata` SET `hospital_code`='$hospital_code',`patient_name`='$patient_name',`patient_address`='$patient_address',`phone`='$phone',`oxygen_level`='$oxygen_level',`bed_type`='$bed_type' WHERE `srfid`='$srfid';";
    $sql="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospital_code';";
    $sqlresult=$conn->query($sql);
    if($bed_type=="normal_bed"){
      while($rows = $sqlresult->fetch_assoc()){
        $beds=$rows['normal_bed'];
      }
    }
    if($bed_type=="icu_bed"){
      while($rows = $sqlresult->fetch_assoc()){
        $beds=$rows['icu_bed'];
      }
    }
    if($bed_type=="vent_bed"){
      while($rows = $sqlresult->fetch_assoc()){
        $beds=$rows['vent_bed'];
      }
    }

if($hospital_code==$hospital_cod and $patient_name==$patient_nam and $patient_address==$patient_addres and $phone==$phon and $oxygen_level==$oxygen_leve and $bed_type==$bed_typ){
        echo"<script>alert('Same Data already Exists with the given srfid.');</script>";
}
else{
    if($hospital_code==$hospital_cod and $bed_typ==$bed_type){
        if($conn->query($quer)==true){
          $queryy="INSERT INTO `patient_operations`(`srfid`, `hospital_code`, `patient_name`, `patient_address`, `phone`, `oxygen_level`, `bed_type`, `query`) VALUES ('$srfid', '$hospital_code', '$patient_name', '$patient_address', '$phone', '$oxygen_level', '$bed_type', 'UPDATED') ;";
          if($conn->query($queryy)==true){
            echo"<script>alert('Data successfully updated.');</script>";
          }
        }
      }
  else{
        if($beds > 0){
          if($bed_typ=="normal_bed"){
            $edit="UPDATE `hospital_data` SET `normal_bed`=normal_bed+1 WHERE  `hospital_code`='$hospital_cod';";
          }
          elseif($bed_typ=="icu_bed"){
            $edit="UPDATE `hospital_data` SET `icu_bed`=icu_bed+1 WHERE  `hospital_code`='$hospital_cod';";
          }
          else{
            $edit="UPDATE `hospital_data` SET `vent_bed`=vent_bed+1 WHERE  `hospital_code`='$hospital_cod';";
          }

          if($bed_type=="normal_bed"){
            $update="UPDATE `hospital_data` SET `normal_bed`=normal_bed-1 WHERE  `hospital_code`='$hospital_code';";
          }
          elseif($bed_type=="icu_bed"){
            $update="UPDATE `hospital_data` SET `icu_bed`=icu_bed-1 WHERE  `hospital_code`='$hospital_code';";
          }
          else{
            $update="UPDATE `hospital_data` SET `vent_bed`=vent_bed-1 WHERE  `hospital_code`='$hospital_code';";
          }
          if($conn->query($quer)==true){
              $conn->query($update);
              $conn->query($edit);
              $queryy="INSERT INTO `patient_operations`(`srfid`, `hospital_code`, `patient_name`, `patient_address`, `phone`, `oxygen_level`, `bed_type`, `query`) VALUES ('$srfid', '$hospital_code', '$patient_name', '$patient_address', '$phone', '$oxygen_level', '$bed_type', 'UPDATED') ;";
              if($conn->query($queryy)==true){
                echo"<script>alert('Data successfully updated.');</script>";
              }
          }
        }
        else{
            echo"<script>alert('No Beds Available.');</script>";
        }
    }
  }
}
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
    <title>Patient update</title>
</head>
<body>
<div class="navbar">
      <ul>
        <li><a href="userhome.php">Home</a></li>
        <li><a href="patientdetails.php">PatientDetails</a></li>
        <li><a href="patientoperations.php">Operations</a></li>
        <li><a href="hospitalslist.php">Hospital Information</a><li>
        <li><a href="bookslot.php">Bed Booking slot-Book Now</a></li>
        <div class="dropdown-menu">
          <button class="btn">Welcome <bold><?php echo $_SESSION['srfid']; ?></bold> !</button>
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
  <div class="adminlogin">
    <h1>Edit patient Details</h1>
    </div>
    <div>
    <form class="aaa" method="POST">
    <div class="login">
        <label>SRFID: </label>
        <div class="default">
        <input type="text"  name="srfid" value="<?php echo $_SESSION['srfid']; ?>" disabled> 
        </div>
        <label>Hospital Code: </label>
        <input type="text"  name="hospital_code" value="<?php echo $hospital_cod; ?>" required> 
        <label>Patients Name: </label>
        <input type="text" placeholder="Enter Patient Name" name="patient_name" value="<?php echo $patient_nam ?>" required>
        <label>Patient Address: </label>
        <input type="text" placeholder="Enter Patient address" name="patient_address" value="<?php echo $patient_addres ?>" required>  
        <label>Phone Number: </label>      
        <input type="text" placeholder="Enter Phone Number" name="phone"  value="<?php echo $phon ?>"  required>
        <label>Oxygen Level: </label>        
        <input type="number" placeholder="Enter Oxygen Level" name="oxygen_level" min="70" max="100" value="<?php echo $oxygen_leve ?>" required> 
        <label>Choose Bed Type: </label>       
        <select name = "bed_type">
          <?php
            if($bed_typ=="normal_bed")
            {
          ?>
            <option value = "normal_bed" selected>Normal Bed</option>
            <option value = "icu_bed">ICU Bed</option>
            <option value = "vent_bed">Ventillator Bed</option>
          <?php
            }
            elseif($bed_typ=="icu_bed")
            {
          ?>
            <option value = "normal_bed">Normal Bed</option>
            <option value = "icu_bed" selected>ICU Bed</option>
            <option value = "vent_bed">Ventillator Bed</option>
          <?php
            }
            else
            {
          ?>
            <option value = "normal_bed">Normal Bed</option>
            <option value = "icu_bed">ICU Bed</option>
            <option value = "vent_bed" selected>Ventillator Bed</option>
          <?php
            }
          ?>
         </select>
        <button class="submit" type="submit" name="updatepatient">Submit</button>
    </div>
  </div>
 
</body>
</html>