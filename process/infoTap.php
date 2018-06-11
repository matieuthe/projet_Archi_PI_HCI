<?php
include_once('./config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$selectsql = "";

$selectsql = "SELECT value FROM parameters WHERE name='minHumidity'";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $level = $r['value'];
}

$selectsql = "SELECT type FROM tap_event ORDER BY tid DESC LIMIT 1";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    if($r['type'] == "1"){
        $type = "ON";
    }else{
        $type = "OFF";
    }
}

echo "{\"level\": $level,\"statut\": \"$type\"}";
$con->close();
?>