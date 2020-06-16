<?php

session_start();
if(!isset($_SESSION['user_email']) ) {
    header("Location:../../index.php");
}


$cid=$_SESSION['user_id'];

include '../../src/common/DBConnection.php';

$conn=new DBConnection();

$dateString=$_POST['eventDate'];
$avaFrom=$_POST['eventTime'];
$avaTo=$_POST['eventTime2'];
$date=new DateTime($dateString.' '.$avaFrom);
$nowDate = new DateTime();
if($date >= $nowDate){
    $from = strtotime($avaFrom);
    $to = strtotime($avaTo);
    if($from - $to < 0){
        $query=" INSERT INTO `availability`(`contractor_id`, `date`, `available_from`, `available_to`) 
        VALUES( '$cid', '$dateString', '$avaFrom' ,'$avaTo' ) ";
                                    
        $result = $conn->execute($query);
        if($result) {
            header("Location: " ."../../views/Contractors/RecordAvailability.php?msg=success");

        } else {
            header("Location: " ."../../views/Contractors/RecordAvailability.php?error=failed to insert");

        }
    }
    else{
        header("Location: " ."../../views/Contractors/RecordAvailability.php?error=you have intered wrong period");
    }
}
else{
    header("Location: " ."../../views/Contractors/RecordAvailability.php?error=Your Date in before today");
}
?>
