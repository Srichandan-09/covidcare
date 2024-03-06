<?php
  session_start();
  $hospitalid=$_SESSION['hospital_id'];
?>

<?php
  require("connectdb.php");
?>

<?php
  $query="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospitalid';";
  $result=$conn->query($query);
?>

 <?php 
    if(isset($_POST['logout']))
    { 
      session_destroy();
      header("location: hospitallogin.php");
    }
?>

<?php
  if(isset($_POST['update']))
  { 
    if($result->num_rows == 0){
      $_SESSION['hospital_id'];
      header("location: hospitalpage.php");
    }
    else{
    $_SESSION['hospital_id'];
    header("location: hospitalupdate.php");
    }
  }
?>

<?php
  if(isset($_POST['delete']))
  { 
    $que="SELECT * FROM `hospital_data` WHERE `hospital_code`='$hospitalid';";
    $quer="DELETE  FROM `hospital_data` WHERE `hospital_code`='$hospitalid';";
    $resul=$con->query($que);
    if($resul->num_rows > 0){
      while($row=$resul->fetch_assoc())
      {
        $hospital_nam=$row['hospital_name'];
        $hospital_addres=$row['hospital_address'];
        $noraml_be=$row['normal_bed'];
        $icu_be=$row['icu_bed'];
        $vent_be=$row['vent_bed'];
      }
    if($con->query($quer)==true){
      $queryy="INSERT INTO `hospital_operations`(`hospital_code`, `hospital_name`, `hospital_address`, `normal_bed`, `icu_bed`, `vent_bed`, `query`) VALUES ('$hospitalid', '$hospital_nam', '$hospital_addres', '$noraml_be', '$icu_be', '$vent_be', 'DELETED') ;";
      if($con->query($queryy)==true){
        echo"<script>alert('Data deleted successfully.');</script>";
      }
    }
  }
    $con->close();
    $_SESSION['hospital_id'];
    header("location: hospitaldetails.php");
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
    <title>Hospital Details</title>
</head>
<body>
<div class="navbar">
      <ul>
        <li><a href="hospitalhome.php">Home</a></li>
        <li><a href="hospatientdetails.php">Patient Details</a></li>
        <li><a class="active" href="hospitaldetails.php">Hospital Details</a></li>
        <li><a href="hospitaloperations.php">Hospital Operations</a></li>
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
  <div>

  <div>
    <div class="databorder">
    <div class="data">
    <h1>Hospital Data</h1>
    </div>
    </div>
    <table>
      <?php
        while($rows=$result->fetch_assoc())
        {
      ?>
      <tr>
        <th>Hospital Code</th>
        <td><?php echo $rows['hospital_code']; ?></td>
      </tr>
      <tr>
        <th>Hospital Name</th>
        <td><?php echo $rows['hospital_name']; ?></td>
      </tr>
      <tr>
        <th>Hospital Address</th>
        <td><?php echo $rows['hospital_address']; ?></td>
      </tr>
      <tr>
        <th>Normal Bed</th>
        <td><?php echo $rows['normal_bed']; ?></td>
      </tr>
      <tr>
        <th>ICU Bed</th>
        <td><?php echo $rows['icu_bed']; ?></td>
      </tr>
      <tr>
        <th>Ventillator Bed</th>
        <td><?php echo $rows['vent_bed']; ?></td>
      </tr>
      
      <?php
        }
        if($result->num_rows == 0){
      ?>
      <h3 class="h3">No Data Available</h3>
      <?php
         }
      ?>
    </table>
     
      <div>
      <form class="updatedelete" method="post">
      <button class="update" name="update">Update</button>
      <button class="delete" name="delete">Delete</button>
      </form>
      </div> 
  </div>
  <?php
       
       $conn->close();
     ?>
</body>
</html>