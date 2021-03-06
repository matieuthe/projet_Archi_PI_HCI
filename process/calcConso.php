<?php
if(isset($_POST['month'])){
    $monthSel = $_POST['month'];
}else{
    $currentTime = new DateTime();
    $currentTime->modify('+ 5 hour');
    $monthSel = $currentTime->format('m');
}

include_once('./config.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$selectsql = "SELECT value FROM parameters WHERE name='outputTap'";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $debit = $r['value']; //debit du robinet à la minute
}
//echo $monthSel;
$selectsql = "SELECT * FROM tap_event WHERE MONTH(recordTime)=$monthSel AND YEAR(recordTime)=2018 order by recordTime";
$record = array();
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $record[] = $r; //Event occuring in a month
}
$con->close();

$consoJournal = array();
$consoJournal[0] = 0;
$listDays = array();
$compteurDay=0;

foreach($record as $temp){
    if(count($listDays) == 0)
        $listDays[] = (new DateTime($temp['recordTime']))->format('Y-m-d');
    //Event of opening the tap
    if($temp['type'] == 1){
        $dateTemp = new DateTime($temp['recordTime']);
        if(isset($dateClose)){
            if($dateClose->format('Y-m-d') != $dateTemp->format('Y-m-d')){
                $consoJournal[++$compteurDay] = 0;
                $listDays[] = $dateTemp->format('Y-m-d');
            }
        }
    }
    //Event of closing the tap
    else{
        $dateClose = new DateTime($temp['recordTime']);
        if(isset($dateTemp)){
            if($dateClose->format('Y-m-d') != $dateTemp->format('Y-m-d')){
                $listDays[] = $dateClose->format('Y-m-d');
                //Total time between the two events
                $diffTotal = abs($dateTemp->getTimestamp() - $dateClose->getTimestamp());
                $startDay = new DateTime($dateClose->format('Y-m-d'));
                $diffStart = abs($startDay->getTimestamp() - $dateClose->getTimestamp());
                //Add conso to day before
                $consoJournal[$compteurDay] += round((($diffTotal - $diffStart) * $debit)/60);
                //Add the rest to the day after
                $consoJournal[++$compteurDay] = round(($diffStart * $debit)/60,2);
            }else{
                $diff = abs($dateTemp->getTimestamp() - $dateClose->getTimestamp());
                $consoJournal[$compteurDay] += round(($diff * $debit)/60);
            }
        }else{//If the record start by a closing event
            $startDay = new DateTime($dateClose->format('Y-m-d'));
            $diffStart = abs($startDay->getTimestamp() - $dateClose->getTimestamp());
            $consoJournal[$compteurDay] += round(($diffStart * $debit)/60,2);
        }
    }
}

$compteur = 0;
//Creation of a JSON table with the result
$str = "[";
$consoMonth = 0;
foreach($consoJournal as $temp)
    $str .= "{\"recordTime\":\"".$listDays[$compteur++]."\", \"value\": $temp},";
if($str != "[")
    echo substr($str,0,-1)."]";
else
    echo "[]";
?>