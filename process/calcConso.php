<?php
include_once('./config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$selectsql = "SELECT value FROM parameters WHERE name='outputTap'";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $debit = $r['value']; //debit du robinet à la minute
}

$selectsql = "SELECT * FROM tap_event WHERE MONTH(recordTime) = 06 AND YEAR(recordTime) = 2018 order by recordTime";
$record = array();
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $record[] = $r; //Event occuring in a month
}

$consoJournal = array();
$consoJournal[0] = 0;

$compteurDay=0;
$consoMonth = 0;

foreach($record as $temp){
    //Event of opening the tap
    if($temp['type'] == 1){
        $dateTemp = new DateTime($temp['recordTime']);
        if(isset($dateClose)){
            if($dateClose->format('Y-m-d') != $dateTemp->format('Y-m-d')){
                $consoJournal[++$compteurDay] = 0;
            }
        }
    }
    //Event of closing the tap
    else{
        $dateClose = new DateTime($temp['recordTime']);
        if(isset($dateTemp)){
            if($dateClose->format('Y-m-d') != $dateTemp->format('Y-m-d')){
                //Total time between the two events
                $diffTotal = abs($dateTemp->getTimestamp() - $dateClose->getTimestamp())/60;
                $startDay = new DateTime($dateClose->format('Y-m-d'));
                $diffStart = abs($startDay->getTimestamp() - $dateClose->getTimestamp())/60;
                //Add conso to day before
                $consoJournal[$compteurDay] += ($diffTotal - $diffStart) * $debit;
                //Add the rest to the day after
                $consoJournal[++$compteurDay] = $diffStart * $debit;
            }else{
                $diff = abs($dateTemp->getTimestamp() - $dateClose->getTimestamp())/60;
                $consoJournal[$compteurDay] += $diff * $debit;
            }
        }else{//If the record start by a closing event
            $startday = $dateClose->format('Y-m-d');
            $diffStart = abs($startDay->getTimestamp() - $dateClose->getTimestamp())/60;
            $consoJournal[$compteurDay] += $diffStart * $debit;
        }
    }
}

echo "$compteurDay<br><br>";
foreach($consoJournal as $temp){
    echo $temp."<br>";
}
$con->close();
?>