<?php
include_once('./config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$selectsql = "";

if(isset($_GET['date']) && $_GET['date'] != ""){
    $dateEnter = mysqli_real_escape_string($con, $_GET['date']);
    $selectsql = "SELECT * FROM humidity WHERE DATE(recordTime)='$dateEnter' ORDER BY rid DESC";
}else{
    $selectsql = "SELECT * FROM humidity ORDER BY rid DESC LIMIT 30";
}

$result = mysqli_query($con, $selectsql);

$rows = array();
while($r = mysqli_fetch_assoc($result)){
    $rows[] = $r;
}
echo json_encode($rows);
$con->close();
?>