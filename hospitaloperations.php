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
    $query="SELECT * FROM `hospital_operations` WHERE `hospital_code`='$hospitalid' ;";
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
        <li><a href="hospatientdetails.php">Patient Details</a></li>
        <li><a href="hospitaldetails.php">Hospital Details</a></li>
        <li><a class="active" href="hospitaloperations.php">Hospital Operations</a></li>
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
    <h1>Hospital Operations</h1>
    </div>
    </div>
    <table>
    <tr class="heading">
        <th>Hospital Code</th>
        <th>Hospital Name</th>
        <th>Hospital Address</th>
        <th>Normal Bed</th>
        <th>ICU Bed</th>
        <th>Ventillator Bed</th>
        <th>Query</th>
        <th>Date and Time</th>
    </tr>
    <?php
        if($result->num_rows > 0){
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
  </div>
  
</body>
</html>