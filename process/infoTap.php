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

$selectsql = "SELECT MAX(recordTime), MIN(recordTime) FROM humidity";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $dateLimits = $r;
}

$selectsql = " SELECT * FROM tap_event WHERE DATE(recordTime) = (SELECT MAX(DATE(recordTime)) FROM tap_event)";
$result = mysqli_query($con, $selectsql);
$valueEvent = array();
while($r = mysqli_fetch_assoc($result)){
    $valueEvent[] = $r;
}

$consoDay = 0;
$debit = 1;
$lastEvent = 0;
foreach($valueEvent as $temp){
    if($temp['type'] == 1){
        $lastEvent = 1;
        $dateTemp = new DateTime($temp['recordTime']);
    }else{
        $lastEvent = 0;
        $dateClose = new DateTime($temp['recordTime']);
        if(isset($dateTemp)){
            $diff = abs($dateTemp->getTimestamp() - $dateClose->getTimestamp())/60;
            $consoDay += $diff * $debit;
        }else{//If the record start by a closing event
            $startDay = new DateTime($dateClose->format('Y-m-d'));
            $diffStart = abs($startDay->getTimestamp() - $dateClose->getTimestamp())/60;
            $consoDay += $diffStart * $debit;
        }
    }
}

echo "{\"level\": $level,\"statut\": \"$type\", \"dateMin\": \""
    .$dateLimits['MIN(recordTime)']."\", \"dateMax\": \""
    .$dateLimits['MAX(recordTime)']."\",\"consoDay\":".
    $consoDay."}";
$con->close();
?>