<?php 
session_start();

include_once('../../src/common/DBConnection.php');

$conn=new DBConnection();


$selected=$_POST["select_catalog"];
$qeury="SELECT id FROM services Where type='$selected'";
$result=$conn->getOne($qeury);
$serviceID=$result['id'];
$customerID=$_SESSION['user_id'];



$date =$_POST["eventDate"];
$time =$_POST["eventTime"];
$location =$_POST["location"];

$sql = "INSERT INTO service_list ( state, Date, Time, location, service_ID, customer_ID)
VALUES ( 'pending','$date','$time','$location','$serviceID','$customerID')";

$result=$conn->execute($sql);
if($result){
header("refresh:0.00001; url=../../views/customer/requestservice.php?msg=Successfully Request Service");
}
else{
    header("refresh:0.00001; url=../../views/customer/requestservice.php?error=Unsuccessfully Requesrted");
}
?>