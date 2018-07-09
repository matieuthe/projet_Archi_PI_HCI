<?php
/*include_once('./config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Send the data of capteur on this page
//YYYY-MM-DD HH:MM:SS

//$humidityLevel = mysqli_real_escape_string($con, $_POST['humidity']);
$humidityLevel = 30;//mysqli_real_escape_string($con, $_POST['humidity']);
$date = new DateTime("2018-05-01");
while($date < new DateTime("2018-07-10 14:00:00")){
    $date->modify('+ 1 hour');
    echo $date->format('Y-m-d H:i:s')."<br>";
    $humidityLevel = rand(20, 80);
    $insertSql = "INSERT INTO humidity (recordTime, level) value ('".$date->format('Y-m-d H:i:s')."','$humidityLevel')";
    $result = mysqli_query($con, $insertSql);
}*/
?>