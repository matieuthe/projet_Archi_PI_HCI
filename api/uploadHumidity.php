<?php
if(isset($_GET['humidity'])){
    include_once('../process/config.php');
    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    //Get the current Time to record in database
    $currentTime = new DateTime();
    $currentTime->modify('+ 5 hour'); //Necessary to be in phnom penh time
    
    $humidityLevel = mysqli_real_escape_string($con, $_GET['humidity']);

    $insertSql = "INSERT INTO humidity (recordTime, level) value ('".$currentTime->format('Y-m-d H:i:s')."','$humidityLevel')";
    $result = mysqli_query($con, $insertSql);
}
?>