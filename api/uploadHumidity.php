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

    //If the level is too low, we need to start the pump
    //Need to know if the pump is already running
    $selectsql = "SELECT type FROM tap_event ORDER BY tid DESC LIMIT 1";
    $result = mysqli_query($con, $selectsql);
    while($r = mysqli_fetch_assoc($result)){
        if($r['type'] == "1"){
            $type = "ON";
        }else{
            $type = "OFF";
        }
    }

    $selectsql = "SELECT value FROM parameters WHERE name='minHumidity'";
    $result = mysqli_query($con, $selectsql);
    while($r = mysqli_fetch_assoc($result)){
        $humi = $r['value'];
    }

    $currentTime = new DateTime();
    $currentTime->modify('+ 5 hour');
    if($humi > $humidityLevel && $type == "OFF"){
        //need to start the pump
        $insertSql = "INSERT INTO tap_event (recordTime, type) value ('".$currentTime->format('Y-m-d H:i:s')."','1')";
        $result = mysqli_query($con, $insertSql);
    }elseif($humi < $humidityLevel && $type == "ON"){
        //need to turn it off
        $insertSql = "INSERT INTO tap_event (recordTime, type) value ('".$currentTime->format('Y-m-d H:i:s')."','0')";
        $result = mysqli_query($con, $insertSql);
    }
    $con->close();
}
?>