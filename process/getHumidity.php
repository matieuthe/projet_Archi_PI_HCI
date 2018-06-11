<?php
include_once('./config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$selectsql = "";

if(isset($_GET['date'])){
    $selectsql = "SELECT * FROM humidity ORDER BY rid DESC LIMIT 24";
}else{
    $selectsql = "SELECT * FROM humidity ORDER BY rid DESC LIMIT 24";
}

$result = mysqli_query($con, $selectsql);

$rows = array();
while($r = mysqli_fetch_assoc($result)){
    $rows[] = $r;
}
echo json_encode(array_reverse($rows));
?>