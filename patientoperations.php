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
    $query="SELECT * FROM `patient_operations` WHERE `srfid`='$srfid' ;";
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
    <title>Patient Operations</title>
</head>
<body>
<div class="navbar">
      <ul>
        <li><a href="userhome.php">Home</a></li>
        <li><a href="patientdetails.php">Patient Details</a></li>
        <li><a class="active" href="patientoperations.php">Operations</a></li>
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

    <div class="databorderrr">
    <div class="dataaa">
    <h1>Patient Operations</h1>
    </div>
    </div>
    <table>
    <tr class="heading">
        <th>SRF ID</th>
        <th>Hospital Code</th>
        <th>Patient Name</th>
        <th>Patient Address</th>
        <th>Phone Number</th>
        <th>Oxygen Level</th>
        <th>Bed Type</th>
        <th>Query</th>
        <th>Date and Time</th>
    </tr>
    <?php
        if($result->num_rows > 0){
        while($rows=$result->fetch_assoc())
        {
      ?>
      
      <tr>
        <td><?php echo $rows['srfid']; ?></td>
        <td><?php echo $rows['hospital_code']; ?></td>
        <td><?php echo $rows['patient_name']; ?></td>
        <td><?php echo $rows['patient_address']; ?></td>
        <td><?php echo $rows['phone']; ?></td>
        <td><?php echo $rows['oxygen_level']; ?></td>
        <td><?php echo $rows['bed_type']; ?></td>
        <td class="red"><?php echo $rows['query']; ?></td>
        <td><?php echo $rows['date']; ?></td>
      </tr>
      <?php
        }
      }
      ?>     
    </table>
    <?php
    if($result->num_rows==0)
    {
      echo"<script>alert('No Data Available.');</script>";
      ?>
    <h3 class="h3">No Data Available</h3>
    <?php
    }
    ?>
</body>
</html>