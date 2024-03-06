<?php
  session_start();
  $hospitalid=$_SESSION['hospital_id'];
?>

<?php
  require("connectdb.php");
?>

<?php 
    if(isset($_POST['logout']))
    { 
      session_destroy();
      header("location: hospitallogin.php");
    }
?>

<?php
    $query="SELECT * FROM `patientdata` WHERE `hospital_code`='$hospitalid' ;";
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
    <title>Hospital Operations</title>
</head>
<body>
<div class="navbar">
      <ul>
        <li><a href="hospitalhome.php">Home</a></li>
        <li><a class="active" href="hospatientdetails.php">Patient Details</a></li>
        <li><a href="hospitaldetails.php">Hospital Details</a></li>
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
    <div class="databorderr">
    <div class="dataa">
    <h1>Patient Details</h1>
    </div>
    </div>
    <table>
    <?php
        if($result->num_rows > 0){
        ?>
        <tr class="heading">
        <th>SRF ID</th>
        <th>Patient Name</th>
        <th>Patient Address</th>
        <th>Phone</th>
        <th>Oxygen Level</th>
        <th>Bed Type</th>
      </tr>
    <?php
        while($rows=$result->fetch_assoc())
        {
      ?>
      
      <tr>
        <td><?php echo $rows['srfid']; ?></td>
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
        echo"<script>alert('No Data Available.');</script>";
      ?>
        <h3 class="h3">No Data Available</h3>
      <?php
      }
      ?>
    </table>
  </div>
  
</body>
</html>