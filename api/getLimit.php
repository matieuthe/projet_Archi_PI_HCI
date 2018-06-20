<?php
include_once('../process/config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$selectsql = "SELECT value FROM parameters WHERE name='minHumidity'";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $minVal = $r['value'];
}

$selectsql = "SELECT * FROM humidity ORDER BY recordTime DESC LIMIT 1";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $level = $r['level'];
}

if($level < $minVal){
    echo "1"; //open the tap
}else{
    echo "0"; //Close the tap
}
?>