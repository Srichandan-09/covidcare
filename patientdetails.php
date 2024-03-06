<?php
  session_start();
  $srfid=$_SESSION['srfid'];
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
    $query="SELECT * FROM `patientdata` WHERE `srfid`='$srfid' ;";
    $result=$conn->query($query);
    $conn->close();
?>

<?php
  if(isset($_POST['update']))
  { 
    if($result->num_rows == 0){
      $_SESSION['srfid'];
      header("location: bookslot.php");
    }
    else{
      $_SESSION['srfid'];
      header("location: patientupdate.php");
    }
  }
?>

<?php
  if(isset($_POST['delete']))
  { 
    $que="SELECT * FROM `patientdata` WHERE `srfid`='$srfid';";
    $quer="DELETE  FROM `patientdata` WHERE `srfid`='$srfid';";
    $resul=$con->query($que);
    if($resul->num_rows > 0){
      while($row=$resul->fetch_assoc())
      {
        $hospital_cod=$row['hospital_code'];
        $patient_nam=$row['patient_name'];
        $patient_addres=$row['patient_address'];
        $phon=$row['phone'];
        $oxygen_leve=$row['oxygen_level'];
        $bed_typ=$row['bed_type'];
      }
      if($bed_typ=="normal_bed"){
        $update="UPDATE `hospital_data` SET `normal_bed`=normal_bed+1 WHERE  `hospital_code`='$hospital_cod';";
      }
      elseif($bed_typ=="icu_bed"){
        $update="UPDATE `hospital_data` SET `icu_bed`=icu_bed+1 WHERE  `hospital_code`='$hospital_cod';";
      }
      else{
        $update="UPDATE `hospital_data` SET `vent_bed`=vent_bed+1 WHERE  `hospital_code`='$hospital_cod';";
      }
    if($con->query($quer)==true){
      $con->query($update);
      $queryy="INSERT INTO `patient_operations`(`srfid`, `hospital_code`, `patient_name`, `patient_address`, `phone`, `oxygen_level`, `bed_type`, `query`) VALUES ('$srfid', '$hospital_cod', '$patient_nam', '$patient_addres', '$phon', '$oxygen_leve', '$bed_typ', 'DELETED') ;";
      if($con->query($queryy)==true){
        echo"<script>alert('Data deleted successfully.');</script>";
      }
    }
  }
    $con->close();
    $_SESSION['srfid'];
    header("location: patientdetails.php");
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
    <title>Hospital Operations</title>
</head>
<body>
<div class="navbar">
      <ul>
        <li><a href="userhome.php">Home</a></li>
        <li><a class=active href="patientdetails.php">Patient Details</a></li>
        <li><a  href="patientoperations.php">Operations</a></li>
        <li><a href="hospitalslist.php">Hospital Information</a><li>
        <li><a href="bookslot.php">Bed Booking slot-Book Now</a></li>
        <div class="dropdown-menu">
          <button class="btn" name="btn" >Welcome "<?php echo $_SESSION['srfid']; ?>"</button>
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

  <div>
    <div class="databorder">
    <div class="data">
    <h1>Patient Details</h1>
    </div>
    </div>
    <table>
    <?php
        if($result->num_rows > 0){

        while($rows=$result->fetch_assoc())
        {
      ?>
    <tr class="heading">
        <th>SRF ID</th>
        <th>Hospital Code</th>
        <th>Patient Name</th>
        <th>Patient Address</th>
        <th>Phone Number</th>
        <th>Oxygen Level</th>
        <th>Bed type</th>
    </tr>
      
      <tr>
        <td><?php echo $rows['srfid']; ?></td>
        <td><?php echo $rows['hospital_code']; ?></td>
        <td><?php echo $rows['patient_name']; ?></td>
        <td><?php echo $rows['patient_address']; ?></td>
        <td><?php echo $rows['phone']; ?></td>
        <td><?php echo $rows['oxygen_level']; ?></td>
        <td><?php echo $rows['bed_type']; ?></td>
      </tr>
      <?php
        }
      }
      else{
      ?>
      <h3 class="h3">No Data Available</h3>
      <?php
      }
      ?>
    </table>
  </div>
  <div>
      <form class="updatedelete" method="post">
      <button class="update" name="update">Update</button>
      <button class="delete" name="delete">Delete</button>
      </form>
    </div> 
</body>
</html>