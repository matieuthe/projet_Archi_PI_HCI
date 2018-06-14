<?php
include_once('./config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$selectsql = "SELECT value FROM parameters WHERE name='outputTap'";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $debit = $r['value']; //debit du robinet à la minute
}

$selectsql = "SELECT * FROM tap_event WHERE MONTH(recordTime) = 6 AND YEAR(recordTime) = 2018 order by recordTime";
$record = array();
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $record[] = $r; //Event occuring in a month
}

$consoMonth = 0;
$consoJournal = array();
$compteurDay=0;
$consoJournal[0] = 0;
foreach($record as $temp){
    if($temp['type'] == 1){
        $dateTemp = new DateTime($temp['recordTime']);
        if(isset($dateClose)){
            if($dateClose->format('Y-m-d') == $dateTemp->format('Y-m-d'))
                $consoJournal[++$compteurDay] = 0;
        }
    }else{
        $dateClose = new DateTime($temp['recordTime']);
        if(isset($dateTemp)){
            if($dateClose->format('Y-m-d') != $dateTemp->format('Y-m-d')){
                echo $dateClose->format('Y-m-d')." :: ".$dateTemp->format('Y-m-d')."<br>";
                $consoJournal[++$compteurDay] = 0;
            }
        }
        $diff = abs($dateTemp->getTimestamp() - $dateClose->getTimestamp())/60;
        $consoMonth += $diff * $debit;
        $consoJournal[$compteurDay] += $diff * $debit;
    }
}

echo round($consoMonth/1000,1)."m²";
echo "$compteurDay<br><br>";
foreach($consoJournal as $temp){
    echo $temp."<br>";
}
$con->close();
?>