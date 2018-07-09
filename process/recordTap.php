<?php
/*include_once('./config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$aleatType=1;

$date = new DateTime("2018-05-01");
while($date < new DateTime("2018-07-10 14:00:00")){
    $randTime = rand(1,4);    
    $date->modify("+ $randTime hour");

    $humidityLevel = rand(20, 80);
    $insertSql = "INSERT INTO tap_event (recordTime, type) value ('".$date->format('Y-m-d H:i:s')."','$aleatType')";
    $result = mysqli_query($con, $insertSql);
    if($aleatType == 0) $aleatType = 1;
    else $aleatType = 0;
}
$con->close();
*/
?>