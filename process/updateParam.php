<?php
if(isset($_POST['rangeHumidity'])){
    include_once('./config.php');
    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $humi = mysqli_real_escape_string($con, $_POST['rangeHumidity']);
    $updateSQL = "UPDATE parameters SET value='$humi' where name='minHumidity'";
    $result = mysqli_query($con, $updateSQL);

    //After update we need to check if the pump need to start or not
    $selectsql = "SELECT * FROM humidity ORDER BY rid DESC LIMIT 1";
    $result = mysqli_query($con, $selectsql);
    $res = 0;
    while($r = mysqli_fetch_assoc($result)){
        $res = $r['level'];
    }

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

    $currentTime = new DateTime();
    $currentTime->modify('+ 5 hour');
    if($humi > $res && $type == "OFF"){
        //need to start the pump
        $insertSql = "INSERT INTO tap_event (recordTime, type) value ('".$currentTime->format('Y-m-d H:i:s')."','1')";
        $result = mysqli_query($con, $insertSql);
    }elseif($humi < $res && $type == "ON"){
        //need to turn it off
        $insertSql = "INSERT INTO tap_event (recordTime, type) value ('".$currentTime->format('Y-m-d H:i:s')."','0')";
        $result = mysqli_query($con, $insertSql);
    }
    $con->close();
    echo 1;
}else{
    echo 0;
}
?>