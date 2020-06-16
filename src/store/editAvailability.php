<?php
session_start();

if(!isset($_SESSION['user_email']) ) {
	if(!strcmp($_SESSION['user_type'], "contractors") ) {
    header("Location:../../index.php");
	}
}

include_once('../../src/common/DBConnection.php');
$conn=new DBConnection();
$CID=$_SESSION['user_id'];

$id = $_POST['dateId'];
$dateString = $_POST["available_Datee"] ;
$avaFrom=$_POST["available_fromm"];
$avaTo=$_POST["available_too"];
$date=new DateTime($dateString .' '.$avaFrom);
$nowDate =  new DateTime();


if($date >= $nowDate){
    $from = strtotime($avaFrom);
    $to = strtotime($avaTo);
    if($from - $to < 0){
        $sql = "UPDATE availability SET date = '$dateString', available_from='$avaFrom', available_to='$avaTo' WHERE availability.contractor_id = '$CID' and id='$id'";

        if ($conn->execute($sql) === TRUE) {
            echo '<script>alert("You have succesffuly updated your availability!  ")</script>'; 
            
        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }

        header("refresh:0.00001; url=../../views/Contractors/RecordAvailability.php");
    }
    else{
        echo '<script>alert("You have intered wrong period")</script>';
        header("refresh:0.00001; url=../../views/Contractors/RecordAvailability.php");
    }   
}
else{
    echo '<script>alert("Your Date is before today")</script>';
    header("refresh:0.00001; url=../../views/Contractors/RecordAvailability.php");
}
?>