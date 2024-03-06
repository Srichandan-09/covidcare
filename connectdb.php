<?php
    $servername="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="covidcare";

    $conn= mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
    $con= mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
    if(!$conn){
        die("Database not Connected: ".mysqli_connect_error());
    }

    if(!$con){
        die("Database not Connected: ".mysqli_connect_error());
    }
?>