<?php
if(isset($_POST['rangeHumidity'])){
    include_once('./config.php');
    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $humi = mysqli_real_escape_string($con, $_POST['rangeHumidity']);
    $updateSQL = "UPDATE parameters SET value='$humi' where name='minHumidity'";
    $result = mysqli_query($con, $updateSQL);
    $con->close();
    echo 1;
}else{
    echo 0;
}
?>