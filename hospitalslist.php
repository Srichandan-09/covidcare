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
    $quer="SELECT * FROM `hospital_data`;";
    $result=$conn->query($quer);
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
        <li><a href="patientdetails.php">Patient Details</a></li>
        <li><a href="patientoperations.php">Operations</a></li>
        <li><a class="active" href="hospitalslist.php">Hospital Information</a><li>
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
    <div>
        <div class="databorderr">
            <div class="dataa">
                <h1>Hospital Information</h1>
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
          </tr>
      <?php
        }
      }
      $conn->close();
      ?>
    </div>
  
</body>
</html>